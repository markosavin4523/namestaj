@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Aktivnosti korisnika</h1>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <form action="{{ route("admin.activity.index") }}" method="GET" class="d-flex justify-content-center align-items-end">
                <div class="form-group p-1">
                    <label for="">E-mail korisnika</label>
                    <input type="text" class="form-control" name="email" id="" placeholder="korisnik" value="{{ $request->email }}">
                </div>
                <div class="form-group p-1">
                    <label for="">Datum od</label>
                    <input type="date" class="form-control" name="date_from" id="" value="{{ $request->date_from }}" placeholder="korisnik">
                </div>
                <div class="form-group p-1">
                    <label for="">Datum od</label>
                    <input type="date" class="form-control" name="date_to" id="" value="{{ $request->date_to }}" placeholder="korisnik">
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
                        <th>Korisnik</th>
                        <th>Ruta / Akcija</th>
                        <th>Podaci</th>
                        <th>Query string</th>
                        <th>Datum</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $a)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2 bg-soft-primary text-primary">
                                        {{ $a->user }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $a->route }}</div>
                            </td>
                            <td>
                                <span data-toggle="tooltip" data-placement="top" title="{{ $a->data }}">
                                    {{ \Illuminate\Support\Str::limit($a->data, 20, '...') }}
                                </span>
                            </td>
                            <td>
                                <span data-toggle="tooltip" data-placement="top" title="{{ $a->query }}">
                                    {{ \Illuminate\Support\Str::limit($a->query, 20, '...') }}
                                </span>
                            </td>
                            <td class="pe-4">
                                <div class="text-muted">{{ $a->created_at->format('d.m.Y H:i') }}</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $activities->withQueryString()->links() }}
    </div>
@endsection
