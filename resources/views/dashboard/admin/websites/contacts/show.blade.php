<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.contacts') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.contacts') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-5">

        {{-- Main Details --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Contact Info Card --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">{{ trans('admin.global.details') }}</h3>
                    @if ($contact->type->value === 'rfq')
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary">
                            <span class="material-symbols-outlined text-xs">request_quote</span> RFQ
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-secondary/10 text-secondary">
                            <span class="material-symbols-outlined text-xs">chat_bubble</span>
                            {{ trans('site.contact.tab_quick') }}
                        </span>
                    @endif
                </div>
                <div class="kt-card-body">
                    
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-5 mr-5">

                        <div>
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.name') }}</dt>
                            <dd class="font-semibold text-on-surface">{{ $contact->name }}</dd>
                        </div>

                        <div>
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.email') }}</dt>
                            <dd><a href="mailto:{{ $contact->email }}" class="text-primary hover:underline">{{ $contact->email }}</a></dd>
                        </div>

                        @if ($contact->phone)
                            <div>
                                <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.phone') }}</dt>
                                <dd><a href="tel:{{ $contact->phone }}" class="text-primary hover:underline">{{ $contact->phone }}</a></dd>
                            </div>
                        @endif

                        @if ($contact->company_name)
                            <div>
                                <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('site.contact.company_name') }}</dt>
                                <dd class="font-semibold">{{ $contact->company_name }}</dd>
                            </div>
                        @endif

                        @if ($contact->activity_type)
                            <div>
                                <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('site.contact.activity_type') }}</dt>
                                <dd>{{ $contact->activity_type }}</dd>
                            </div>
                        @endif

                        @if ($contact->budget_range !== null)
                            <div>
                                <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('site.contact.budget_range') }}</dt>
                                <dd class="text-secondary font-bold">
                                    @php
                                        $v = $contact->budget_range;
                                        $label = $v < 20 ? '< 50k SAR' : ($v < 40 ? '50k - 100k SAR' : ($v < 60 ? '100k - 150k SAR' : ($v < 80 ? '150k - 200k SAR' : '200k+ SAR')));
                                    @endphp
                                    {{ $label }}
                                    <span class="text-gray-400 font-normal text-xs ml-1">({{ $contact->budget_range }}/100)</span>
                                </dd>
                            </div>
                        @endif

                        <div>
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.date') }}</dt>
                            <dd class="text-sm text-gray-500">{{ $contact->created_at->format('Y-m-d H:i') }}</dd>
                        </div>

                    </dl>

                    {{-- Project Scope / Message --}}
                    @if ($contact->project_scope)
                        <div class="mt-6 pt-6 border-t border-border">
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">{{ trans('site.contact.project_scope') }}</dt>
                            <dd class="text-sm text-on-surface leading-relaxed bg-surface-container-low rounded-xl p-4">{{ $contact->project_scope }}</dd>
                        </div>
                    @endif

                    @if ($contact->message)
                        <div class="mt-6 pt-6 border-t border-border mr-5">
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">{{ trans('admin.global.message') }}</dt>
                            <dd class="text-sm text-on-surface leading-relaxed bg-surface-container-low rounded-xl p-4">{{ $contact->message }}</dd>
                        </div>
                    @endif

                </div>
            </div>

        </div>

        {{-- Sidebar: Status --}}
        <div class="space-y-5">

            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">{{ trans('admin.global.status') }}</h3>
                </div>
                <div class="kt-card-body p-6 space-y-4">

                    {{-- Current Status Badge --}}
                    <div class="flex items-center justify-center py-4">
                        @php
                            $statusColor = match($contact->status->value) {
                                'new'     => 'bg-blue-100 text-blue-700',
                                'read'    => 'bg-gray-100 text-gray-600',
                                'replied' => 'bg-green-100 text-green-700',
                                default   => 'bg-gray-100 text-gray-500',
                            };
                            $statusIcon = match($contact->status->value) {
                                'new'     => 'mark_email_unread',
                                'read'    => 'mark_email_read',
                                'replied' => 'reply',
                                default   => 'info',
                            };
                        @endphp
                        <div class="flex flex-col items-center gap-2">
                            <span class="material-symbols-outlined text-4xl {{ $statusColor }} p-3 rounded-2xl" style="font-variation-settings: 'FILL' 1;">{{ $statusIcon }}</span>
                            <span class="text-sm font-bold {{ $statusColor }} px-3 py-1 rounded-full">{{ trans('admin.contact.' . $contact->status->value) }}</span>
                        </div>
                    </div>

                    {{-- Change Status --}}
                    @if (permissionAdmin('status-contacts'))
                        <div class="pt-4 border-t border-border mb-5 mx-5">
                            <label class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 block">{{ trans('admin.global.change') }}</label>
                            <select id="change-status" data-id="{{ $contact->id }}"
                                    class="w-full border border-border rounded-xl px-4 py-2.5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20">
                                <option value="new"     {{ $contact->status->value === 'new'     ? 'selected' : '' }}>{{ trans('admin.contact.new') }}</option>
                                <option value="read"    {{ $contact->status->value === 'read'    ? 'selected' : '' }}>{{ trans('admin.contact.read') }}</option>
                                <option value="replied" {{ $contact->status->value === 'replied' ? 'selected' : '' }}>{{ trans('admin.contact.replied') }}</option>
                            </select>
                        </div>
                    @endif

                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="kt-card">
                <div class="kt-card-body p-6 space-y-3">
                    <a href="mailto:{{ $contact->email }}"
                       class="w-full kt-btn kt-btn-primary flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">mail</span>
                        {{ __('رد بالبريد') }}
                    </a>
                    @if ($contact->phone)
                        <a href="tel:{{ $contact->phone }}"
                           class="w-full kt-btn kt-btn-outline flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">phone</span>
                            {{ __('اتصل') }}
                        </a>
                    @endif
                    <a href="{{ route('dashboard.admin.websites.contacts.index') }}"
                       class="w-full kt-btn kt-btn-mono flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        {{ trans('admin.global.back') }}
                    </a>
                </div>
            </div>

        </div>

    </div>

    <x-slot name="scripts">
        <script>
            $('#change-status').on('change', function () {
                $.post('{{ route('dashboard.admin.websites.contacts.status') }}', {
                    id:     $(this).data('id'),
                    status: $(this).val(),
                }, function (response) {
                    new Noty({ layout: 'topRight', type: 'success', text: response, killer: true, timeout: 2000 }).show();
                    location.reload();
                });
            });
        </script>
    </x-slot>

</x-dashboard.admin.layout.app>
