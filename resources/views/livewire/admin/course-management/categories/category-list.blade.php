<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Courses /<span class="text-secondary">
                        Category List
                    </span>
                </h5>
                <p class="text-muted">{{ __('Create, edit or delete the category') }}</p>

            </span>

        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-info  mb-3" data-bs-toggle="modal" data-bs-target="#category-modal"><i
                    class="fas fa-plus me-2"></i> Add Category</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$categories" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th style="width: 50px;">Background</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'name'"
                                        :display-name="'Name'" :width="'300px'" />
                                    <th style="width: 50px;">Total Sub-Categories</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <img src="{{ $category->background_url }}"
                                                class="w-100 border-radius-lg shadow-sm avatar-xxl">
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ $category->subCategories->count() }}
                                        </td>
                                        <td>
                                            @if (!empty($category->created_at))
                                                {{ \App\Utils\DateSupport::parse($category->created_at)->format(config('app.date_format') . ' H:i:s') }}
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
                                                            wire:click="$dispatch('edit-category', {id:{{ $category->id }}})"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#category-modal">Edit</a>
                                                    </li>
                                                    @if ($category->subCategories->count() == 0)
                                                        <li>
                                                            <a class="dropdown-item border-radius-md text-danger"
                                                                href="javascript:void(0);"
                                                                wire:click="$dispatch('swal:confirm', {id:{{ $category->id }}})">Delete
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

    <livewire:admin.course-management.categories.create-update-category />
</div>
