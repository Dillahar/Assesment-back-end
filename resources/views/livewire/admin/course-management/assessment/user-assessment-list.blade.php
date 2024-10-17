<div>
    <div class="row mb-3">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Courses / {{ $course->title }} /<span class="text-secondary">
                        Assessment User List
                    </span>
                </h5>
            </span>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$assessments" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'user_id'"
                                        :display-name="'Name'" :width="'300px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'score'"
                                        :display-name="'Score'" :width="'100px'" />
                                    <th style="width: 50px;">File</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'status'"
                                        :display-name="'Status'" :width="'50px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($assessments as $assessment)
                                    <tr>
                                        <td>
                                            {{ $assessment->user->name }}
                                        </td>
                                        <td>
                                            {{ $assessment->score }} / {{ $course->assessment->max_score }}
                                        </td>
                                        <td>
                                            @if ($assessment->file)
                                                <a href="{{ $assessment->file_url }}" target="_blank" download
                                                    class="btn btn-sm btn-info">View</a>
                                            @endif
                                        </td>
                                        <td>
                                            <h6 class=" mb-0 ms-3 ">
                                                @if ($assessment->status == \App\Enums\AssessmentStatus::PENDING)
                                                    <span class="badge bg-warning-light text-warning mb-0 ms-3">
                                                        Pending
                                                    </span>
                                                @elseif($assessment->status == \App\Enums\AssessmentStatus::PASSED)
                                                    <span class="badge bg-success-light mb-0 ms-3 text-success">
                                                        Passed
                                                    </span>
                                                @elseif($assessment->status == \App\Enums\AssessmentStatus::REJECTED)
                                                    <span class="badge bg-danger-light mb-0 ms-3 text-danger">
                                                        Rejected
                                                    </span>
                                                @endif
                                            </h6>
                                        </td>
                                        <td>
                                            @if (!empty($assessment->created_at))
                                                {{ \App\Utils\DateSupport::parse($assessment->created_at)->format(config('app.date_format') . ' H:i:s') }}
                                            @endif
                                        </td>
                                        <td class="align-middle text-right">
                                            <a class="btn btn-link text-dark ms-4 mb-0 category_edit" href="javascript:void(0);" wire:click="$dispatch('edit-user-assessment', {id:{{ $assessment->id }}})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#user-assessment-modal">

                                                <i class="far fa-edit "></i> Edit

                                            </a>
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
    <livewire:admin.course-management.assessment.edit-user-assessment>
</div>
