<div class="container-fluid bg-primary-color">
    <div class="container d-flex justify-content-end">
        <a href="{{ route("contact.index")  }}" class="text-white me-3">Kontakt</a>
        <a href="{{ route("author.index")  }}" class="text-white">Autor</a>
        @auth
        @if(auth()->user()->role_id == 1)
            <a href="{{ route("admin.home.index")  }}" class="text-white ms-3">Admin panel</a>
        @endif
        @endauth
    </div>
</div>
<header class="border-bottom  bg-white position-sticky sticky-top">
    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center gap-4">

            <div class="d-flex align-items-center flex-row flex-shrink-0">
                <button class="btn d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCategories">
                    <i class="bi bi-list fs-3"></i>
                </button>
                <a href="{{ route('home.index') }}">
                    <h1 class="m-0 fs-2 fw-bold text-black">Opremi<span class="primary-color">Stan</span>.rs</h1>
                </a>
            </div>
            <div class="flex-grow-1 d-none d-md-flex justify-content-center" style="max-width: 600px;">
                <x-products.search-container/>
            </div>

            <div class="d-flex align-items-center gap-3 flex-shrink-0">
                <a href="{{ route('like.index') }}" class="icon-container text-black fs-4" title="Lajkovano">
                    <i class="bi bi-heart" id="header_like"></i>
                    <span id="like-count" class="circle-counter">
                        {{ $likeCount }}
                    </span>
                </a>
                <a href="{{ route('cart.index') }}" class="icon-container text-black fs-4" title="Korpa">
                    <i class="bi bi-cart" id="header_cart"></i>
                    <span id="cart-count" class="circle-counter">
                        {{ $cartCount }}
                    </span>
                </a>
                @if (Auth::check())
                    <div class="position-relative">
                        <p class="m-0 btnUnderline" id="header_username">
                            {{ Auth::user()->username }}
                            <i class="bi bi-chevron-down ms-1" id="header_arrow"></i>
                        </p>
                        <ul class="position-absolute top-100 start-0 p-0 border bg-white" id="header_dropDown_profileMenu" style="display:none;">
                            <li class="p-3"><a href="{{ route('my-profile.index')  }}" class="text-black"><i class="bi bi-person me-1"></i>Moj profil</a></li>
                            <li class="p-3"><a href="{{ route('profile-orders.index') }}" class="text-black"><i class="bi bi-list me-1"></i>Moje porudzbine</a></li>
                            <li class="p-0 m-0">
                                <form action="{{ route("logout") }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100 p-3"><i class="bi bi-box-arrow-left me-1"></i>Odjavi se</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-black fs-4" title="Profil"><i class="bi bi-person"></i></a>
                @endif
            </div>
        </div>
    </div>
    <div class="border-top">
        <div class="container">
            <nav class="d-flex justify-content-center align-items-center">
                <div class="flex-grow-1 d-flex d-md-none justify-content-center" style="max-width: 600px;">
                    <x-products.search-container/>
                </div>

                <ul class="nav gap-3 mx-auto d-none d-md-flex position-static">
                    @foreach($categories as $cat)
                        <li class="nav-item has-megamenu">
                            <a class="nav-link text-black px-2" href="{{ route("category.index",['category'=>$cat->slug]) }}">{{ $cat->name }}</a>
                            <div class="megamenu-block border-top border-bottom">
                                <div class="container">
                                    <div class="row py-4">
                                        @foreach($cat->children as $sub)
                                            <div class="col-md-3">
                                                <a class="btnUnderline text-black fws-bold" href="{{ route("category.index",['category'=>$cat->slug, 'subcategory'=>$sub->slug]) }}">{{ $sub->name }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</header>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasCategories" aria-labelledby="offcanvasCategoriesLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCategoriesLabel">Kategorije</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            @foreach($categories as $cat)
                <li class="nav-item mb-2"><a class="nav-link text-black px-2" href="{{ route("category.index",["category" => "$cat->slug"])  }}">{{ $cat->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>


