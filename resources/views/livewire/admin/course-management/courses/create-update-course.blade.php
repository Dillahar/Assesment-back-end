<form wire:submit='{{ $editForm ? 'update' : 'create' }}'>
    <div class="mb-2">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="  fw-bolder">
                    Courses /<span class="text-secondary">
                        {{ $editForm ? 'Edit Course' : 'Add New Course' }}
                    </span>
                </h5>
            </div>

            <div class="col-lg-6 text-right ">

                <button type="submit" class="btn btn-blue mb-2">Submit</button>
            </div>

        </div>


        <div class="row ">
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Course Information</h5>
                        <div class="row">
                        </div>


                        <x-forms.input label="Course Title" field="title" type="text" placeholder="Course Title"
                            class="form-group" asterisk='1' liveUpdate='true' />

                        <div class="row mt-3 mb-3">

                            <div class="col-md-4">
                                <label class="">Level</label><label class="text-danger">*</label>

                                <select class="form-control" aria-label="Default select example" name="level"
                                    wire:model='level'>
                                    <option value="">Select Level</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level }}">
                                            {{ $level }}</option>
                                    @endforeach
                                </select>
                                <x-forms.error field="level" />
                            </div>
                            <div class="col-sm-4">
                                <label class="">Category <a href="{{ route('categories') }}"
                                        class="text-info-light">Add New</a></label><label class="text-danger">*</label>
                                <select class="form-control" name="category_id" id="choices-category-edit"
                                    wire:model.live='category_id'>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-forms.error field="category_id" />
                            </div>
                            <div class="col-sm-4">
                                <label class="">Subcategory <a href="{{ route('sub-categories') }}"
                                        class="text-info-light">Add New</a></label><label class="text-danger">*</label>
                                <select class="form-control" name="category_id" id="choices-category-edit"
                                    wire:model.live='subcategory_id'>
                                    <option value=''>Select Subcategory</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-forms.error field="subcategory_id" />
                            </div>
                        </div>

                        <label for="basic-url" for="courseSlug" class="form-label">Slug</label><label
                            class="text-danger">*</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text fw-bolder">{{ config('app.url') }}/course/</span>
                            <input type="text" id="courseSlug" name="slug" class="form-control ps-1"
                                wire:model='slug'>
                        </div>
                        <x-forms.error field="slug" />
                        <x-forms.input label="Price" field="price" type="number" placeholder="Price"
                            class="col-md-12" asterisk='1' />
                        <div class="col-md-12 mt-3">
                            <label for="tools">Tools</label><label class="text-danger">*</label>
                            <div class="row mt-1">
                                @foreach ($toolsData as $tool)
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $tool->id }}"
                                                id="tool-{{ $tool->id }}" wire:model.lazy='tools'>
                                            <label class="form-check-label" for="tool-{{ $tool->id }}">
                                                {{ $tool->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <x-forms.error field="tools" />
                        </div>
                        <x-forms.input label="Group Invite Links (For discussion)" field="group_invite_link"
                            type="text" placeholder="https://chat.whatsapp.com/923rjssafo" class="col-md-12 mt-3"
                            asterisk='1' />
                        <div class="mt-3">
                            <label class="">Mentor</label><label class="text-danger">*</label>

                            <select class="form-control" aria-label="Default select example" wire:model='mentor_id'>
                                <option value="">Select Mentor</option>
                                @foreach ($mentors as $mentor)
                                    <option value="{{ $mentor->id }}">
                                        {{ $mentor->name . ' - ' . $mentor->profession }}</option>
                                @endforeach
                            </select>
                            <x-forms.error field="mentor_id" />
                        </div>

                        <label class="mt-4">Description</label><label class="text-danger">*</label>

                        <div class="form-group" wire:ignore>
                            <textarea class="form-control" rows="10" id="description" name="description" wire:model='description'></textarea>
                        </div>
                        <x-forms.error field="description" />

                        <label class="mt-4">Methods</label><label class="text-danger">*</label>

                        <div class="form-group" wire:ignore>
                            <textarea class="form-control" rows="10" id="methods" name="methods" wire:model='methods'></textarea>
                        </div>
                        <x-forms.error field="methods" />
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Media Information</h5>
                        <div class="row">
                            <div class="col-12">

                                @if (!$editForm)
                                    <img src="{{ $useTemp ? $thumbnail->temporaryUrl() : asset('img/placeholder.jpeg') }}"
                                        class="w-100 border-radius-lg shadow-lg mt-3">
                                @else
                                    <img src="{{ $useTemp ? $thumbnail->temporaryUrl() : asset($model->thumbnail_url) }}"
                                        class="w-100  border-radius-lg shadow-lg mt-3">
                                @endif
                            </div>

                            <div class="align-self-center">
                                <x-forms.input label="Upload Thumbnail" field="thumbnail" type="file"
                                    placeholder="Upload Thumbnail" class="mt-3"
                                    asterisk="{{ $editForm ? 0 : 1 }}" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-3">
                                <label class="">{{ __('Status') }}</label><label class="text-danger">*</label>

                                <select class="form-control" aria-label="Default select example" wire:model='status'>
                                    <option value="">Select Status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                                <x-forms.error field="status" />
                            </div>
                            <div class="col-12">
                                @if (!empty($overview_video) && Str::contains($overview_video, 'youtube.com/watch?v='))
                                    @php
                                        parse_str(parse_url($overview_video, PHP_URL_QUERY), $query);

                                        // Get the 'v' parameter from the query string
                                        $videoId = isset($query['v']) ? $query['v'] : null;
                                    @endphp
                                    <iframe class="embed-responsive-item w-100  border-radius-lg shadow-lg mt-3"
                                        src="https://www.youtube.com/embed/{{ $videoId }}?controls=0"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                @endif
                            </div>
                            <x-forms.input label="Overview Video" field="overview_video" type="text"
                                placeholder="https://www.youtube.com/watch?v=xyz123abc" class="mt-3"
                                liveUpdate="true" />
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
        tinymce.init({
            selector: '#methods',
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
                    @this.set('methods', editor.getContent());
                });
            }
        });
    </script>
@endpush
