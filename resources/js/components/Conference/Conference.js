import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner } from 'reactstrap';
import MediaHandler from '../../MediaHandler';
import getUserMedia from 'getusermedia';
import Peer from 'simple-peer';
import axios from 'axios';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken};

var simulateClick = (elem) => {
	// Create our event (with options)
	var evt = new MouseEvent('click', {
		bubbles: true,
		cancelable: true,
		view: window
	});
	// If cancelled, don't dispatch our event
	var canceled = !elem.dispatchEvent(evt);
};

var PEERS = [];

export default class VideoConference extends Component {

    constructor(props) {
        super(props);
        this.state = {
            peerIniciator: true,
            userList: window.userList,
            userListActive: [],
            miniVideoActive: window.user.id,
        };

        this.user = window.user;
        this.userList = this.state.userList;
        this.peers = [];

        // Bindings
        this.mediaHandler = new MediaHandler();
        this.startCall = this.startCall.bind(this);

        // Channels
        Echo.channel(`RequestStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\RequestStreamUser', (e) => {
            this.setState({peerIniciator: false});
            this.startCall(e.user_id_emisor)
            setTimeout(() => {
                this.peers[e.user_id_emisor].signal(e.stream)
            }, 250);
            console.log(this.peers)
        });

        Echo.channel(`ResponseStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\ResponseStreamUser', (e) => {
            this.peers[e.user_id_emisor].signal(e.stream)
            console.log(this.peers)
        });
    }

    componentWillMount() {
        // this.mediaHandler.getPermissions()
        // .then((stream) => {
        //     var myVideo = document.getElementById(`userVideo-${this.user.id}`);
        //     var mainVideo = document.getElementById('mainVideo');
        //     PEERS[this.user.id] = stream;
        //     try {
        //         myVideo.srcObject = stream;
        //         mainVideo.srcObject = stream;
        //     } catch (e) {
        //         myVideo.src = URL.createObjectURL(stream);
        //         mainVideo.src = URL.createObjectURL(stream);
        //     }
        //     myVideo.play();
        //     mainVideo.play();
        // });
        this.userList.map(user=>{
            this.startCall(user.id);
        })
    }

    startCall(userID){
        getUserMedia({ video: true, audio: true }, (err, stream) => {
            if (err) return console.error(err)
            this.peers[userID] = new Peer({
                initiator: this.state.peerIniciator,
                trickle: false,
                stream: stream
            })
          
            this.peers[userID].on('signal', (data) => {
                // document.getElementById('yourId').value = JSON.stringify(data);
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
                video.play()
            })
        })
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    {
                        this.state.userListActive.map(user=>{
                            return(
                                <div className="col-md-4">
                                    <div className="card">
                                        <div className="card-header">{`VideoChat user ID:${user.id}`}</div>
                                        <div className="card-body">
                                            <video id={`video-${user.id}`} width="100%" />
                                        </div>
                                    </div>
                                </div>
                            )
                        })
                    }
                    {/* <div className="col-md-4">
                        <div className="card">
                            <div className="card-header">VideoChat</div>
                            <div className="card-body" id="card">
                                <video id="video" width="100%" />
                            </div>
                        </div>
                    </div> */}
                </div>
            </div>
        )
    }
}

const style = {
    containerMiniVideo: {
        cursor: 'pointer'
    },
    miniVideo: {
        borderRadius: 5,
    },
    miniVideoActive: {
        borderRadius: 5,
        border: 'solid 5px green',
    }
};

if (document.getElementById('videoconference')) {
    ReactDOM.render(<VideoConference />, document.getElementById('videoconference'));
}