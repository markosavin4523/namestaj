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
                    <input type="text" class="form-control" name="email" value="{{ $request->email }}" id="">
                </div>
                <div class="form-group p-1">
                    <label for="">Uloga</label>
                    <select name="role" id="" class="form-select">
                        <option value="">Izaberi</option>
                        @foreach($roles as $r)
                            <option value="{{$r->id}}" {{ $r->id == $request->role ? "selected" : ""}}>{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group p-1">
                    <button class="btn btn-primary shadow-sm">Pretrazi</button>
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
                                <form action="{{ route("admin.role.update",["id"=>$u->id]) }}" method="POST" class="d-flex flex-row">
                                    @csrf
                                    @method("patch")
                                    <select name="role" class="form-select col-6">
                                        @foreach($roles as $r)
                                            <option value="{{$r->id}}" {{ $u->role->id == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i></button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route("admin.status.update",["id"=>$u->id]) }}" method="POST" class="d-flex flex-row">
                                    @csrf
                                    @method("patch")
                                    <select name="status" class="form-select col-6">
                                        <option value="0" {{ $u->status==0 ? "selected" : "" }}>Banovan</option>
                                        <option value="1" {{ $u->status==1 ? "selected" : "" }}>Aktivan</option>
                                    </select>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i></button>
                                </form>
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
