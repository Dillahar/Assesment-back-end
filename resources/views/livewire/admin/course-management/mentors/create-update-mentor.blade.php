<x-forms.modal :editForm='$editForm' title="Mentor" id="mentor-modal">
    <x-forms.input label="Mentor Name" field="name" type="text" placeholder="Mentor  Name" class="mb-4" />
    <x-forms.input label="Profession" field="profession" type="text" placeholder="Profession" class="mb-4" />
    <x-forms.input label="Picture" field="picture" type="file" placeholder="Picture" class="mb-5" />
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" wire:click="$dispatch('reset-form')">Cancel</button>
</x-forms.modal>
