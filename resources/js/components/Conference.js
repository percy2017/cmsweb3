import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import { Container, Row, Col, ListGroupItem, ListGroup, Spinner } from 'reactstrap';
import MediaHandler from '../MediaHandler';

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

    render() {
        return (
            <Container>
        
                <Row>
                    <Col md={{ size: '3' }}>   
                   
                   
                    </Col>
                    <Col md={{ size: '6' }}>
                        <video className="" width="100%" ref={(ref) => {this.myVideo = ref;}}></video>
                    </Col>
                    <Col md={{ size: '3' }}>
                        <ListGroup>
                            <ListGroupItem> <Spinner type="grow" color="primary" /> Cras justo odio</ListGroupItem>
                            <ListGroupItem>Dapibus ac facilisis in</ListGroupItem>
                            <ListGroupItem>Morbi leo risus</ListGroupItem>
                            <ListGroupItem>Porta ac consectetur ac</ListGroupItem>
                            <ListGroupItem>Vestibulum at eros</ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </Container>
        )
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Conference />, document.getElementById('example'));
}