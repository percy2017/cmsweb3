import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: process.env.MIX_PUSHER_APP_PORT,
    disableStats: true,
    // forceTLS: true, 
    // wssPort: process.env.MIX_PUSHER_APP_PORT,
    // enabledTransports: ['ws', 'wss'] 
});
