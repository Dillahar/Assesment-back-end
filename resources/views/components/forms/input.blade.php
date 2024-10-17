@props(['label', 'field', 'type' => 'text', 'placeholder', 'class' => '', 'asterisk' => false, 'liveUpdate' => false])
<div class="{{ $class }}">
    <label for="{{ $field }}">{{ $label }}</label>
    @if ($asterisk)
        <label class="text-danger">*</label>
    @endif
    <input id="{{ $field }}" type="{{ $type }}" name="{{ $field }}" class="form-control"
        placeholder="{{ $placeholder }}" aria-label="{{ $label }}" aria-describedby="{{ $field }}-addon"
        @if($liveUpdate) wire:model.live="{{ $field }}" @else wire:model="{{ $field }}" @endif>
    <x-forms.error field="{{ $field }}" />
</div>
