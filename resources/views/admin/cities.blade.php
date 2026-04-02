@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Gradovi</h1>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <form action="{{ route("admin.cities.index") }}" class="d-flex justify-content-center align-items-end">
                <div class="form-group p-1">
                    <label for="">Pretrazi grad</label>
                    <input type="text" class="form-control" value="{{ $request->city }}" name="city" id="">
                </div>
                <div class="form-group p-1">
                    <button class="btn btn-primary shadow-sm">Pretrazi</button>
                </div>
            </form>
            <form action="{{ route("admin.cities.store") }}" method="POST" class="d-flex justify-content-center align-items-end">
                @csrf
                <div class="form-group p-1">
                    <label for="">Dodaj grad</label>
                    <input type="text" class="form-control" name="city" id="">
                    @error("city")
                        <p class="red-color m-0">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group p-1">
                    <button class="btn btn-primary shadow-sm">Dodaj</button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>Grad</th>
                        <th>Brisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($cities->isEmpty())
                        <tr><div class="alert alert-warning">Ne postoji grad</div></tr>
                    @endif
                    @foreach($cities as $c)
                        <tr>
                            <td>
                                <div>
                                    {{ $c->name}}
                                </div>
                            </td>
                            <td>
                                <form action="{{ route("admin.cities.destroy",$c->id) }}" method="POST">
                                    @csrf
                                    @method("delete")
                                    <button class="btn btn-danger" onclick="return confirm('Obriši grad?')">Obrisi </button>
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
        {{ $cities->withQueryString()->links() }}
    </div>
@endsection
