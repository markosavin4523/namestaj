@extends('adminlte::page')

@section('title', 'Porudžbine')

@section('content_header')
    <h1>Proizvodi</h1>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="h3 fw-bold mb-1">Svi Proizvodi</h2>
                <p class="text-muted small mb-0">Upravljajte zalihama, cenama i vidljivošću nameštaja na sajtu.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-dark px-4 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i>Dodaj Proizvod
            </a>
        </div>

        <form action="{{ route("admin.products.index") }}" method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="name" class="form-control border-0 py-2" placeholder="Pretraži po nazivu ...">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select border-0 shadow-sm py-2">
                    <option value="">Sve Kategorije</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" disabled>{{ $cat->name }}</option>
                        @foreach($cat->children as $child)
                            <option class="ms-2" value="{{ $child->id }}">{{ $child->name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Pretrazi</button>
            </div>
        </form>

        <div class="bg-white rounded-4 shadow-sm overflow-hidden">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-uppercase small fw-bold text-muted" style="width: 80px">Slika</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Proizvod</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Kategorija</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Cena</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Zalihe</th>
                    <th class="pe-4 py-3 text-end text-uppercase small fw-bold text-muted">Akcije</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="ps-4">
                            <img src="{{ asset($product->image_path) }}"
                                 class="rounded-3 object-fit-cover"
                                 style="width: 50px; height: 50px;" alt="">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $product->name }}</div>
                        </td>
                        <td>
                        <span class="">
                            {{ $product->category->name ?? "nekategorizovan"  }}
                        </span>
                        </td>
                        <td>
                            <span class="">{{ number_format($product->price, 2) }} RSD</span>
                        </td>
                        <td>
                            @if($product->quantity <= 5)
                                <span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle me-1"></i>{{ $product->quantity }}</span>
                            @else
                                <span class="text-dark">{{ $product->quantity }} kom.</span>
                            @endif
                        </td>
                        <td class="text-end pe-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-link btn-sm text-secondary p-0 me-2">Izmeni</a>
                            <form action="{{ route('admin.products.quantityUpdate', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('patch')
                                <button class="btn btn-link btn-sm text-danger p-0" onclick="return confirm('Ukloni sa stanja?')">Ukloni</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="p-4 border-top bg-light">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
