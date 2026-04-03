@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Poruke</h1>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>Ime</th>
                        <th>Email</th>
                        <th>Poruka</th>
                        <th>Datum</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($messages->isEmpty())
                        <div><div class="alert alert-warning">Ne postoje poruke</div></div>
                    @endif
                    @foreach($messages as $m)
                            <tr class="{{ $m->is_seen ? "" : 'fw-bold' }}">
                                <td>{{ $m->name }}</td>
                                <td>{{ $m->email }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($m->question, 20, '...') }}</td>
                                <td>{{ $m->created_at->format("d.m") }}</td>
                                <td>
                                    <a href="{{ route("admin.contact.show",$m) }}">
                                        Pogledaj
                                    </a>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $messages->withQueryString()->links() }}
    </div>
@endsection
