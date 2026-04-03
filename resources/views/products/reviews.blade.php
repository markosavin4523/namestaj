@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <x-pages.title title="Rezencije proizvoda '{{ $product->name }}'" />
        <form class="form-group mb-3" action="{{ route("review.index",$product->slug) }}" method="GET">
            <label class="text-muted">Sortiraj po:</label><br>
            <select name="sort" id="" class="form-select w-50" onchange="this.form.submit()">
                <option value="">Izaberi</option>
                <option value="rateAsc" {{ $request->sort=="rateAsc" ? "selected" : "" }}>Najvisa ocena</option>
                <option value="rateDesc" {{ $request->sort=="rateDesc" ? "selected" : "" }}>Najniza ocena</option>
                <option value="dateAsc" {{ $request->sort=="dateAsc" ? "selected" : "" }}>Najstarije</option>
                <option value="dateDesc" {{ $request->sort=="dateDesc" ? "selected" : "" }}>Najnovije</option>
            </select>
        </form>
        <div class="col-12 row m-0">
            @foreach($product->reviews as $rev)
                <x-products.review-row :review="$rev"/>
            @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $reviews->withQueryString()->links() }}
        </div>
    </div>
@endsection
