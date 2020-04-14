import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner } from 'reactstrap';
import Peer from 'simple-peer';
import axios from 'axios';
import { FaDesktop, FaCamera, FaComments, FaHandPaper } from "react-icons/fa";
import Swal from 'sweetalert2';

// Components
import MediaHandler from '../../MediaHandler';
import PanelChat from './Chat/PanelChat/PanelChat'
// import Message from './Chat/Message/Message';
import ListMiniVideo from './ListMiniVideo/ListMiniVideo';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken};

export default class VideoConference extends Component {

    constructor(props) {
        super(props);

        this.state = {
            peerIniciator: true,
            userList: window.userList,
            userListActive: [],
            miniVideoActive: window.user.id,
            userStream: null,
            userStreamName: 'desktop',
            userScreenCamera: null,
            userScreenCapture: null,
            displayChat: false,
            handUp : false
        };

        const warning = () => {
            console.log('Exit')
        }
        window.onbeforeunload = warning;

        this.user = window.user;
        this.userList = this.state.userList;
        this.peers = [];

        // Bindings
        this.mediaHandler = new MediaHandler();
        this.startCall = this.startCall.bind(this);
        this.setStream = this.setStream.bind(this);
        this.changeMiniVideoActive = this.changeMiniVideoActive.bind(this);
        this.screenCapture = this.screenCapture.bind(this);
        this.handUp = this.handUp.bind(this);

        // Channels
        Echo.channel(`RequestStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\RequestStreamUser', (e) => {
            this.setState({peerIniciator: false});
            setTimeout(() => {
                this.startCall(e.user_emisor)
            }, 100);
            setTimeout(() => {
                this.peers[e.user_emisor.id].signal(e.stream)
            }, 100);
        });

        Echo.channel(`ResponseStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\ResponseStreamUser', (e) => {
            this.peers[e.user_emisor.id].signal(e.stream)
        });

        Echo.channel(`UserHandUpChannel`)
        .listen('.App\\Events\\Telematic\\UserHandUp', (e) => {
            let userList = this.state.userListActive;
            userList.map((user)=>{
                if(user.id==e.data.user_id){
                    user.handUp = e.data.value;
                }
            });
            this.setState({userListActive: userList});
        });
    }

    componentWillMount() {
        this.mediaHandler.getPermissions()
        .then((stream) => {
            let newUser = {
                id: this.user.id,
                name: this.user.name,
                stream: stream,
                handUp: false
            }
            let userList = this.state.userListActive;
            userList.push(newUser);
            this.setState({userListActive: userList, userStream: stream, userScreenCamera: stream});
            this.setStream(this.user.id, stream);

            document.getElementById("audio-join").play();
            setTimeout(() => {
                this.userList.map(user=>{
                    this.startCall(user);
                })
            }, 100);
        });
    }

    startCall(user){
        this.peers[user.id] = new Peer({
            initiator: this.state.peerIniciator,
            trickle: false,
            stream: this.state.userStream
        })
        
        this.peers[user.id].on('signal', (data) => {
            // Si es el iniciador envía su token al receptor
            if(this.state.peerIniciator){
                axios({
                    method: 'post',
                    url: 'videochats/request',
                    data: {
                        type: 'request', emisorId: this.user.id, receptId: user.id, stream: JSON.stringify(data)
                    }
                })
            }
            // Si es el receptor de la llamada al recibir el token del iniciaor genera el suyo y se lo envía para abrir la cpexión
            else{
                axios({
                    method: 'post',
                    url: 'videochats/request',
                    data: {
                        type: 'response', emisorId: this.user.id, receptId: user.id, stream: JSON.stringify(data)
                    }
                })
            }
        })
        
        this.peers[user.id].on('stream', (stream) => {
            let newUser = {
                id: user.id,
                name: user.name,
                stream: stream,
                handUp: false
            }
            let userList = this.state.userListActive.filter(item=>item.id!=user.id);
            userList.push(newUser);
            this.setState({userListActive: userList});
            console.log(`Se unió ${user.name}`)
            if(!this.state.peerIniciator){
                document.getElementById("audio-join").play();
            }

            var video = document.getElementById(`video-${user.id}`)
            try {video.srcObject = stream;} catch (e) {video.src = URL.createObjectURL(stream);}
            video.play();
        })

        this.peers[user.id].on('error', (err) => {
            console.log(`Cerró sesión ${user.name}`)
            let userList = this.state.userListActive.filter(item=>item.id!=user.id);
            this.setState({ userListActive: userList });
        })
    }

    setStream(id, stream){
        var myVideo = document.getElementById(`video-${id}`);
        var mainVideo = document.getElementById('mainVideo');
        try {
            myVideo.srcObject = stream;
            mainVideo.srcObject = stream;
        } catch (e) {
            myVideo.src = URL.createObjectURL(stream);
            mainVideo.src = URL.createObjectURL(stream);
        }
        myVideo.play();
        mainVideo.play();
    }

    changeMiniVideoActive(id){
        this.setState({miniVideoActive: id});
        var video = document.getElementById('mainVideo')
        var stream = id == this.user.id ? this.state.userStream : this.peers[id].streams[0]
        try {video.srcObject = stream;} catch (e) {video.src = URL.createObjectURL(stream);}
        video.play();
        // console.log(id)
    }

    async screenCapture(){
        let userStreamNameActive = this.state.userStreamName == 'camera' ? 'desktop' : 'camera';
        this.setState({
            userStreamName: userStreamNameActive
        });
        if(userStreamNameActive=='camera'){
            try {
                var mediaStream = await navigator.mediaDevices.getDisplayMedia({video: true, audio: true });
                this.setState({userStream: mediaStream, userScreenCapture: mediaStream});
                this.setStream(this.user.id, mediaStream);
                let oldVideoTrack = this.state.userScreenCamera.getVideoTracks()[0];
                let newVideoTrack = mediaStream.getVideoTracks()[0];
                this.peers.map(peer=>{
                    peer.replaceTrack(oldVideoTrack, newVideoTrack, peer.streams[0])
                })
            } catch (e) {
                console.log('Unable to acquire screen capture: ' + e);
                this.setState({
                    userStreamName: 'desktop'
                });
            }
        }else{
            let oldVideoTrack = this.state.userScreenCapture.getVideoTracks()[0];
            let newVideoTrack = this.state.userScreenCamera.getVideoTracks()[0];
            this.peers.map(peer=>{
                peer.replaceTrack(oldVideoTrack, newVideoTrack, peer.streams[0])
            })
            this.setState({userStream: this.state.userScreenCamera});
            this.setStream(this.user.id, this.state.userScreenCamera);
        }
    }

    handUp(){
        this.setState({handUp: !this.state.handUp});
        axios({
            method: 'post',
            url: 'videochats/hand_up',
            data: {
                user_id: this.user.id, value: !this.state.handUp
            }
        })
    }

    render() {

        return (
            <div style={{ width: '100%', height: '100%', backgroundColor: '#000' }}>
                <video id='mainVideo' muted style={{ width: '100%', height: `${window.innerHeight}px` }} />
                <ListMiniVideo
                    userListActive={this.state.userListActive}
                    changeMiniVideoActive={(id) => this.changeMiniVideoActive(id)}
                    userID={this.user.id}
                    miniVideoActive={this.state.miniVideoActive}
                />
                <div style={{ position: 'fixed', right: 20, bottom: 60 }}>
                    <button
                        type="button"
                        style={{ backgroundColor: 'transparent', color: '#57BB59', fontSize: 35, border: 'none', display: !this.state.displayChat ? 'block' : 'none' }}
                        onClick={()=>this.screenCapture()}
                    >
                        { this.state.userStreamName == 'camera' ? <FaCamera /> : <FaDesktop /> }
                    </button>
                    <button
                        type="button"
                        style={{ backgroundColor: 'transparent', color: this.state.handUp ? '#E3522B' : '#57BB59', fontSize: 35, border: 'none', }}
                        onClick={()=>this.handUp()}
                    >
                        <FaHandPaper />
                    </button>
                    <button
                        type="button"
                        style={{ backgroundColor: 'transparent', color: '#57BB59', fontSize: 40, border: 'none', display: !this.state.displayChat ? 'block' : 'none' }}
                        onClick={()=>this.setState({displayChat: !this.state.displayChat})}
                    >
                        <FaComments />
                    </button>
                </div>
                <PanelChat
                    user={this.user}
                    displayChat={this.state.displayChat}
                    onDismisPanelChat={()=>this.setState({displayChat: !this.state.displayChat})}
                />
                <div style={{ position: 'fixed', left: 0, right: 0, bottom: 0, height: 50, textAlign: 'left', backgroundColor: 'rgba(0,0,0,0.6)' }}>
                    <h4 style={{ color: '#fff', marginLeft: 30, margin: 10 }}>Video conferencia LoginWeb</h4>
                </div>
                <audio id="audio-newMessage" src="/audio/chat/newMessage.mp3"></audio>
                <audio id="audio-join" src="/audio/chat/join.mp3"></audio>
            </div>
        )
    }
}

if (document.getElementById('videoconference')) {
    ReactDOM.render(<VideoConference />, document.getElementById('videoconference'));
}