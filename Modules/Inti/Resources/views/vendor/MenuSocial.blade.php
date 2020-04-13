@foreach($items as $menu_item)
@php ($hasChildren = count($menu_item->children) > 0)
<div class="social_icon">
    <a href="{{ $menu_item->link() }}"> <i class="{{ $menu_item->icon_class }} "></i></a>
</div>
@endforeach