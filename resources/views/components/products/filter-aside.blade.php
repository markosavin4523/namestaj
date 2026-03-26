
<div class="card mb-4 rounded-0 position-sticky" style="top:100px;">
    <div class="card-header"><i class="bi bi-funnel"></i> Filteri</div>
    <div class="card-body">
        <form>
            <!-- Category filter -->
            <div class="mb-3">
                <label class="form-label">Sortiraj po</label>
                <select class="form-select form-input">
                    <option>Cena opadajuce</option>
                    <option>Cena rastuce</option>
                </select>
            </div>
            <!-- Price filter -->
            <div class="mb-3">
                <label class="form-label">Cena (RSD)</label>
                <input type="range" class="form-range" min="100" max="5000" value="1000" id="priceRange">
                <div id="priceDisplay">Do 10000 dinara</div>
            </div>
            <!-- Dimensions filter -->
            <div class="mb-3">
                <label class="form-label">Duzina (cm)</label>
                <input type="number" class="form-control  form-input mb-1" placeholder="Min">
                <input type="number" class="form-control  form-input" placeholder="Max">
            </div>
            <div class="mb-3">
                <label class="form-label">Visina (cm)</label>
                <input type="number" class="form-control  form-input mb-1" placeholder="Min">
                <input type="number" class="form-control  form-input" placeholder="Max">
            </div>
            <div class="mb-3">
                <label class="form-label">Dubina (cm)</label>
                <input type="number" class="form-control  form-input mb-1" placeholder="Min">
                <input type="number" class="form-control  form-input" placeholder="Max">
            </div>
            <button type="submit" class="btn btn-primary w-100">Primerni filtere</button>
        </form>
    </div>
</div>
