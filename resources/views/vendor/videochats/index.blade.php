<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>Video Chats - CmsWeb v3.0</title>
</head>
<body>

    <div id="example"></div>
    
    
     @if(auth()->user())
        <script>
            window.user = {
                id: {{ auth()->id() }},
                name: "{{ auth()->user()->name }}"
            };
            window.csrfToken = "{{ csrf_token() }}";

            

        </script>
    @endif

    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    
</body>
</html>