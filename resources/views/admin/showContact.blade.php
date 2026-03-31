@extends('adminlte::page')

@section('title', 'Poruke')

@section('content')
    <div class="container-fluid p-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">Poruka od: {{ $c->name }}</h5>
                <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="bi bi-arrow-left"></i> Nazad na listu
                </a>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-muted mb-1 text-uppercase fs-7 fw-bold">Email adresa</p>
                        <p class="lead text-primary">{{ $c->email }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="text-muted mb-1 text-uppercase fs-7 fw-bold">Datum slanja</p>
                        <p>{{ $c->created_at->format('d.m.Y. \u H:i') }}</p>
                    </div>
                </div>

                <hr class="text-dark">

                <div class="mt-4">
                    <p class="text-muted mb-2 text-uppercase fs-7 fw-bold">Sadržaj pitanja:</p>
                    <div class="p-4 bg-light rounded-3 border">
                        {{ $c->question }}
                    </div>
                </div>
            </div>
            <div class="card-footer py-3">
                {{-- Ovde možeš dodati dugme "Odgovori" koje otvara mailto link --}}
                <a href="mailto:{{ $c->email }}?subject=Odgovor na vaše pitanje" class="btn btn-primary">
                    Odgovori putem mejla
                </a>
            </div>
        </div>
    </div>
@endsection
