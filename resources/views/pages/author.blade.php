@extends('layout.layout')
@section('content')
    <div class="container pt-2">
        <x-pages.title title="Autor"/>
        <div class="row">
            <div class="col-12 col-md-4 p-4">
                <img src="{{ asset("images/autor.jpg") }}" alt="autor" class="w-100">
            </div>
            <div class="col-12 col-md-6 p-4">
                <h2>Marko Savin</h2>
                <p>
                    45/23
                </p>
                <p>
                    Ja sam Marko Savin, student 3. godine na Visokoj ICT skoli.<br>
                    Napravio sam online prodavnicu namestaja u Laravel frameworku. <br>

                </p>
            </div>
        </div>
    </div>
@endsection
