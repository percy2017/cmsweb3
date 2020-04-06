import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner } from 'reactstrap';
import MediaHandler from '../MediaHandler';
import getUserMedia from 'getusermedia';
import Peer from 'simple-peer';
import axios from 'axios';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken}

export default class Conference extends Component {

    constructor(props) {
        super(props);
        this.state = {
            hasInitiador: false,
            myuser: window.user.name,
            userList: window.userList,
            callIncommig: false,
            callIncommigUser: null
        };

        this.user = window.user;
        this.user = window.user;

        // Bindings
        this.mediaHandler = new MediaHandler();
        this.startCall = this.startCall.bind(this);

        // Channels
        Echo.channel(`RequestStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\RequestStreamUser', (e) => {
            document.getElementById('otherId').value = e.stream;
            this.startCall(false, e.user_id_receptor, e.user_id_emisor)
            this.setState({callIncommig : true, callIncommigUser : e.user_id_receptor});
        });

        Echo.channel(`ResponseStreamUserChannel-${this.user.id}`)
        .listen('.App\\Events\\Telematic\\ResponseStreamUser', (e) => {
            document.getElementById('otherId').value = e.stream;
            // setTimeout(() => {
                document.getElementById('connect').dispatchEvent(new Event('click'));
            // }, 1000);
        });
    }

    componentWillMount() {
        this.mediaHandler.getPermissions()
        .then((stream) => {
            try {
                this.myVideo.srcObject = stream;
            } catch (e) {
                this.myVideo.src = URL.createObjectURL(stream);
            }
            this.myVideo.play();
        });
        // this.startCall(false, 1, 2);
    }

    startCall(init, emisorId, receptId){
        getUserMedia({ video: true, audio: true }, function (err, stream) {
            if (err) return console.error(err)
            var peer = new Peer({
              initiator: init,
              trickle: false,
              stream: stream
            })

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
            
            // if(!init){
            //     var otherId = JSON.parse(document.getElementById('otherId').value)
            //     peer.signal(otherId)
            // }
            document.getElementById('connect').addEventListener('click', function () {
                var otherId = JSON.parse(document.getElementById('otherId').value)
                peer.signal(otherId)

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
          
            document.getElementById('send').addEventListener('click', function () {
              var yourMessage = document.getElementById('yourMessage').value
              peer.send(yourMessage)
            })
          
            peer.on('data', function (data) {
              document.getElementById('messages').textContent += data + '\n'
            })
          
            peer.on('stream', function (stream) {
                var video = document.createElement('video')
                document.getElementById('userVideo').appendChild(video)
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
            <Container>
                <Row>
                    <Col md={{ size: '2' }}>   
                        <ListGroup>
                            <ListGroupItem>
                                <video className="" width="100%" ref={(ref) => {this.myVideo = ref;}}></video>
                            </ListGroupItem>
                        </ListGroup>
                    </Col>
                    <Col md={{ size: '7' }}>
                        <div id="userVideo"></div>
                    </Col>
                    <Col md={{ size: '3' }}>
                        <ListGroup>
                            {
                                this.state.userList.map(user=>
                                    <ListGroupItem>
                                        {user.name} {this.user.id != user.id && !this.state.callIncommig ? <button onClick={()=>this.startCall(true, this.user.id, user.id)} className="btn btn-success">Llamar</button> : this.state.callIncommig && this.user.id != user.id ? <button id="connect" className="btn btn-primary">Responder</button> : '' }
                                    </ListGroupItem>
                                )
                            }
                        </ListGroup>
                    </Col>
                </Row>
                <div className="row">
                    <input type="hidden" id="yourId" className="form-control" />
                    <input type="hidden" id="otherId" className="form-control" />

                    <textarea id="yourMessage" className="form-control" placeholder="Escribe..."></textarea><br/><br/>
                    <button id="send" className="btn btn-primary">send</button>
                    <p id="messages"></p>
                </div>
            </Container>
        )
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Conference />, document.getElementById('example'));
}