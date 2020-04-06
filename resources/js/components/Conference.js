import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner, ButtonGroup, Button } from 'reactstrap';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';
// import videojs from 'video.js'
import MediaHandler from '../MediaHandler';
import Echo from "laravel-echo";
const MySwal = withReactContent(Swal)

export default class Conference extends Component {
    constructor() {
        super();

        this.state = {
            hasMedia: false,
            otherUserId: null,
            myuser: window.user.name
        };

        this.user = window.user;
        this.stream = null;
        this.peers = {};

        this.mediaHandler = new MediaHandler();
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
        });
    }

    componentWillMount() {
        this.mediaHandler.getPermissions()
        .then((stream) => {
            this.setState({hasMedia: true});
            try {
                this.myVideo.srcObject = stream;
            } catch (e) {
                this.myVideo.src = URL.createObjectURL(stream);
            }
            this.myVideo.play();
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
        
        )
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Conference />, document.getElementById('example'));
}