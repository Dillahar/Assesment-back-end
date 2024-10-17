<x-forms.modal :editForm='$editForm' title="Category" id="subcategory-modal">
    <div class="mb-4">
        <label class="">Category</label>
        <select class="form-control" wire:model.live='category_id'>
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <x-forms.error field="category_id" />
    </div>
    <x-forms.input label="Sub-Category Name" field="name" type="text" placeholder="Sub-Category  Name" class="mb-4" />
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" wire:click="$dispatch('reset-form')">Cancel</button>
</x-forms.modal>
