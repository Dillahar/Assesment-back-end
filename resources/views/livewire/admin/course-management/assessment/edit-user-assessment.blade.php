<x-forms.modal :editForm='$editForm' title="User Assessment" id="user-assessment-modal">
    <x-forms.input label="Score" field="score" type="text"
        placeholder="{{ $model ? $model->assessment->max_score : 0 }}" class="mb-4" />
    <p class="form-text text-info-light text-xs ms-1">Passed minimum score is:
        {{ $model ? $model->assessment->passed_min_score : 0 }}</p>
    <x-forms.input label="Assessment Note" field="note" type="text" placeholder="Some issue in...." class="mb-4" />
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close"
        wire:click="$dispatch('reset-form')">Cancel</button>
</x-forms.modal>
