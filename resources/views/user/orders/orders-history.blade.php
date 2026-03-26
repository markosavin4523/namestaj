@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <x-pages.title title="Istorija porudzbina"/>
        @if($orders->isEmpty())
            <div class="mt-2"><p class="alert alert-warning rounded-0">Nemate zatvorenih poruzbina</p></div>
        @else
            <x-users.order-list :orders="$orders"/>
            <div>
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
