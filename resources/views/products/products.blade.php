@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <h2>produkti</h2>
        @foreach($products as $product)
            {{ $product->name  }}<br>
        @endforeach
    </div>
@endsection
