import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Peer from 'simple-peer';
import MediaHandler from '../MediaHandler';
import Echo from "laravel-echo";
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';
import axios from 'axios';

const MySwal = withReactContent(Swal)

export default class App extends Component {
    
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
            <div className="container-fluid">
                <div className="row">
                    <div className="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <code><u>Chats de Usuarios</u></code>
                        <ul> 
                            <li><code>{this.state.myuser}</code> - <small>Hola Grupo</small></li>
                            <li><code>admin</code> - <small>Hola Grupo</small></li> 
                            <li><code>juan peres</code> - <small>Hola Grupo</small></li> 
                        </ul>
                    </div>
                    <div className="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <video className="" width="100%" ref={(ref) => {this.myVideo = ref;}}></video>
                        <br />
                        <div className="standalone text-center">
                        
                            <label style={{ padding: "30px" }}>
                            <input className="form-control" type="radio" />
                                Camara Web
                            </label>
                            
                            <label>
                            <input className="form-control"  type="radio" />
                                Escritorio
                            </label>
                           
                        </div>
                    </div>
                    <div className="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <code><u>Usuarios Conectados</u></code>
                        <ul> 
                            <li>{this.state.myuser} <button className="btn btn-sm btn-primary" onClick={this.startSocket}>Pido Palabra </button></li> 
                            <li>admin</li> 
                            <li>juan peres</li> 
                        </ul>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<App />, document.getElementById('example'));
}
