@extends('layout.layout')
@section('content')
    <div class="container d-flex justify-content-center align-items-center flex-colum pt-5 p-3">
        <div class="form mt-5 col-12 col-md-6 col-lg-3">
            <h2 class="text-center">Prijava</h2>
            <form action="/login" method="GET" class="">
                <div class="form-group">
                    <x-forms.input-field type="text" placeholder="E-mail" name="email"/>
                </div>
                <div class="form-group mt-3">
                    <x-forms.input-field type="password" placeholder="Lozinka" name="password"/>
                </div>
                <input type="submit" class="btn btn-primary form-input w-100 mt-3" value="Prijavi se">
            </form>
            <p>Nemate nalog? <a href="{{ route('register')  }}" class="btnUnderline">Registruj se</a></p>
        </div>
        @if(session('errors'))
            <p class="alert alert-danger">{{session('errors')}}</p>
        @endif
    </div>

@endsection
