@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <div class="row showProduct">
            <div class="col-12 col-lg-6 p-2">
                <img src="{{ asset($product->image_path) }}" width="100%">
            </div>
            <div class="col-12 col-lg-6 p-2">
                <div class="showProduct_info bg-white-color p-3">
                        <div class="d-flex-justify-content-between border-bottom position-relative">
                            <h2>{{ $product->name }}</h2>
                            <x-products.like-button :p="$product"/>
                        </div>

                        <p class="text-secondary mt-3">{{ $product->description  }}</p>
                        <ul class="list-group rounded-0 mb-3">
                            <li class="list-group-item"><i class="bi bi-arrows-vertical"></i> Visina: {{ $product->dimension->height }} cm</li>
                            <li class="list-group-item"><i class="bi bi-arrows"></i> Sirina: {{ $product->dimension->width }} cm</li>
                            <li class="list-group-item"><i class="bi bi-arrows-vertical rotate45"></i> Dubina: {{ $product->dimension->depth }} cm</li>
                            <li class="list-group-item">Kategorija: {{ $product->category->name ?? "nekategorizovan" }}</li>
                        </ul>
                        <p class="fs-1">{{ $product->price  }} RSD</p>
                    @if($product->quantity > 0)
                        <div class="d-flex flex-row pb-3 border-bottom">
                            <button class="btn btn-primary fs-4 me-2" id="btn-cart" data-id="{{ $product->id  }}">
                                <i class="bi bi-cart-plus-fill me-2"></i>Dodaj u korpu
                            </button>
                            <input type="number" class="form-contro form-input" id="cart_quantity" min="1" max="10"  name="" id="" value="1">
                        </div>
                    @else
                           <div class="alert alert-danger">Nije na stanju</div>
                    @endif
                        <div class="reviews mt-3">
                            <h2>Recenzije ({{ count($product->reviews) }})</h2>
                            @if(count($product->reviews)==0)
                                <p class="alert alert-warning">Ne postoje recenzije za ovaj proizvod</p>
                            @else
                                @foreach($product->reviews()->take(4)->get() as $review)
                                    <x-products.review-row :review="$review"/>
                                @endforeach
                            @endif
                            <form action="{{ route("review.store") }}" method="POST" class="mb-2">
                                @csrf
                                <div class="form-group">
                                    <label for="comment">Komentar</label>
                                    <textarea name="comment" id="comment" cols="30" rows="4" class="form-control"></textarea>
                                    @error('comment')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="comment">Ocena</label>
                                    <div class="star-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star fs-3 star text-warning" data-value="{{ $i }}"></i>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="rating" id="rating" value="0">
                                    @error('rating')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button class="btn btn-primary mt-2">Dodaj recenziju</button>
                            </form>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                @if(count($product->reviews)!=0)
                                    <a href="{{ route("review.index",$product->slug) }}">Prikazi sve</a>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection


