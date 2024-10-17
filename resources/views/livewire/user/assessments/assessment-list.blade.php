<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Assessments /<span class="text-secondary">
                        My Assessment
                    </span>
                </h5>
                <p class="text-muted">All of my assignments.</p>

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
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'name'"
                                        :display-name="'Name'" :width="'100px'" />
                                    <th style="width: 100px;">Course</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'score'"
                                        :display-name="'Score'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'status'"
                                        :display-name="'Status'" :width="'50px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Submited At'" :width="'50px'" />
                                    <th style="width: 50px;">Action</th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($assessments as $assessment)
                                    <tr>
                                        <td>
                                            {{ $assessment->assessment->title }}
                                        </td>
                                        <td>
                                            {{ $assessment->assessment->course->title }}
                                        </td>
                                        <td>
                                            @if ($assessment->status != \App\Enums\AssessmentStatus::PENDING)
                                                {{ $assessment->score }}
                                            @else
                                                Not yet graded
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
                                            @if ($assessment->created_at)
                                                {{ \App\Utils\DateSupport::parse($assessment->created_at)->format(config('app.date_format') . ' h:i:s') }}
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="{{route('user.assessments.view', $assessment->id)}}"
                                                class="btn btn-icon btn-2 bg-info-light shadow-none " type="button">
                                                <span class="btn-inner--icon text-info-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                        height="18" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-file">
                                                        <path
                                                            d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z">
                                                        </path>
                                                        <polyline points="13 2 13 9 20 9"></polyline>
                                                    </svg>
                                                </span>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                                @if ($assessments->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No data available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </x-table.pagination>
                </div>
            </div>
        </div>
    </div>
</div>
