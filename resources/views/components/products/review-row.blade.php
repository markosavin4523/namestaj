@props(["review"])
<div class="review border bg-white-color p-2 mb-2">
    <span class="m-0 fw-bold me-2"><i class="bi bi-person-circle me-2"></i>{{ $review->user->first_name." ".$review->user->last_name }}</span>
    <div>
        @for($i=0;$i<5; $i++)
            @if ($i<$review->rate)
                <span><i class="bi bi-star-fill text-warning"></i></span>
            @else
                <span><i class="bi bi-star text-warning"></i></span>
            @endif
        @endfor
    </div>
    <div class="text-wrap wrap-break-word">
        <p class="m-0 text-secondary">{{ $review->comment }}</p>
    </div>
</div>
