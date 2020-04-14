import React, { Component } from 'react';

import 'bootstrap/dist/css/bootstrap.css';
import axios from 'axios';
import { FaRegPaperPlane, FaArrowRight } from "react-icons/fa";

// Components
import Message from './Message';

axios.defaults.headers.common = {'X-CSRF-TOKEN' : window.csrfToken};

export default class PanelChat extends Component {

    constructor(props) {
        super(props);

        this.state = {
            inputMessage: '',
            messageList : [],
            detailChat: {
                userName: '',
                display: 'none'
            }
        };

        // Bindings
        this.handleInpuMessage = this.handleInpuMessage.bind(this);
        this.submitMessage = this.submitMessage.bind(this);

        // Channels

        Echo.channel(`NewMessageChannel`)
        .listen('.App\\Events\\Telematic\\NewMessage', (e) => {
            let messageList = this.state.messageList;
            messageList.push(e.data);
            this.setState({messageList});
            
            let offsetHeight = document.getElementById("panel-chat-messages").offsetHeight;
            let scrollTop = document.getElementById("panel-chat-messages").scrollTop
            let scrollHeight = document.getElementById("panel-chat-messages").scrollHeight
            let posAct = offsetHeight + scrollTop;
            let redirectToBottom = scrollHeight - posAct <= 200 ? true : false;
            setTimeout(() => {
                if(redirectToBottom){
                    document.getElementById("panel-chat-messages").scrollTo({ top: scrollHeight, behavior: 'smooth' });
                }
            }, 250);
            let typingUser = {userName: '', display: 'none'}
            this.setState({detailChat: typingUser});
            if(e.data.user.id != this.props.user.id){
                document.getElementById("audio-newMessage").play();
            }
            
        });

        Echo.channel(`NewMessageTypingChannel`)
        .listen('.App\\Events\\Telematic\\NewMessageTyping', (e) => {
            if(this.props.user.id != e.user.id && this.state.detailChat.display == 'none'){
                let typingUser = {userName: e.user.name, display: 'block'}
                this.setState({detailChat: typingUser});
                setTimeout(() => {
                    let typingUser = {userName: '', display: 'none'}
                    this.setState({detailChat: typingUser});
                }, 2000);
            }
        });
    }

    handleInpuMessage(event){
        this.setState({inputMessage: event.target.value});
        axios({
            method: 'post',
            url: 'videochats/message/typing',
            data: {
                user: {id: this.props.user.id, name: this.props.user.name}
            }
        })
    }

    submitMessage(event) {
        event.preventDefault();
        let dateTime = new Date()
        let date = `${dateTime.getHours()}:${dateTime.getMinutes()}:${dateTime.getSeconds()}`;
        let message = this.state.inputMessage;
        this.setState({inputMessage: ''});
        if(this.state.inputMessage){
            axios({
                method: 'post',
                url: 'videochats/message',
                data: {
                    user: {id: this.props.user.id, name: this.props.user.name}, message, date
                }
            })
            .then(res=>{
                
            });
        }
    }

    render() {

        return (
            <div style={{ position: 'fixed', right: 0, bottom: 0, height: window.innerHeight, overflowY: 'hidden', width: 350, backgroundColor: 'rgba(0,0,0,0.8)', display: this.props.displayChat ? 'block' : 'none' }}>
                <div style={{ position: 'absolute', width: '100%', height: window.innerHeight, marginTop: 10 }}>
                    <div style={{ marginLeft: 20, marginBottom: 20 }}>
                        <button
                            type="button"
                            style={{ backgroundColor: 'transparent', color: '#fff', fontSize: 25, border: 'none' }}
                            onClick={this.props.onDismisPanelChat}
                        >
                            <FaArrowRight />
                        </button>
                    </div>
                    <div id="panel-chat-messages" style={{  height: window.innerHeight-150, overflowY: 'auto', scrollbarColor: '#EAEAEA rgba(0,0,0,0.8)', scrollbarWidth: 5 }}>
                        {
                            this.state.messageList.map(item=>{
                                return(
                                    <Message
                                        key={ `${item.user.id}_${Math.floor(Math.random() * 100000)}` }
                                        type={item.user.id == this.props.user.id ? 'sent' : 'received' }
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
            </div>
        )
    }
}
