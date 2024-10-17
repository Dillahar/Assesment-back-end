<x-forms.modal :editForm='$editForm' title="Module" id="module-modal">
    <x-forms.input label="Title" field="title" type="text" placeholder="Module title" class="mb-4" />
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" wire:click="$dispatch('reset-form')">Cancel</button>
</x-forms.modal>
