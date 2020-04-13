import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner } from 'reactstrap';
import Peer from 'simple-peer';
import axios from 'axios';
import { FaRegPaperPlane, FaArrowRight, FaComments } from "react-icons/fa";

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
            userScreenCapture: null,
            displayChat: false,
            // inputMessage: '',
            // messageList : [],
            // detailChat: {
            //     userName: '',
            //     display: 'none'
            // }
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
        // this.handleInpuMessage = this.handleInpuMessage.bind(this);
        // this.submitMessage = this.submitMessage.bind(this);

        // Channels
        Echo.channel(`RequestStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\RequestStreamUser', (e) => {
            this.setState({peerIniciator: false});
            this.startCall(e.user_emisor)
            setTimeout(() => {
                this.peers[e.user_emisor.id].signal(e.stream)
            }, 200);
            // console.log(this.peers)
        });

        Echo.channel(`ResponseStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\ResponseStreamUser', (e) => {
            try {
                this.peers[e.user_emisor.id].signal(e.stream)
            } catch (error) {}
            
            // console.log(this.peers)
        });

        // Echo.channel(`NewMessageChannel`)
        // .listen('.App\\Events\\Telematic\\NewMessage', (e) => {
        //     let messageList = this.state.messageList;
        //     messageList.push(e.data);
        //     this.setState({messageList});
            
        //     let offsetHeight = document.getElementById("panel-chat-messages").offsetHeight;
        //     let scrollTop = document.getElementById("panel-chat-messages").scrollTop
        //     let scrollHeight = document.getElementById("panel-chat-messages").scrollHeight
        //     let posAct = offsetHeight + scrollTop;
        //     let redirectToBottom = scrollHeight - posAct <= 200 ? true : false;
        //     setTimeout(() => {
        //         if(redirectToBottom){
        //             document.getElementById("panel-chat-messages").scrollTo({ top: scrollHeight, behavior: 'smooth' });
        //         }
        //     }, 250);
        //     let typingUser = {userName: '', display: 'none'}
        //     this.setState({detailChat: typingUser});
        //     if(e.data.user.id != this.user.id){
        //         document.getElementById("audio-newMessage").play();
        //     }
            
        // });

        // Echo.channel(`NewMessageTypingChannel`)
        // .listen('.App\\Events\\Telematic\\NewMessageTyping', (e) => {
        //     if(this.user.id != e.user.id && this.state.detailChat.display == 'none'){
        //         let typingUser = {userName: e.user.name, display: 'block'}
        //         this.setState({detailChat: typingUser});
        //         setTimeout(() => {
        //             let typingUser = {userName: '', display: 'none'}
        //             this.setState({detailChat: typingUser});
        //         }, 2000);
        //     }
        // });
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
        setTimeout(() => {
            document.getElementById("audio-join").play();
        }, 100);
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

    // handleInpuMessage(event){
    //     this.setState({inputMessage: event.target.value});
    //     axios({
    //         method: 'post',
    //         url: 'videochats/message/typing',
    //         data: {
    //             user: {id: this.user.id, name: this.user.name}
    //         }
    //     })
    // }

    // submitMessage(event) {
    //     event.preventDefault();
    //     let dateTime = new Date()
    //     let date = `${dateTime.getHours()}:${dateTime.getMinutes()}:${dateTime.getSeconds()}`;
    //     let message = this.state.inputMessage;
    //     this.setState({inputMessage: ''});
    //     if(this.state.inputMessage){
    //         axios({
    //             method: 'post',
    //             url: 'videochats/message',
    //             data: {
    //                 user: {id: this.user.id, name: this.user.name}, message, date
    //             }
    //         })
    //         .then(res=>{
                
    //         });
    //     }
    // }

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
                {/* <div style={{ position: 'fixed', right: 0, bottom: 0, height: window.innerHeight, overflowY: 'hidden', width: 350, backgroundColor: 'rgba(0,0,0,0.8)' }}>
                    <div style={{ position: 'absolute', width: '100%', height: window.innerHeight, marginTop: 10 }}>
                        <div style={{ marginLeft: 20, marginBottom: 20 }}>
                            <button type="button" style={{ backgroundColor: 'transparent', color: '#fff', fontSize: 25, border: 'none' }}><FaArrowRight /></button>
                        </div>
                        <div id="panel-chat-messages" style={{  height: window.innerHeight-150, overflowY: 'auto', scrollbarColor: '#EAEAEA rgba(0,0,0,0.8)', scrollbarWidth: 5 }}>
                            {
                                this.state.messageList.map(item=>{
                                    return(
                                        <Message
                                            key={ `${item.user.id}_${Math.floor(Math.random() * 100000)}` }
                                            type={item.user.id == this.user.id ? 'sent' : 'received' }
                                            name={item.user.name}
                                            message={item.message}
                                            date={item.date}
                                        />
                                    )
                                })
                            }
                        </div>
                        <form onSubmit={this.submitMessage}>
                            <div className="input-group">
                                <input type="text" className="form-control" placeholder="Escribe algo..." value={this.state.inputMessage} onChange={this.handleInpuMessage} />
                                <div className="input-group-append">
                                    <button className="btn btn-success" type="submit"><FaRegPaperPlane /></button>
                                </div>
                            </div>
                        </form>
                        <small style={{ marginTop: 5, color: 'green', display: this.state.detailChat.display }}>{this.state.detailChat.userName} está escribiendo...</small>
                    </div>
                </div> */}
                {/* <div style={{ position: 'fixed', left: 20, right: 20, bottom: 0, height: 50, textAlign: 'left', backgroundColor: 'rgba(0,0,0,0.6)' }}>
                    <h4 style={{ color: '#fff', marginTop: 10 }}>Video conferencia LoginWeb</h4>
                    <button onClick={()=>this.screenCapture(true)}>Mostrar pantalla</button>
                    <button onClick={()=>this.screenCapture(false)}>Mostrar cámara</button>
                </div> */}
                <audio id="audio-newMessage" src="/audio/chat/newMessage.mp3"></audio>
                <audio id="audio-join" src="/audio/chat/join.mp3"></audio>
            </div>
        )
    }
}

if (document.getElementById('videoconference')) {
    ReactDOM.render(<VideoConference />, document.getElementById('videoconference'));
}