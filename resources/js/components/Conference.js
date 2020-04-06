import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner, ButtonGroup, Button } from 'reactstrap';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';
// import videojs from 'video.js'
import MediaHandler from '../MediaHandler';
<<<<<<< HEAD
import Echo from "laravel-echo";
const MySwal = withReactContent(Swal)

export default class Conference extends Component {
    constructor() {
        super();
=======
import getUserMedia from 'getusermedia';
import Peer from 'simple-peer';
import axios from 'axios';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken}

export default class Conference extends Component {

    constructor(props) {
        super(props);
>>>>>>> 1b2f5e47c20d5c8b6729fd30830fcc60a5b60d6f

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
<<<<<<< HEAD
        this.startSocket = this.startSocket.bind(this);
    }
      
    componentDidMount() {
        // this.fetchInitialDataUsingHttp();
        // window.Pusher = require('pusher-js');
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.MIX_PUSHER_APP_KEY,
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
            // forceTLS: true, 
            // wssPort: 6001,
            // enabledTransports: ['ws', 'wss'] 
        });
        //Set up listeners when the component is being mounted
        window.Echo.channel('home').listen('NewMessage', (e) =>{
            // this.setState({name_user: e.message});
            // this.setState({myuser: e.message});
            // console.log(e.message);
            MySwal.fire({
                title: <p>Mensage de un user</p>,
                footer: 'CmsWeb v3.0',
                onOpen: () => {
                    // `MySwal` is a subclass of `Swal`
                    //   with all the same instance & static methods
                    MySwal.clickConfirm()
                }
                }).then(() => {
                return MySwal.fire(<p>{e.message}</p>)
            })
=======
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
>>>>>>> 1b2f5e47c20d5c8b6729fd30830fcc60a5b60d6f
        });
    }

    componentWillMount() {
        this.mediaHandler.getPermissions()
        .then((stream) => {
<<<<<<< HEAD
            this.setState({hasMedia: true});
=======
>>>>>>> 1b2f5e47c20d5c8b6729fd30830fcc60a5b60d6f
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

    startSocket() {
        // this.setState(state => ({
        //   isToggleOn: !state.isToggleOn
        // }));
        axios.get('http://localhost:8000/videochats/send/hola_buddy')
            .then(res => {
                console.log(res);
            })

      }

    render() {
        return (
<<<<<<< HEAD
            <div>
                <Container fluid={true}>
                    <Row size="lg">
                        <Col className="text-center">
                        <h2>Live #</h2>
                        <hr />
                        </Col>
                    </Row>
                    <Row size="lg">
                  
                        <Col sm={{ size: '8' }} className="text-center">
                            <video className="" width="100%" ref={(ref) => {this.myVideo = ref;}}></video>                         
                            <ButtonGroup>
                                <Button color="primary">Camara</Button>
                                <Button color="secondary">Pantalla</Button>
                                {/* <Button color="primary">Three</Button> */}
                            </ButtonGroup>
                            
                        </Col>
                        <Col sm={{ size: '4' }}>
                            <ListGroup flush>
                                <ListGroupItem><small>Participantes</small></ListGroupItem>
                                <ListGroupItem><Spinner type="grow" size="sm" color="info" /> <small>{this.state.myuser}</small><Button color="primary" onClick={this.startSocket} size="sm">Envir Llave</Button> </ListGroupItem>
                                <ListGroupItem><small>Porta ac consectetur ac</small></ListGroupItem>
                                <ListGroupItem><Spinner type="grow" size="sm" color="info" /><small>Vestibulum at eros</small></ListGroupItem>
                            </ListGroup>
                        </Col>
                    </Row>

                    <Row size="lg">
                   
                        <Col className="text-center">
                        <hr />
                        <h2>Chats</h2>
                        
                        </Col>
                    </Row>
                </Container>
            </div>
        
=======
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
>>>>>>> 1b2f5e47c20d5c8b6729fd30830fcc60a5b60d6f
        )
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Conference />, document.getElementById('example'));
}