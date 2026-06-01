@php
    $inputBase = 'w-full bg-surface-container-low border rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 text-on-surface transition-all';
    $inputOk   = 'border-transparent';
    $inputErr  = 'border-red-400 ring-2 ring-red-100';
@endphp

<div class="glass-card rounded-xl p-8 md:p-12 shadow-2xl border border-outline-variant/30">

    {{-- Tabs --}}
    <div class="flex gap-8 border-b border-outline-variant/20 mb-10 overflow-x-auto">
        <button type="button" wire:click="$set('tab','rfq')"
                class="pb-4 font-bold text-lg whitespace-nowrap transition-colors {{ $tab === 'rfq' ? 'text-primary border-b-2 border-secondary' : 'text-on-surface-variant hover:text-primary' }}">
            {{ trans('site.contact.tab_rfq') }}
        </button>
        <button type="button" wire:click="$set('tab','quick')"
                class="pb-4 font-bold text-lg whitespace-nowrap transition-colors {{ $tab === 'quick' ? 'text-primary border-b-2 border-secondary' : 'text-on-surface-variant hover:text-primary' }}">
            {{ trans('site.contact.tab_quick') }}
        </button>
    </div>

    {{-- Success Message --}}
    @if ($successMessage)
        <div class="mb-6 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-medium flex items-center gap-2">
            <span class="material-symbols-outlined text-green-600 text-base">check_circle</span>
            {{ $successMessage }}
        </div>
    @endif

    {{-- ===== RFQ Form ===== --}}
    @if ($tab === 'rfq')
        <form wire:submit="submitRfq" class="space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.full_name') }}</label>
                    <input wire:model="rfq_name" type="text" placeholder="John Doe"
                           class="{{ $inputBase }} @error('rfq_name') {{ $inputErr }} @else {{ $inputOk }} @enderror" />
                    @error('rfq_name') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.business_email') }}</label>
                    <input wire:model="rfq_email" type="email" placeholder="john@company.com"
                           class="{{ $inputBase }} @error('rfq_email') {{ $inputErr }} @else {{ $inputOk }} @enderror" />
                    @error('rfq_email') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.company_name') }}</label>
                    <input wire:model="rfq_company_name" type="text" placeholder="Global Enterprise"
                           class="{{ $inputBase }} {{ $inputOk }}" />
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.activity_type') }}</label>
                    <select wire:model="rfq_activity_type"
                            class="{{ $inputBase }} {{ $inputOk }} appearance-none">
                        <option value="">{{ trans('site.select') }}</option>
                        <option value="web_dev">Web & App Development</option>
                        <option value="digital_marketing">Digital Marketing</option>
                        <option value="branding">Branding</option>
                        <option value="content">Content Creation</option>
                        <option value="seo">SEO Optimization</option>
                        <option value="consultancy">Business Consultancy</option>
                    </select>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.budget_range') }}</label>
                    <span class="text-xs font-bold text-secondary">{{ $this->getBudgetLabel() }}</span>
                </div>
                <input wire:model.live="rfq_budget_range" type="range" min="0" max="100"
                       class="w-full h-1.5 bg-surface-container-highest rounded-lg appearance-none cursor-pointer accent-secondary" />
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.project_scope') }}</label>
                <textarea wire:model="rfq_project_scope" rows="5"
                          placeholder="{{ trans('site.contact.scope_placeholder') }}"
                          class="{{ $inputBase }} @error('rfq_project_scope') {{ $inputErr }} @else {{ $inputOk }} @enderror"></textarea>
                @error('rfq_project_scope') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</span> @enderror
            </div>

            <div>
                @php $agreedBorder = $errors->has('rfq_agreed') ? 'bg-red-50 border-red-200' : 'border-transparent'; @endphp
                <div class="flex items-center gap-3 p-3 rounded-xl border transition-all {{ $agreedBorder }}">
                    <input wire:model="rfq_agreed" type="checkbox" id="terms-rfq"
                           class="rounded border-outline-variant text-secondary focus:ring-secondary w-4 h-4 shrink-0" />
                    <label for="terms-rfq" class="text-sm text-on-surface-variant">
                        {!! trans('site.contact.privacy_agree', ['link' => '<a href="#" class="text-primary underline font-medium">' . trans('site.contact.privacy_policy') . '</a>']) !!}
                    </label>
                </div>
                @error('rfq_agreed') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    class="w-full signature-gradient text-white py-5 rounded-xl font-bold text-base tracking-[0.2em] uppercase shadow-2xl shadow-primary/30 hover:scale-[1.02] active:scale-95 transition-all">
                <span wire:loading.remove wire:target="submitRfq">{{ trans('site.contact.submit_rfq') }}</span>
                <span wire:loading wire:target="submitRfq" class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                    {{ __('جاري الإرسال...') }}
                </span>
            </button>

        </form>
    @endif

    {{-- ===== Quick Contact Form ===== --}}
    @if ($tab === 'quick')
        <form wire:submit="submitQuick" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.contact.full_name') }}</label>
                    <input wire:model="quick_name" type="text" placeholder="{{ trans('site.enter_name') }}"
                           class="{{ $inputBase }} @error('quick_name') {{ $inputErr }} @else {{ $inputOk }} @enderror" />
                    @error('quick_name') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.email') }}</label>
                    <input wire:model="quick_email" type="email" placeholder="{{ trans('site.enter_email') }}"
                           class="{{ $inputBase }} @error('quick_email') {{ $inputErr }} @else {{ $inputOk }} @enderror" />
                    @error('quick_email') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.phone') }}</label>
                <input wire:model="quick_phone" type="tel" placeholder="{{ trans('site.enter_phone') }}"
                       class="{{ $inputBase }} {{ $inputOk }}" />
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">{{ trans('site.message') }}</label>
                <textarea wire:model="quick_message" rows="5" placeholder="{{ trans('site.enter_message') }}"
                          class="{{ $inputBase }} @error('quick_message') {{ $inputErr }} @else {{ $inputOk }} @enderror"></textarea>
                @error('quick_message') <span class="text-red-500 text-xs mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span>{{ $message }}</span> @enderror
            </div>

            <button type="submit"
                    class="w-full signature-gradient text-white py-5 rounded-xl font-bold text-base tracking-[0.2em] uppercase shadow-2xl shadow-primary/30 hover:scale-[1.02] active:scale-95 transition-all">
                <span wire:loading.remove wire:target="submitQuick">{{ trans('site.contact.send_message') }}</span>
                <span wire:loading wire:target="submitQuick" class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>
                    {{ __('جاري الإرسال...') }}
                </span>
            </button>

        </form>
    @endif

</div>
