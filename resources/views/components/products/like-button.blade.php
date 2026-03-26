@props(['p'])
<div class="product_like text-black">
    @if(Auth::check())
        @if (auth()->user()->likes()->where('product_id',$p->id)->first())
            <i class="btn-like bi bi-heart-fill" data-id="{{ $p->id  }}"></i>
        @else
            <i class="btn-like bi bi-heart" data-id="{{ $p->id  }}"></i>
        @endif
    @else
        @if (in_array($p->id,session()->get('guest_likes',[])))
            <i class="btn-like bi bi-heart-fill" data-id="{{ $p->id  }}"></i>
        @else
            <i class="btn-like bi bi-heart" data-id="{{ $p->id  }}"></i>
        @endif
    @endif
</div>
