@extends('layout.layout')
@section('content')
    <div class="container d-flex justify-content-center align-items-center flex-colum pt-5 p-3">
        <div class="form mt-5 col-12 col-md-6 col-lg-4">
            <h2 class="text-center">Registracija</h2>
            <form action="{{ route('register') }}" method="POST" class="">
                @csrf
                <div class="form-group row">
                    <div class="form-group col-6">
                        <input type="text" name="first_name" class="form-control form-input" placeholder="Ime">
                        <x-error-message name="first_name"/>
                    </div>
                    <div class="form-group col-6">
                        <input type="text" name="last_name" class="form-control form-input" placeholder="Prezime">
                        <x-error-message name="last_name"/>
                    </div>
                </div>
                <input type="text" name="email" id="" class="form-control form-input mt-3" placeholder="E-mail">
                <x-error-message name="email"/>
                <input type="text" name="username" id="" class="form-control form-input mt-3" placeholder="Korisnicko ime">
                <x-error-message name="username"/>
                <input type="password" name="password" id="" class="form-control form-input mt-3" placeholder="Lozinka">
                <x-error-message name="password"/>
                <input type="password" name="password_confirmation" id="" class="form-control form-input mt-3" placeholder="Ponovite lozinku">
                <x-error-message name="password_confirmation"/>
                <input type="submit" class="btn btn-primary form-input w-100 mt-3" value="Registruj se">
            </form>
            <p>Imate nalog? <a href="{{ route('login.index')  }}" class="btnUnderline">Uloguj se</a></p>
        </div>
    </div>
@endsection
