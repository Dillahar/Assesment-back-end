@props(['courses'])

<!-- Cards Section -->
<div class="card-section">
    <div class="row justify-content-center">
        @foreach ($courses as $course)
            <!-- Card 1 -->
            <div class="col-md-4">
                <a href="{{route('course-detail', $course->slug)}}">
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
<!-- End Cards Section -->
