@props(['product'])
<!-- Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST">
            @csrf
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Dodaj svoju recenziju</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="comment">Komentar</label>
                        <textarea name="comment" id="comment" cols="30" rows="6" class="form-control"></textarea>
                        @error('comment')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="comment">Ocena</label>
                        <div class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="far fa-star fs-3 star text-warning" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="rating" id="rating" value="0">
                        @error('rating')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btnUnderline" data-bs-dismiss="modal">Otkaži</button>
                    <button type="submit" class="btn btn-primary">Postavi recenziju</button>
                </div>
            </div>
        </form>
    </div>
</div>
