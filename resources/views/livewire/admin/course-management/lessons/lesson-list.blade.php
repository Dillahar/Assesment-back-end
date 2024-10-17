<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Courses / {{ $course->title }} /<span class="text-secondary">
                        Lesson List
                    </span>
                </h5>
            </span>

        </div>
    </div>

    <div class="col-12">
        <div class="card rounded-3">
            <!-- Card header START -->
            <div class="card-header border-bottom">
                <div class="d-sm-flex justify-content-sm-between align-items-center">
                    <h4 class="mb-0">Lessons</h4>
                    <div>
                        <button type="button" class="btn btn-info me-3" data-bs-toggle="modal"
                            data-bs-target="#module-modal"><i class="fas fa-plus me-2"></i> Add New Module</button>
                        @if (!$course->assessment)
                            <a href="{{ route('assessment', $course->id) }}" class="btn btn-info"><i
                                    class="fas fa-plus me-2"></i> Add New Assessment</a>
                        @endif
                    </div>
                </div>

            </div>
            <!-- Card header END -->

            <!-- Card body START -->
            <div class="card-body">
                <div class="row g-5">
                    <!-- Lecture item START -->
                    <div class="col-12">
                        <!-- Curriculum item -->
                        @foreach ($course->course_modules as $module)
                            <div class="d-sm-flex justify-content-sm-between align-items-center mb-4 pt-2">
                                <h5>{{ $module->title }} ({{ $module->course_lessons()->count() }} lessons)</h5>
                                <div class="dropstart">
                                    <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                        aria-labelledby="dropdownMarketingCard">
                                        <li><a class="dropdown-item border-radius-md" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#module-modal" wire:click="$dispatch('edit-module', {id:{{ $module->id }}})">Edit Module</a>
                                        </li>
                                        <li><a class="dropdown-item border-radius-md"
                                                href="{{ route('lesson.add', $module->id) }}">Add New Lesson</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item border-radius-md text-danger"
                                                href="javascript:void(0);" wire:click="$dispatch('swal:confirm', {id:{{ $module->id }}, dispatch:'delete-module'})">Delete Module
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Divider -->

                            @foreach ($module->course_lessons as $lesson)
                                <div class="d-sm-flex justify-content-sm-between align-items-center">
                                    <div class="d-flex">
                                        <div class="avatar avatar-md bg-info-light  border-radius-md p-2 ">
                                            <i class="fas fa-play text-info"></i>
                                        </div>
                                        <div class="ms-2 ms-sm-3 mt-1 mt-sm-0">
                                            <a href="{{ route('lesson.edit', [$course->id, $lesson->id]) }}">
                                                <h6 class="mb-0">{{ $lesson->title }}</h6>
                                            </a>
                                            <p class="mb-2 mb-sm-0 small">{{ __('Last Updated') }}
                                                {{ $lesson->updated_at }}
                                            </p>
                                            
                                            <p class="mb-2 mb-sm-0 small">Duration: {{ \App\Utils\Helper::formatDuration($lesson->duration) }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="dropstart">
                                        <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                            aria-labelledby="dropdownMarketingCard">
                                            <li><a class="dropdown-item border-radius-md"
                                                    href="{{ route('lesson.edit', [$module->id, $lesson->id]) }}">Edit
                                                    Lesson</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a class="dropdown-item border-radius-md text-danger"
                                                    href="javascript:void(0);"
                                                    wire:click="$dispatch('swal:confirm', {id:{{ $lesson->id }}, dispatch:'delete-lesson'})">Delete
                                                    Lesson
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <p class="mt-2">{!! nl2br(Str::limit(strip_tags($lesson->description), 200)) !!}</p>
                                <!-- Divider -->
                                <hr>
                            @endforeach
                        @endforeach

                        @if ($course->assessment)
                            <div class="d-sm-flex justify-content-sm-between align-items-center mb-4 pt-2">
                                <h5>Final Task</h5>
                            </div>
                            <div class="d-sm-flex justify-content-sm-between align-items-center">
                                <div class="d-flex">
                                    <div class="avatar avatar-md bg-info-light  border-radius-md p-2 ">
                                        <i class="fas fa-tasks text-info"></i>
                                    </div>
                                    <div class="ms-2 ms-sm-3 mt-1 mt-sm-0">
                                        <h6 class="mb-0">{{ $course->assessment->title }}</h6>
                                        <p class="mb-2 mb-sm-0 small">{{ __('Last Updated') }}
                                            {{ $course->assessment->updated_at }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="dropstart">
                                    <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                        aria-labelledby="dropdownMarketingCard">
                                        <li><a class="dropdown-item border-radius-md"
                                                href="{{ route('assessment', $course->id) }}">Edit</a>
                                        </li>

                                        <li><a class="dropdown-item border-radius-md"
                                                href="{{ route('assessments.users', $course->id) }}">See Users
                                                Assessment</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item border-radius-md text-danger"
                                                href="javascript:void(0);"
                                                wire:click="$dispatch('swal:confirm', {id:{{ $course->id }}, dispatch:'delete-assessment'})">Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                            <p class="mt-2">{!! nl2br(Str::limit(strip_tags($course->assessment->description), 200)) !!}</p>

                            <!-- Divider -->
                            <hr>
                        @endif

                        <!-- Curriculum item -->

                    </div>




                </div>
            </div>
            <!-- Card body START -->
        </div>
    </div>
    <livewire:admin.course-management.lessons.create-update-module :course_id="$course->id" />
</div>
