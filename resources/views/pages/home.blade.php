@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <div class="hero rounded w-100 p-5 d-flex justify-content-start align-items-end" style="background-image:url({{ asset("images/hero1.jpg") }})">
            <div class="hero_content ms-0 ms-md-5">
                <h1 class="fw-bold shadow">Dnevna soba</h1>
                <p class="shadow">Svi znamo koliko je važno dom učiniti prijatnim i lepo uređenim prostorom u<br>
                    kom volimo boraviti. Reč je o prostoru u kom možemo izraziti svoj jedinstveni stil. </p>
                <a href="{{ route("category.index","dnevna-soba")  }}" class="btn btn-primary">Istrazi ponudu</a>
            </div>
        </div>
        <div class="mt-3">
            <h2>Kategorije</h2>
            <div class="row">
                @foreach($categories as $cat)
                    <a href="{{ route("category.index",['category'=>$cat->slug]) }}" class="col-12 col-md-6 col-lg-4 text-black">
                        <div class="categoryImg bg-white-color" style="background-image:url({{ asset($cat->image_path) }})">

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
