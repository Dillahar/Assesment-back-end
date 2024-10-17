@props(['field'])
@if ($errors->has($field))
    <p class="text-danger mt-2">{{ $errors->first($field) }}</p>
@endif
