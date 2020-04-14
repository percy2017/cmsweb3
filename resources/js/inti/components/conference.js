import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import 'bootstrap/dist/css/bootstrap.css';
import Peer from 'simple-peer';
import axios from 'axios';
import { FaRegPaperPlane, FaArrowRight, FaComments } from "react-icons/fa";

// Components
import MediaHandler from './extras/MediaHandler';
import PanelChat from './extras/PanelChat'
import ListMiniVideo from './extras/ListMiniVideo';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken};

export default class VideoConference extends Component {

    constructor(props) {
        super(props);
        this.state = {
            peerIniciator: true,
            userList: window.userList,
            userListActive: [],
            miniVideoActive: window.user.id,
            userScreenCapture: null,
            displayChat: false,
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
        this.changeMiniVideoActive = this.changeMiniVideoActive.bind(this);
        this.screenCapture = this.screenCapture.bind(this);

        // Channels
        Echo.channel(`RequestStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\RequestStreamUser', (e) => {
            this.setState({peerIniciator: false});
            this.startCall(e.user_emisor)
            setTimeout(() => {
                this.peers[e.user_emisor.id].signal(e.stream)
            }, 200);
        });

        Echo.channel(`ResponseStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\ResponseStreamUser', (e) => {
            try {
                this.peers[e.user_emisor.id].signal(e.stream)
            } catch (error) {}
        });
    }

    startCall(user){
        this.mediaHandler.getPermissions()
        .then((stream) => {
            this.peers[user.id] = new Peer({
                initiator: this.state.peerIniciator,
                trickle: false,
                stream: this.state.userScreenCapture ? this.state.userScreenCapture : stream
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
                    stream: stream
                }
                let userList = this.state.userListActive.filter(item=>item.id!=user.id);
                userList.push(newUser);
                this.setState({userListActive: userList});
                var video = document.getElementById(`video-${user.id}`)
                console.log(`Se unió ${user.name}`)
                if(!this.state.peerIniciator){
                    document.getElementById("audio-join").play();
                }
                try {
                    video.srcObject = stream;
                } catch (e) {
                    video.src = URL.createObjectURL(stream);
                }
                video.play();
                this.peers[user.id] = stream;
            })

            this.peers[user.id].on('data', (data) => {

            })

            this.peers[user.id].on('error', (err) => {
                console.log(`Cerró sesión ${user.name}`)
                let userList = this.state.userListActive.filter(item=>item.id!=user.id);
                this.setState({ userListActive: userList });
            })
        })
    }

    changeMiniVideoActive(id){
        this.setState({miniVideoActive: id});
        var video = document.getElementById('mainVideo')
        try {
            video.srcObject = this.peers[id];
        } catch (e) {
            video.src = URL.createObjectURL(this.peers[id]);
        }
        video.play();
    }

    async screenCapture(value){
        try {
            let mediaStream = value ?
                                await navigator.mediaDevices.getDisplayMedia({video: true, audio: true }) :
                                await navigator.mediaDevices.getUserMedia({video: true, audio: true });
            var myVideo = document.getElementById(`video-${this.user.id}`);
            var mainVideo = document.getElementById('mainVideo');
            try {
                myVideo.srcObject = mediaStream;
                mainVideo.srcObject = mediaStream;
            } catch (e) {
                myVideo.src = URL.createObjectURL(mediaStream);
                mainVideo.src = URL.createObjectURL(mediaStream);
            }
            myVideo.play();
            mainVideo.play();
            this.setState({peerIniciator: true, userScreenCapture: value ? mediaStream : null});
            setTimeout(() => {
                this.userList.map(user=>{
                    if(user.id!=this.user.id){
                        this.startCall(user);
                    }
                });
            }, 100);
            this.peers[this.user.id] = mediaStream;
        } catch (e) {
            console.log('Unable to acquire screen capture: ' + e);
        }
    }

    render() {
        return (
            <div style={{ width: '100%', height: '100%', backgroundColor: '#000' }}>
                <video id='mainVideo' muted style={{ width: '100%', height: `${window.innerHeight}px` }} />
                <ListMiniVideo
                    userListActive={this.state.userListActive}
                    onClick={()=>this.changeMiniVideoActive(user.id)}
                    userID={this.user.id}
                    miniVideoActive={this.state.miniVideoActive}
                />
                <div style={{ position: 'fixed', right: 20, bottom: 50 }}>
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
                <audio id="audio-newMessage" src="/audio/chat/newMessage.mp3"></audio>
                <audio id="audio-join" src="/audio/chat/join.mp3"></audio>
            </div>
        )
    }
}

if (document.getElementById('conference')) {
    ReactDOM.render(<VideoConference />, document.getElementById('conference'));
}