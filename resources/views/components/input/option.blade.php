<div class="text mt-2 {{ $col }}" id="{{ $id }}-hidden" {{ $hidden ? 'hidden' : '' }}>
    <div class">
        @if($label)
            <label for="{{ $id }}">{{ trans('admin.' . $label) }} @if($required)<span class="text-danger">*</span>@endif</label>
        @endif
        <select {{ $readonly ? 'readonly' : '' }} {{ $multiple ? 'multiple=multiple data-kt-select-multiple=true data-kt-select-enable-search=true data-kt-select-tags=true' : '' }} {{ $disabled ? 'disabled' : '' }} name="{{ $name }}" data-kt-select="true" data-kt-select-placeholder="{{ $placeholder }}" class="kt-select {{ $class }} select2 @error($invalid) is-invalid @enderror" id="{{ $id }}" data-kt-select-config='{"optionsClass": "kt-scrollable overflow-auto max-h-[250px]"}'>
            
            @if($choose)
                <option value="" disabled>@lang('admin.global.choose')</option>
            @endif

            @if($all)
                <option value="">@lang('admin.global.all')</option>
            @endif

            @php($lists = $keywords ? (old($old) ?? $lists) : $lists)
            @foreach($lists as $key=>$list)
                @if($keywords)
                    <option value="{{ $list }}" {{ (bool) old($old) ? (in_array($list, old($old) ?? []) ? 'selected' : '') : (in_array($list, $lists ?? []) ? 'selected' : '') }}>{{ $list }}</option>
                @else
                    <option value="{{ $key }}" {{ $multiple ? (in_array($key, $value ?? []) ? ' selected' : '') : (old($old, $value) == $key ? 'selected' : '') }}>{{ $list }}</option>
                @endif
            @endforeach
        </select>
        @error($invalid)
            <div class="text-red-500 text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>