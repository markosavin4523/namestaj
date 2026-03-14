<!doctype html>
<html lang="en">
<head>
    @include("common.head")
</head>
<body class="d-flex flex-column min-vh-100">
    @include("common.header")

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include("common.footer")

@include("common.scripts")
</body>
</html>
