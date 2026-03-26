@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <x-pages.title :title="$category->name.' - '.$subcategory->name"/>
        <aside class="col-12 col-lg-3 p-2">
            <x-products.filter-aside />
        </aside>
        <div class="col-12 col-md-9 row m-0">
            @if(count($products)==0)
                <div class="mt-2"><p class="alert alert-warning rounded-0">Nema proizvoda izabrane kategorije</p></div>
            @else
                @foreach($products as $p)
                    <x-products.product-card :p="$p"/>
                @endforeach
            @endif
                <div>
                    {{ $products->withQueryString()->links() }}
                </div>
        </div>

    </div>
@endsection
