@extends('layout.layout')
@section('content')
    <div class="container pt-2 row m-auto">
        <x-pages.title title="Licni podaci"/>
        <div class="col-12 col-lg-3 p-2">
            <x-users.account-cards icon="bi bi-person-circle" :text="$user->first_name.' '.$user->last_name" :username="$user->username"/>
        </div>
        <div class="col-12 col-lg-9 p-2">
            <form action="{{ route('profile-personal.update') }}" method="POST" class="bg-white-color p-4">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <div class="form-group col-6">
                        <label for="">Grad</label>
                        @php
                        $selectedCity = old('city', $user->info->city_id ?? '');
                        @endphp
                        <select name="city" id="" class="form-select form-input">
                            <option value="">Izaberi grad</option>
                            @foreach($cities as $city)
                                @if($city->id == $selectedCity)
                                    <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                                @else
                                    <option value="{{ $city->id  }}">{{ $city->name  }}</option>
                                @endif
                            @endforeach
                        </select>
                        <x-forms.error-message name="city"/>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Postanski broj</label>
                        <input type="text" name="zip" class="form-control form-input" placeholder="Primer: 11000"
                               value="{{ old("zip") ?? $user->info->zip ?? "" }}">
                        <x-forms.error-message name="zip"/>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="">Adresa za dostavu</label>
                    <input type="text" name="address" id="" class="form-control form-input" placeholder="Primer: Bulevar kralja Aleksandra 333"
                           value="{{ old("address") ?? $user->info->address ?? ""}}">
                    <x-forms.error-message name="address"/>
                </div>
                <div class="form-group mt-3">
                    <label for="">Broj telefona</label>
                    <input type="text" name="phone" id="" class="form-control form-input" placeholder="Format: 0601234567"
                           value="{{ old("phone") ?? $user->info->phone ?? "" }}">
                    <x-forms.error-message name="phone"/>
                </div>
                <input type="submit" value="Sacuvaj promene" class="btn btn-primary mt-3">
            </form>
        </div>
    </div>
@endsection
