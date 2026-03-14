@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <h2 class="mt-2">Nalog: {{ $user->first_name. " ". $user->last_name." /".$user->username}}</h2>
        @foreach(__('my-profile.cards') as $card)
            <div class="col-6 col-md-4 col-lg-3 p-2">
                <a href="{{ route($card['route']) }}" class="bg-white-color w-100 p-2">
                    <i class="fs-1 {{$card['icon']}}"></i>
                    {{$card['name']}}
                </a>
            </div>
        @endforeach
    </div>
@endsection
