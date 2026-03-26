@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <x-pages.title title="Proizvodi koji sadrže '{{ $term }}'" />
        <div class="col-12 row m-0">
            @if(count($products)==0)
                <div class="mt-2"><p class="alert alert-warning rounded-0">Ne postoje proizvodi koji sadrze "{{ $term  }}"</p></div>
            @else
                @foreach($products as $p)
                    <x-products.product-card :p="$p"/>
                @endforeach
            @endif
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
@endsection
