<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $name }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            body, html, #meet {
                margin: 0;
                overflow-x: hidden; 
                overflow-y: auto;
            }
        </style>
    </head>
    <body>
        <div id="meet"></div>
        <script src='https://live.loginweb.dev/external_api.js'></script>
        <script>
            const domain = 'live.loginweb.dev';
            const options = {
                roomName: '{{ $name }}',
                // width: screen.width,
                height: screen.height-100,
                parentNode: document.querySelector('#meet'),
                devices: {
                    audioInput: '<deviceLabel>',
                    audioOutput: '<deviceLabel>',
                    videoInput: '<deviceLabel>'
                },
            };
            const api = new JitsiMeetExternalAPI(domain, options);
        </script>
    </body>
</html>
