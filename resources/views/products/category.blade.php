@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <x-pages.title :title="$category->name"/>
        <div class="row">
            @foreach($subcategories as $sub)
                <a href="{{ route("category.index",['category'=>$category->slug, 'subcategory'=>$sub->slug]) }}"
                class="col-6 col-md-4 col-lg-3 text-black d-flex flex-column justify-content-center align-items-center p-2 p-sm-5">
                        <div class="rounded-circle w-100 square bg-white-color">

                        </div>
                        <p class=" fs-5 mt-2">{{ $sub->name  }}</p>
                </a>
            @endforeach
        </div>

    </div>

@endsection
