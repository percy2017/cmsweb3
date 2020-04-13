@foreach($items as $menu_item)
    @php ($hasChildren = count($menu_item->children) > 0)
    <li class="nav-item">
        <a class="nav-link" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
        {{--  @if ($hasChildren)
            <ul>
                @include('layouts.menu', ['items' => $menu_item->children])
            </ul>
        @endif  --}}
    </li>
@endforeach