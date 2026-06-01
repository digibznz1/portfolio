<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.appointments') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.appointments') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-5">

        {{-- Main Details --}}
        <div class="lg:col-span-2 space-y-5">

            <div class="kt-card pb-5">
                
                <div class="kt-card-header">
                    <h3 class="kt-card-title">{{ trans('admin.global.details') }}</h3>
                </div>

                <div class="kt-card-body p-6">

                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-5 mr-5">

                        <div>
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.name') }}</dt>
                            <dd class="font-semibold text-on-surface">{{ $appointment->name }}</dd>
                        </div>

                        <div>
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.email') }}</dt>
                            <dd><a href="mailto:{{ $appointment->email }}" class="text-primary hover:underline">{{ $appointment->email }}</a></dd>
                        </div>

                        @if ($appointment->phone)
                            <div>
                                <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.phone') }}</dt>
                                <dd><a href="tel:{{ $appointment->phone }}" class="text-primary hover:underline">{{ $appointment->phone }}</a></dd>
                            </div>
                        @endif

                        <div>
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.date') }}</dt>
                            <dd class="font-semibold text-lg text-primary">{{ $appointment->date->format('Y-m-d') }}</dd>
                        </div>

                        <div>
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('site.contact.available_slots') }}</dt>
                            <dd>
                                <span class="inline-flex items-center rounded-full bg-secondary/10 text-secondary font-bold text-sm">
                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                    {{ $appointment->time_slot }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">{{ trans('admin.global.created_at') }}</dt>
                            <dd class="text-sm text-gray-500">{{ $appointment->created_at }}</dd>
                        </div>

                    </dl>

                    @if ($appointment->notes)
                        <div class="mt-6 pt-6 border-t border-border">
                            <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">{{ trans('admin.global.description') }}</dt>
                            <dd class="text-sm text-on-surface leading-relaxed bg-surface-container-low rounded-xl p-4">{{ $appointment->notes }}</dd>
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

                    @php
                        $statusColor = match($appointment->status->value) {
                            'pending'   => 'bg-yellow-100 text-yellow-700',
                            'confirmed' => 'bg-green-100  text-green-700',
                            'cancelled' => 'bg-red-100    text-red-600',
                            default     => 'bg-gray-100   text-gray-500',
                        };
                        $statusIcon = match($appointment->status->value) {
                            'pending'   => 'hourglass_empty',
                            'confirmed' => 'event_available',
                            'cancelled' => 'event_busy',
                            default     => 'info',
                        };
                    @endphp

                    <div class="flex flex-col items-center gap-2 py-4">
                        <span class="material-symbols-outlined text-4xl {{ $statusColor }} p-3 rounded-2xl" style="font-variation-settings: 'FILL' 1;">{{ $statusIcon }}</span>
                        <span class="text-sm font-bold {{ $statusColor }} px-3 py-1 rounded-full">{{ trans('admin.appointment.' . $appointment->status->value) }}</span>
                    </div>

                    @if (permissionAdmin('status-appointments'))
                        <div class="pt-4 border-t border-border mb-5 mx-5">
                            <label class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 block">{{ trans('admin.global.change') }}</label>
                            <select id="change-status" data-id="{{ $appointment->id }}"
                                    class="w-full border border-border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/20">
                                <option value="pending"   {{ $appointment->status->value === 'pending'   ? 'selected' : '' }}>{{ trans('admin.appointment.pending') }}</option>
                                <option value="confirmed" {{ $appointment->status->value === 'confirmed' ? 'selected' : '' }}>{{ trans('admin.appointment.confirmed') }}</option>
                                <option value="cancelled" {{ $appointment->status->value === 'cancelled' ? 'selected' : '' }}>{{ trans('admin.appointment.cancelled') }}</option>
                            </select>
                        </div>
                    @endif

                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-body p-6 space-y-3">
                    <a href="mailto:{{ $appointment->email }}"
                       class="w-full kt-btn kt-btn-primary flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">mail</span>
                        {{ __('تأكيد بالبريد') }}
                    </a>
                    @if ($appointment->phone)
                        <a href="tel:{{ $appointment->phone }}"
                           class="w-full kt-btn kt-btn-outline flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">phone</span>
                            {{ __('اتصل') }}
                        </a>
                    @endif
                    <a href="{{ route('dashboard.admin.websites.contacts.appointments.index') }}"
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
                $.post('{{ route('dashboard.admin.websites.contacts.appointments.status') }}', {
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
