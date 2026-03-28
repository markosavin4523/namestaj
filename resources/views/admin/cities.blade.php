@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Gradovi</h1>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <form action="" class="d-flex justify-content-center align-items-end">
                <div class="form-group p-1">
                    <label for="">Pretrazi grad</label>
                    <input type="text" class="form-control form-input" name="" id="">
                </div>
                <div class="form-group p-1">
                    <button class="btn btn-primary form-input shadow-sm">Pretrazi</button>
                </div>
            </form>
            <form action="" class="d-flex justify-content-center align-items-end">
                <div class="form-group p-1">
                    <label for="">Dodaj grad</label>
                    <input type="text" class="form-control form-input" name="" id="">
                </div>
                <div class="form-group p-1">
                    <button class="btn btn-primary form-input shadow-sm">Dodaj</button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>Grad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cities as $c)
                        <tr>
                            <td>
                                <div>
                                    {{ $c->name}}
                                </div>
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
