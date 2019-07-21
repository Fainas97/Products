@extends('layout.app')
@section('title', 'Product review')
@section('content')
@if(session('success'))
<h5 class="success">{{session('success')}}</h5>
@endif
<div class="content">
    <h1>Product review</h1>
    <div class="row">
        <div class="col-sm">
            <img src="/images/{{ $product->image }}" style="width:100%; height:100%">
        </div>
        <div class="col-sm">
            <div class="row">
                <h2>{{ $product->name }}</h2>
            </div>
            <div class="row">
                <h3>{{ $product->sku }}</h3>
            </div>
            <div class="row">
                <h2>Kaina - {{ $product->price }}$</h2>
            </div>
            <div class="row">
                <h3>Aprašymas</h3>
            </div>
            <div class="row line-break">
                {{ $product->description }}
            </div>
        </div>
    </div>
</div>
@endsection