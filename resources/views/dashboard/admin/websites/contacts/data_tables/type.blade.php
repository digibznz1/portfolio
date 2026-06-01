@if ($c->type->value === 'rfq')
    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary">
        <span class="material-symbols-outlined text-xs">request_quote</span>
        RFQ
    </span>
@else
    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold bg-secondary/10 text-secondary">
        <span class="material-symbols-outlined text-xs">chat_bubble</span>
        {{ trans('site.contact.tab_quick') }}
    </span>
@endif
