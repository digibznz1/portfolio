<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.services') . ' - ' . trans('admin.settings.general') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.services') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.services.setting.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="p-6">

                    {{-- ===== Language Tabs ===== --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button"
                                    class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}"
                                    data-kt-tab-toggle="#services_tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}"
                                     class="w-5 h-5 rounded-full object-cover"
                                     onerror="this.style.display='none'"
                                     alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    {{-- ===== Tab Content ===== --}}
                    @foreach (getLanguages() as $language)

                        @php
                            $isFirst = $loop->first;
                            $lc      = $language->code;
                            $s       = fn(string $key) => setting('services_page', $lc)->getValue($key) ?? '';
                        @endphp

                        <div id="services_tab_{{ $lc }}" class="{{ $isFirst ? '' : 'hidden' }}">

                            {{-- Hero --}}
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 block">{{ trans('admin.websites.hero') }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <x-input.text
                                    name="badge[{{ $lc }}]"
                                    label="global.badge"
                                    :required="false"
                                    :value="$s('badge')" />

                                <x-input.text
                                    name="title[{{ $lc }}]"
                                    label="global.title"
                                    :required="$isFirst"
                                    :value="$s('title')" />
                            </div>

                            <div class="mb-6">
                                <x-input.textarea
                                    name="description[{{ $lc }}]"
                                    label="global.description"
                                    :required="false"
                                    :value="$s('description')" />
                            </div>

                            {{-- Grid Section --}}
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 mt-4 block">{{ trans('admin.models.services') }}</p>

                            <div class="mb-6">
                                <x-input.text
                                    name="section_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('section_title')" />
                            </div>

                            {{-- CTA --}}
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 mt-4 block">{{ trans('admin.websites.cta') }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <x-input.text
                                    name="cta_title[{{ $lc }}]"
                                    label="global.title"
                                    :required="false"
                                    :value="$s('cta_title')" />

                                <x-input.textarea
                                    name="cta_description[{{ $lc }}]"
                                    label="global.description"
                                    :required="false"
                                    :value="$s('cta_description')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-2">
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

                    {{-- Image (shared) --}}
                    <div class="mt-8 pt-6 border-t border-border">
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4 block">{{ trans('admin.global.image') }}</p>
                        <x-input.image
                            name="image"
                            label="global.image"
                            value="{{ setting('services_page')->getValue('image') }}" />
                    </div>

                </div>

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
