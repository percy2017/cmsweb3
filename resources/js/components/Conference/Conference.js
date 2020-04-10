import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner } from 'reactstrap';
import MediaHandler from '../../MediaHandler';
import getUserMedia from 'getusermedia';
import Peer from 'simple-peer';
import axios from 'axios';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken};

export default class Conference extends Component {

    constructor(props) {
        super(props);

        this.state = {
            peerIniciator: true,
            userList: window.userList,
            userListActive: [],
            miniVideoActive: window.user.id
        };

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
            this.startCall(e.user_id_emisor)
            setTimeout(() => {
                this.peers[e.user_id_emisor].signal(e.stream)
            }, 250);
            // console.log(this.peers)
        });

        Echo.channel(`ResponseStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\ResponseStreamUser', (e) => {
            this.peers[e.user_id_emisor].signal(e.stream)
            // console.log(this.peers)
        });
    }

    componentWillMount() {
        this.mediaHandler.getPermissions()
        .then((stream) => {
            let newUser = {
                id: this.user.id,
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
            this.startCall(user.id);
        })
    }

    startCall(userID, mediaStream = null){
        
        getUserMedia({ video: true, audio: true }, (err, stream) => {
            if (err) return console.error(err)
            this.peers[userID] = new Peer({
                initiator: this.state.peerIniciator,
                trickle: false,
                stream: mediaStream ? mediaStream : stream
            })
            
            this.peers[userID].on('signal', (data) => {
                if(this.state.peerIniciator){
                    axios({
                        method: 'post',
                        url: 'videochats/request',
                        data: {
                            'type': 'request', emisorId: this.user.id, receptId: userID, stream: JSON.stringify(data)
                        }
                    })
                }else{
                    axios({
                        method: 'post',
                        url: 'videochats/request',
                        data: {
                            'type': 'response',
                            emisorId: this.user.id, receptId: userID,
                            stream: JSON.stringify(data)
                        }
                    })
                }
            })
          
            this.peers[userID].on('stream', (stream) => {
                try {
                    document.getElementById(`containerVideo-${userID}`).remove();
                } catch (error) {}

                let newUser = {
                    id: userID,
                    stream: stream
                }
                let userList = this.state.userListActive;
                userList.push(newUser);
                this.setState({userListActive: userList});
                var video = document.getElementById(`video-${userID}`)
          
                try {
                    video.srcObject = stream;
                } catch (e) {
                    video.src = URL.createObjectURL(stream);
                }
                video.play();
                this.peers[userID] = stream;
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
            let mediaStream = await navigator.mediaDevices.getDisplayMedia({video:true});
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
                this.startCall(user.id, mediaStream);
            });
            this.peers[this.user.id] = mediaStream;
        } catch (e) {
            console.log('Unable to acquire screen capture: ' + e);
        }
    }

    render() {
        return (
            <div style={{ width: '100%', height: '100%', backgroundColor: '#000' }}>
                <video id='mainVideo' style={{ width: '100%', height: `${window.innerHeight}px` }} />
                <div style={{ position: 'fixed', left: 20, top: 20, bottom: 30, height: `${window.innerHeight}px`, overflowY: 'auto' }}>
                
                {
                    this.state.userListActive.map(user=>{
                        return( 
                            <div key={user.id} id={`containerVideo-${user.id}`} style={{ width: '100px' }}>
                                <video
                                    id={`video-${user.id}`}
                                    muted='muted'
                                    width="100%"
                                    style={this.state.miniVideoActive == user.id ? style.miniVideoActive : style.miniVideo}
                                    onClick={()=>this.changeMiniVideoActive(user.id)}
                                />
                            </div>
                        )
                    })
                }
                </div>
                <div style={{ position: 'fixed', left: 0, right: 0, bottom: 20, textAlign: 'center' }}>
                    <button onClick={()=>this.screenCapture()}>Mostrar pantalla</button>
                </div>
            </div>
        )
    }
}

const style = {
    // containerMiniVideo: {
    //     cursor: 'pointer'
    // },
    miniVideo: {
        cursor: 'pointer',
        borderRadius: 5,
    },
    miniVideoActive: {
        cursor: 'pointer',
        borderRadius: 5,
        border: 'solid 5px green',
    }
};

if (document.getElementById('example')) {
    ReactDOM.render(<Conference />, document.getElementById('example'));
}