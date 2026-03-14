@props(['name'])
@error($name)
<p class="red-color m-0">{{ $message }}</p>
@enderror
