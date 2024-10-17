<div class="row">
    <div class="col-md-12">
        <div class="row ">
            <div class="card ">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
                    <span class="mask bg-dark-alt"></span>
                    <div class="card-body position-relative z-index-1 h-100 ">
                        <h4 class="text-white font-weight-bolder mb-3 mt-3"> Hi, {{ $user->name }}, Happy
                            Learning!</h4>
                        <div class="text-end mb-2">
                            <a href="{{ route('user.profile') }}" class="btn btn-round btn-outline-white mb-2">
                                My Profile
                                <i class="fas fa-user-alt text-sm ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-4">

            <div class="card mb-4">
                <div class="card-header pb-0 p-2">
                    <h6 class="mb-1 mt-2">My Rencent Courses</h6>

                </div>

                <div class=" p-2">

                    <div class="row">

                        @foreach ($user->my_courses->take(3) as $course)
                            @php
                                $course = $course->course;
                            @endphp
                            <div class="col-md-4">
                                <a href="{{ route('user.my-course.detail', $course->slug) }}">
                                    <div class="custom-card pb-3">
                                        <img src="{{ $course->thumbnail_url }}"
                                            class="w-100 border-radius-md shadow-sm">
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
                        @if ($user->my_courses->count() == 0)
                            <div class="col-12 text-center">
                                No Data
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
