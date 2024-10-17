<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Courses /<span class="text-secondary">
                        Mentor List
                    </span>
                </h5>
                <p class="text-muted">{{ __('Create, edit or delete the mentor') }}</p>

            </span>

        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-info  mb-3" data-bs-toggle="modal" data-bs-target="#mentor-modal"><i
                    class="fas fa-plus me-2"></i> Add Mentor</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$mentors" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'name'"
                                        :display-name="'Name'" :width="'300px'" />
                                    <th style="width: 50px;">Courses</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($mentors as $mentor)
                                    <tr>
                                        <td class="sorting_1">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if (empty($mentor['picture']))
                                                        <div
                                                            class="avatar avatar-md rounded-circle bg-info-light border-radius-md p-2 ">
                                                            <h6 class="text-info-light text-uppercase mt-1">
                                                                {{ $mentor->name[0] }}</h6>
                                                        </div>
                                                    @else
                                                        <img src="{{ asset($mentor->picture) }}"
                                                            class="avatar avatar-md rounded-circle  shadow-sm">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-3">
                                                    <a href="/student-about?id=36">
                                                        <h6 class="mb-0">{{ $mentor->name }}</h6>
                                                    </a>

                                                    <p class="text-sm text-muted mb-0">{{ $mentor->profession }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $mentor->courses->count() }}
                                        </td>
                                        <td>
                                            @if (!empty($mentor->created_at))
                                                {{ \App\Utils\DateSupport::parse($mentor->created_at)->format(config('app.date_format')) }}
                                            @endif
                                        </td>
                                        <td class="align-middle text-right">
                                            <div class="dropstart me-3">
                                                <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                                    aria-labelledby="dropdownMarketingCard">
                                                    <li><a class="dropdown-item border-radius-md"
                                                            href="javascript:void(0);"
                                                            wire:click="$dispatch('edit-mentor', {id:{{ $mentor->id }}})"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#mentor-modal">Edit</a>
                                                    </li>
                                                    @if ($mentor->courses->count() == 0)
                                                        <li>
                                                            <a class="dropdown-item border-radius-md text-danger"
                                                                href="javascript:void(0);"
                                                                wire:click="$dispatch('swal:confirm', {id:{{ $mentor->id }}})">Delete
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
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

    <livewire:admin.course-management.mentors.create-update-mentor />
</div>
