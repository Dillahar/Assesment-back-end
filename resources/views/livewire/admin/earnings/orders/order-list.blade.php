<div>
    <div class="row mb-2">
        <div class="col">
            <span>

                <h5 class="  fw-bolder">
                    Earnings /<span class="text-secondary">
                        Order List
                    </span>
                </h5>
            </span>

        </div>
    </div>

    <div class="row mt-4">

        <div class="col-md-3 mb-4">
            <div class="card  ">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 text-capitalize font-weight-bold ">Total Order</p>
                                <h5 class="font-weight-bolder   mt-4 ">
                                    {{ $orders->count() }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-info-light rounded-circle  text-center">

                                <svg class="feather feather-grid text-info-light ms-auto mt-2 " width="24"
                                    height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2 1C1.44772 1 1 1.44772 1 2C1 2.55228 1.44772 3 2 3H3.21922L6.78345 17.2569C5.73276 17.7236 5 18.7762 5 20C5 21.6569 6.34315 23 8 23C9.65685 23 11 21.6569 11 20C11 19.6494 10.9398 19.3128 10.8293 19H15.1707C15.0602 19.3128 15 19.6494 15 20C15 21.6569 16.3431 23 18 23C19.6569 23 21 21.6569 21 20C21 18.3431 19.6569 17 18 17H8.78078L8.28078 15H18C20.0642 15 21.3019 13.6959 21.9887 12.2559C22.6599 10.8487 22.8935 9.16692 22.975 7.94368C23.0884 6.24014 21.6803 5 20.1211 5H5.78078L5.15951 2.51493C4.93692 1.62459 4.13696 1 3.21922 1H2ZM18 13H7.78078L6.28078 7H20.1211C20.6742 7 21.0063 7.40675 20.9794 7.81078C20.9034 8.9522 20.6906 10.3318 20.1836 11.3949C19.6922 12.4251 19.0201 13 18 13ZM18 20.9938C17.4511 20.9938 17.0062 20.5489 17.0062 20C17.0062 19.4511 17.4511 19.0062 18 19.0062C18.5489 19.0062 18.9938 19.4511 18.9938 20C18.9938 20.5489 18.5489 20.9938 18 20.9938ZM7.00617 20C7.00617 20.5489 7.45112 20.9938 8 20.9938C8.54888 20.9938 8.99383 20.5489 8.99383 20C8.99383 19.4511 8.54888 19.0062 8 19.0062C7.45112 19.0062 7.00617 19.4511 7.00617 20Z"
                                        fill="#0172ef" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card ">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 text-capitalize font-weight-bold">Total Discount</p>
                                <h5 class="font-weight-bolder mt-4 text-danger">
                                    @rupiah($orders->where('status', \App\Enums\OrderStatus::SUCCESS)->sum('discount'))
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-info-light  rounded-circle text-center">
                                <svg width="24" height="24"
                                    class="feather feather-grid text-info-light ms-auto mt-2 " viewBox="-0.5 0 25 25"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M18 3.91992H6C3.79086 3.91992 2 5.71078 2 7.91992V17.9199C2 20.1291 3.79086 21.9199 6 21.9199H18C20.2091 21.9199 22 20.1291 22 17.9199V7.91992C22 5.71078 20.2091 3.91992 18 3.91992Z"
                                        stroke="#0172ef" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M7 17.9199L17 7.91992" stroke="#0172ef" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M8 11.9199C9.10457 11.9199 10 11.0245 10 9.91992C10 8.81535 9.10457 7.91992 8 7.91992C6.89543 7.91992 6 8.81535 6 9.91992C6 11.0245 6.89543 11.9199 8 11.9199Z"
                                        stroke="#0172ef" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M16 17.9199C17.1046 17.9199 18 17.0245 18 15.9199C18 14.8154 17.1046 13.9199 16 13.9199C14.8954 13.9199 14 14.8154 14 15.9199C14 17.0245 14.8954 17.9199 16 17.9199Z"
                                        stroke="#0172ef" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 text-capitalize font-weight-bold">Total Earnings</p>
                                <h5 class="font-weight-bolder mt-4 text-success">
                                    @rupiah($orders->where('status', \App\Enums\OrderStatus::SUCCESS)->sum('total'))
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-info-light rounded-circle text-center">

                                <svg width="24" height="24"
                                    class="feather feather-grid text-info-light ms-auto mt-2 " viewBox="-0.5 0 25 25"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.7003 17.1099V18.22C12.7003 18.308 12.6829 18.395 12.6492 18.4763C12.6156 18.5576 12.5662 18.6316 12.504 18.6938C12.4418 18.7561 12.3679 18.8052 12.2867 18.8389C12.2054 18.8725 12.1182 18.8899 12.0302 18.8899C11.9423 18.8899 11.8551 18.8725 11.7738 18.8389C11.6925 18.8052 11.6187 18.7561 11.5565 18.6938C11.4943 18.6316 11.4449 18.5576 11.4113 18.4763C11.3776 18.395 11.3602 18.308 11.3602 18.22V17.0801C10.9165 17.0072 10.4917 16.8468 10.1106 16.6082C9.72943 16.3695 9.39958 16.0573 9.14023 15.6899C9.04577 15.57 8.99311 15.4226 8.99023 15.27C8.99148 15.1842 9.00997 15.0995 9.04459 15.021C9.0792 14.9425 9.12927 14.8718 9.19177 14.813C9.25428 14.7542 9.32794 14.7087 9.40842 14.679C9.4889 14.6492 9.57455 14.6359 9.66025 14.6399C9.74504 14.6401 9.82883 14.6582 9.90631 14.6926C9.98379 14.7271 10.0532 14.7773 10.1102 14.8401C10.4326 15.2576 10.8657 15.5763 11.3602 15.76V13.21C10.0302 12.69 9.36023 11.9099 9.36023 10.8999C9.38027 10.3592 9.5928 9.84343 9.9595 9.44556C10.3262 9.04769 10.8229 8.79397 11.3602 8.72998V7.62988C11.3602 7.5419 11.3776 7.45482 11.4113 7.37354C11.4449 7.29225 11.4943 7.21847 11.5565 7.15625C11.6187 7.09403 11.6925 7.04466 11.7738 7.01099C11.8551 6.97732 11.9423 6.95996 12.0302 6.95996C12.1182 6.95996 12.2054 6.97732 12.2867 7.01099C12.3679 7.04466 12.4418 7.09403 12.504 7.15625C12.5662 7.21847 12.6156 7.29225 12.6492 7.37354C12.6829 7.45482 12.7003 7.5419 12.7003 7.62988V8.71997C13.0724 8.77828 13.4289 8.91103 13.7485 9.11035C14.0681 9.30967 14.3442 9.57137 14.5602 9.87988C14.6555 9.99235 14.7117 10.1329 14.7202 10.28C14.7229 10.3662 14.7084 10.4519 14.6776 10.5325C14.6467 10.613 14.6002 10.6867 14.5406 10.749C14.481 10.8114 14.4096 10.8613 14.3306 10.8958C14.2516 10.9303 14.1665 10.9487 14.0802 10.95C13.99 10.9475 13.9013 10.9257 13.8202 10.886C13.7391 10.8463 13.6675 10.7897 13.6102 10.72C13.3718 10.4221 13.0575 10.1942 12.7003 10.0601V12.3101L12.9503 12.4099C14.2203 12.9099 15.0103 13.63 15.0103 14.77C14.9954 15.3808 14.7481 15.9629 14.3189 16.3977C13.8897 16.8325 13.3108 17.0871 12.7003 17.1099ZM11.3602 11.73V10.0999C11.1988 10.1584 11.0599 10.2662 10.963 10.408C10.8662 10.5497 10.8162 10.7183 10.8203 10.8899C10.8173 11.0676 10.8669 11.2424 10.963 11.3918C11.0591 11.5413 11.1973 11.6589 11.3602 11.73ZM13.5502 14.8C13.5502 14.32 13.2203 14.03 12.7003 13.8V15.8C12.9387 15.7639 13.1561 15.6427 13.3123 15.459C13.4685 15.2752 13.553 15.0412 13.5502 14.8Z"
                                        fill="#0172ef" />
                                    <path
                                        d="M18 3.96997H6C4.93913 3.96997 3.92172 4.39146 3.17157 5.1416C2.42142 5.89175 2 6.9091 2 7.96997V17.97C2 19.0308 2.42142 20.0482 3.17157 20.7983C3.92172 21.5485 4.93913 21.97 6 21.97H18C19.0609 21.97 20.0783 21.5485 20.8284 20.7983C21.5786 20.0482 22 19.0308 22 17.97V7.96997C22 6.9091 21.5786 5.89175 20.8284 5.1416C20.0783 4.39146 19.0609 3.96997 18 3.96997Z"
                                        stroke="#0172ef" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0   font-weight-bold">Total Success Order</p>

                                <h5 class="font-weight text-white-bolder mt-4">
                                    {{ $orders->where('status', \App\Enums\OrderStatus::SUCCESS)->count() }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-info-light rounded-circle text-center">


                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-book text-info-light mt-2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body ">
                    <x-table.pagination :data="$orders" :sort-by="$sortBy" :sort-dir="$sortDir">
                        <table class="table align-items-center mb-0 dataTable no-footer" id="data_table"
                            aria-describedby="data_table_info">
                            <thead class="bg-gray-100">
                                <tr>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'number'"
                                        :display-name="'Number'" :width="'100px'" />
                                    <th style="width: 100px;">Course</th>
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'user_id'"
                                        :display-name="'User'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'payment_id'"
                                        :display-name="'Payment'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'amount'"
                                        :display-name="'Amount'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'discount'"
                                        :display-name="'Discount'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'total'"
                                        :display-name="'Total Amount'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'status'"
                                        :display-name="'Status'" :width="'100px'" />
                                    <x-table.sortable-th :sort-by="$sortBy" :sort-dir="$sortDir" :field="'created_at'"
                                        :display-name="'Created At'" :width="'10px'" />
                                    <th style="width: 50px;"></th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm">{{ $order->number }}</h6>
                                        </td>
                                        <td>
                                            {{ $order->details->first() ? $order->details->first()->course->title : "-"}}
                                        </td>
                                        <td>
                                            {{ $order->user->name }}
                                        </td>
                                        <td>
                                            @if ($order->payment_method)
                                                {{ $order->payment_method->bank }}
                                            @else
                                                Deleted payment method
                                            @endif
                                        </td>
                                        <td>
                                            @rupiah($order->amount)
                                        </td>
                                        <td>
                                            @rupiah($order->discount)

                                            @if ($order->discount_detail)
                                                <button class="btn btn-sm btn-info ms-3" data-bs-toggle="modal"
                                                    data-bs-target="#discount-detail-modal"
                                                    wire:click="$dispatch('detail-discount', {id:{{ $order->id }}})">See
                                                    Detail</button>
                                            @endif
                                        </td>
                                        <td>
                                            @rupiah($order->total)
                                        </td>
                                        <td>
                                            @if ($order->status == \App\Enums\OrderStatus::PENDING)
                                                <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                            @elseif($order->status == \App\Enums\OrderStatus::SUCCESS)
                                                <span class="badge badge-sm bg-gradient-success">Success</span>
                                            @else
                                                <span
                                                    class="badge badge-sm bg-gradient-danger">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($order->created_at))
                                                {{ \App\Utils\DateSupport::parse($order->created_at)->format(config('app.date_format') . ' H:i:s') }}
                                            @endif
                                        </td>
                                        <td class="align-middle text-right">
                                            <div class="dropstart me-3">
                                                <a href="javascript:" class="text-secondary"
                                                    id="dropdownMarketingCard" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                                    aria-labelledby="dropdownMarketingCard">
                                                    <li><a class="dropdown-item border-radius-md"
                                                            href="{{ route('orders.edit', $order->id) }}">See
                                                            Details</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item border-radius-md text-danger"
                                                            href="javascript:void(0);"
                                                            wire:click="$dispatch('swal:confirm', {id:{{ $order->id }}})">Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                                @if ($orders->isEmpty())
                                    <tr class="odd">
                                        <td valign="top" colspan="6" class="dataTables_empty">No data available
                                            in
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
    <livewire:admin.earnings.orders.detail-discount />
</div>
