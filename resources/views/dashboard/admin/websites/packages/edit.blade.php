<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.packages') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.packages') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.packages.update', $package->id) }}">
                @csrf
                @method('PUT')

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button"
                                    class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}"
                                    data-kt-tab-toggle="#pkg_tab_{{ $language->code }}">
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
                            $isFirst  = $loop->first;
                            $lc       = $language->code;
                            $features = $package->features ?? [];
                        @endphp

                        <div id="pkg_tab_{{ $lc }}" class="{{ $isFirst ? '' : 'hidden' }}">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <x-input.text
                                    name="name[{{ $lc }}]"
                                    label="global.name"
                                    :required="$isFirst"
                                    :value="$package->getTranslation('name', $lc)" />

                                <x-input.text
                                    name="subtitle[{{ $lc }}]"
                                    label="global.description"
                                    :required="false"
                                    :value="$package->getTranslation('subtitle', $lc)" />
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <x-input.text
                                    name="price_unit[{{ $lc }}]"
                                    label="global.price"
                                    :required="false"
                                    :value="$package->getTranslation('price_unit', $lc)" />

                                <x-input.text
                                    name="button_text[{{ $lc }}]"
                                    label="global.btn_primary"
                                    :required="false"
                                    :value="$package->getTranslation('button_text', $lc)" />
                            </div>

                            {{-- Features --}}
                            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 mt-2 block">
                                {{ trans('admin.websites.features') }}
                            </p>
                            <div id="features-{{ $lc }}" class="space-y-2 mb-3">
                                @foreach ($features as $i => $feature)
                                    <div class="flex gap-2">
                                        <input type="text"
                                               name="features[{{ $i }}][{{ $lc }}]"
                                               value="{{ is_array($feature) ? ($feature[$lc] ?? $feature['en'] ?? '') : $feature }}"
                                               placeholder="{{ trans('admin.websites.feature') }} {{ $i + 1 }}"
                                               class="kt-input flex-1" />
                                        @if ($i > 0)
                                            <button type="button" class="kt-btn kt-btn-xs kt-btn-destructive" onclick="this.parentElement.remove()">×</button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <button type="button"
                                    class="kt-btn kt-btn-xs kt-btn-outline"
                                    onclick="addFeature('{{ $lc }}', {{ count($features) }})">
                                + {{ trans('admin.global.add') }}
                            </button>
                        </div>
                    @endforeach

                    {{-- Shared fields --}}
                    <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-border">
                        <div>
                            <label class="kt-label">{{ trans('admin.global.price') }}</label>
                            <input type="text" name="price" value="{{ $package->price }}"
                                   class="kt-input w-full" placeholder="4,500" />
                        </div>
                        <div>
                            <label class="kt-label">{{ trans('admin.global.type') }}</label>
                            <select name="button_style" class="kt-input w-full">
                                <option value="outline" {{ $package->button_style === 'outline' ? 'selected' : '' }}>Outline</option>
                                <option value="filled"  {{ $package->button_style === 'filled'  ? 'selected' : '' }}>Filled</option>
                            </select>
                        </div>
                        <div class="flex items-end gap-4 pb-1">
                            <x-input.checkbox name="is_featured" label="admin.global.badge"  :value="$package->is_featured" />
                            <x-input.checkbox :value="$package->status" />
                        </div>
                    </div>

                </div>

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

    <x-slot name="scripts">
        <script>
            const featureCounts = {};

            function addFeature(lang, start) {
                featureCounts[lang] = featureCounts[lang] ?? start;
                featureCounts[lang]++;
                const idx = featureCounts[lang] - 1;
                const container = document.getElementById('features-' + lang);
                const div = document.createElement('div');
                div.className = 'flex gap-2';
                div.innerHTML = `<input type="text" name="features[${idx}][${lang}]"
                                        placeholder="{{ trans('admin.websites.feature') }} ${featureCounts[lang]}"
                                        class="kt-input flex-1" />
                                 <button type="button" class="kt-btn kt-btn-xs kt-btn-destructive" onclick="this.parentElement.remove()">×</button>`;
                container.appendChild(div);
            }
        </script>
    </x-slot>

</x-dashboard.admin.layout.app>
