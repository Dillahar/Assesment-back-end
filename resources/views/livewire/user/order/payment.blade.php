@push('scripts')
    <script>
        Livewire.on('payment-input', (data) => {
            Swal.fire({
                title: "Mohon tunggu, admin akan segera konfirmasi pesananmu",
                showDenyButton: false,
                showCancelButton: false,
                imageUrl: "{{ asset('img/logo/skillage-3d-logo.png') }}",
                imageWidth: 119,
                imageHeight: 42,
                imageAlt: "Icon Success",
                confirmButtonText: "Kembali",
                confirmButtonColor: "#2466AB",
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            }).then(function(result) {
                window.location.href = data.redirect;
            });
        });
    </script>
@endpush
<div>
    <section class="px-0 mt-4 ">
        <div class="container">
            <div class="card-section">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <a href="{{ route('course-detail', $order->details[0]->course->slug) }}">
                            <div class="custom-card pb-3">
                                <img src="{{ $order->details[0]->course->thumbnail_url }}"
                                    class="w-100 border-radius-md shadow-sm">
                                <div class="text-start px-3">
                                    <h5 class="mt-4 text-start">{{ $order->details[0]->course->title }}</h5>
                                    <p class="price">@rupiah($order->details[0]->course->price) @if ($order->details[0]->course->price != $order->amount)
                                            (Old Price)
                                        @endif
                                    </p>
                                    <div class="row">
                                        <div class="col">
                                            {!! \App\Utils\Helper::ratingStarBuilder($order->details[0]->course->ratings) !!}
                                        </div>
                                        <div class="level col text-end me-2">
                                            {{ $order->details[0]->course->level }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 vh-100">
                        <div class="custom-card pb-3">
                            <div class="text-start px-3">
                                <h5 class="mt-4 text-start">Complete the Payment</h5>
                                <p class="price">Step 2 of 2</p>
                                <div class="row mb-1">
                                    <div class="col">
                                        <span class="text-start">Harga</span>
                                    </div>
                                    <div class="col text-end me-2">
                                        <span>@rupiah($order->amount)</span>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col">
                                        <span class="text-start text-danger">Discount</span>
                                    </div>
                                    <div class="col text-end me-2 text-danger">
                                        <span>@rupiah($order->discount)</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <span class="text-start fw-bold">Total</span>
                                    </div>
                                    <div class="col text-end me-2">
                                        <span class="fw-bold">@rupiah($order->total)</span>
                                    </div>
                                </div>
                                <hr />
                                <h5 class="mt-4 text-start">Payment Method</h5>
                                <div class="mt-4 d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-row align-items-center">
                                        <img src="{{ $order->payment_method->logo_url }}" class="rounded"
                                            width="70">
                                        <div class="d-flex flex-column ms-3">
                                            <span class="h5 mb-1">{{ $order->payment_method->bank }}</span>
                                            <span class="small text-muted">{{ $order->payment_method->number }} /
                                                An.{{ $order->payment_method->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                @if (!$order->payment)
                                    <h5 class="mt-4 text-start">Input Your Payment Proof</h5>
                                    <x-forms.input field="accountNumber" type="number" label="Account Number"
                                        placeholder="Account Number" class="mb-4" />
                                    <x-forms.input field="accountName" type="text" label="Account Name"
                                        placeholder="Account Name" class="mb-4" />
                                    <x-forms.input field="paymentProof" type="file" label="Payment Proof"
                                        placeholder="Paymen Proof" />
                                    <div class="spinner-border text-primary d-none" wire:loading.class.remove="d-none"
                                        wire:target='paymentProof' role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <div class="text-end">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-primary mt-3" wire:click='submit'
                                                wire:loading.remove>Submit</button>
                                            <div class="spinner-border text-primary d-none"
                                                wire:loading.class.remove="d-none" wire:target='submit' role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
