<div class="flex items-center gap-2">
    @if ($permissions['status'])
        <select data-id="{{ $c->id }}"
                class="contact-status text-xs rounded-lg px-2 py-1 border border-border cursor-pointer
                       {{ $c->status->value === 'new'     ? 'bg-blue-50  text-blue-600'  : '' }}
                       {{ $c->status->value === 'read'    ? 'bg-gray-50  text-gray-600'  : '' }}
                       {{ $c->status->value === 'replied' ? 'bg-green-50 text-green-600' : '' }}">
            <option value="new"     {{ $c->status->value === 'new'     ? 'selected' : '' }}>{{ trans('admin.contact.new') }}</option>
            <option value="read"    {{ $c->status->value === 'read'    ? 'selected' : '' }}>{{ trans('admin.contact.read') }}</option>
            <option value="replied" {{ $c->status->value === 'replied' ? 'selected' : '' }}>{{ trans('admin.contact.replied') }}</option>
        </select>
    @else
        <span class="text-xs text-gray-500">{{ $c->status->value }}</span>
    @endif
</div>
