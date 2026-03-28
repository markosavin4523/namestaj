@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Porudzbine</h1>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <form action="" class="d-flex justify-content-center align-items-end">
                <div class="form-group p-1">
                    <label for="">E-mail ili username</label>
                    <input type="text" class="form-control form-input" name="" id="">
                </div>
                <div class="form-group p-1">
                    <label for="">Sifra porudzbine</label>
                    <input type="text" class="form-control form-input" name="" placeholder="primer ORD-12345623">
                </div>
                <div class="form-group p-1">
                    <button class="btn btn-primary form-input shadow-sm">Pretrazi</button>
                </div>

            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
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
                    @foreach($orders as $o)
                        <tr>
                            <td>
                                <div>
                                    {{ $o->user->email ?? $o->details->first_name." ".$o->details->last_name}}
                                </div>
                            </td>
                            <td>
                                <div>{{ $o->order_number }}</div>
                            </td>
                            <td>
                                <div>{{ $o->total_price }} RSD</div>
                            </td>
                            <td>
                                <div class="text-muted">{{ $o->created_at->format('d.m.Y H:i') }}</div>
                            </td>
                            <td>
                                <div>{{ $o->status->name }}</div>
                            </td>
                            <td>
                                <a href="" class="">Proizvodi</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
