<form wire:submit='{{ $editForm ? 'update' : 'create' }}'>
    <div class="mb-4">
        <div class="row">
            <div class="col-lg-6">
                <h4> {{ $editForm ? 'Edit' : 'Add' }} lesson for {{ $module->title }}</h4>

            </div>
            <div class="col-lg-6 text-end d-flex flex-row">

                <button type="submit" class="btn btn-info mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0">Save</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Lesson Information</h5>
                        <div class="row">

                        </div>
                        <x-forms.input label="Lesson Title" field="title" type="text" placeholder="Lesson Title"
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
                                @if (!empty($video) && Str::contains($video, 'youtube.com/watch?v='))
                                    @php
                                        parse_str(parse_url($video, PHP_URL_QUERY), $query);

                                        // Get the 'v' parameter from the query string
                                        $videoId = isset($query['v']) ? $query['v'] : null;
                                    @endphp
                                    <iframe class="embed-responsive-item w-100  border-radius-lg shadow-lg mt-3"
                                        src="https://www.youtube.com/embed/{{ $videoId }}?controls=0"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                @else
                                    <img src="{{ asset('img/placeholder.jpeg') }}"
                                        class="w-100 border-radius-lg shadow-lg mt-3">
                                @endif
                            </div>

                            <div class="align-self-center mt-4">
                                <x-forms.input label="Youtube Video Url" field="video" type="text" placeholder="https://www.youtube.com/watch?v=abc123xyz"
                                class="form-group" asterisk='1' liveUpdate='true'/>
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
