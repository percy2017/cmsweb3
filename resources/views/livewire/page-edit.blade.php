<div>
    A good traveler has no fixed plans and is not intent upon arriving.
    <div class="form-group col-md-6">
        <label>Nombre</label>
        <input class="form-control" type="text" name="{{ $page->name }}" value="{{ $page->name }}" readonly />
    </div>
    <div class="form-group col-md-6">
        <label>Slug</label>
        <input class="form-control" type="text" name="{{ $page->slug }}" value="{{ $page->slug }}" readonly />
    </div>
    <div class="form-group col-md-12">
        <label>Descripcion</label>
        <textarea class="form-control" rows="3" name="{{ $page->description }}" readonly>{{ $page->description }}</textarea>
        
    </div>
</div>
