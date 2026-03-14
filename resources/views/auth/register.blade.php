@extends('layout.layout')
@section('content')
    <div class="container d-flex justify-content-center align-items-center flex-colum pt-5 p-3">
        <div class="form mt-5 col-12 col-md-6 col-lg-4">
            <h2 class="text-center">Registracija</h2>
            <form action="/register" method="POST" class="">
                @csrf
                <div class="form-group row">
                    <div class="form-group col-6">
                        <x-forms.input-field type="text" placeholder="Ime" name="first_name"/>
                    </div>
                    <div class="form-group col-6">
                        <x-forms.input-field type="text" placeholder="Prezime" name="last_name"/>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <x-forms.input-field type="text" placeholder="E-mail" name="email"/>
                </div>
                <div class="form-group mt-3">
                    <x-forms.input-field type="text" placeholder="Korisnicko ime" name="username"/>
                </div>
                <div class="form-group mt-3">
                    <x-forms.input-field type="password" placeholder="Lozinka" name="password"/>
                </div>
                <div class="form-group mt-3">
                    <x-forms.input-field type="password" placeholder="Ponovite lozinku" name="password_confirmation"/>
                </div>

                <input type="submit" class="btn btn-primary form-input w-100 mt-3" value="Registruj se">
            </form>
            <p>Imate nalog? <a href="{{ route('login')  }}" class="btnUnderline">Uloguj se</a></p>
        </div>
    </div>
@endsection
