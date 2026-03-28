@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <x-pages.title title="Korpa"/>
        @if(count($products)==0)
            <div class="d-flex flex-column justify-content-center align-items-center p-5">
                <i class="bi bi-cart-x fs-1"></i>
                <h2 class="mt-2">Vaza korpa je prazna</h2>
                <a href="{{ route("home.index") }}" class="btn btn-primary mt-2">Pogledaj ponudu</a>
            </div>
        @else
            <div class="table-responsive p-2">
                <table class="table table-bordered align-middle">
                    <thead>
                    <tr>
                        <th>Proizvod</th>
                        <th>Dimenzije</th>
                        <th>Cena</th>
                        <th>Kolicina</th>
                        <th>Ukupna cena</th>
                        <th>Ukloni</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $p)
                        @php
                            $qty = auth()->check() ? $p->pivot->quantity : $cart[$p->id]['quantity'];
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($p->image_path)  }}" alt="Sofa" width="80" class="me-2">
                                    <span>{{ $p->name  }}</span>
                                </div>
                            </td>
                            <td>{{ $p->dimension->height.' x '.$p->dimension->width.' x '.$p->dimension->depth }}</td>
                            <td>{{ $p->price  }} RSD</td>
                            <td>{{ $qty  }}</td>
                            <td>{{ $p->price * $qty }} RSD </td>
                            <td>
                                <form action="{{ route("cart.destroy",[$p->id]) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-x"></i>Ukloni</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Ukupno:</td>
                        <td colspan="2" class="fw-bold">{{ $cartPrice }} RSD</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route("order.create")  }}" class="btn btn-success btn-lg">Nastavi</a>
            </div>
        @endif
    </div>
@endsection
