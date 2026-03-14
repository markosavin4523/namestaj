@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <h2 class="mt-2">Nalog: {{ $user->first_name. " ". $user->last_name." /".$user->username}}</h2>
        @for($i=0;$i<6;$i++)
            <div class="col-6 col-md-4 col-lg-3 p-2">
                <div class="bg-white-color w-100 p-2">
                    <i class="fs-1 bi bi-person"></i>
                </div>
            </div>
        @endfor
    </div>
@endsection
