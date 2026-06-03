<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.websites') . ' - ' . trans('admin.websites.about_page') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.websites.about_page') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.about-page.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="p-6">

                    {{-- ===== Language Tabs ===== --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        
                        @foreach (getLanguages() as $language)
                        
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}" data-kt-tab-toggle="#about_tab_{{ $language->code }}">
                            
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                            
                                {{ $language->name }}
                            
                            </button>

                        @endforeach

                    </div>

                    {{-- ===== Tab Content ===== --}}
                    @foreach (getLanguages() as $language)

                        @php
                            $isFirst = $loop->first;
                            $lc      = $language->code;
                            $s       = fn(string $key) => setting('about_page', $lc)->getValue($key) ?? '';
                        @endphp

                        <div id="about_tab_{{ $lc }}" class="{{ $isFirst ? '' : 'hidden' }}">

                            {{-- Hero --}}
                            <p class="section-label">{{ trans('admin.websites.hero') }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <x-input.text
                                    name="hero_badge[{{ $lc }}]"
                                    label="global.badge"
                                    :required="false"
                                    :value="$s('hero_badge')" />

                                <x-input.text
                                    name="hero_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="$isFirst"
                                    :value="$s('hero_title')" />
                            </div>

                            <div class="mb-6">
                                <x-input.textarea
                                    name="hero_description[{{ $lc }}]"
                                    label="global.description"
                                    :required="false"
                                    :value="$s('hero_description')" />
                            </div>

                            {{-- Stat Card --}}
                            <p class="section-label mt-2">{{ trans('admin.global.stat_number') }}</p>

                            <div class="grid grid-cols-3 gap-4 mb-6">
                                <x-input.text
                                    name="hero_stat_number[{{ $lc }}]"
                                    label="global.stat_number"
                                    :required="false"
                                    :value="$s('hero_stat_number')" />

                                <x-input.text
                                    name="hero_stat_label[{{ $lc }}]"
                                    label="global.stat_label"
                                    :required="false"
                                    :value="$s('hero_stat_label')" />

                                <x-input.text
                                    name="hero_stat_description[{{ $lc }}]"
                                    label="global.description"
                                    :required="false"
                                    :value="$s('hero_stat_description')" />
                            </div>

                            {{-- Vision --}}
                            <p class="section-label mt-2">{{ __('Vision') }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <x-input.text
                                    name="vision_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('vision_title')" />

                                <x-input.textarea
                                    name="vision_description[{{ $lc }}]"
                                    label="global.description"
                                    :required="false"
                                    :value="$s('vision_description')" />
                            </div>

                            {{-- Mission --}}
                            <p class="section-label mt-2">{{ __('Mission') }}</p>

                            <div class="grid grid-cols-3 gap-4 mb-6">
                                <x-input.text
                                    name="mission_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('mission_title')" />

                                <x-input.textarea
                                    name="mission_description[{{ $lc }}]"
                                    label="global.description"
                                    :required="false"
                                    :value="$s('mission_description')" />

                                <x-input.text
                                    name="mission_cta[{{ $lc }}]"
                                    label="global.learn_more"
                                    :required="false"
                                    :value="$s('mission_cta')" />
                            </div>

                            {{-- Leadership --}}
                            <p class="section-label mt-2">{{ trans('admin.models.members') }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <x-input.text
                                    name="leadership_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('leadership_title')" />

                                <x-input.text
                                    name="leadership_subtitle[{{ $lc }}]"
                                    label="global.sub_title"
                                    :required="false"
                                    :value="$s('leadership_subtitle')" />
                            </div>

                            {{-- CTA --}}
                            <p class="section-label mt-2">{{ trans('admin.websites.cta') }}</p>

                            <div class="grid grid-cols-3 gap-4">
                                <x-input.text
                                    name="cta_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('cta_title')" />

                                <x-input.text
                                    name="cta_btn_primary[{{ $lc }}]"
                                    label="global.btn_primary"
                                    :required="false"
                                    :value="$s('cta_btn_primary')" />

                                <x-input.text
                                    name="cta_btn_secondary[{{ $lc }}]"
                                    label="global.btn_secondary"
                                    :required="false"
                                    :value="$s('cta_btn_secondary')" />
                            </div>

                        </div>

                    @endforeach

                    {{-- ===== Hero Image (shared) ===== --}}
                    <div class="mt-8 pt-6 border-t border-border">
                        <p class="section-label mb-4">{{ trans('admin.global.image') }}</p>
                        <x-input.image name="hero_image" label="global.image" value="setting('about_page')->getValue('hero_image')" />
                    </div>

                </div>

                <x-input.checkbox />

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

    <x-slot name="styles">
        <style>
            .section-label {
                @apply text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 block;
            }
        </style>
    </x-slot>

</x-dashboard.admin.layout.app>
