<x-site.layout.app>

    <x-site.sections.navbar />

    <main class="pt-20 min-h-screen">

        {{-- ===== Hero ===== --}}
        <section class="relative signature-gradient py-32 px-8 overflow-hidden">

            {{-- Background blobs --}}
            <div class="absolute inset-0 opacity-15 pointer-events-none">
                <div class="absolute top-0 end-0 w-[800px] h-[800px] bg-secondary rounded-full blur-[120px] -me-96 -mt-96"></div>
                <div class="absolute bottom-0 start-0 w-[600px] h-[600px] bg-primary/50 rounded-full blur-[100px] -ms-48 -mb-48"></div>
            </div>

            <div class="max-w-7xl mx-auto relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                    {{-- Left: Text --}}
                    <div>
                        <span class="inline-block bg-secondary text-white text-[10px] font-bold uppercase tracking-[0.2em] px-3 py-1 rounded-full mb-6">
                            @setting('services_page', 'badge')
                        </span>

                        <h1 class="font-montserrat text-5xl md:text-7xl font-black text-white leading-[1.1] mb-8">
                            @setting('services_page', 'title')
                        </h1>

                        <p class="text-white/80 text-lg md:text-xl max-w-lg leading-relaxed mb-10">
                            @setting('services_page', 'description')
                        </p>

                        <a href="{{ route('contact.index') }}"
                           class="inline-flex items-center gap-2 bg-secondary text-white px-8 py-4 rounded-xl font-bold hover:bg-secondary/90 transition-all shadow-xl shadow-secondary/20">
                            {{ trans('site.contact_nav') }}
                            <span class="material-symbols-outlined text-sm">{{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_forward' }}</span>
                        </a>
                    </div>

                    {{-- Right: Image --}}
                    @if (setting('services_page')->image)
                        <div class="relative group">
                            <div class="absolute -inset-4 bg-secondary/20 rounded-[2.5rem] blur-2xl group-hover:bg-secondary/30 transition-all duration-700"></div>
                            <div class="relative rounded-[2rem] overflow-hidden p-1">
                                <img src="{{ asset('storage/' . setting('services_page')->image) }}"
                                     class="w-full h-[450px] object-cover rounded-[1.8rem]"
                                     alt="" />
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </section>

        {{-- ===== Services Grid ===== --}}
        @if ($services->count())
            <section class="py-32 px-8 bg-white">
                <div class="max-w-7xl mx-auto">

                    <div class="mb-20 text-start">
                        <h2 class="font-montserrat text-4xl font-extrabold text-primary mb-4">
                            @setting('services_page', 'section_title')
                        </h2>
                        <div class="h-1.5 w-24 bg-secondary rounded-full"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

                        @foreach ($services as $index => $service)

                            @if ($index === 0)
                                {{-- Large card --}}
                                <div class="md:col-span-8 group relative bg-surface-container-low rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 border border-outline-variant/10 min-h-[320px]">
                                    <div class="absolute top-0 end-0 w-1/2 h-full opacity-10 pointer-events-none">
                                        <span dir="ltr" class="material-symbols-outlined text-[20rem] text-primary leading-none"
                                              style="font-variation-settings: 'FILL' 1;">{{ $service->icon }}</span>
                                    </div>
                                    <div class="p-12 relative z-10 h-full flex flex-col justify-between">
                                        <div>
                                            <span dir="ltr" class="material-symbols-outlined text-4xl text-primary mb-6 block"
                                                  style="font-variation-settings: 'FILL' 1;">{{ $service->icon }}</span>
                                            <h3 class="font-montserrat text-3xl font-bold text-primary mb-6">{{ $service->name }}</h3>
                                            <p class="text-on-surface-variant text-lg max-w-md leading-relaxed">{{ $service->description }}</p>
                                        </div>
                                        <a href="{{ route('contact.index') }}"
                                           class="inline-flex items-center gap-2 text-primary font-bold mt-8 group/btn">
                                            {{ trans('site.services.learn_more') }}
                                            <span class="material-symbols-outlined transition-transform group-hover/btn:translate-x-1 rtl:group-hover/btn:-translate-x-1">
                                                {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_forward' }}
                                            </span>
                                        </a>
                                    </div>
                                </div>

                            @elseif ($index === 1)
                                {{-- Dark card --}}
                                <div class="md:col-span-4 group bg-primary rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 min-h-[320px]">
                                    <div class="p-12 h-full flex flex-col justify-between text-white">
                                        <div>
                                            <span dir="ltr" class="material-symbols-outlined text-4xl text-primary-fixed mb-6 block">{{ $service->icon }}</span>
                                            <h3 class="font-montserrat text-2xl font-bold mb-4">{{ $service->name }}</h3>
                                            <p class="text-white/70 text-base leading-relaxed">{{ $service->description }}</p>
                                        </div>
                                        <a href="{{ route('contact.index') }}"
                                           class="inline-flex items-center gap-2 text-secondary-fixed font-bold mt-8 group/btn">
                                            {{ trans('site.services.learn_more') }}
                                            <span class="material-symbols-outlined transition-transform group-hover/btn:translate-x-1 rtl:group-hover/btn:-translate-x-1">
                                                {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_forward' }}
                                            </span>
                                        </a>
                                    </div>
                                </div>

                            @elseif ($index === $services->count() - 1)
                                {{-- Last: Accent card --}}
                                <div class="md:col-span-4 group vibrant-orange-accent rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2">
                                    <div class="p-10 h-full flex flex-col text-white">
                                        <span dir="ltr" class="material-symbols-outlined text-4xl text-white mb-6">{{ $service->icon }}</span>
                                        <h3 class="font-montserrat text-2xl font-bold mb-4">{{ $service->name }}</h3>
                                        <p class="text-white/80 text-base leading-relaxed mb-auto pb-8">{{ $service->description }}</p>
                                        <a href="{{ route('contact.index') }}"
                                           class="inline-flex items-center gap-2 text-white font-bold mt-4 group/btn">
                                            {{ trans('site.services.learn_more') }}
                                            <span class="material-symbols-outlined transition-transform group-hover/btn:translate-x-1 rtl:group-hover/btn:-translate-x-1">
                                                {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_forward' }}
                                            </span>
                                        </a>
                                    </div>
                                </div>

                            @else
                                {{-- Standard card --}}
                                <div class="md:col-span-4 group bg-surface-container-low rounded-[2rem] overflow-hidden transition-all duration-500 hover:-translate-y-2 border border-outline-variant/10">
                                    <div class="p-10 h-full flex flex-col">
                                        <span dir="ltr" class="material-symbols-outlined text-4xl text-primary mb-6">{{ $service->icon }}</span>
                                        <h3 class="font-montserrat text-2xl font-bold text-primary mb-4">{{ $service->name }}</h3>
                                        <p class="text-on-surface-variant text-base leading-relaxed mb-auto pb-8">{{ $service->description }}</p>
                                        <a href="{{ route('contact.index') }}"
                                           class="inline-flex items-center gap-2 text-primary font-bold mt-4 group/btn">
                                            {{ trans('site.services.learn_more') }}
                                            <span class="material-symbols-outlined transition-transform group-hover/btn:translate-x-1 rtl:group-hover/btn:-translate-x-1">
                                                {{ app()->isLocale('ar') ? 'arrow_back' : 'arrow_forward' }}
                                            </span>
                                        </a>
                                    </div>
                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>
            </section>
        @endif

        {{-- ===== CTA ===== --}}
        <section class="py-32 px-8 bg-surface-container-low">
            <div class="max-w-5xl mx-auto rounded-[3rem] signature-gradient p-16 text-center relative overflow-hidden shadow-2xl shadow-primary/20">
                <div class="absolute top-0 end-0 w-64 h-64 bg-secondary/20 rounded-full blur-3xl -me-16 -mt-16"></div>
                <div class="absolute bottom-0 start-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -ms-16 -mb-16"></div>
                <div class="relative z-10">
                    <h2 class="font-montserrat text-4xl md:text-5xl font-black text-white mb-8">
                        @setting('services_page', 'cta_title')
                    </h2>
                    <p class="text-white/70 text-lg mb-12 max-w-2xl mx-auto">
                        @setting('services_page', 'cta_description')
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact.index') }}"
                           class="bg-secondary hover:bg-secondary/90 text-white px-10 py-4 rounded-xl font-bold transition-all shadow-xl shadow-secondary/20">
                            @setting('services_page', 'cta_btn_primary')
                        </a>
                        <a href="{{ route('home') }}"
                           class="glass-card text-white px-10 py-4 rounded-xl font-bold border border-white/10 hover:bg-white/10 transition-all">
                            @setting('services_page', 'cta_btn_secondary')
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <x-site.sections.footer />

</x-site.layout.app>
