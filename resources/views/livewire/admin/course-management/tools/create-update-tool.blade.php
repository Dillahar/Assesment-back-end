<x-forms.modal :editForm='$editForm' title="Tool" id="tool-modal">
    <x-forms.input label="Image" field="image" type="file" placeholder="Image" class="mb-4" />
    <x-forms.input label="Name" field="name" type="text" placeholder="Name" class="mb-4" />
    <x-forms.input label="Description" field="description" type="text" placeholder="Description" class="mb-4" />
    <x-forms.input label="Link" field="link" type="text" placeholder="https://example.com" class="mb-5" />
    
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" wire:click="$dispatch('reset-form')">Cancel</button>
</x-forms.modal>
