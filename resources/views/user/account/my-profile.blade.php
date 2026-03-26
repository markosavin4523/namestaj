@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <x-pages.title title="Moj nalog"/>
        @foreach(__('my-profile.cards') as $card)
            <div class="col-6 col-md-4 col-lg-3 p-2">
                <x-users.account-cards :icon="$card['icon']" :text="$card['name']" :route="$card['route']"/>
            </div>
        @endforeach
    </div>
@endsection
