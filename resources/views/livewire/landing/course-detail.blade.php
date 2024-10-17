@push('styles')
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/3.0.1/Youtube.min.js"
        integrity="sha512-W11MwS4c4ZsiIeMchCx7OtlWx7yQccsPpw2dE94AEsZOa3pmSMbrcFjJ2J7qBSHjnYKe6yRuROHCUHsx8mGmhA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
@push('scripts')
    <script>
        @if ($course->overview_video)

            const youtube_player = videojs('youtube_player', {
                controls: true,
                autoplay: false,
                preload: false,
                fluid: true,
                controlBar: {
                    volumePanel: true
                },
                techOrder: ['youtube'],
                sources: [{
                    type: 'video/youtube',
                    src: 'https://www.youtube.com/watch?v={{ $course->overview_video_id }}'
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
                }
            });
            youtube_player.on('loadedmetadata', function() {
                // Set quality to the highest
                const qualityLevels = youtube_player.qualityLevels();
                if (qualityLevels.length) {
                    let highestQualityIndex = 0;
                    for (let i = 0; i < qualityLevels.length; i++) {
                        if (qualityLevels[i].height > highestQualityHeight) {
                            highestQualityHeight = qualityLevels[i].height;
                            highestQualityIndex = i;
                        }
                    }
                    qualityLevels[highestQualityIndex].enabled = true;
                    for (let i = 0; i < qualityLevels.length; i++) {
                        if (i !== highestQualityIndex) {
                            qualityLevels[i].enabled = false;
                        }
                    }
                }
            });
        @endif
    </script>
@endpush
<div>
    <header class="pt-5">
        <div class="page-header bg-white  ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 pe-0 order-2 order-md-2">
                        <h1 class="fw-bolder display-5  text-start mt-4 mb-0">
                            {{ $course->title }}
                        </h1>
                        <p class="text-start lead  mt-3 mb-4">
                        </p>
                        <p class="subtitle-course-detail">Upgrade Your Skill with skillage Academy</p>
                        <div class="row d-flex mb-4">
                            <span class="col-auto price-tag align-middle">Rp.
                                {{ number_format($course->price, 0, ',', '.') }}</span>
                            <span class="col-auto align-middle">&#x2022;</span>
                            <div class="col-auto align-middle">
                                {!! \App\Utils\Helper::ratingStarBuilder($course->ratings) !!}
                            </div>
                            <div class="level col-auto align-middle">
                                {{ $course->level }}
                            </div>
                        </div>
                        <div class="text-start buttons mb-4">
                            @if (auth()->check() &&
                                    auth()->user()->hasThisCourse($course->id))
                                <a href="{{ route('user.my-course.detail', $course->slug) }}"
                                    class="btn btn-primary me-3">Lanjutkan Belajar</a>
                            @else
                                <a href="{{ route('user.checkout', $course->slug) }}" class="btn btn-primary me-3">Beli
                                    Course</a>
                            @endif
                        </div>
                    </div>
                    <div class="mb-md-7 col-lg-6 col-md-6 d-flex text-md-start flex-column order-1 order-md-2">
                        <div class="row ">
                            <div class="position-relative d-flex flex-column h-100" wire:ignore>
                                @if ($course->overview_video)
                                    <video id="youtube_player" class="video-js vjs-default-skin vjs-16-9" controls>
                                    </video>
                                @else
                                    <div class="position-relative">
                                        <img src="{{ asset($course->thumbnail_url) }}" class="img-fluid rounded-3">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="container mb-6 mt-sm-3">
        <div class="row">
            <div class="col-md-8 col-sm-12 mb-sm-3">
                <div class="row pe-sm-0 pe-md-4">
                    <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start mb-4">
                        <h3 class="text-info-light fw-bold"> Deskripsi
                        </h3>
                        {!! $course->description !!}
                    </div>
                    <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start">
                        <h3 class="text-info-light fw-bold"> Pelajaran
                        </h3>
                        <div class="list-group">
                            @foreach ($course->course_modules as $module)
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2">
                                    <div class="text-start">
                                        <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                            <i class="fas fa-lock text-white"></i>
                                        </div>
                                        {{ $module->title }}
                                    </div>

                                    <span>{{ \App\Utils\Helper::formatDurationReadable($module->total_duration) }}</span>
                                </div>
                            @endforeach
                            @if ($course->assessment)
                                <div
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div class="text-start">
                                        <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                            <i class="fas fa-tasks text-white"></i>
                                        </div>
                                        {{ $course->assessment->title }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="row">
                    <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start mb-3">
                        <h3 class="text-info-light fw-bold"> Metode Belajar
                        </h3>
                        {!! $course->methods !!}
                    </div>
                    <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start mb-3">
                        <h3 class="text-info-light fw-bold"> Learn With Expert
                        </h3>
                        <div class="d-flex mt-3">
                            <img src="{{ $course->mentor->picture }}"
                                class="avatar avatar-lg rounded-circle shadow-sm">

                            <div class="text-start ms-3">
                                <h6 class="mb-0 text-dark">{{ $course->mentor->name }}</h6>
                                <p class="mb-0 small text-dark">{{ $course->mentor->profession }}</p>
                            </div>
                        </div>
                    </div>
                    @if ($course->tools->count() > 0)
                        <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start mb-3">
                            <h3 class="text-info-light fw-bold"> Tools
                            </h3>
                            <div class="row">
                                @foreach ($course->tools as $tool)
                                    <div class="col-12 d-flex mt-3 mb-2">
                                        <img src="{{ $tool->image_url }}" class="avatar avatar-lg  shadow-sm">
                                        <div class="text-start ms-3">
                                            <h6 class="mb-0 text-dark">{{ $tool->name }}</h6>
                                            <p class="">{{ $tool->description }}</p>
                                            @if ($tool->link)
                                                <a href="{{ $tool->link }}" target="_blank"
                                                    class="btn btn-primary btn-sm small">Link</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
