<div class="{{ $col }}" id="{{ $id }}-hidden" {{ $hidden ? 'hidden' : '' }}>

    @if($label)
        <label class="kt-label" for="{{ $id }}">{{ trans($label) }}</label>
    @endif
    <div class="flex items-center gap-2">
        
        <input type="hidden" name="{{ $name }}" value="0">

        <input
            {{ $readonly ? 'readonly' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="kt-switch kt-switch-lg mt-2"
            id="{{ $id }}"
            aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
            type="checkbox"
            name="{{ $name }}"
            value="1"
            {{ old($name, $value) ? 'checked' : '' }}>

        @error($name)
            <div class="text-red-500 text-xs">{{ $message }}</div>
        @enderror
    
    </div>

</div>