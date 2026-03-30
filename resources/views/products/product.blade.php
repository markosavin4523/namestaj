@extends('layout.layout')
@section('content')
    <x-modals.review-modal :product="$product" />
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
                            <li class="list-group-item">Kategorija: {{ $product->category->name }}</li>
                        </ul>
                        <p class="fs-1">{{ $product->price  }} RSD</p>
                        <div class="d-flex flex-row pb-3 border-bottom">
                            <button class="btn btn-primary fs-4 me-2" id="btn-cart" data-id="{{ $product->id  }}">
                                <i class="bi bi-cart-plus-fill me-2"></i>Dodaj u korpu
                            </button>
                            <input type="number" class="form-contro form-input" id="cart_quantity" min="1" max="10"  name="" id="" value="1">
                        </div>
                        <div class="reviews mt-3">
                            <h2>Recenzije ({{ count($product->reviews) }})</h2>
                                @if(count($product->reviews)==0)
                                    <p class="alert alert-warning">Ne postoje recenzije za ovaj proizvod</p>
                                @else
                                <div class="review border p-2">
                                    @foreach($product->reviews as $review)
                                        <p class="m-0 fw-bold"><i class="bi bi-person-circle me-2"></i>{{ $review->user->first_name }}</p>
                                        <div>
                                            @for($i=0;$i<5; $i++)
                                                @if ($i<$review->rate)
                                                    <span><i class="bi bi-star-fill"></i></span>
                                                @else
                                                    <span><i class="bi bi-star"></i></span>
                                                @endif
                                            @endfor
                                        </div>
                                    @endforeach
                            </div>
                                @endif
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                @if(count($product->reviews)!=0)
                                    <a href="">Prikazi sve</a>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
