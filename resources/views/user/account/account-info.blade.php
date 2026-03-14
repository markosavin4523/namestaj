@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <div class="col-12 col-lg-3">
            <div class="bg-white-color p-5">

            </div>
        </div>
        <div class="col-12 col-lg-9">
            <form action="{{ route('profile-required.update')  }}" method="POST" class="bg-white-color p-4">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="form-group col-6">
                        <label for="">Ime</label>
                        <input type="text" name="first_name" class="form-control form-input" placeholder="Ime"
                               value="{{ old("first_name") ?? $user->first_name }}">
                        <x-forms.error-message name="first_name"/>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Prezime</label>
                        <input type="text" name="last_name" class="form-control form-input" placeholder="Prezime"
                               value="{{ old("last_name") ?? $user->last_name }}">
                        <x-forms.error-message name="last_name"/>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" class="form-control form-input" placeholder="E-mail"
                           value="{{ old("email") ?? $user->email }}">
                    <x-forms.error-message name="email"/>
                </div>
                <div class="form-group mt-3">
                    <label for="">Korisnicko ime</label>
                    <input type="text" name="username" id="" class="form-control form-input" placeholder="Korisnicko ime"
                           value="{{ old("username") ?? $user->username }}">
                    <x-forms.error-message name="username"/>
                </div>
                <input type="submit" value="Sacuvaj promene" class="btn btn-primary mt-3">
            </form>
        </div>
    </div>
@endsection
