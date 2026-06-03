<x-site.layout.app>

    <x-site.sections.navbar />

    <main class="pt-24">

        {{-- ===== Hero Section ===== --}}
        <section class="relative min-h-[820px] flex items-center px-8 md:px-16 overflow-hidden bg-white">

            {{-- Background Image --}}
            <div class="absolute inset-0 z-0">
                @php $heroImg = setting('about_page')->getValue('hero_image'); @endphp
                @if ($heroImg)
                    <img src="{{ asset('storage/' . $heroImg) }}"
                         class="w-full h-full object-cover opacity-10 grayscale brightness-110" alt="" />
                @endif
                <div class="absolute inset-0 bg-gradient-to-r from-white via-white/80 to-transparent"></div>
            </div>

            <div class="relative z-10 max-w-4xl">
                <span class="inline-block py-1 px-4 rounded-full bg-secondary/10 text-secondary font-bold text-xs tracking-widest uppercase mb-6">
                    @setting('about_page', 'hero_badge')
                </span>
                <h1 class="text-6xl md:text-8xl font-black font-montserrat text-primary leading-[1.1] mb-8">
                    @setting('about_page', 'hero_title')
                </h1>
                <p class="text-xl md:text-2xl text-on-surface-variant max-w-2xl leading-relaxed">
                    @setting('about_page', 'hero_description')
                </p>
            </div>

            {{-- Stat Card --}}
            <div class="absolute end-0 bottom-0 md:end-16 md:bottom-24 z-20">
                <div class="glass-card p-12 rounded-[2.5rem] shadow-2xl max-w-sm border border-primary/10">
                    <div class="text-8xl font-black text-secondary mb-2 leading-none">
                        @setting('about_page', 'hero_stat_number')
                    </div>
                    <div class="text-primary font-bold text-xl mb-4">
                        @setting('about_page', 'hero_stat_label')
                    </div>
                    <p class="text-on-surface-variant text-sm">
                        @setting('about_page', 'hero_stat_description')
                    </p>
                </div>
            </div>

        </section>

        {{-- ===== Vision & Mission ===== --}}
        <section class="py-32 px-8 md:px-16 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">

                {{-- Vision --}}
                <div class="md:col-span-7 bg-primary text-on-primary p-12 md:p-20 rounded-[3rem] signature-gradient flex flex-col justify-center shadow-2xl relative overflow-hidden">
                    <span class="material-symbols-outlined absolute -top-8 -end-8 text-[12rem] opacity-10"
                          style="font-variation-settings: 'FILL' 1;">visibility</span>
                    <h2 class="text-4xl md:text-5xl font-black font-montserrat mb-8">
                        @setting('about_page', 'vision_title')
                    </h2>
                    <p class="text-xl md:text-2xl leading-relaxed font-light opacity-90">
                        @setting('about_page', 'vision_description')
                    </p>
                    <div class="mt-12 h-1 w-24 bg-secondary rounded-full"></div>
                </div>

                {{-- Mission --}}
                <div class="md:col-span-5 bg-surface-container-low p-12 rounded-[3rem] shadow-xl flex flex-col justify-between border border-outline-variant/10">
                    <div>
                        <div class="w-16 h-16 rounded-2xl bg-secondary/10 flex items-center justify-center text-secondary mb-8">
                            <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
                        </div>
                        <h2 class="text-3xl font-bold font-montserrat text-primary mb-6">
                            @setting('about_page', 'mission_title')
                        </h2>
                        <p class="text-on-surface-variant leading-relaxed text-lg">
                            @setting('about_page', 'mission_description')
                        </p>
                    </div>
                    <div class="pt-8 flex items-center gap-4 text-primary font-bold group cursor-pointer">
                        <span class="group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform">
                            @setting('about_page', 'mission_cta')
                        </span>
                        <span class="material-symbols-outlined group-hover:translate-x-2 rtl:group-hover:-translate-x-2 transition-transform">
                            {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_forward' }}
                        </span>
                    </div>
                </div>

            </div>
        </section>

        {{-- ===== Leadership ===== --}}
        @if ($members->count())
            <section class="py-32 bg-surface-container-low">
                <div class="max-w-7xl mx-auto px-8 md:px-16">

                    <div class="mb-20">
                        <h2 class="text-5xl font-black font-montserrat text-primary mb-6">
                            @setting('about_page', 'leadership_title')
                        </h2>
                        <p class="text-xl text-on-surface-variant max-w-2xl">
                            @setting('about_page', 'leadership_subtitle')
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        @foreach ($members as $member)
                            <div class="group relative overflow-hidden rounded-[2.5rem] bg-white h-[500px] shadow-lg">

                                @if ($member->image)
                                    <img src="{{ asset('storage/' . $member->image) }}"
                                         class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700"
                                         alt="{{ $member->name }}" />
                                @else
                                    <div class="w-full h-full bg-surface-container-highest flex items-center justify-center">
                                        <span class="material-symbols-outlined text-8xl text-outline-variant">person</span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-primary/95 via-primary/30 to-transparent flex flex-col justify-end p-12">
                                    <h3 class="text-3xl font-bold text-white font-montserrat">{{ $member->name }}</h3>
                                    <p class="text-secondary font-semibold tracking-widest uppercase text-sm mb-4">{{ $member->position }}</p>
                                    @if ($member->bio)
                                        <p class="text-white/80 max-w-sm transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                                            {{ $member->bio }}
                                        </p>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

        {{-- ===== CTA ===== --}}
        <section class="py-40 px-8 bg-white">
            <div class="max-w-5xl mx-auto glass-card rounded-[4rem] p-16 md:p-24 text-center shadow-2xl relative overflow-hidden border border-primary/5">
                <div class="absolute top-0 end-0 w-64 h-64 bg-secondary/10 rounded-full blur-3xl -me-32 -mt-32"></div>
                <div class="absolute bottom-0 start-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -ms-32 -mb-32"></div>
                <h2 class="text-4xl md:text-6xl font-black font-montserrat text-primary mb-12 relative z-10">
                    @setting('about_page', 'cta_title')
                </h2>
                <div class="flex flex-col md:flex-row gap-6 justify-center items-center relative z-10">
                    <a href="{{ route('contact.index') }}"
                       class="signature-gradient text-white px-12 py-5 rounded-2xl font-bold text-lg tracking-wide transition-transform active:scale-95 shadow-xl shadow-primary/30">
                        @setting('about_page', 'cta_btn_primary')
                    </a>
                    <a href="{{ route('home') }}"
                       class="px-12 py-5 rounded-2xl font-bold text-lg text-primary border border-primary/20 hover:bg-surface-container-high transition-colors">
                        @setting('about_page', 'cta_btn_secondary')
                    </a>
                </div>
            </div>
        </section>

    </main>

    <x-site.sections.footer />

</x-site.layout.app>
