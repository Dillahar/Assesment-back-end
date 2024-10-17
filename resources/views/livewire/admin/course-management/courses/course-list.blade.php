<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Courses /<span class="text-secondary">
                        Course List
                    </span>
                </h5>
                <p class="text-muted">{{ __('Create, edit or delete the course') }}</p>

            </span>

        </div>
        <div class="col text-end">
            <a href="{{ route('course.add') }}" class="btn btn-info  mb-3"><i class="fas fa-plus me-2"></i> Add Course</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$courses" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'title'"
                                        :display-name="'Title'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'price'"
                                        :display-name="'Price'" :width="'60px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'status'"
                                        :display-name="'Status'" :width="'60px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'sub_category_id'"
                                        :display-name="'Subcategory'" :width="'60px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'mentor_id'"
                                        :display-name="'Mentor'" :width="'100px'" />
                                    <th class="text-uppercase text-xs" style="width: 60px;">
                                        Rating
                                    </th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset($course->thumbnail_url) }}"
                                                        class="w-100 border-radius-lg shadow-sm mt-2 avatar-xxl">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-3">
                                                    <a href="/view-course?id={{ $course->id }}"
                                                        class="text-dark font-weight-normal">
                                                        <h6 class=" mb-0 ">{{ $course->title }}</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class=" mb-0 ms-3 ">@rupiah($course->price)</h6>
                                        </td>
                                        <td>
                                            <h6 class=" mb-0 ms-3 ">
                                                @if ($course->status == \App\Enums\CourseStatus::DRAFT)
                                                    <span class="badge bg-warning-light text-warning mb-0 ms-3">
                                                        Draft
                                                    </span>
                                                @elseif($course->status == \App\Enums\CourseStatus::PUBLISHED)
                                                    <span class="badge bg-success-light mb-0 ms-3 text-success">
                                                        Published
                                                    </span>
                                                @else
                                                    <span class="badge bg-pink-light text-danger mb-0 ms-3">
                                                        Archived
                                                    </span>
                                                @endif
                                            </h6>
                                        </td>
                                        <td>
                                            <span class="badge bg-purple-light mb-0 ms-3">
                                                {{ $course->sub_category->name }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $course->mentor->name }}
                                        </td>
                                        <td>
                                            {{ $course->ratings }}
                                        </td>
                                        <td>
                                            @if (!empty($course->created_at))
                                                {{ \App\Utils\DateSupport::parse($course->created_at)->format(config('app.date_format')) }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <div class="dropstart">
                                                    <a href="javascript:" class="text-secondary"
                                                        id="dropdownMarketingCard" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                                        aria-labelledby="dropdownMarketingCard">
                                                        <li><a class="dropdown-item border-radius-md fw-bold"
                                                                href="{{ route('course.edit', $course->id) }}">Edit</a>
                                                        </li>
                                                        <li><a class="dropdown-item border-radius-md fw-bold"
                                                                href="{{ route('lessons', $course->id) }}">Lessons</a>
                                                        </li>
                                                        @if ($course->assessment)
                                                            <li><a class="dropdown-item border-radius-md fw-bold"
                                                                    href="{{ route('assessments.users', $course->id) }}">Assessment
                                                                    Users</a>
                                                            </li>
                                                        @endif
                                                        <li><a class="dropdown-item border-radius-md fw-bold"
                                                                href="{{ route('reviews', $course->id) }}">Reviews</a>
                                                        </li>
                                                        <li><a class="dropdown-item border-radius-md fw-bold"
                                                                href="{{ route('reports', $course->id) }}">Reports</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item border-radius-md text-danger fw-bold"
                                                            href="javascript:void(0);"
                                                            wire:click="$dispatch('swal:confirm', {id:{{ $course->id }}})">{{ __('Delete') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-table.pagination>
                </div>
            </div>
        </div>
    </div>
</div>
