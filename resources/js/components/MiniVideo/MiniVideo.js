import React from 'react';

const MiniVideo = (props) => {
    return (
        <li key={props.id} id={`li-userVideo-${props.id}`}>
            <div style={style.containerMiniVideo}>
                <video
                    style={style.miniVideo}
                    // onClick={()=>this.changeMiniVideoActive(user.id)}
                    id={`userVideo-${props.id}`} muted="muted" width="100%" height="100%">
                </video>
                <div style={{ position: 'relative', bottom: 30, 'textAlign': 'center', color: 'white' }}>{props.name}</div>
            </div>
        </li>
    )
}

const style = {
    containerMiniVideo: {
        cursor: 'pointer',
        width: '100%',
        border: 'solid 2px black',
    },
    miniVideo: {
        borderRadius: 5,
    },
    miniVideoActive: {
        borderRadius: 5,
        border: 'solid 5px green',
    }
};

export default MiniVideo;