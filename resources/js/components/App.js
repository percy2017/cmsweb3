import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Peer from 'simple-peer';
import MediaHandler from '../MediaHandler';
import Echo from "laravel-echo";



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
    }

    componentDidMount() {
        // this.fetchInitialDataUsingHttp();
        window.Pusher = require('pusher-js');
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
            this.setState({myuser: e.message});
            console.log(e.message);
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

    
    render() {
        return (
            <div className="container-fluid">
                <div className="row">
                    <div className="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <video className="" width="100%" ref={(ref) => {this.myVideo = ref;}}></video>
                    </div>
                    
              
                    <div className="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <code><u>Usuarios Conectados</u></code>
                        <ul> 
                            <li>{this.state.myuser} <button key="" onClick="">Call </button></li> 
                        </ul>
                    </div>

                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
