import React from 'react';

import MiniVideo from '../MiniVideo/MiniVideo';

const ListMiniVideo = ({userListActive, changeMiniVideoActive, userID, miniVideoActive}) =>{
    return(
        <div style={{ position: 'fixed', left: 20, top: 20, bottom: 30, height: `${window.innerHeight}px`}}>
            {
                userListActive.map(user=>{
                    return(
                        <MiniVideo
                            key={user.id}
                            user={user}
                            onClick={() => changeMiniVideoActive(user.id)}
                            userID={userID}
                            miniVideoActive={miniVideoActive}
                            handUp={user.handUp}
                        />
                    )
                })
            }
        </div>
    );
}

export default ListMiniVideo;