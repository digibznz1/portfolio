<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.packages') . ' - ' . trans('admin.settings.general') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.packages') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.packages.setting.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button"
                                    class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}"
                                    data-kt-tab-toggle="#pricing_tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}"
                                     class="w-5 h-5 rounded-full object-cover"
                                     onerror="this.style.display='none'"
                                     alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    @foreach (getLanguages() as $language)
                        @php
                            $isFirst = $loop->first;
                            $lc      = $language->code;
                            $s       = fn(string $key) => setting('pricing_page', $lc)->getValue($key) ?? '';
                        @endphp

                        <div id="pricing_tab_{{ $lc }}" class="{{ $isFirst ? '' : 'hidden' }}">

                            {{-- Hero --}}
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 block">{{ trans('admin.websites.hero') }}</p>

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

                            {{-- Custom Card --}}
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 mt-4 block">{{ __('Custom Package') }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <x-input.text
                                    name="custom_badge[{{ $lc }}]"
                                    label="global.badge"
                                    :required="false"
                                    :value="$s('custom_badge')" />

                                <x-input.text
                                    name="custom_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('custom_title')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <x-input.textarea
                                    name="custom_description[{{ $lc }}]"
                                    label="global.description"
                                    :required="false"
                                    :value="$s('custom_description')" />

                                <x-input.text
                                    name="custom_btn_text[{{ $lc }}]"
                                    label="global.btn_primary"
                                    :required="false"
                                    :value="$s('custom_btn_text')" />
                            </div>

                            <div class="mb-6">
                                <x-input.text
                                    name="custom_plan_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('custom_plan_title')" />
                            </div>

                            {{-- Comparison --}}
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 mt-4 block">{{ __('Comparison') }}</p>

                            <div class="mb-4">
                                <x-input.text
                                    name="comparison_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('comparison_title')" />
                            </div>

                        </div>

                    @endforeach

                    {{-- Custom Image --}}
                    <div class="mt-8 pt-6 border-t border-border">
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 block">{{ trans('admin.global.image') }}</p>
                        <x-input.image
                            name="custom_image"
                            label="global.image"
                            value="{{ setting('pricing_page')->toArray()['custom_image'] ?? null }}" />
                    </div>

                </div>

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
