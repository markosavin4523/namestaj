<div class="container-fluid d-flex justify-content-center">
    <footer class="container row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
            <p class="text-body-secondary">© 2026</p></div>
        <div class="col mb-3"></div>
        <div class="col mb-3"><h5>Kategorije</h5>
            <ul class="nav flex-column">
                @foreach($categories as $c)
                    <li class="nav-item mb-2"><a href="{{ route("category.index",$c->slug) }}" class="nav-link p-0 text-body-secondary">{{ $c->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col mb-3"><h5>Autor</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ route("contact.index") }}" class="nav-link p-0 text-body-secondary">Kontakt</a></li>
                <li class="nav-item mb-2"><a href="{{ route("author.index") }}" class="nav-link p-0 text-body-secondary">Autor</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Dokumentacija</a></li>
            </ul>
        </div>
        <div class="col mb-3"><h5>Dokumentaicja</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="{{ asset("dokumentacija.pdf") }}" class="nav-link p-0 text-body-secondary">Dokumentacija</a></li>
            </ul>
        </div>
    </footer>
</div>
