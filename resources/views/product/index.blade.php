@extends('layout.app')
@section('title', 'Product review')
@section('content')
<div class="content">
    <h1>Product review</h1>
    @if(session('success'))
    <h5 class="success">{{session('success')}}</h5>
    @endif
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
            <div class="row rating" style="float: left">
                <div id="{{ $product->id }}" class="rate_widget">
                    <div class="star_1 ratings_stars"></div>
                    <div class="star_2 ratings_stars"></div>
                    <div class="star_3 ratings_stars"></div>
                    <div class="star_4 ratings_stars"></div>
                    <div class="star_5 ratings_stars"></div>
                    <div class="total_votes">vote data</div>
                </div>
            </div>
            <div class="row line-break" style="clear: both">
                {{ $product->description }}
            </div>
        </div>
    </div>
</div>
@endsection