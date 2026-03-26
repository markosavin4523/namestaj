@props(['icon','text','username'=>null, 'route'=>null])
@if($route)
    <a class="bg-white-color d-block link text-black link p-2" href="{{ route($route)  }}">
        <div class="account-card">
            <i class="{{ $icon }}"></i>
        </div>
        <p class="text-center fs-3 m-0">{{ $text }}</p>
    </a>
@else
    <div class="bg-white-color p-2">
        <div class="account-card">
            <i class="{{ $icon }}"></i>
        </div>
        <p class="text-center fs-3 m-0">{{ $text }}</p>
        <p class="text-center text-secondary m-0">~{{ $username  }}</p>
    </div>
@endif
