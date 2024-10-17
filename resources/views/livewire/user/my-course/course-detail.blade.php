@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.3.0/video-js.min.css"
        integrity="sha512-IhUEHAVKtjGwKoBY2lnSHDo7Ivn9oKNLJMNbU6JygLxxfxj/12xby07R0KLu+3fJt6QbYukZZi5X6AaHr4MigQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/8.3.0/video.min.js"
        integrity="sha512-2uqQaCV1+Xwdhj0ZwOuckUfVRwK+uWl372jXlURTK376U/rt0pg8zwEKYlMhzTg6JsyUciE0ogqEXJ54TDfgOg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/3.0.0/Youtube.min.js"
        integrity="sha512-W11MwS4c4ZsiIeMchCx7OtlWx7yQccsPpw2dE94AEsZOa3pmSMbrcFjJ2J7qBSHjnYKe6yRuROHCUHsx8mGmhA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@push('scripts')
    <script>
        @if ($video_id)

            const youtube_player = videojs('youtube_player', {
                controls: true,
                autoplay: false,
                preload: 'auto',
                fluid: true,
                controlBar: {
                    volumePanel: false
                },
                techOrder: ['youtube'],
                sources: [{
                    type: 'video/youtube',
                    src: 'https://www.youtube.com/watch?v={{ $video_id }}'
                }],
                youtube: {
                    iv_load_policy: 3,
                    modestbranding: 1,
                    rel: 0,
                    showinfo: 0,
                    cc_load_policy: 0,
                    fs: 0,
                    playsinline: 1,
                    controls: 1,
                    disablekb: 1,
                    enablejsapi: 1,
                    origin: window.location.origin
                }
            });
        @endif
    </script>
@endpush
<div>
    <section class="container mb-6 mt-sm-3 min-vh-70 d-flex flex-column">
        <div class="row">
            <div class="col-md-4 col-sm-12 mb-sm-3 order-2 order-md-2">
                <div class="row pe-sm-0 pe-md-4">
                    <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start">
                        <h3 class="text-info-light fw-bold"> Pelajaran
                        </h3>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('user.my-course.detail', [$course->slug]) }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ !$module && !$lesson ? 'active' : '' }} mb-2">
                                <div class="text-start">
                                    <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                    Overview Course
                                </div>

                                <span></span>
                            </a>
                            <a href="#module-prep"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2"
                                data-bs-toggle="collapse">
                                <div class="text-start">
                                    <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                        <i class="fas fa-hourglass-start text-white"></i>
                                    </div>
                                    Class Preparation
                                </div>
                            </a>
                            <div id="module-prep" class="collapse mb-3">
                                <a href="{{ $course->group_invite_link }}" target="_blank"
                                    class="list-group-item list-group-item-action px-4">Discussion Group</a>
                            </div>
                            @foreach ($course->course_modules as $moduleList)
                                <a href="#module-{{ $moduleList->id }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2 {{ $module && $module->id == $moduleList->id ? 'active' : '' }}"
                                    data-bs-toggle="collapse"
                                    @if ($module && $module->id == $moduleList->id) aria-expanded="true" @endif>
                                    <div class="text-start">
                                        <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                            <i class="fas fa-play text-white"></i>
                                        </div>
                                        {{ $moduleList->title }}
                                    </div>

                                    <span>{{ \App\Utils\Helper::formatDurationReadable($moduleList->total_duration) }}</span>
                                </a>
                                <div id="module-{{ $moduleList->id }}" wire:key="module-{{ $moduleList->id }}"
                                    class="collapse mb-3 @if ($module && $module->id == $moduleList->id) collapse show @endif">
                                    @foreach ($moduleList->course_lessons as $lessonList)
                                        <a href="{{ route('user.my-course.learn', [$course->slug, $moduleList->id, $lessonList->id]) }}"
                                            class="list-group-item list-group-item-action px-4 {{ $lesson && $module && $lesson->id == $lessonList->id && $module->id == $moduleList->id ? 'active' : '' }}">{{ $lessonList->title }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                            @if ($course->assessment)
                                <a href="{{ route('user.my-course.assessment', [$course->slug]) }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div class="text-start">
                                        <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                            <i class="fas fa-tasks text-white"></i>
                                        </div>
                                        {{ $course->assessment->title }}
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 order-1 order-md-2">
                <div class="card">
                    <div class="card-body" wire:ignore>
                        <h3 class="card-title">{{ $title }}</h3>
                        <!-- Video Player Placeholder -->
                        @if ($video_id)
                            <video id="youtube_player" class="video-js vjs-default-skin vjs-16-9" controls>
                            </video>
                        @else
                            <div class="ratio ratio-16x9 ">
                                <img src="{{ asset($image) }}" class="img-fluid rounded-3">
                            </div>
                        @endif

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-3 mb-3">
                            <a class="btn btn-outline-primary {{ !$prev ? 'disabled' : '' }}"
                                href="{{ $prev }}">Prev</a>
                            @if ($module && $lesson)
                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#report-modal"><i class="fas fa-edit text-primary"></i>
                                    Report</button>
                            @endif
                            <a class="btn btn-outline-primary {{ !$next ? 'disabled' : '' }}"
                                href="{{ $next }}">Next</a>
                        </div>
                        <!-- Content Text -->
                        <p class="text-center">Description</p>
                        <hr />
                        {!! $description !!}
                        <!-- Repeat with actual content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="report-modal" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Report</h2>
                    <button type="button" class="btn-close" style="color:red" data-bs-dismiss="modal"
                        aria-label="Close" wire:click="$dispatch('reset-form')">X</button>
                </div>
                <div class="modal-body">
                    <form wire:submit='reportLesson'>
                        <div class="mb-4">
                            <label for="report">Report Message</label>
                            <textarea wire:model="report" class="form-control" id="report" rows="3" placeholder="Report"></textarea>
                            @error('report')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
