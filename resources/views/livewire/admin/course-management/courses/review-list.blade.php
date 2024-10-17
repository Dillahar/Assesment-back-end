<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Courses / {{ $course->title }} /<span class="text-secondary">
                        Review List
                    </span>
                </h5>
            </span>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$reviews" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'user_id'"
                                        :display-name="'Name'" :width="'150px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'review'"
                                        :display-name="'Review'" :width="'150px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'star_count'"
                                        :display-name="'Star'" :width="'150px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'is_approved'"
                                        :display-name="'Is Approved'" :width="'150px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>
                                            {{ $review->user->name }}
                                        </td>
                                        <td>
                                            {{ $review->review }}
                                        </td>
                                        <td>
                                            {{ $review->star_count }}
                                        </td>
                                        <td>
                                            {{ $review->is_approved ? 'Approved' : 'Not Approved' }}
                                        </td>
                                        <td>
                                            @if (!empty($review->created_at))
                                                {{ \App\Utils\DateSupport::parse($review->created_at)->format(config('app.date_format') . ' H:i:s') }}
                                            @endif
                                        </td>
                                        <td class="text-end">

                                            @if (!$review->is_approved)
                                                <a class="btn btn-link text-dark ms-4 mb-0" href="javascript:void(0);"
                                                    wire:click="$dispatch('swal:confirm', {id:{{ $review->id }}, 
                                                    title: 'Ingin menyetujui review ini?',
                                                    message: 'Setelah disetujui, data tidak akan bisa dirubah!', 
                                                    dispatch: 'approve-data', 
                                                    confirmText: 'Ya, setujui', 
                                                    confirmClass: 'btn btn-success me-3',
                                                    dismissText: 'Data tidak jadi disetujui',
                                                })">

                                                    <i class="far fa-check-square me-2"></i> Approve
                                                </a>
                                            @endif

                                            <a class="btn btn-link text-danger ms-4 mb-0" href="javascript:void(0);"
                                                wire:click="$dispatch('swal:confirm', {id:{{ $review->id }}})">
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

    <livewire:admin.course-management.categories.create-update-category />
</div>
