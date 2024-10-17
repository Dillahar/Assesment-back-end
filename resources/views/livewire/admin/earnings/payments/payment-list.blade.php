<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Earnings /<span class="text-secondary">
                        Payment List
                    </span>
                </h5>
                <p class="text-muted">{{ __('Create, edit or delete the payment gateway') }}</p>

            </span>

        </div>
        <div class="col text-end">
            <a class="btn btn-info  mb-3" href="{{route('payments.add')}}"><i class="fas fa-plus me-2"></i> Add Payment</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$payments" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'bank'"
                                        :display-name="'Bank Name'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'number'"
                                        :display-name="'Bank Number'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'name'"
                                        :display-name="'Account Name/Nama Rekening'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'is_active'"
                                        :display-name="'Status'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>

                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $payment->logo_url }}"
                                                        class="avatar avatar-md rounded-circle  shadow-sm">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-3">
                                                    <h6 class="mb-0">{{ $payment->bank }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $payment->number }} -
                                                        {{ $payment->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $payment->number }}
                                        </td>
                                        <td>
                                            {{ $payment->name }}
                                        </td>
                                        <td>
                                            @if ($payment->is_active)
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($payment->created_at))
                                                {{ \App\Utils\DateSupport::parse($payment->created_at)->format(config('app.date_format') . ' H:i:s') }}
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
                                                            href="{{route('payments.edit', $payment->id)}}">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item border-radius-md text-danger"
                                                            href="javascript:void(0);"
                                                            wire:click="$dispatch('swal:confirm', {id:{{ $payment->id }}})">Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                                @if ($payments->isEmpty())
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="dataTables_empty">No data available in
                                            table</td>
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
