@props(['msg', 'type' => 'success'])
@if($msg)
    <div class="popup show row border">
        <div class="col-3 d-flex justify-content-center align-items-center {{ $type === 'error' ? 'popup--error' : 'popup--success' }}">
            <i class="fs-1 bi {{ $type === 'error' ? 'bi-x' : 'bi-check' }}  me-1"></i>
        </div>
        <div class="col-9 d-flex justify-content-center align-items-center">
            <p class="p-2 m-0">{{ $msg }}</p>
        </div>
    </div>
@endif
