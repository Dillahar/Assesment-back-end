<div>
    <header class="py-5">
        <div class="page-header bg-white min-vh-70 ">
            <div class="container">
                <div class="row">
                    <div class="mb-7 col-lg-6 col-md-6 d-flex text-md-start flex-column">

                        <h4 class="fw-bolder text-start journey mt-5 mb-0">
                            <svg class="mb-5" xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                viewBox="0 0 36 36" fill="none">
                                <path
                                    d="M19.5047 24.6797L16.8047 32.0063C16.7248 32.2216 16.5809 32.4073 16.3924 32.5384C16.2038 32.6695 15.9797 32.7398 15.75 32.7398C15.5204 32.7398 15.2962 32.6695 15.1077 32.5384C14.9191 32.4073 14.7752 32.2216 14.6953 32.0063L11.9953 24.6797C11.9384 24.5251 11.8485 24.3846 11.732 24.2681C11.6154 24.1516 11.475 24.0617 11.3203 24.0047L3.99377 21.3047C3.77847 21.2248 3.59279 21.0809 3.46166 20.8924C3.33054 20.7038 3.26025 20.4797 3.26025 20.25C3.26025 20.0204 3.33054 19.7962 3.46166 19.6077C3.59279 19.4191 3.77847 19.2752 3.99377 19.1953L11.3203 16.4953C11.475 16.4384 11.6154 16.3485 11.732 16.232C11.8485 16.1154 11.9384 15.975 11.9953 15.8203L14.6953 8.49377C14.7752 8.27847 14.9191 8.09279 15.1077 7.96166C15.2962 7.83054 15.5204 7.76025 15.75 7.76025C15.9797 7.76025 16.2038 7.83054 16.3924 7.96166C16.5809 8.09279 16.7248 8.27847 16.8047 8.49377L19.5047 15.8203C19.5617 15.975 19.6516 16.1154 19.7681 16.232C19.8846 16.3485 20.0251 16.4384 20.1797 16.4953L27.5063 19.1953C27.7216 19.2752 27.9073 19.4191 28.0384 19.6077C28.1695 19.7962 28.2398 20.0204 28.2398 20.25C28.2398 20.4797 28.1695 20.7038 28.0384 20.8924C27.9073 21.0809 27.7216 21.2248 27.5063 21.3047L20.1797 24.0047C20.0251 24.0617 19.8846 24.1516 19.7681 24.2681C19.6516 24.3846 19.5617 24.5251 19.5047 24.6797Z"
                                    fill="#2466AB" />
                                <path d="M24.75 2.25V9" stroke="#2466AB" stroke-width="2.25" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M28.125 5.625H21.375" stroke="#2466AB" stroke-width="2.25"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M31.5 10.125V14.625" stroke="#2466AB" stroke-width="2.25"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M33.75 12.375H29.25" stroke="#2466AB" stroke-width="2.25"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg> START YOUR JOURNEY
                        </h4>
                        <h1 class="fw-bolder display-5  text-start mt-4 mb-0">
                            Complete Your Journey with Skillage Academy
                        </h1>
                        <p class="text-start lead  mt-3 mb-4">
                        </p>
                        <p class="subtitle-home">Skillage Academy menyediakan
                            kelas dan bootcamp yang cocok untuk pemula.!</p>
                        <p></p>
                        <div class="text-start buttons mb-4">
                            <a href="{{ route('course-list', 'all') }}" class="btn btn-primary">Lihat Kelas</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 ps-5 pe-0  d-flex">
                        <div class="row ">
                            <div
                                class="position-relative d-flex flex-column align-items-center justify-content-center h-100 ">
                                <div class="position-relative">
                                    <img src="{{ asset('img/landing/zoom.png') }}" alt=""
                                        class="img-fluid  rounded-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- <section class="px-0 py-5 mt-3 gradient-course ">
        <div class="container">
            <div class="row ">
                <div class="col-12 text-center mt-5">
                    <h3 class="mb-5 text-white text-course">Menigkatkan Skill dimana <br /> Saja dan Kapan Saja</h3>
                </div>
            </div>
            <div class="card-section">
                <div class="row justify-content-center">
                    @foreach ($courses as $course)
                        <!-- Card 1 -->
                        <div class="col-md-4">
                            <a href="{{ route('course-detail', $course->slug) }}">
                                <div class="custom-card pb-3">
                                    <img src="{{ $course->thumbnail_url }}" class="w-100 border-radius-md shadow-sm">
                                    <div class="text-start px-3">
                                        <h5 class="mt-4 text-start">{{ $course->title }}</h5>
                                        <p class="price">@rupiah($course->price)</p>
                                        <div class="row">
                                            <div class="col">
                                                {!! \App\Utils\Helper::ratingStarBuilder($course->ratings) !!}
                                            </div>
                                            <div class="level col text-end me-2">
                                                {{ $course->level }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section> --}}
    <section class="splide gradient-course" aria-label="Splide Courses">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <h3 class="mb-5 text-white text-course">Menigkatkan Skill dimana <br /> Saja dan Kapan Saja</h3>
                </div>
                <div class="splide__track mb-7">
                    <ul class="splide__list">
                        @foreach ($courses as $course)
                            <!-- Each card will be a slide -->
                            <li class="splide__slide">
                                <a href="{{ route('course-detail', $course->slug) }}">
                                    <div class="custom-card pb-3">
                                        <div class="img-container">
                                            <img src="{{ $course->thumbnail_url }}" class="w-100 border-radius-md shadow-sm">
                                        </div>
                                        <div class="text-start px-3">
                                            <h5 class="mt-4 text-start">{{ $course->title }}</h5>
                                            <p class="price">@rupiah($course->price)</p>
                                            <div class="row">
                                                <div class="col">
                                                    {!! \App\Utils\Helper::ratingStarBuilder($course->ratings) !!}
                                                </div>
                                                <div class="level col text-end me-2">
                                                    {{ $course->level }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <header class="py-5">
        <div class="page-header bg-white min-vh-70 ">
            <div class="container">
                <div class="row">
                    <div class="mb-7 col-lg-6 col-md-6 d-flex text-md-start flex-column">
                        <h4 class="fw-bolder text-start text-purple  mt-8 mb-0">
                        </h4>
                        <h1 class="fw-bolder display-5  text-start mt-4 mb-0">
                            Find & Join a
                        </h1>
                        <h1 class="fw-bolder display-5  text-start mt-2 mb-0 text-gradient">
                            Bootcamp.
                        </h1>
                        <p class="text-start lead  mt-3 mb-4">
                        </p>
                        <p class="subtitle-home">Skillage Academy menyediakan
                            kelas dan bootcamp yang cocok untuk pemula.</p>
                        <p></p>
                        <div class="text-start buttons mb-4">
                            <a href="{{ route('events') }}" class="btn btn-primary">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 ps-5 pe-0  d-flex">
                        <div class="row ">
                            <div
                                class="position-relative d-flex flex-column align-items-center justify-content-center h-100 ">
                                <div class="position-relative">
                                    <img src="{{ asset('img/landing/zoom.png') }}" alt=""
                                        class="img-fluid  rounded-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="mb-5 mt-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-5 text-course">Tools</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($tools as $tool)
                    <div class="col-md-3  col-sm-6 bg-gray-100 rounded-3 p-4 d-flex me-3 mb-3">
                        <img src="{{ $tool->image_url }}" class="avatar avatar-lg  shadow-sm">
                        <div class="text-start ms-3">
                            <h6 class="mb-0 text-dark">{{ $tool->name }}</h6>
                            <p class="">{{ $tool->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="px-0 gradient-course py-7">
        <div class="container text-center py-3">
            <h3 class="mb-5 text-course text-white">Feedback Customer</h3>
            <div class="row justify-content-center gx-4">
                @foreach ($reviews as $review)
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="{{ $review->user->photo_url }}" class="avatar avatar-lg  shadow-sm">
                                    <div class="text-start ms-3">
                                        <h6 class="mb-0 text-dark">{{ $review->user->name }}</h6>
                                        <p class="">{{ $review->user->instance }}</p>
                                    </div>
                                </div>
                                <p class="mt-3 text-start">{{ $review->review }}</p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

</div>



@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var splide = new Splide('.splide', {
                focus: 'center',
                breakpoints: {
                    640: {
                        perPage: 1,
                        gap: 20,
                    },
                    768: {
                        perPage: 2,
                        gap: 10,
                    },
                    1024: {
                        perPage: 3,
                        gap: 10,
                    },
                },
                perPage: 4,
                gap: 20,
                autoplay: true,
                omitEnd: true,
                rewind: true,
            });
            splide.mount();
        });
    </script>
@endpush
