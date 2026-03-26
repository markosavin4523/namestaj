@extends('layout.layout')
@section('content')
    <div class="container pt-2 m-auto">
        <x-pages.title title="Moje porudzbine"/>
        @if($orders->isEmpty())
            <div class="mt-2"><p class="alert alert-warning rounded-0">Trenutno nemate aktivnih porudzbina</p></div>
        @else
            <x-users.order-list :orders="$orders"/>
            <div>
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
