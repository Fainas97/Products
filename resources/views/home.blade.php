@extends('layout.app')
@section('title', 'Home')
@section('content')
@auth
<div class="content">
    @if(session('success'))
        <p class="success">{{session('success')}}</p>
    @endif
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
                <td>{{$product->name}}</td>
                <td>{{$product->sku}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->updated_at}}</td>
                <td align="center">
                    <a href="{{ route('edit', $product->id) }}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="{{ route('destroy', $product->id) }}">
                        <i class="fa fa-trash" style="color: red"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            {{ $products->links() }}
        </tbody>
    </table>
</div>
@else

@endauth
</div>
@endsection