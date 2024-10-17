<x-forms.modal :editForm='$editForm' title="Discount" id="discount-modal">
    <div class="mb-4">
        <label for="code">Code</label>
        <label class="text-danger">*</label>
        <div class="row">
            <div class="col-md-9">


                <input id="code" type="text" name="code" class="form-control" placeholder="Code"
                    aria-label="Code" aria-describedby="code-addon" wire:model="code">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-info" wire:click='generateCode'>Generate
                </button>
            </div>
        </div>
        <x-forms.error field="code" />
    </div>
    <div class="mb-4">
        <label class="">Type</label>
        <select class="form-control" wire:model='type'>
            <option value="">Select Type</option>
            @foreach (\App\Enums\DiscountType::values() as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </select>
        <x-forms.error field="type" />
    </div>
    <x-forms.input label="Value" field="value" type="number" placeholder="Value" class="mb-4" />
    <x-forms.input label="Max Usage" field="max_usage" type="number" placeholder="Max Usage" />
    <p class="form-text text-info-light text-xs mb-4 ms-1">
        Leave blank if you want to set unlimited usage.
    </p>
    <x-forms.input label="Expired At" field="expired_at" type="date" placeholder="Expired At" class="mb-4" />
    <div class="mb-4">
        <label class="">Is Active</label>
        <select class="form-control" wire:model='is_active'>
            <option value="1">Active</option>
            <option value="0">Inactie</option>
        </select>
        <x-forms.error field="is_active" />
    </div>
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close"
        wire:click="$dispatch('reset-form')">Cancel</button>
</x-forms.modal>
