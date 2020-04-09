import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner } from 'reactstrap';
import MediaHandler from '../../MediaHandler';
import getUserMedia from 'getusermedia';
import Peer from 'simple-peer';
import axios from 'axios';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken};

var simulateClick = function (elem) {
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
            userList: window.userList,
            miniVideoActive: window.user.id,
            callIncommig: false,
            callIncommigUser: null
        };

        this.user = window.user;
        this.userList = this.state.userList;

        // Bindings
        this.mediaHandler = new MediaHandler();
        this.startCall = this.startCall.bind(this);
        this.changeMiniVideoActive = this.changeMiniVideoActive.bind(this);

        // Channels
        Echo.channel(`RequestStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\RequestStreamUser', (e) => {
            document.getElementById('otherId').value = e.stream;
            this.startCall(false, e.user_id_receptor, e.user_id_emisor)
            this.setState({callIncommig : true, callIncommigUser : e.user_id_receptor});
            console.log('request')
            setTimeout(() => {
                simulateClick(document.getElementById('connect'));
            }, 500);
        });

        Echo.channel(`ResponseStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\ResponseStreamUser', (e) => {
            document.getElementById('otherId').value = e.stream;
            console.log('response');
            setTimeout(() => {
                simulateClick(document.getElementById('connect'));
            }, 500);
        });
    }

    componentWillMount() {
        this.mediaHandler.getPermissions()
        .then((stream) => {
            var myVideo = document.getElementById(`userVideo-${this.user.id}`);
            var mainVideo = document.getElementById('mainVideo');
            PEERS[this.user.id] = stream;
            try {
                myVideo.srcObject = stream;
                mainVideo.srcObject = stream;
            } catch (e) {
                myVideo.src = URL.createObjectURL(stream);
                mainVideo.src = URL.createObjectURL(stream);
            }
            myVideo.play();
            mainVideo.play();
        });

        // Lamar a todos los usuarios
        setTimeout(() => {
            this.userList.map(user=>{
                if(this.user.id != user.id){
                    this.startCall(true, this.user.id, user.id);
                }
            });
        }, 0);
    }

    startCall(init, emisorId, receptId){
        getUserMedia({ video: true, audio: true }, function (err, stream) {
            if (err) return console.error(err)
            var peer = new Peer({
              initiator: init,
              trickle: false,
              stream: stream
            })

            // Crear el boton que dispare el evento ce conexión
            if(init){
                var buttom = document.createElement('buttom');
                buttom.id = 'connect';
                buttom.value = 'ok'
                document.body.appendChild(buttom);
            }
          
            peer.on('signal', function (data) {
                document.getElementById('yourId').value = JSON.stringify(data)
                if(init){
                    axios({
                        method: 'post',
                        url: 'videochats/request',
                        data: {
                            'type': 'request',
                            emisorId, receptId,
                            stream: JSON.stringify(data)
                        }
                    })
                    .then(function (response) {
                        // console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            })

            document.getElementById('connect').addEventListener('click', function () {
                var otherId = JSON.parse(document.getElementById('otherId').value)
                peer.signal(otherId)
                console.log('connect')
                if(!init){
                    setTimeout(() => {
                        var yourId = document.getElementById('yourId').value;
                        axios({
                            method: 'post',
                            url: 'videochats/request',
                            data: {
                                'type': 'response',
                                emisorId, receptId,
                                stream: yourId
                            }
                        })
                        .then(function (response) {
                            // console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }, 500);
                }
            })
          
            peer.on('stream', function (stream) {
                var userVideo = document.getElementById(`userVideo-${receptId}`);
                PEERS[receptId] = stream;
                try {userVideo.srcObject = stream}
                catch (e) {userVideo.src = URL.createObjectURL(stream)}
                userVideo.play();
            })
        })
    }

    changeMiniVideoActive(id){
        this.setState({miniVideoActive: id});
        var userVideo = document.getElementById(`mainVideo`);
        var userStream = PEERS[id];
        // console.log(userStream)
        try {userVideo.srcObject = userStream}
        catch (e) {userVideo.src = URL.createObjectURL(userStream)}
        userVideo.play();
    }

    render() {
        return (
            <Container style={{ marginTop:20 }}>
                <Row>
                    <Col md={{ size: '2' }}>
                        <ul style={{ listStyle:'none' }}>
                            <li>
                                <div style={style.containerMiniVideo}>
                                    <video
                                        style={this.state.miniVideoActive == this.user.id ? style.miniVideoActive : style.miniVideo}
                                        onClick={()=>this.changeMiniVideoActive(this.user.id)}
                                        id={`userVideo-${this.user.id}`} muted="muted" width="100%"
                                    >
                                    </video>
                                </div>
                            </li>
                            {/* Usuarios Conectados */}
                            {
                                this.state.userList.map(user=>{
                                    if(this.user.id != user.id){
                                        return (<li key={user.id}>
                                            <div style={style.containerMiniVideo}>
                                                <video
                                                    style={this.state.miniVideoActive == user.id ? style.miniVideoActive : style.miniVideo}
                                                    onClick={()=>this.changeMiniVideoActive(user.id)}
                                                    id={`userVideo-${user.id}`} muted="muted" width="100%">
                                                </video>
                                            </div>
                                        </li>);
                                    }
                                })
                            }
                        </ul>
                    </Col>
                    <Col md={{ size: '8' }}>
                        <video id="mainVideo" width="100%"></video>
                    </Col>
                    <Col md={{ size: '2' }}>
                        <ListGroup>
                            {
                                this.state.userList.map(user=>
                                    <ListGroupItem key={user.id}>
                                        {user.name} {this.user.id != user.id && !this.state.callIncommig ? <button style={{ display: 'none' }} onClick={()=>this.startCall(true, this.user.id, user.id)}></button> : this.state.callIncommig && this.user.id != user.id ? <button style={{ display: 'none' }} id="connect"></button> : '' }
                                    </ListGroupItem>
                                )
                            }
                        </ListGroup>
                    </Col>
                </Row>
                <div className="row">
                    <input type="hidden" id="yourId" className="form-control" />
                    <input type="hidden" id="otherId" className="form-control" />
                    <div id="messages"></div>
                </div>
            </Container>
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