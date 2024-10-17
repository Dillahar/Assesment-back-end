<form wire:submit='update'>
    <div class="mb-4">
        <div class="row">
            <div class="col-12">
                <h4>Detail Order of {{ $order->number }}</h4>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Order Information</h5>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                            class="text-dark">Amount:</strong>
                                        @rupiah($order->amount)</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Discount
                                            Used:</strong>
                                        @rupiah($order->discount)</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Total
                                            Amount:</strong>
                                        @rupiah($order->total)</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Created
                                            At:</strong>
                                        @if (!empty($order->created_at))
                                            {{ \App\Utils\DateSupport::parse($order->created_at)->format(config('app.date_format') . ' H:i:s') }}
                                        @endif
                                    </li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                            class="text-dark">Status:</strong>
                                        {{ $order->status }}</li>
                                </ul>
                            </div>
                            <div class="col-12 mt-3">
                                <h6 class="mb-0 text-capitalize">Order Items</h6>
                                <div class="table-responsive  p-0 mt-2">
                                    <table class="table align-items-center mb-0" id="data_table">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-uppercase  text-xs">Course</th>
                                                <th class="text-uppercase  text-xs  ps-2">Price</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($order->details as $detail)
                                                <tr>
                                                    <td class="align-middle text-start">
                                                        <h6 class="mb-0 text-sm">{{ $detail->course->title }}</h6>
                                                    </td>
                                                    <td class="align-middle text-start">
                                                        <span class="">
                                                            @rupiah($detail->price)
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if ($order->discount_detail)
                                <div class="col-12 mt-3">
                                    <h6 class="mb-0 text-capitalize">Discount Detail</h6>

                                    <ul class="list-group">
                                        @if ($order && $order->discount_detail)
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Discount
                                                    Code:</strong>
                                                {{ $order->discount_detail->code }}</li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Type:</strong>
                                                {{ $order->discount_detail->type }}</li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Value:</strong>
                                                @if ($order->discount_detail->type == \App\Enums\DiscountType::PERCENT)
                                                    {{ $order->discount_detail->value }}%
                                                @else
                                                    @rupiah($order->discount_detail->value)
                                                @endif
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Used:</strong>
                                                @rupiah($order->discount)</li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Expired At
                                                    Created:</strong>
                                                @if (!empty($order->discount_detail->expired_at))
                                                    {{ \App\Utils\DateSupport::parse($order->discount_detail->expired_at)->format(config('app.date_format') . ' H:i:s') }}
                                                @endif
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif

                            @if ($order->status == \App\Enums\OrderStatus::PENDING)
                                <div class="col-12 d-flex flex-row justify-content-center mt-4">
                                    <button class="btn btn-success me-4" type="button"
                                        wire:click="$dispatch('swal:confirm', {id:{{ $order->id }}, 
                                    title: 'Ingin menyetujui order ini?',
                                    message: 'Setelah disetujui, data tidak akan bisa dirubah!', 
                                    dispatch: 'confirm-order', 
                                    confirmText: 'Ya, setujui', 
                                    confirmClass: 'btn btn-success me-3',
                                    dismissText: 'Data tidak jadi disetujui',
                                })">Confirm
                                        Order</button>
                                    <button class="btn btn-danger me-4" type="button"
                                        wire:click="$dispatch('swal:confirm', {id:{{ $order->id }}, 
                                    title: 'Ingin membatalkan order ini?',
                                    message: 'Setelah dibatalkan, data tidak akan bisa dirubah!', 
                                    dispatch: 'cancel-order', 
                                    confirmText: 'Ya, batalkan', 
                                    confirmClass: 'btn btn-success me-3',
                                    dismissText: 'Data tidak jadi dibatalkan',
                                })">Cancel
                                        Order</button>
                                    <button class="btn btn-warning me-4" type="button"
                                        wire:click="$dispatch('swal:confirm', {id:{{ $order->id }}, 
                                    title: 'Ingin refund order ini?',
                                    message: 'Setelah dibatalkan, data tidak akan bisa dirubah!', 
                                    dispatch: 'refund-order', 
                                    confirmText: 'Ya, refund', 
                                    confirmClass: 'btn btn-success me-3',
                                    dismissText: 'Data tidak jadi direfund',
                                })">Refund
                                        Order</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="font-weight-bolder">Payment Information</h5>
                        <div class="row">
                            <div class="col-12">
                                @if ($this->order->payment)
                                    <img src="{{ $this->order->payment->payment_proof_url }}"
                                        class="w-100 border-radius-lg shadow-lg mt-3">

                                    <a class="btn btn-success my-3" href="{{ $this->order->payment->payment_proof_url }}" download>Download</a>
                                    <h6 class="mb-0 text-capitalize mt-3">Payment Detail</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Account Number:</strong>
                                            {{ $this->order->payment->account_number }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Account Name:</strong>
                                            {{ $this->order->payment->account_name }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Created
                                                At:</strong>
                                            @if (!empty($this->order->payment->created_at))
                                                {{ \App\Utils\DateSupport::parse($this->order->payment->created_at)->format(config('app.date_format') . ' H:i:s') }}
                                            @endif
                                        </li>
                                    </ul>
                                @else
                                    <h6 class="text-center mt-3">No Payment</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
@endpush
