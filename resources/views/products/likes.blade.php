@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <x-pages.title title="Sacuvani proizvodi"/>
        <div class="row m-0">
            @if(count($products)==0)
                <div><p class="alert alert-warning rounded-0 m-0">Nemate sacuvane proizvode</p></div>
            @else
                @foreach($products as $p)
                    <x-products.product-card :p="$p"/>
                @endforeach
            @endif
        </div>
    </div>
@endsection
