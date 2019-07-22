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
                <h2>
                    Price : @if ($product->discount > 0)
                    <span style="text-decoration: line-through">{{$product->price * 1.21}}$</span>
                    @endif
                    {{number_format($product->price * 1.21 - $product->discount, 2)}}$
                </h2>
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
            <div class="row" style="clear: both">
                <h3>Description</h3>
            </div>
            <div class="row line-break">
                {{ $product->description }}
            </div>
            <div class="row">
                <h3>Reviews</h3>
            </div>
            @if ($product->review->count() > 0)
            <div class="row" style="margin-top: 10px">
                <div class="col-3">
                    <label for="author" style="color: #828282; font-weight: bold;">Name</label>
                </div>
                <div class="col">
                    <label for="comment" style="color: #828282; font-weight: bold;">Review</label>
                </div>
            </div>
            @endif
            @foreach($product->review as $review)
            <div class="row" style="margin-top: 10px">
                <div class="col-3">
                    {{ $review->author }}
                </div>
                <div class="col">
                    {{ $review->review }}
                </div>
            </div>
            <hr>
            @endforeach
            <div class="row">
                <h3>Write review</h3>
            </div>
            <form method="post" action="/product/review">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" name="product_id" value="{{ $product->id }}">
                <div class="row">
                    <div class="form-group col-3">
                        <label for="author" style="color: #828282; font-weight: bold;">Name</label>
                        <input type="text" class="form-control" name="author" value="">
                    </div>
                    <div class="form-group col">
                        <label for="comment" style="color: #828282; font-weight: bold;">Review</label>
                        <textarea class="form-control" name="review"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary" style="background: #0054A6;">Leave review
                        </button>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection