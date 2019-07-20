@extends('layout.app')
@section('content')
@if(session('success'))
    <h5 class="success">{{session('success')}}</h5>
@endif
<h1>Product review</h1>
<div class="content">
  <div class="row">
    <div class="col-sm">
      One of three columns
    </div>
    <div class="col-sm">
      One of three columns
    </div>
    <div class="col-sm">
      One of three columns
    </div>
  </div>
</div>
@endsection