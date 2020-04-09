<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Video Chats - CmsWeb v3.0</title>
</head>
<body>
    <div id="videoconference"></div>
     @if(auth()->user())
        <script>
            window.user = {
                id: '{{ auth()->id() }}',
                name: "{{ auth()->user()->name }}"
            };
            window.userList = @json($userList);
            window.csrfToken = "{{ csrf_token() }}";
        </script>
    @endif
    <script src="{{ asset('js/app.js') }}"></script>
    
    
</body>
</html>