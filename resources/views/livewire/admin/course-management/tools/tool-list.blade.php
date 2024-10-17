<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Courses /<span class="text-secondary">
                        Tool List
                    </span>
                </h5>
                <p class="text-muted">{{ __('Create, edit or delete the tool') }}</p>

            </span>

        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-info  mb-3" data-bs-toggle="modal" data-bs-target="#tool-modal"><i
                    class="fas fa-plus me-2"></i> Add Tool</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$tools" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th style="width: 100px;">Image</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'name'"
                                        :display-name="'Name'" :width="'50px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'description'"
                                        :display-name="'Description'" :width="'50px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'link'"
                                        :display-name="'Link'" :width="'50px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'30px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($tools as $tool)
                                    <tr>
                                        <td class="sorting_1">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset($tool->image_url) }}"
                                                        class="avatar avatar-md rounded-circle  shadow-sm">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $tool->name }}
                                        </td>
                                        <td>
                                            {{ $tool->description }}
                                        </td>
                                        <td>
                                            {{ $tool->link ?? '-' }}
                                        </td>
                                        <td>
                                            @if (!empty($tool->created_at))
                                                {{ \App\Utils\DateSupport::parse($tool->created_at)->format(config('app.date_format')) }}
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
                                                            wire:click="$dispatch('edit-tool', {id:{{ $tool->id }}})"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#tool-modal">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item border-radius-md text-danger"
                                                            href="javascript:void(0);"
                                                            wire:click="$dispatch('swal:confirm', {id:{{ $tool->id }}})">Delete
                                                        </a>
                                                    </li>
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

    <livewire:admin.course-management.tools.create-update-tool />
</div>
