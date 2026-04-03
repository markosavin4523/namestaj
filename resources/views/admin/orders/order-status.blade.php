@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Statusi porudzbina</h1>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <form action="{{ route("admin.orderStatuses.store") }}" method="POST" class="d-flex justify-content-center align-items-end">
                @csrf
                <div class="form-group p-1">
                    <label for="">Dodaj status</label>
                    <input type="text" class="form-control" name="status" id="">
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
                        <th>Status porudzbine</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statuses as $s)
                        <tr>
                            <td>
                                <div>
                                    {{ $s->name}}
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
        {{ $statuses->withQueryString()->links() }}
    </div>
@endsection
