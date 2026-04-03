<!doctype html>
<html lang="en">
<head>
    @include("common.head")
</head>
<body class="d-flex flex-column min-vh-100">
<x-pages.pop-up-message msg="{{ session ('error') }}" type="error"/>
<x-pages.pop-up-message msg="{{ session ('success') }}" type="success"/>
    @include("common.header")
    <main class="flex-grow-1">
        <div id="loader-wrapper">
            <div class="loader"></div>
            <p>Učitavanje...</p>
        </div>
        @yield('content')
    </main>

    @include("common.footer")

@include("common.scripts")
</body>
</html>
