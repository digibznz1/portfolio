<div class="{{ $col }} mt-2" id="{{ $id }}-hidden" {{ $hidden ? 'hidden' : '' }}>
    <div class="">
        @if($label)
            <label for="{{ $id }}">{{ trans('admin.' . $label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        <input type="{{ $type }}" aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}" name="{{ $name }}" placeholder="{{ $placeholder }}" {{ $readonly ? 'readonly' : '' }} {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" autofocus class="kt-input block w-full" value="{{ old($old, $value) }}">
        @error($invalid)
            <div class="text-red-500 text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>