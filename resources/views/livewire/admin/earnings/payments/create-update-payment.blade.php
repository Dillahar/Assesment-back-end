<form wire:submit='{{ $editForm ? 'update' : 'create' }}'>
    <div class="mb-4">
        <div class="row">
            <div class="col-lg-6">
                <h4> {{ $editForm ? 'Edit' : 'Add' }} payment</h4>

            </div>
            <div class="col-lg-6 text-end d-flex flex-row">

                <button type="submit" class="btn btn-info mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0">Save</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Payment Information</h5>
                        <div class="row">

                        </div>
                        <x-forms.input label="Bank Name" field="bank" type="text" placeholder="Ex BCA"
                            class="form-group" asterisk='1' />
                        <x-forms.input label="Bank Number" field="number" type="text" placeholder="123456789"
                            class="form-group" asterisk='1' />
                        <x-forms.input label="Account Name" field="name" type="text"
                            placeholder="PT. Permata Cendekia Indonesia" class="form-group" asterisk='1' />
                        <div class="mt-3">
                            <label class="">Is Active</label><label class="text-danger">*</label>

                            <select class="form-control" aria-label="Default select example" wire:model='is_active'>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <x-forms.error field="is_active" />
                        </div>



                        <div class="form-group" wire:ignore>
                            <label class="mt-4" for="instructions">Instructions</label><label
                                class="text-danger">*</label>
                            <textarea class="form-control" rows="10" id="instructions" name="instructions" wire:model='instructions'></textarea>
                        </div>
                        <x-forms.error field="instructions" />
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Media</h5>
                        <div class="row">
                            <div class="col-12">

                                @if (!$editForm)
                                    @if ($useTemp)
                                        <img src="{{ $useTemp ? $logo->temporaryUrl() : asset('img/placeholder.jpeg') }}"
                                            class="w-100 border-radius-lg shadow-lg mt-3">
                                    @endif
                                @else
                                    <img src="{{ $useTemp ? $logo->temporaryUrl() : asset($model->logo_url) }}"
                                        class="w-100  border-radius-lg shadow-lg mt-3">
                                @endif
                            </div>

                            <div class="align-self-center">
                                <x-forms.input label="Upload Logo" field="logo" type="file"
                                    placeholder="Upload Logo" class="mt-3" asterisk="{{ $editForm ? 0 : 1 }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>

@push('scripts')
    <script>
        tinymce.init({
            selector: '#instructions',
            plugins: 'lists,table,code',
            toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo | numlist bullist',
            lists_indent_on_tab: false,
            branding: false,
            menubar: false,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('instructions', editor.getContent());
                });
            }
        });
    </script>
@endpush
