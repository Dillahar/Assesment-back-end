<div>
    <div class="row mb-2">
        <div class="col">
            <span>
                <h5 class="  fw-bolder">
                    Courses / {{ $course->title }} /<span class="text-secondary">
                        Report List
                    </span>
                </h5>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$reports" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th style="width: 50px;">Module</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'lesson_id'"
                                        :display-name="'Lesson'" :width="'50px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'message'"
                                        :display-name="'Message'" :width="'50px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'status'"
                                        :display-name="'Status'" :width="'30px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>
                                            {{ $report->lesson->course_module->title }}
                                        </td>
                                        <td>
                                            {{ $report->lesson->title }}
                                        </td>
                                        <td>
                                            {{ $report->message }}
                                        </td>
                                        <td>
                                            @if (!empty($report->created_at))
                                                {{ \App\Utils\DateSupport::parse($report->created_at)->format(config('app.date_format') . 'h:i:s') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($report->status == \App\Enums\ReportStatus::PENDING)
                                                <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                            @elseif ($report->status == \App\Enums\ReportStatus::RESOLVED)
                                                <span class="badge badge-sm bg-gradient-success">Resolved</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if ($report->status == \App\Enums\ReportStatus::PENDING)
                                                <a class="btn btn-link text-dark ms-4 mb-0" href="javascript:void(0);"
                                                    wire:click="$dispatch('swal:confirm', {id:{{ $report->id }}, 
                                                    title: 'Ingin menyelsaikan report ini?',
                                                    message: 'Setelah disetujui, data tidak akan bisa dirubah!', 
                                                    dispatch: 'resolved-data', 
                                                    confirmText: 'Ya, setujui', 
                                                    confirmClass: 'btn btn-success me-3',
                                                    dismissText: 'Data tidak jadi diselesaikan',
                                                })">

                                                    <i class="far fa-check-square me-2"></i> Resolved
                                                </a>
                                            @endif

                                            <a class="btn btn-link text-danger ms-4 mb-0" href="javascript:void(0);"
                                                wire:click="$dispatch('swal:confirm', {id:{{ $report->id }}})">
                                                <i class="far fa-trash-alt me-2"></i> Delete
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
</div>
