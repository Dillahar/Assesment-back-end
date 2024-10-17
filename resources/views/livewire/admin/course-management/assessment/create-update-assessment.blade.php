<form wire:submit='{{ $editForm ? 'update' : 'create' }}'>
    <div class="mb-4">
        <div class="row">
            <div class="col-lg-6">
                <h4> {{ $editForm ? 'Edit' : 'Add' }} assessment for {{ $course->title }}</h4>

            </div>
            <div class="col-lg-6 text-end d-flex flex-row">

                <button type="submit" class="btn btn-info mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0">Save</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Assessment Information</h5>
                        <div class="row">

                        </div>
                        <x-forms.input label="Assessment Title" field="title" type="text"
                            placeholder="Assessment Title" class="form-group" asterisk='1' />
                        <x-forms.input label="Max Score" field="max_score" type="number" placeholder="100"
                            class="form-group" asterisk='1' />
                        <x-forms.input label="Passed Min Score" field="passed_min_score" type="number" placeholder="60"
                            class="form-group" asterisk='1' />


                        <div class="form-group" wire:ignore>
                            <label class="mt-4">Description</label><label class="text-danger">*</label>
                            <textarea class="form-control" rows="10" id="description" name="description" wire:model='description'></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Media</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="align-self-center mt-4">
                                    <x-forms.input label="File" field="file" type="file" placeholder="document"
                                        class="form-group" asterisk='1' />
                                    <p class="form-text text-info-light text-xs ms-1">
                                        This is optional file, if you want to add document file with this lesson.
                                    </p>
                                </div>
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
            selector: '#description',
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
                    @this.set('description', editor.getContent());
                });
            }
        });
    </script>
@endpush
