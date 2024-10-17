<div wire:ignore.self class="modal fade" id="discount-detail-modal" tabindex="-1" role="dialog"
    aria-labelledby="modal-default" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Discount Detail</h2>
                <button type="button" class="btn-close" style="color:red" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="$dispatch('reset-form')">X</button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @if ($order && $order->discount_detail)
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Discount
                                Code:</strong>
                            {{ $order->discount_detail->code }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Type:</strong>
                            {{ $order->discount_detail->type }}</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Value:</strong>
                            @if($order->discount_detail->type == \App\Enums\DiscountType::PERCENT)
                                {{ $order->discount_detail->value }}%
                            @else
                                @rupiah($order->discount_detail->value)
                            @endif</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Used:</strong>
                            @rupiah($order->discount)</li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Expired At
                                Created:</strong>
                            @if (!empty($order->discount_detail->expired_at))
                                {{ \App\Utils\DateSupport::parse($order->discount_detail->expired_at)->format(config('app.date_format') . ' H:i:s') }}
                            @endif
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
