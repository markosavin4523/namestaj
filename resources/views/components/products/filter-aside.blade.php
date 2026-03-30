
<div class="card mb-4 rounded-0 position-sticky" style="top:100px;">
    <div class="card-header"><i class="bi bi-funnel"></i> Filteri</div>
    <div class="card-body">
        <form action="{{ route("category.index",["category"=>$c->slug , "subcategory"=>$s->slug]) }}" method="GET">
            <!-- Category filter -->
            <div class="mb-3">
                <label class="form-label">Sortiraj po</label>
                <select name="sort" class="form-select form-input">
                    <option value="">Izaberi</option>
                    <option value="desc" {{ $r->sort == "desc" ? "selected" : ""}}>Cena opadajuce</option>
                    <option value="asc" {{ $r->sort == "asc" ? "selected" : ""}}>Cena rastuce</option>
                </select>
            </div>
            <!-- Price filter -->
            <div class="mb-3">
                <label class="form-label">Cena (RSD)</label>
                <input type="range" name="price" class="form-range" min="0" max="10000" value="{{ $r->price ? $r->price : 0 }}" id="priceRange">
                <div id="priceDisplay"></div>
            </div>
            <!-- Dimensions filter -->
            <div class="mb-3">
                <label class="form-label">Sirina (cm)</label>
                <input type="number" value="{{$r->min_width}}" name="min_width" class="form-control  form-input mb-1" placeholder="Min">
                <input type="number" value="{{$r->max_width}}" name="max_width" class="form-control  form-input" placeholder="Max">
            </div>
            <div class="mb-3">
                <label class="form-label">Visina (cm)</label>
                <input type="number" value="{{$r->min_height}}" name="min_height" class="form-control  form-input mb-1" placeholder="Min">
                <input type="number" value="{{$r->max_height}}" name="max_height" class="form-control  form-input" placeholder="Max">
            </div>
            <div class="mb-3">
                <label class="form-label">Dubina (cm)</label>
                <input type="number" value="{{$r->min_depth}}" name="min_depth" class="form-control  form-input mb-1" placeholder="Min">
                <input type="number" value="{{$r->max_depth}}" name="max_depth" class="form-control  form-input" placeholder="Max">
            </div>
            <button type="submit" class="btn btn-primary w-100">Primerni filtere</button>
            <a href="{{ route("category.index",["category"=>$c->slug , "subcategory"=>$s->slug]) }}" class="btn btnUnderline text-center w-100"><i
                        class="bi bi-arrow-clockwise me-1"></i>Resetuj filtere
            </a>
        </form>
    </div>
</div>
