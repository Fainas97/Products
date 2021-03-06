@extends('layout.app')
@section('title', 'Add product')
@section('content')
<div class="content top-space">
    <h2>Add product</h2>
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <p class="errors">{{ $error }}</p>
    @endforeach
    @endif
    <form method="post" action="/product/create" enctype="multipart/form-data">
        @csrf
        <div class="form-group row row-white">
            <label for="name" class="col-sm-3 col-form-label">Name</label>
            <div class="col" style="padding-right: 0px">
                <input name="name" type="text" class="form-control" placeholder="name"  value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group row row-white">
            <label for="status" class="col-sm-3 col-form-label">Status</label>
            <div class="col" style="padding-right: 0px">
                <input name="status" type="checkbox" class="form-control"  @if(old('status')) checked @endif>
            </div>
        </div>
        <div class="form-group row row-white">
            <label class="col-sm-3 col-form-label">SKU</label>
            <div class="col" style="padding-right: 0px">
                <input name="sku" type="text" class="form-control" placeholder="sku"  value="{{ old('sku') }}">
            </div>
        </div>
        <div class="form-group row row-white">
            <label for="price" class="col-sm-4 col-form-label">Price</label>
            <div class="col" style="padding-right: 0px">
                <input name="price" type="text" class="form-control" placeholder="price"  value="{{ old('price') }}">
            </div>
        </div>
        <div class="form-group row row-white">
            <label class="col-sm-4 col-form-label">Discount*</label>
            <div class="col" style="padding-right: 0px">
                <input name="discount" type="text" class="form-control" placeholder="special price" value="{{ old('discount') }}">
            </div>
        </div>
        <div class="form-group row row-white">
            <label for="description" class="col-sm-3 col-form-label">Description</label>
            <div class="col" style="padding-right: 0px">
                <textarea name="description" type="text" class="form-control" placeholder="description">{{ old('description') }}</textarea>
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