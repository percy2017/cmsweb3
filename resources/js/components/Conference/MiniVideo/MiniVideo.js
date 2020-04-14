import React from 'react';
import { FaHandPaper } from "react-icons/fa";

const VideoChat = (props) =>{
    return(
        <div id={`containerVideo-${props.user.id}`} style={{position: 'relative', width: '100px', textAlign: 'center', }}>
            <div style={{ position: 'absolute', right: 5, top: 0, color: '#E3522B', fontSize: 20 }}>
                {props.handUp ? <FaHandPaper /> : ''}
            </div>
            <video
                id={`video-${props.user.id}`}
                muted={props.userID == props.user.id ? 'muted' : false}
                width="100%"
                style={props.miniVideoActive == props.user.id ? style.miniVideoActive : style.miniVideo}
                onClick={props.onClick}
            />
            <div style={{ position: 'absolute', left: 5, bottom: 8, color: '#fff', fontSize: 11 }}>
                { props.user.name }
            </div>
        </div>
    );
}

const style = {
    miniVideo: {
        backgroundColor: '#000',
        cursor: 'pointer',
        borderRadius: 5,
        height: 60,
        border: 'solid 2px #616161',
    },
    miniVideoActive: {
        backgroundColor: '#000',
        cursor: 'pointer',
        borderRadius: 5,
        height: 60,
        border: 'solid 2px #39E23C',
    }
};

export default VideoChat;