<x-forms.modal :editForm='$editForm' title="User" id="user-modal">
    <x-forms.input label="Name" field="name" type="text" placeholder="Name" class="mb-4" />
    <x-forms.input label="Email" field="email" type="email" placeholder="Email" class="mb-4" />
    <div class="mb-4">
        <label class="">Province</label>
        <select class="form-control" wire:model.live='province_id'>
            <option value="">Select Province</option>
            @foreach ($provinces as $province )
                <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
        <x-forms.error field="province_id" />
    </div>
    <div class="mb-4">
        <label class="">City</label>
        <select class="form-control" wire:model.live='city_id'>
            <option value="">Select City</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" @if($city_id == $city->id) selected @endif>{{ $city->name }}</option>
            @endforeach
        </select>
        <x-forms.error field="city_id" />
    </div>
    <x-forms.input label="Address" field="address" type="text" placeholder="Address" class="mb-4" />
    <x-forms.input label="Instance" field="instance" type="text" placeholder="Instance" class="mb-4" />
    <x-forms.input label="Password" field="password" type="password" placeholder="Password" class="mb-4" />
    <x-forms.input label="Confirm Password" field="password_confirmation" type="password" placeholder="Confirm Password"
        class="mb-4" />
    <div class="mb-4">
        <label class="">Role</label>
        <select class="form-control" wire:model='is_admin'>
            <option value="0">Student</option>
            <option value="1">Admin</option>
        </select>
        <x-forms.error field="is_admin" />
    </div>
    <x-forms.input label="Photo" field="photo" type="file" placeholder="Photo" class="mb-5" />
    <button type="submit" class="btn btn-info" wire:loading.attr="disabled">Submit</button>
    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close" wire:click="$dispatch('reset-form')">Cancel</button>
</x-forms.modal>
