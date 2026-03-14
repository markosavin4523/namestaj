@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <h2>{{ $category->name  }}</h2>
        @foreach($subcategories as $sub)
            <a href="{{ route("category.index",['category'=>$category->slug, 'subcategory'=>$sub->slug]) }}">{{ $sub->name  }}</a><br>
        @endforeach
    </div>

@endsection
