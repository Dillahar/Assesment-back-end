@props(['id', 'title', 'editForm'])
<div wire:ignore.self class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">{{ $title }}</h2>
                <button type="button" class="btn-close" style="color:red" data-bs-dismiss="modal" aria-label="Close" wire:click="$dispatch('reset-form')">X</button>
            </div>
            <div class="modal-body">
                <div id="sp_result_div"></div>
                <form wire:submit='{{ $editForm ? 'update' : 'create' }}'>
                     {{ $slot }}
                </form>
            </div>

        </div>
    </div>
</div>