<div class="space-y-8">

    {{-- Calendar Card --}}
    <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/30">

        <div class="flex items-center justify-between mb-8">
            <h2 class="text-primary font-bold text-xl">@setting('contact', 'consultation_title')</h2>
            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase">
                {{ trans('site.contact.live_schedule') }}
            </span>
        </div>

        {{-- Month Navigation --}}
        <div class="flex items-center justify-between mb-6">
            <button type="button" wire:click="prevMonth"
                    class="p-2 hover:bg-surface-container-high rounded-full transition-colors text-primary">
                <span class="material-symbols-outlined align-middle">
                    {{ app()->isLocale('ar') ? 'chevron_right' : 'chevron_left' }}
                </span>
            </button>
            <span class="font-bold text-primary">{{ $monthLabel }}</span>
            <button type="button" wire:click="nextMonth"
                    class="p-2 hover:bg-surface-container-high rounded-full transition-colors text-primary">
                <span class="material-symbols-outlined align-middle">
                    {{ app()->isLocale('ar') ? 'chevron_left' : 'chevron_right' }}
                </span>
            </button>
        </div>

        {{-- Day Headers --}}
        <div class="grid grid-cols-7 gap-2 mb-3 text-center text-xs font-bold text-outline uppercase tracking-wider">
            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d)
                <div>{{ $d }}</div>
            @endforeach
        </div>

        {{-- Days Grid --}}
        <div class="grid grid-cols-7 gap-2">
            @foreach ($calendarDays as $day)
                @if (!$day['current'])
                    <div class="h-10"></div>
                @elseif ($day['past'])
                    <div class="h-10 flex items-center justify-center text-sm text-outline-variant opacity-40 cursor-not-allowed">
                        {{ $day['label'] }}
                    </div>
                @else
                    <button type="button"
                            wire:click="selectDate('{{ $day['date'] }}')"
                            class="h-10 flex items-center justify-center rounded-lg text-sm font-medium transition-all
                                   {{ $day['selected']
                                        ? 'accent-gradient text-white font-bold shadow-lg'
                                        : 'hover:bg-surface-container-high text-on-surface cursor-pointer' }}">
                        {{ $day['label'] }}
                    </button>
                @endif
            @endforeach
        </div>

        {{-- Time Slots --}}
        <div class="mt-8 space-y-4">
            <h3 class="text-sm font-bold text-on-surface-variant uppercase tracking-wide">
                {{ trans('site.contact.available_slots') }}
            </h3>
            <div class="grid grid-cols-2 gap-3">
                @forelse ($availableSlots as $slot)
                    <button type="button"
                            wire:click="selectSlot('{{ $slot }}')"
                            class="py-3 px-4 rounded-xl border text-primary text-sm font-bold transition-all
                                   {{ $selectedSlot === $slot
                                        ? 'border-primary bg-primary/5'
                                        : 'border-outline-variant/30 hover:border-primary' }}">
                        {{ $slot }}
                    </button>
                @empty
                    @if ($selectedDate)
                        <p class="col-span-2 text-center text-sm text-outline-variant py-4">
                            {{ __('لا توجد مواعيد متاحة في هذا اليوم') }}
                        </p>
                    @endif
                @endforelse
            </div>
        </div>

        {{-- Appointment Form --}}
        @if ($selectedDate && $selectedSlot)
            <form wire:submit="submit" class="mt-6 space-y-3">
                <input wire:model="name" type="text"
                       placeholder="{{ trans('site.contact.full_name') }}"
                       class="w-full bg-surface-container-low border-none rounded-xl py-3 px-5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20" />
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <input wire:model="email" type="email"
                       placeholder="{{ trans('site.contact.business_email') }}"
                       class="w-full bg-surface-container-low border-none rounded-xl py-3 px-5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20" />
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                <input wire:model="phone" type="tel"
                       placeholder="{{ trans('site.phone') }}"
                       class="w-full bg-surface-container-low border-none rounded-xl py-3 px-5 text-sm text-on-surface focus:ring-2 focus:ring-primary/20" />

                {{-- Feedback --}}
                @if ($successMessage)
                    <p class="text-green-600 text-sm font-medium">{{ $successMessage }}</p>
                @endif
                @if ($errorMessage)
                    <p class="text-red-500 text-sm font-medium">{{ $errorMessage }}</p>
                @endif

                <button type="submit"
                        class="w-full signature-gradient text-white py-4 rounded-xl font-bold text-sm tracking-widest uppercase flex items-center justify-center gap-2 shadow-xl shadow-primary/20 transition-opacity">
                    <span wire:loading.remove wire:target="submit">{{ trans('site.contact.confirm_appointment') }}</span>
                    <span wire:loading wire:target="submit">...</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
                        {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_right_alt' }}
                    </span>
                </button>
            </form>
        @else
            {{-- Success after reset --}}
            @if ($successMessage)
                <p class="mt-4 text-green-600 text-sm font-medium text-center">{{ $successMessage }}</p>
            @endif

            <button type="button" disabled
                    class="w-full mt-6 signature-gradient text-white py-4 rounded-xl font-bold text-sm tracking-widest uppercase flex items-center justify-center gap-2 shadow-xl opacity-50 cursor-not-allowed">
                {{ trans('site.contact.confirm_appointment') }}
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">
                    {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_right_alt' }}
                </span>
            </button>
        @endif

    </div>

    {{-- Office Map --}}
    <div class="bg-surface-container-low rounded-xl overflow-hidden group border border-outline-variant/30">
        <div class="h-48 w-full relative overflow-hidden">
            @php $officeImg = setting('contact')->getValue('office_image'); @endphp
            @if ($officeImg)
                <img src="{{ asset('storage/' . $officeImg) }}"
                     class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700"
                     alt="Office" />
            @else
                <div class="w-full h-full bg-surface-container-highest flex items-center justify-center">
                    <span class="material-symbols-outlined text-outline-variant text-5xl">location_city</span>
                </div>
            @endif
            <div class="absolute inset-0 bg-primary/10"></div>
            <div class="absolute bottom-4 start-4 glass-card px-4 py-2 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">location_on</span>
                <span class="text-xs font-bold text-primary uppercase">@setting('contact', 'address')</span>
            </div>
        </div>
    </div>

</div>
