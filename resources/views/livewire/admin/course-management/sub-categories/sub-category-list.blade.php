<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Courses /<span class="text-secondary">
                        Sub-Category List
                    </span>
                </h5>
                <p class="text-muted">{{ __('Create, edit or delete the sub-category') }}</p>

            </span>

        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-info  mb-3" data-bs-toggle="modal" data-bs-target="#subcategory-modal"><i
                    class="fas fa-plus me-2"></i> Add Sub-Category</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$subcategories" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'name'"
                                        :display-name="'Name'" :width="'300px'" />

                                    <th style="width: 50px;">Category</th>
                                    <th style="width: 50px;">Total Courses</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td>
                                            {{ $subcategory->name }}
                                        </td>

                                        <td>
                                            {{ $subcategory->category->name }}
                                        </td>
                                        <td>
                                            {{ $subcategory->courses->count() }}
                                        </td>
                                        <td>
                                            @if (!empty($subcategory->created_at))
                                                {{ \App\Utils\DateSupport::parse($subcategory->created_at)->format(config('app.date_format') . ' H:i:s') }}
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
                                                            wire:click="$dispatch('edit-sub-category', {id:{{ $subcategory->id }}})"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#subcategory-modal">Edit</a>
                                                    </li>
                                                    @if ($subcategory->courses->count() == 0)
                                                        <li>
                                                            <a class="dropdown-item border-radius-md text-danger"
                                                                href="javascript:void(0);"
                                                                wire:click="$dispatch('swal:confirm', {id:{{ $subcategory->id }}})">Delete
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

    <livewire:admin.course-management.sub-categories.create-update-sub-category />
</div>
