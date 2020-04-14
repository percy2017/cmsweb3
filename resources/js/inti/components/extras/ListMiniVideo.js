import React from 'react';

import MiniVideo from './MiniVideo';

const ListMiniVideo = ({userListActive, onClick, userID, miniVideoActive}) =>{
    return(
        <div style={{ position: 'fixed', left: 20, top: 20, bottom: 30, height: `${window.innerHeight}px`}}>
            {
                userListActive.map(user=>{
                    return(
                        <MiniVideo
                            key={user.id}
                            user={user}
                            onClick={onClick}
                            userID={userID}
                            miniVideoActive={miniVideoActive}
                        />
                    )
                })
            }
        </div>
    );
}

export default ListMiniVideo;