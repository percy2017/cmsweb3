@foreach($items as $menu_item)
@php ($hasChildren = count($menu_item->children) > 0)
    <a href="{{ $menu_item->link() }}"> <i class="{{ $menu_item->icon_class }} "></i></a>
@endforeach