@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <x-pages.title title="Izmena lozinke"/>
        <div class="col-12 col-lg-3 p-2">
            <x-users.account-cards icon="bi bi-person-circle" :text="$user->first_name.' '.$user->last_name" :username="$user->username"/>
        </div>
        <div class="col-12 col-lg-9 p-2">
            <form action="{{ route('profile-password.update') }}" method="POST" class="bg-white-color p-4">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label for="">Trenutna lozinka</label>
                    <input type="password" name="old_password" id="" class="form-control form-input"/>
                    <x-forms.error-message name="old_password"/>
                </div>
                <div class="form-group mt-3">
                    <label for="">Nova lozinka</label>
                    <input type="password" name="password" id="" class="form-control form-input"/>
                    <x-forms.error-message name="password"/>
                </div>
                <div class="form-group mt-3">
                    <label for="">Ponovite novu lozinku</label>
                    <input type="password" name="password_confirmation" id="" class="form-control form-input"/>
                    <x-forms.error-message name="password_confirmation"/>
                </div>
                <input type="submit" value="Sacuvaj promene" class="btn btn-primary mt-3">
            </form>
            @if(session('error'))
                <p class="alert alert-danger rounded-0 mt-2">{{session('error')}}</p>
            @endif
        </div>
    </div>
@endsection
