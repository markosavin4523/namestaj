@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Korisnici</h1>
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
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Korisnicko ime</th>
                        <th>E-mail</th>
                        <th>Uloga</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td>
                                <div>
                                    {{ $u->first_name}}
                                </div>
                            </td>
                            <td>
                                <div>{{ $u->last_name }}</div>
                            </td>
                            <td>
                                <div>{{ $u->username }}</div>
                            </td>
                            <td>
                                <div>{{ $u->email }}</div>
                            </td>
                            <td>
                                <div class="text-muted">{{ $u->role->name }}</div>
                            </td>
                            <td>
                                <div>{{ $u->status ? "Aktivan" : "Neaktivan"}}</div>
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
        {{ $users->withQueryString()->links() }}
    </div>
@endsection
