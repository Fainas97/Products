@extends('layout.app')
@section('title', 'Add product')
@section('content')
<div class="content">
    <h2>Add product</h2>
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <p class="errors">{{ $error }}</p>
    @endforeach
    @endif
    <form method="post" action="/product/create" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col">
                <input name="name" type="text" class="form-control" placeholder="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="col">
                <input name="status" type="checkbox" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">SKU</label>
            <div class="col">
                <input name="sku" type="text" class="form-control" placeholder="sku">
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-4 col-form-label">Price</label>
            <div class="col">
                <input name="price" type="text" class="form-control" placeholder="price">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Spec Price</label>
            <div class="col">
                <input name="special_price" type="text" class="form-control" placeholder="special price">
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-3 col-form-label">Description</label>
            <div class="col">
                <textarea name="description" type="text" class="form-control" placeholder="description"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <input type="file" name="image" class="custom-file-input">
                <label class="custom-file-label">Choose image</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-10 col-sm-2">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>
    </form>
</div>
@endsection