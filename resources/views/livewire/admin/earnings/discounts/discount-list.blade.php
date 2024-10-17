<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Earnings /<span class="text-secondary">
                        Discount List
                    </span>
                </h5>
                <p class="text-muted">Create, edit or delete the discount</p>

            </span>

        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-info  mb-3" data-bs-toggle="modal" data-bs-target="#discount-modal"><i
                    class="fas fa-plus me-2"></i> Add Discount</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$discounts" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'code'"
                                        :display-name="'Code'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'type'"
                                        :display-name="'Type'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'value'"
                                        :display-name="'Value'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'max_usage'"
                                        :display-name="'Usage'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'expired_at'"
                                        :display-name="'Expired At'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'100px'" />
                                    <th style="width: 50px;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($discounts as $discount)
                                    <tr>
                                        <td>
                                            <h6 class="text-sm">
                                                {{ $discount->code }}
                                            </h6>
                                        </td>
                                        <td>
                                            @if ($discount->type == \App\Enums\DiscountType::PERCENT)
                                                <span
                                                    class="badge badge-sm bg-gradient-success">{{ $discount->type }}</span>
                                            @else
                                                <span
                                                    class="badge badge-sm bg-gradient-info">{{ $discount->type }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-md mb-0">
                                                @if ($discount->type == \App\Enums\DiscountType::PERCENT)
                                                    {{ $discount->value }}%
                                                @else
                                                    @rupiah($discount->value)
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-md mb-0">
                                                {{$discount->usage}} / @if ($discount->max_usage)
                                                    {{ $discount->max_usage }}
                                                @else
                                                    <x-svg.infinite />
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm mb-0">
                                                @if (!empty($discount->expired_at))
                                                    {{ \App\Utils\DateSupport::parse($discount->expired_at)->format(config('app.date_format') . ' H:i:s') }}
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm mb-0">
                                                @if (!empty($discount->created_at))
                                                    {{ \App\Utils\DateSupport::parse($discount->created_at)->format(config('app.date_format') . ' H:i:s') }}
                                                @endif
                                            </p>
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
                                                            wire:click="$dispatch('edit-discount', {id:{{ $discount->id }}})"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#discount-modal">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item border-radius-md text-danger"
                                                            href="javascript:void(0);"
                                                            wire:click="$dispatch('swal:confirm', {id:{{ $discount->id }}})">Delete
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

    <livewire:admin.earnings.discounts.create-update-discount />
</div>
