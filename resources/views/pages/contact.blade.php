@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <x-pages.title title="Kontakt"/>
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm rounded-0 overflow-hidden">
                            <div class="row g-0">
                                <div class="col-md-5 bg-primary-color text-white p-5 d-flex flex-column justify-content-center">
                                    <h3 class="fw-bold mb-4">Kontaktirajte nas</h3>
                                    <p class="text-white-50 mb-5">Imate pitanje o našem nameštaju? Tu smo da pomognemo.</p>

                                    <div class="d-flex mb-3">
                                        <i class="bi bi-geo-alt me-3 fs-5 text-primary"></i>
                                        <span>Bulevar Kralja Aleksandra 123, Beograd</span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-envelope me-3 fs-5 text-primary"></i>
                                        <span>podrska@opremistan.rs</span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <i class="bi bi-telephone me-3 fs-5 text-primary"></i>
                                        <span>+381 11 123 4567</span>
                                    </div>
                                </div>

                                <div class="col-md-7 p-5 bg-white">
                                    <form action="{{ route("contact.store") }}" method="POST">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label fw-semibold">Vaše Ime</label>
                                                <input type="text" name="name" class="form-control form-control-lg bg-light border-0 shadow-none" placeholder="Marko Marković">
                                                @error("name")
                                                    <p class="m-0 red-color">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label fw-semibold">Email Adresa</label>
                                                <input type="email" name="email" class="form-control form-control-lg bg-light border-0 shadow-none" placeholder="ime@primer.rs">
                                                @error("email")
                                                <p class="m-0 red-color">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label fw-semibold">Vaše Pitanje</label>
                                                <textarea name="question" class="form-control bg-light border-0 shadow-none" rows="4" placeholder="Kako vam možemo pomoći?" ></textarea>
                                                @error("question")
                                                <p class="m-0 red-color">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm">
                                                    Pošalji poruku
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
