@extends('inti::layouts.app')
@section('content')
    @foreach ($blocks as $item) 
        @switch($item->type)
            @case('dinamyc-data')
                @include('inti::blocks.pages.'.$item->name, ['data' => json_decode($item->details)])
                @break
            @case('controller')
                <div id="{{ $item->title }}"></div>
                    @if(auth()->user())
                        @php
                            $userList = App\User::where('id', '<>', Auth::user()->id)->select('id', 'name', 'avatar')->get();
                        @endphp
                        <script>
                            window.user = {
                                id: {{ auth()->id() }},
                                name: "{{ auth()->user()->name }}",
                                avatar: "{{ auth()->user()->avatar }}"
                            };
                            window.userList = @json($userList);
                            window.csrfToken = "{{ csrf_token() }}";
                        </script>
                    @endif
                @break
            @default
                <code> Error al cargar el blocke.</code>
                @break
        @endswitch
    @endforeach
@endsection