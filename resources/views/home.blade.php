@extends('layout.app')
@section('title', 'Home')
@section('content')
<div class="content">
    @auth
    <h2>All products</h2>
    @if(session('success'))
    <p class="success">{{session('success')}}</p>
    @endif
    <button class="btn btn-primary" data-url="{{ route('destroyAll') }}">Delete All Selected</button>
    <table class="table table-bordered content-admin">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">SKU</th>
                <th scope="col">Price</th>
                <th scope="col">Added at</th>
                <th scope="col">Edited at</th>
                <th style="text-align: center" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td><a href="{{ route('review', $product->id) }}">{{$product->name}}</a></td>
                <td>{{$product->sku}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->updated_at}}</td>
                <td align="center">
                    <a href="{{ route('edit', $product->id) }}">
                        <button><i class="fa fa-pencil"></i></button>
                    </a>
                    <form class="form" action="{{ route('destroy', $product->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit"><i class="fa fa-trash" style="color: red"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
    @else
    @php
    $count = $products->count()
    @endphp
    @for($i = 0; $i < ceil($products->count() / 3); $i++)
        <div class="row" style="width: 80%">
            @for($j = $i * 3; $j < 3 * $i + 3; $j++) @if ($count==$j) @break 2; @endif <div
                class="col-3 border grid-view">
                <div class="row">
                    <img src="/images/{{ $products[$j]->image }}" style="width:100%; height:100%">
                </div>
                <div class="row">
                    <div class="col-4 border" style="padding: 5px">
                        <a href="{{ route('review', $products[$j]->id) }}">{{$products[$j]->name}}</a>
                    </div>
                    <div class="col-2 border" style="padding: 5px">
                        {{$products[$j]->sku}}
                    </div>
                    <div class="col-1 border" style="padding: 5px">
                        {{$products[$j]->review->count()}}
                    </div>
                    <div class="col border" style="padding: 5px">
                        @if ($products[$j]->discount > 0)
                        <span style="text-decoration: line-through">{{$products[$j]->price * 1.21}}$</span>
                        @endif
                        {{number_format($products[$j]->price * 1.21 - $products[$j]->discount, 2)}}$
                    </div>
                </div>
        </div>
        @endfor
</div>
@endfor
{{ $products->links() }}
@endauth
</div>
@endsection