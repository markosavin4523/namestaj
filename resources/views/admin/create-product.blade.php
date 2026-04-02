@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Kreiraj proizvod</h1>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}" class="text-decoration-none text-muted">Proizvodi</a></li>
                <li class="breadcrumb-item active fw-bold text-dark">Novi Proizvod</li>
            </ol>
        </nav>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
                        <h5 class="fw-bold mb-4">Osnovne Informacije</h5>

                        <div class="mb-4">
                            <label class="form-label small text-uppercase fw-bold text-muted">Naziv Proizvoda</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="npr. Drveni Trpezarijski Sto">
                            @error("name")
                            <p class="red-color">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-uppercase fw-bold text-muted">Opis</label>
                            <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Detaljan opis materijala, završne obrade...">{{ old('description') }}</textarea>
                            @error("description")
                            <p class="red-color">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-uppercase fw-bold text-muted">Glavna Kategorija</label>
                                <select id="main_category" class="form-select">
                                    <option value="0">Izaberi glavnu...</option>
                                    @foreach($mainCategories as $main)
                                        <option value="{{ $main->id }}">{{ $main->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-uppercase fw-bold text-muted">Podkategorija</label>
                                <select name="category_id" id="sub_category" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">Prvo izaberi glavnu...</option>
                                    <div id="subcategory-options">

                                    </div>
                                </select>
                                @error("category_id")
                                <p class="red-color">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
                        <h5 class="fw-bold mb-4">Dimenzije (cm)</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label text-muted small fw-bold">Širina</label>
                                <div class="input-group">
                                    <input type="number" name="width" class="form-control" value="{{ old('width') }}">
                                    <span class="input-group-text bg-light text-muted small">cm</span>
                                </div>
                                @error("width")
                                <p class="red-color">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small fw-bold">Visina</label>
                                <div class="input-group">
                                    <input type="number" name="height" class="form-control" value="{{ old('height') }}">
                                    <span class="input-group-text bg-light text-muted small">cm</span>
                                </div>
                                @error("height")
                                <p class="red-color">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small fw-bold">Dubina</label>
                                <div class="input-group">
                                    <input type="number" name="depth" class="form-control" value="{{ old('depth') }}">
                                    <span class="input-group-text bg-light text-muted small">cm</span>
                                </div>
                                @error("depth")
                                <p class="red-color">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
                        <h5 class="fw-bold mb-4">Cena i Zalihe</h5>
                        <div class="mb-4">
                            <label class="form-label small text-uppercase fw-bold text-muted">Cena (RSD)</label>
                            <input type="number" name="price" class="form-control form-control-lg fw-bold" value="{{ old('price') }}">
                            @error("price")
                            <p class="red-color">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label small text-uppercase fw-bold text-muted">Količina na zalihama</label>
                            <input type="number" name="quantity" class="form-control" value="{{ old('stock', 0) }}">
                            @error("quantity")
                            <p class="red-color">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
                        <h5 class="fw-bold mb-4">Slika Proizvoda</h5>
                        <div class="mb-3">
                            <input type="file" name="image" class="form-control border-0 bg-light" id="imageInput">
                            @error("image")
                            <p class="red-color">{{$message}}</p>
                            @enderror
                        </div>
                        <div id="imagePreview" class="rounded-3 bg-light d-flex align-items-center justify-content-center border-dashed" style="height: 200px; border: 2px dashed #dee2e6;">
                            <span class="text-muted small">Pregled slike će se pojaviti ovde</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark btn-lg rounded-3">Objavi Proizvod</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-link text-decoration-none text-muted">Otkaži</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
