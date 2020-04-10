import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner } from 'reactstrap';
import MediaHandler from '../../MediaHandler';
import getUserMedia from 'getusermedia';
import Peer from 'simple-peer';
import axios from 'axios';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken};

export default class VideoConference extends Component {

    constructor(props) {
        super(props);

        this.state = {
            peerIniciator: true,
            userList: window.userList,
            userListActive: [],
            miniVideoActive: window.user.id
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
            }, 250);
            // console.log(this.peers)
        });

        Echo.channel(`ResponseStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\ResponseStreamUser', (e) => {
            this.peers[e.user_emisor.id].signal(e.stream)
            // console.log(this.peers)
        });
    }

    componentWillMount() {
        this.mediaHandler.getPermissions()
        .then((stream) => {
            let newUser = {
                id: this.user.id,
                name: this.user.name,
                stream: stream
            }
            let userList = this.state.userListActive;
            userList.push(newUser);
            this.setState({userListActive: userList});
            var myVideo = document.getElementById(`video-${this.user.id}`);
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
            this.peers[this.user.id] = stream;
        });
        this.userList.map(user=>{
            this.startCall(user);
        })
    }

    startCall(user, mediaStream = null){
        
        getUserMedia({ video: true, audio: true }, (err, stream) => {
            if (err) return console.error(err)
            this.peers[user.id] = new Peer({
                initiator: this.state.peerIniciator,
                trickle: false,
                stream: mediaStream ? mediaStream : stream 
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
          
                try {
                    video.srcObject = stream;
                } catch (e) {
                    video.src = URL.createObjectURL(stream);
                }
                video.play();
                this.peers[user.id] = stream;
            })

            this.peers[user.id].on('close', () => {
                console.log(`Close ${user.name}`)
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
        video.play()
    }

    async screenCapture(){
        try {
            let mediaStream = await navigator.mediaDevices.getDisplayMedia({video:true, audio: true});
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
            this.setState({peerIniciator: true});
            this.userList.map(user=>{
                this.startCall(user, mediaStream);
            });
            this.peers[this.user.id] = mediaStream;
        } catch (e) {
            console.log('Unable to acquire screen capture: ' + e);
        }
    }

    render() {
        return (
            <div style={{ width: '100%', height: '100%', backgroundColor: '#000' }}>
                <video id='mainVideo' muted style={{ width: '100%', height: `${window.innerHeight}px` }} />
                <div style={{ position: 'fixed', left: 20, top: 20, bottom: 30, height: `${window.innerHeight}px`, overflowY: 'auto' }}>
                {
                    this.state.userListActive.map(user=>{
                        return( 
                            <div key={user.id} id={`containerVideo-${user.id}`} style={{position: 'relative', width: '100px', textAlign: 'center', }}>
                                <video
                                    id={`video-${user.id}`}
                                    muted={this.user.id == user.id ? 'muted' : false}
                                    width="100%"
                                    style={this.state.miniVideoActive == user.id ? style.miniVideoActive : style.miniVideo}
                                    onClick={()=>this.changeMiniVideoActive(user.id)}
                                />
                                <div style={{ position: 'absolute', left: 5, bottom: 8, color: '#fff', fontSize: 11 }}>
                                    { user.name }
                                </div>
                            </div>
                        )
                    })
                }
                </div>
                <div style={{ position: 'fixed', left: 0, right: 20, bottom: 20, textAlign: 'right' }}>
                    <button onClick={()=>this.screenCapture()}>Mostrar pantalla</button>
                </div>
            </div>
        )
    }
}

const style = {
    miniVideo: {
        backgroundColor: '#000',
        cursor: 'pointer',
        borderRadius: 5,
        height: 60,
        border: 'solid 2px #616161',
    },
    miniVideoActive: {
        backgroundColor: '#000',
        cursor: 'pointer',
        borderRadius: 5,
        height: 60,
        border: 'solid 2px #39E23C',
    }
};

if (document.getElementById('videoconference')) {
    ReactDOM.render(<VideoConference />, document.getElementById('videoconference'));
}