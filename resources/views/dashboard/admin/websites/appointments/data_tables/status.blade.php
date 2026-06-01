<div class="flex items-center gap-2">
    @if ($permissions['status'])
        <select data-id="{{ $a->id }}"
                class="appointment-status text-xs rounded-lg px-2 py-1 border border-border cursor-pointer
                       {{ $a->status->value === 'pending'   ? 'bg-yellow-50 text-yellow-700' : '' }}
                       {{ $a->status->value === 'confirmed' ? 'bg-green-50  text-green-700' : '' }}
                       {{ $a->status->value === 'cancelled' ? 'bg-red-50    text-red-600'   : '' }}">
            <option value="pending"   {{ $a->status->value === 'pending'   ? 'selected' : '' }}>{{ trans('admin.appointment.pending') }}</option>
            <option value="confirmed" {{ $a->status->value === 'confirmed' ? 'selected' : '' }}>{{ trans('admin.appointment.confirmed') }}</option>
            <option value="cancelled" {{ $a->status->value === 'cancelled' ? 'selected' : '' }}>{{ trans('admin.appointment.cancelled') }}</option>
        </select>
    @else
        <span class="text-xs text-gray-500">{{ $a->status->value }}</span>
    @endif
</div>
