@extends("layout.layout")
@section("content")
    <div class="container pt-2 row m-auto">
        <x-pages.title title="Kreiraj porudzbinu"/>
        <div class="p-2 m-0">
            <div class="bg-white-color d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('cart.index') }}" class="btnUnderline text-black"><i class="bi bi-arrow-left"></i> Nazad na korpu</a>
                <p class="m-0 fw-bold">Ukupna cena: {{ $cartPrice }} RSD</p>
            </div>
            <form action="{{ route('order.store') }}" method="POST" class="bg-white-color p-4 mt-3">
                @csrf
                <h3>Popunite podatke o porudzbini</h3>
                <div class="form-group row">
                    <div class="form-group col-6">
                        <label for="">Ime</label>
                        {{-- Proveravamo auth() direktno unutar value atributa --}}
                        <input type="text" name="first_name" class="form-control form-input" placeholder="Ime"
                               value="{{ old('first_name', auth()->user()->first_name ?? '') }}">
                        <x-forms.error-message name="first_name"/>
                    </div>

                    <div class="form-group col-6">
                        <label for="">Prezime</label>
                        <input type="text" name="last_name" class="form-control form-input" placeholder="Prezime"
                               value="{{ old('last_name', auth()->user()->last_name ?? '') }}">
                        <x-forms.error-message name="last_name"/>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <div class="form-group col-6">
                        <label for="">Grad</label>
                        {{-- Ovde koristimo tvoju logiku za selektovani grad --}}
                        @php
                            $selectedCity = old('city', auth()->user()->info->city_id ?? '');
                        @endphp
                        <select name="city" id="" class="form-select form-input">
                            <option value="">Izaberi grad</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $city->id == $selectedCity ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-forms.error-message name="city"/>
                    </div>

                    <div class="form-group col-6">
                        <label for="">Postanski broj</label>
                        <input type="text" name="zip" class="form-control form-input" placeholder="Primer: 11000"
                               value="{{ old('zip', auth()->user()->info->zip ?? '') }}">
                        <x-forms.error-message name="zip"/>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="">Adresa za dostavu</label>
                    <input type="text" name="address" id="" class="form-control form-input" placeholder="Primer: Bulevar kralja Aleksandra 333"
                           value="{{ old('address', auth()->user()->info->address ?? '') }}">
                    <x-forms.error-message name="address"/>
                </div>

                <div class="form-group mt-3">
                    <label for="">Broj telefona</label>
                    <input type="text" name="phone" id="" class="form-control form-input" placeholder="Format: 0601234567"
                           value="{{ old('phone', auth()->user()->info->phone ?? '') }}">
                    <x-forms.error-message name="phone"/>
                </div>
                <div class="d-flex justify-content-end">
                    <input type="submit" value="Poruci" class="btn btn-primary mt-3">
                </div>

            </form>
        </div>

    </div>
@endsection
