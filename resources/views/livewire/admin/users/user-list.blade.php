<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Users /<span class="text-secondary">
                        User List
                    </span>
                </h5>
                <p class="text-muted">{{ __('Create, edit or delete the users') }}</p>

            </span>

        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-info  mb-3" data-bs-toggle="modal" data-bs-target="#user-modal"><i
                    class="fas fa-plus me-2"></i> Add User</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$users" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'name'"
                                        :display-name="'Name'" :width="'50px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'address'"
                                        :display-name="'Address'" :width="'300px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'is_admin'"
                                        :display-name="'Role'" :width="'10px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th class="sorting" tabindex="0" aria-controls="data_table" rowspan="1"
                                        colspan="1" aria-label=": activate to sort column ascending"
                                        style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="sorting_1">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if (empty($user['photo']))
                                                        <div
                                                            class="avatar avatar-md rounded-circle bg-info-light border-radius-md p-2 ">
                                                            <h6 class="text-info-light text-uppercase mt-1">
                                                                {{ $user->name[0] }}</h6>
                                                        </div>
                                                    @else
                                                        <img src="{{ asset('storage/' . $user->photo) }}"
                                                            class="avatar avatar-md rounded-circle  shadow-sm">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-3">
                                                    <a href="/student-about?id=36">
                                                        <h6 class="mb-0">{{ $user->name }}</h6>
                                                    </a>

                                                    <p class="text-sm text-muted mb-0">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $user->address }}
                                        </td>
                                        <td>
                                            @if ($user->is_admin)
                                                <span class="badge badge-sm bg-gradient-success">Admin</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-info">Student</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($user->created_at))
                                                {{ \App\Utils\DateSupport::parse($user->created_at)->format(config('app.date_format')) }}
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
                                                            wire:click="$dispatch('edit-user', {id:{{ $user->id }}})"
                                                            data-bs-toggle="modal" data-bs-target="#user-modal">Edit</a>
                                                    </li>
                                                    @if (!$user->is_admin)
                                                        <li><a class="dropdown-item border-radius-md"
                                                                href="{{ route('users.detail', $user->id) }}">See
                                                                Details</a>
                                                        </li>
                                                    @endif

                                                    @if (Auth::user()->id != $user->id)
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>

                                                        <li>
                                                            <a class="dropdown-item border-radius-md text-danger"
                                                                href="javascript:void(0);"
                                                                wire:click="$dispatch('swal:confirm', {id:{{ $user->id }}})">Delete
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

    <livewire:admin.users.create-update-user />
</div>
