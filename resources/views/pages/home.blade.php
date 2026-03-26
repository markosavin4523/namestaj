@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <div class="hero bg-white-color rounded w-100">

        </div>
        <div class="mt-3">
            <h2>Kategorije</h2>
            <div class="row">
                @foreach($categories as $cat)
                    <a href="{{ route("category.index",['category'=>$cat->slug]) }}" class="col-12 col-md-6 col-lg-4 text-black">
                        <div class="categoryImg bg-white-color">

                        </div>
                        <p class="text-black fs-5">{{$cat->name}}</p>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="mt-3">
            <h2>Preporucujemo</h2>
            <div class="row">
                @foreach($recomendedProducts as $p)
                    <x-products.product-card :p="$p"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
