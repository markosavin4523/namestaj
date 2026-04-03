@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Porudzbine</h1>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <form action="{{ route("admin.order.index") }}" method="GET" class="d-flex justify-content-center align-items-end">
                <div class="form-group p-1">
                    <label for="">E-mail ili username</label>
                    <input type="text" class="form-control" value="{{ $request->email }}" name="email" id="">
                </div>
                <div class="form-group p-1">
                    <label for="">Sifra porudzbine</label>
                    <input type="text" class="form-control" value="{{ $request->order }}" name="order" placeholder="primer ORD-12345623">
                </div>
                <div class="form-group p-1">
                    <button class="btn btn-primary shadow-sm">Pretrazi</button>
                </div>

            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>Korisnik</th>
                        <th>Sifra porudzbine</th>
                        <th>Ukupna cena</th>
                        <th>Datum</th>
                        <th>Status</th>
                        <th>Proizvodi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($orders->isEmpty())
                        <tr><div class="alert alert-warning">Ne postoje porudzbine u aplikaciji</div></tr>
                    @else
                        @foreach($orders as $o)
                            <x-admin.order-row :o="$o" :statuses="$statuses"/>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
