<!doctype html>
<html lang="en">
@include("common.head")
<body>
@include("common.header")
@foreach($categories as $c)
    <p>{{ $c->name  }}</p>
    @foreach($categories->whereIn("id",$c->children()->id) as $sub)
        <p class="ms-5">{{ $sub->name }}</p>
    @endforeach
@endforeach
@yield("content")

@include("common.footer")

@include("common.scripts")
</body>
</html>
