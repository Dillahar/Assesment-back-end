@push('scripts')
    <script>
        Livewire.on('checkout-success', (data) => {
            Livewire.dispatch('reset-form');
            Swal.fire({
                title: "Success!",
                text: data.message,
                showDenyButton: false,
                showCancelButton: false,
                imageUrl: "{{ asset('img/ic_success.png') }}",
                imageWidth: 80,
                imageHeight: 80,
                imageAlt: "Icon Success",
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: 'btn btn-success'
                }
            }).then(function(result) {
                window.location.href = data.redirect;
            });
        });
    </script>
@endpush
<div>
    <section class="px-0 ">
        <div class="container min-vh-70 d-flex flex-column">
            <div class="card-section ">
                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <a href="{{ route('course-detail', $course->slug) }}">
                            <div class="custom-card pb-3">
                                <img src="{{ $course->thumbnail_url }}" class="w-100 border-radius-md shadow-sm">
                                <div class="text-start px-3">
                                    <h5 class="mt-4 text-start">{{ $course->title }}</h5>
                                    <p class="price">@rupiah($course->price)</p>
                                    <div class="row">
                                        <div class="col">
                                            {!! \App\Utils\Helper::ratingStarBuilder($course->ratings) !!}
                                        </div>
                                        <div class="level col text-end me-2">
                                            {{ $course->level }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 ">
                        <div class="custom-card pb-3">
                            <div class="text-start px-3">
                                <h5 class="mt-4 text-start">Add Your Payment Method</h5>
                                <p class="price">Step 1 of 2</p>
                                <div class="row mb-1">
                                    <div class="col">
                                        <span class="text-start">Harga</span>
                                    </div>
                                    <div class="col text-end me-2">
                                        <span>@rupiah($course->price)</span>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col">
                                        <span class="text-start text-danger">Discount</span>
                                    </div>
                                    <div class="col text-end me-2 text-danger">
                                        <span>@rupiah($discountCut)</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <span class="text-start fw-bold">Total</span>
                                    </div>
                                    <div class="col text-end me-2">
                                        <span class="fw-bold">@rupiah($course->price - $discountCut < 0 ? 0 : $course->price - $discountCut)</span>
                                    </div>
                                </div>
                                <div class="input-group mt-4">
                                    <input type="text" class="form-control" placeholder="Promo code"
                                        wire:model='discountCode'>
                                    <button type="button" class="btn btn-secondary" wire:click='redeem'>Redeem</button>
                                </div>
                                <x-forms.error field="discountCode" />
                                <hr />
                                <h5 class="mt-4 text-start">Pick Your Payment Method</h5>
                                @foreach ($payment_methods as $payment)
                                    <div class="form-check">
                                        <input class="form-check-input mt-3" type="radio" name="paymentMethodId"
                                            wire:model.live="paymentMethodId" id="payment-{{ $payment->id }}"
                                            value="{{ $payment->id }}">
                                        <label class="form-check-label" for="payment-{{ $payment->id }}">
                                            <span class="radio-option">
                                                <img src="{{ $payment->logo_url }}"
                                                    alt="{{ $payment->bank }} Logo" class="avatar avatar-md me-2">
                                                {{ $payment->bank }} - A.N {{ $payment->name }} /
                                                {{ $payment->number }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                                <x-forms.error field="paymentMethodId" />

                                @if ($paymentMethod)
                                    <hr />
                                    <h5 class="mt-3 text-start">Instruction</h5>
                                    {!! $paymentMethod->instructions !!}

                                    <div class="text-end">
                                        <button type="button" class="btn btn-primary mt-3" wire:click='checkout'
                                            wire:loading.remove>Checkout</button>
                                        <div class="spinner-border text-primary d-none"
                                            wire:loading.class.remove="d-none" wire:target='checkout' role="status">
                                            <span class="visually-hidden">Loading...</span>
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
