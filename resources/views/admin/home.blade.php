
@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Admin panel</h1>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row g-4">

            <!-- Prodatih proizvoda -->
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary text-white rounded-3 p-3 me-3">
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Proizvodi</h6>
                            <h3 class="fw-bold mb-0">{{ $countProducts }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dostavljene porudžbine -->
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-success text-white rounded-3 p-3 me-3">
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Broj porudzbina</h6>
                            <h3 class="fw-bold mb-0">{{ $countOrders  }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Korisnici -->
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-warning text-white rounded-3 p-3 me-3">
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Korisnici</h6>
                            <h3 class="fw-bold mb-0">{{ $countUsers  }} </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ukupne porudžbine -->
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-danger text-white rounded-3 p-3 me-3">

                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Prodatih proizvoda</h6>
                            <h3 class="fw-bold mb-0">{{ $countSoldProducts}}</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
