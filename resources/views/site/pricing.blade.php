<x-site.layout.app>

    <x-site.sections.navbar />

    <main class="pt-32 pb-24">

        {{-- ===== Hero ===== --}}
        <header class="max-w-7xl mx-auto px-8 mb-20 text-center relative">

            <span class="inline-block px-4 py-1.5 mb-6 rounded-full bg-surface-container-high text-on-surface-variant text-xs font-bold uppercase tracking-[0.2em]">
                @setting('pricing_page', 'hero_badge')
            </span>

            <h1 class="font-montserrat text-6xl md:text-7xl font-black text-primary tracking-tighter mb-6 leading-tight">
                @setting('pricing_page', 'hero_title')
            </h1>

            <p class="text-xl text-on-surface-variant max-w-2xl mx-auto font-light leading-relaxed">
                @setting('pricing_page', 'hero_description')
            </p>

        </header>

        {{-- ===== Pricing Cards ===== --}}
        @if ($packages->count())
            <section class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

                @foreach ($packages as $package)
                    <div class="md:col-span-4 bg-surface-container-lowest rounded-2xl p-10 border relative group transition-all duration-300 hover:-translate-y-1
                                {{ $package->is_featured ? 'border-2 border-secondary/20 scale-105 z-10 shadow-2xl shadow-primary/10' : 'border border-outline-variant/10' }}"
                         style="box-shadow: 0 20px 40px -10px rgba(93,49,140,0.08);">

                        {{-- Featured Badge --}}
                        @if ($package->is_featured)
                            <div class="absolute -top-4 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 vibrant-orange-accent text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest whitespace-nowrap">
                                {{ app()->isLocale('ar') ? 'الأكثر شعبية' : 'Most Popular' }}
                            </div>
                        @endif

                        {{-- Header --}}
                        <div class="mb-12">
                            <h3 class="font-montserrat text-2xl font-bold text-primary mb-2">{{ $package->name }}</h3>
                            <p class="text-on-surface-variant text-sm font-medium">{{ $package->subtitle }}</p>
                        </div>

                        {{-- Price --}}
                        <div class="mb-10 flex items-baseline gap-1">
                            @if ($package->price)
                                <span class="text-4xl font-black text-primary">{{ $package->price }}</span>
                                <span class="text-on-surface-variant text-sm">{{ $package->price_unit }}</span>
                            @else
                                <span class="text-2xl font-black text-primary">{{ $package->price_unit ?: 'Custom' }}</span>
                            @endif
                        </div>

                        {{-- Features --}}
                        @php
                            $features = $package->features ?? [];
                            $lang     = app()->getLocale();
                        @endphp
                        <ul class="space-y-5 mb-12">
                            @foreach ($features as $i => $feature)
                                <li class="flex items-start gap-4">
                                    <span class="material-symbols-outlined text-secondary text-xl shrink-0"
                                          style="{{ $i === 0 && $package->index > 1 ? 'font-variation-settings: \"FILL\" 1;' : '' }}">
                                        {{ $i === 0 && $package->index > 1 ? 'verified' : 'check_circle' }}
                                    </span>
                                    <span class="{{ $i === 0 && $package->index > 1 ? 'text-on-surface font-semibold' : 'text-on-surface-variant' }} text-sm">
                                        {{ is_array($feature) ? ($feature[$lang] ?? $feature['en'] ?? '') : $feature }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                        {{-- CTA Button --}}
                        <a href="{{ route('contact.index') }}"
                           class="block w-full py-4 rounded-xl font-montserrat text-sm font-bold uppercase tracking-widest text-center transition-all active:scale-95
                                  {{ $package->button_style === 'filled'
                                       ? 'vibrant-orange-accent text-white hover:opacity-90'
                                       : 'border-2 border-primary text-primary hover:bg-primary hover:text-white' }}">
                            {{ $package->button_text }}
                        </a>

                    </div>
                @endforeach

                {{-- ===== Custom Package Wide Card ===== --}}
                @php
                    $pricingRaw  = setting('pricing_page')->toArray();
                    $customChips = $pricingRaw['custom_chips']      ?? [];
                    $customItems = $pricingRaw['custom_plan_items'] ?? [];
                    $customImage = $pricingRaw['custom_image']      ?? null;
                    $clang       = app()->getLocale();
                @endphp
                <div class="md:col-span-12 mt-12 bg-surface-container-low rounded-2xl overflow-hidden relative min-h-[400px] flex items-center">

                    @if ($customImage)
                        <div class="absolute inset-0 z-0">
                            <img src="{{ asset('storage/' . $customImage) }}"
                                 class="w-full h-full object-cover opacity-10 mix-blend-multiply" alt="" />
                        </div>
                    @endif

                    <div class="relative z-10 w-full p-12 flex flex-col md:flex-row items-center justify-between gap-12">

                        {{-- Left --}}
                        <div class="max-w-xl">
                            <div class="text-secondary font-bold text-xs uppercase tracking-widest mb-4">
                                @setting('pricing_page', 'custom_badge')
                            </div>
                            <h2 class="font-montserrat text-5xl font-black text-primary tracking-tighter mb-6">
                                @setting('pricing_page', 'custom_title')
                            </h2>
                            <p class="text-lg text-on-surface-variant leading-relaxed mb-8">
                                @setting('pricing_page', 'custom_description')
                            </p>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($customChips as $chip)
                                    <span class="px-4 py-2 bg-white rounded-full text-xs font-bold text-primary border border-outline-variant/30">
                                        {{ is_array($chip) ? ($chip[$clang] ?? $chip['en'] ?? '') : $chip }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Right: Mini Form --}}
                        <div class="bg-white/80 backdrop-blur-xl p-8 rounded-2xl border border-white max-w-sm w-full"
                             style="box-shadow: 0 20px 40px -10px rgba(93,49,140,0.08);">
                            <h4 class="font-montserrat font-bold text-primary mb-6">
                                @setting('pricing_page', 'custom_plan_title')
                            </h4>
                            <div class="space-y-4 mb-8">
                                @foreach ($customItems as $item)
                                    <div class="flex justify-between items-center p-3 bg-surface rounded-lg">
                                        <span class="text-sm font-semibold">
                                            {{ is_array($item) ? ($item[$clang] ?? $item['en'] ?? '') : $item }}
                                        </span>
                                        <span class="material-symbols-outlined text-primary">add_circle</span>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('contact.index') }}"
                               class="block w-full py-4 vibrant-orange-accent text-white rounded-xl font-montserrat font-bold uppercase tracking-wider text-center active:scale-95 transition-transform">
                                @setting('pricing_page', 'custom_btn_text')
                            </a>
                        </div>

                    </div>
                </div>

            </section>
        @endif

        {{-- ===== Comparison Table ===== --}}
        @php
            $pricingRaw2        = setting('pricing_page')->toArray();
            $comparisonFeatures = $pricingRaw2['comparison_features'] ?? [];
            $clang              = app()->getLocale();
        @endphp
        @if (count($comparisonFeatures))
            <section class="max-w-5xl mx-auto px-8 mt-32">

                <h2 class="font-montserrat text-4xl font-black text-primary text-center mb-4">
                    @setting('pricing_page', 'comparison_title')
                </h2>

                {{-- Column Headers --}}
                <div class="grid grid-cols-12 px-6 mb-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant/60">
                    <div class="col-span-6"></div>
                    @foreach ($packages->take(3) as $pkg)
                        <div class="col-span-2 text-center">{{ $pkg->name }}</div>
                    @endforeach
                </div>

                <div class="space-y-4">
                    @foreach ($comparisonFeatures as $i => $row)
                        <div class="grid grid-cols-12 p-6 rounded-xl items-center {{ $i % 2 === 0 ? 'bg-surface-container-lowest' : 'bg-surface-container-low' }}">
                            <div class="col-span-6 font-bold text-primary text-sm">
                                {{ is_array($row['name'] ?? null) ? ($row['name'][$clang] ?? $row['name']['en'] ?? '') : ($row['name'] ?? '') }}
                            </div>
                            @foreach (['startup', 'growth', 'enterprise'] as $key)
                                <div class="col-span-2 text-center">
                                    @if (!empty($row[$key]))
                                        <span class="material-symbols-outlined text-primary font-bold">check</span>
                                    @else
                                        <span class="material-symbols-outlined text-on-surface-variant/40">remove</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

            </section>
        @endif

    </main>

    <x-site.sections.footer />

</x-site.layout.app>
