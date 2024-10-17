<div class="container my-3">
    <h2>My Course</h2>
    <p>Kamu Mengikuti {{ $count }} Courses</p>
    <div class="row d-flex justify-content-between">
        <div class="mb-3 col-md-9 col-sm-12">
            <div class="btn-group" role="group" aria-label="filter">
                <button type="button" class="btn btn-outline-primary {{ $filter == 'all' ? 'active' : '' }}"
                    wire:click='changeFilter("all")'>Semuanya</button>
                <button type="button" class="btn btn-outline-primary {{ $filter == 'finished' ? 'active' : '' }}"
                    wire:click='changeFilter("finished")'>Sudah</button>
                <button type="button" class="btn btn-outline-primary {{ $filter == 'unfinished' ? 'active' : '' }}"
                    wire:click='changeFilter("unfinished")'>Belum</button>
            </div>
        </div>
        <div class="col-md-3">
            <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" wire:model.live.debounce.500ms='search'>
        </div> 
    </div>

    <div class="card mt-4">
        <div class=" p-4">
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-4">
                        <a href="{{ route('user.my-course.detail', $course->slug) }}">
                            <div class="custom-card pb-3">
                                <img src="{{ $course->thumbnail_url }}" class="w-100 border-radius-md shadow-sm">
                                <div class="text-start px-3">
                                    <h5 class="mt-4 text-start">{{ $course->title }}</h5>
                                    <p class="text-info-light">{{ $course->is_finished ? 'Selesai' : 'Belum Selesai' }}
                                    </p>
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
                @if (count($courses) == 0)
                    <div class="col-12 text-center">
                        No Data
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
