@extends('layout.layout')
@section('content')
    <div class="container d-flex justify-content-center align-items-center flex-colum pt-5 p-3">
        <div class="form mt-5 col-12 col-md-6 col-lg-3">
            <h2 class="text-center">Prijava</h2>
            <form action="{{ route('login')  }}" method="GET" class="">
                <input type="text" name="email" id="" class="form-control form-input" placeholder="E-mail">
                <x-error-message name="email"/>
                <input type="password" name="password" id="" class="form-control form-input mt-3" placeholder="Lozinka">
                <x-error-message name="password"/>
                <input type="submit" class="btn btn-primary form-input w-100 mt-3" value="Prijavi se">
            </form>
            <p>Nemate nalog? <a href="{{ route('register.index')  }}" class="btnUnderline">Registruj se</a></p>
        </div>
        @if(session('errors'))
            <p class="alert alert-danger">{{session('errors')}}</p>
        @endif
    </div>

@endsection
