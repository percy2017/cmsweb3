import React from 'react';

const Message = (props) =>{
    return(
        <div style={{ textAlign: props.type == 'received' ? 'left' : 'right'}}>
            <div style={{ 
                            display: 'inline-block',
                            marginLeft:20,
                            marginRight:20,
                            marginBottom: 10,
                            position: 'relative',
                            border: `1px solid ${props.type == 'received' ? '#fff' : '#57BB59'}`,
                            borderRadius: 10,
                            paddingRight: 20,
                            paddingLeft: 20,
                            backgroundColor: props.type == 'received' ? '#57BB59' : '#fff',
                        }}>
                <p style={{ marginTop: 10, marginBottom: 3, color: props.type == 'received' ? '#fff' : '#57BB59' }}>
                    {props.type == 'received' ? <b style={{ fontSize: 12 }}>{ props.name }:<br/></b> : ''} { props.message }
                </p>
                <div style={{ marginTop: -10, color: props.type == 'received' ? '#414141' : '#848484' }}><small style={{ fontSize: 10 }}>{props.date}</small></div>
            </div>
        </div>
    );
}

export default Message;