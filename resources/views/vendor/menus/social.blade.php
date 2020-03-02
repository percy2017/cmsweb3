@foreach($items as $menu_item)
    <a class="p-2 m-2 fa-lg fb-ic ml-0" href="{{ $menu_item->link() }}">
        <i class="{{ $menu_item->icon_class }} white-text mr-lg-4"> </i>
    </a>
@endforeach