@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Upravljanje Kategorijama</h2>
            <form action="{{ route('admin.categories.store') }}" method="POST" class="d-flex flex-row">
                @csrf
                <input type="hidden" name="parent_id" value="">
                <input type="text" placeholder="Dodaj glavnu kategoriju" class="form-control" name="name" required>
                @error("name")
                    <p class="red-color">{{ $message }}</p>
                @enderror
                <button href="" class="btn btn-primary px-4 shadow-sm">Dodaj</button>
            </form>
        </div>

        @foreach($parentCategories as $cat)
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 small text-uppercase fw-bold tracking-wide">
                        <i class="bi bi-folder-fill me-2"></i> {{ $cat->name }}
                    </h5>
                    <div>
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-outline-light border-0">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Obriši glavnu kategoriju i svu decu?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <tbody>
                        @foreach($cat->children as $child)
                            <tr>
                                <td class="ps-4" style="width: 70%">
                                    <i class="bi bi-arrow-return-right text-muted me-2"></i>
                                    {{ $child->name }}
                                </td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('admin.categories.edit', $child) }}" class="btn btn-link btn-sm text-secondary p-0 me-2">Izmeni</a>
                                    <form action="{{ route('admin.categories.destroy', $child) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-link btn-sm text-danger p-0" onclick="return confirm('Obriši kategoriju i sve?')">Obriši</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        {{-- INPUT ZA BRZO DODAVANJE PODKATEGORIJE --}}
                        <tr class="bg-light">
                            <td colspan="2" class="p-2 ps-4">
                                <form action="{{ route('admin.categories.store') }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $cat->id }}">
                                    <input type="text" name="name" class="form-control form-control-sm border-dashed" placeholder="Dodaj novu podkategoriju u '{{ $cat->name }}'..." required>
                                    @error("name")
                                    <p class="red-color">{{ $message }}</p>
                                    @enderror
                                    <button type="submit" class="btn btn-sm btn-success px-3">Dodaj</button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    <div class="w-100 d-flex justify-content-center">
        {{ $parentCategories->withQueryString()->links() }}
    </div>
    <style>
        .border-dashed { border-style: dashed; }
        .tracking-wide { letter-spacing: 1px; }
    </style>
@endsection

