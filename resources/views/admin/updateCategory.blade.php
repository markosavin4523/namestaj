@extends('adminlte::page')

@section('title', 'Izmena')

@section('content')
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}" class="text-decoration-none text-muted">Kategorije</a></li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">Izmena: {{ $category->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8">
                <div class="mb-5">
                    <h2 class="h3 fw-bold mb-1">Podešavanja kategorije</h2>
                </div>

                <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="needs-validation">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label class="form-label small text-uppercase fw-bold text-muted">Naziv kategorije</label>
                                <input type="text" name="name"
                                       class="form-control form-control-lg border-0 shadow-sm bg-white @error('name') is-invalid @enderror"
                                       value="{{ old('name', $category->name) }}"
                                       placeholder="npr. Ugaone garniture" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label small text-uppercase fw-bold text-muted">Pripada grupi (Roditelj)</label>
                                <select name="parent_id" class="form-select form-select-lg border-0 shadow-sm bg-white @error('parent_id') is-invalid @enderror">
                                    <option value="">Glavna kateogrija</option>
                                    @foreach($categories as $main)
                                        @if($main->id != $category->id)
                                            <option value="{{ $main->id }}"
                                                {{ (old('parent_id', $category->parent_id) == $main->id) ? 'selected' : '' }}>
                                                {{ $main->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        </div>

                        <div class="col-12 mt-5">
                            <hr class="opacity-10 mb-4">
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-dark btn-lg px-5 rounded-3">
                                    Sačuvaj izmene
                                </button>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-link text-decoration-none text-muted btn-lg">
                                    Odustani
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
