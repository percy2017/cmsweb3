@foreach($items as $menu_item)
@php ($hasChildren = count($menu_item->children) > 0)
<li class="nav-item">
    <a href="{{ $menu_item->link() }}"> <i class="{{ $menu_item->icon }} "></i>{{ $menu_item->title }} </a>
</li>
@endforeach