
<!-- HEADER -->
<header class="border-bottom shadow-sm bg-white">
    <!-- Gornji red: Logo - Search - Ikonice -->
    <div class="container py-2">
        <div class="row align-items-center g-2">
            <!-- Logo levo, uvek vidljiv -->
            <div class="col-auto">
                <a class="navbar-brand fw-bold text-black" href="#">
                    <img src="logo.png" alt="Logo" width="40" height="40">
                </a>
            </div>
            <!-- Search input centriran, širi maksimalno koliko može-->
            <div class="col d-flex justify-content-center">
                <form class="w-100" style="max-width:400px;">
                    <input type="search" class="form-control" placeholder="Pretraga...">
                </form>
            </div>
            <!-- Ikonice desno -->
            <div class="col-auto d-flex align-items-center gap-3 text-black fs-4">
                <a href="#" title="Lajkovano"><i class="bi bi-heart"></i></a>
                <a href="#"  title="Profil"><i class="bi bi-person"></i></a>
                <a href="#" title="Korpa"><i class="bi bi-cart"></i></a>
            </div>
        </div>
    </div>
    <!-- Donji red: Navigacija sa kategorijama, hamburger za mobilni -->
    <div class="border-top">
        <div class="container">
            <nav class="py-1 d-flex justify-content-center align-items-center">
                <!-- Hamburger za male ekrane (d-md-none = samo mobil/tablet) -->
                <button class="btn d-md-none px-2 py-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCategories">
                    <i class="bi bi-list fs-3"></i>
                </button>
                <!-- Kategorije za desktop (d-none d-md-flex = skrivene na mobilu, prikazane na >=md) -->
                <ul class="nav gap-3 mx-auto d-none d-md-flex">
                    <li class="nav-item"><a class="nav-link text-black px-2" href="#">Kategorija 1</a></li>
                    <li class="nav-item"><a class="nav-link text-black px-2" href="#">Kategorija 2</a></li>
                    <li class="nav-item"><a class="nav-link text-black px-2" href="#">Kategorija 3</a></li>
                    <li class="nav-item"><a class="nav-link text-black px-2" href="#">Kategorija 4</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- Offcanvas meni za mobilne, sa leve strane -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCategories" aria-labelledby="offcanvasCategoriesLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCategoriesLabel">Kategorije</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a class="nav-link" href="#">Kategorija 1</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="#">Kategorija 2</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="#">Kategorija 3</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="#">Kategorija 4</a></li>
        </ul>
    </div>
</div>


