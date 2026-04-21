<div class="{{ $col }}" id="{{ $id }}-hidden" {{ $hidden ? 'hidden' : '' }}>
    <div class="form-group mt-2">
        @if(!empty($label))
            <label for="{{ $id }}">{{ trans('admin.' . $label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        <textarea id="{{ $id }}" aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}" {{ $readonly ? 'readonly' : '' }} {{ $disabled ? 'disabled' : '' }} class="kt-textarea {{ $ckeditor ? 'ckeditor' : '' }}" name="{{ $name }}" rows="{{ $rows }}">{!! old($old, $value) !!}</textarea>
        @error($invalid)
            <div class="text-red-500 text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>