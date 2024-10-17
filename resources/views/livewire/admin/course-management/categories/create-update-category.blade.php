<x-forms.modal :editForm='$editForm' title="Category" id="category-modal">
    <x-forms.input label="Category Name" field="name" type="text" placeholder="Category Name" class="mb-4" />
    <x-forms.input label="Background" field="background" type="file" placeholder="Background" class="mb-5" />
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" wire:click="$dispatch('reset-form')">Cancel</button>
</x-forms.modal>
