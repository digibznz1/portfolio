<div class="flex items-center gap-2">
        <input class="kt-switch kt-switch-sm checkbox" data-type="{{ $type }}" id="{{ $type }}-{{ $models->id }}" data-id="{{ $models->id }}"
               type="checkbox" name="id" value="{{ $models->id }}" {{ $models[$type] ? 'checked' : '' }}>
</div>