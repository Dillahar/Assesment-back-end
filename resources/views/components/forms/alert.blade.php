@if(flash()->message)
    <div class="alert alert-{{ flash()->class ?? "success" }}" role="alert">
        {{ flash()->message }}
    </div>
@endif