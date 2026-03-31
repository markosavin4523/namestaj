@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Kategorije</h1>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Upravljanje Kategorijama</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-success px-4 rounded-pill">+ Nova Kategorija</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 40%">Naziv Kategorije</th>
                        <th>Tip</th>
                        <th style="width: 20%">Brza Izmena Naziva</th>
                        <th class="text-end">Akcije</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $cat)
                        {{-- RED ZA GLAVNU KATEGORIJU --}}
                        <tr class="table-info font-weight-bold">
                            <td>
                                <i class="bi bi-folder2-open me-2"></i>
                                <strong>{{ $cat->name }}</strong>
                            </td>
                            <td><span class="badge bg-primary">Glavna</span></td>
                            <td>
                                <input type="text" name="cat_name_{{ $cat->id }}" value="{{ $cat->name }}" class="form-control form-control-sm">
                            </td>
                            <td class="text-end">
                                <a href="{{ route('categories.edit', $cat) }}" class="btn btn-sm btn-outline-dark">Izmeni</a>
                                <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Obriši glavnu kategoriju i svu njenu decu?')">Obriši</button>
                                </form>
                            </td>
                        </tr>

                        {{-- REDOVI ZA DECU (PODKATEGORIJE) --}}
                        @foreach($cat->children as $child)
                            <tr>
                                <td class="ps-5 text-muted">
                                    <i class="bi bi-arrow-return-right me-2"></i>
                                    {{ $child->name }}
                                </td>
                                <td><span class="badge bg-secondary">Podkategorija</span></td>
                                <td>
                                    <input type="text" name="cat_name_{{ $child->id }}" value="{{ $child->name }}" class="form-control form-control-sm">
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('categories.edit', $child) }}" class="btn btn-sm btn-outline-secondary">Izmeni</a>
                                    <form action="{{ route('categories.destroy', $child) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Obriši podkategoriju?')">Obriši</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
