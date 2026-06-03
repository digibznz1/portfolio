@php
    $services = \App\Models\Service::all();
    $total    = $services->count();
@endphp

<section class="py-24 px-8 max-w-7xl mx-auto">

    <div class="text-center mb-16">
        <h2 class="text-primary font-montserrat font-black text-4xl md:text-5xl mb-6">
            {{ trans('site.services.title') }}
        </h2>
        <p class="text-on-surface-variant text-lg max-w-2xl mx-auto">
            {{ trans('site.services.subtitle') }}
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-12 gap-6 auto-rows-[280px]">

        @foreach ($services as $index => $service)

            @if ($index === 0)
                {{-- First card: Large tall --}}
                <div class="md:col-span-3 lg:col-span-4 row-span-1 glass-card p-8 rounded-[2.5rem] border border-white/60 shadow-xl flex flex-col justify-center group hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">

                    {{-- Decorative blobs --}}
                    <div class="absolute -top-10 -end-10 w-40 h-40 vibrant-orange-accent opacity-10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="absolute -bottom-8 -start-8 w-32 h-32 bg-primary/10 rounded-full blur-2xl"></div>

                    {{-- Large watermark icon --}}
                    <span dir="ltr" class="material-symbols-outlined absolute bottom-16 end-4 text-[8rem] text-secondary/5 select-none pointer-events-none"
                          style="font-variation-settings: 'FILL' 1;">{{ $service->icon }}</span>

                    <div class="relative z-10">
                        <div class="vibrant-orange-accent w-16 h-16 rounded-2xl flex items-center justify-center mb-8 shadow-lg shadow-secondary/20">
                            <span dir="ltr" class="material-symbols-outlined text-white text-3xl">{{ $service->icon }}</span>
                        </div>
                        <h3 class="text-primary font-black text-2xl mb-4 leading-tight">{{ $service->name }}</h3>
                        <p class="text-on-surface-variant text-base leading-relaxed">{{ $service->description }}</p>
                    </div>

                    {{--<div class="relative z-10 flex justify-between items-center mt-6">
                        <span class="text-secondary font-bold text-xs uppercase tracking-widest">{{ trans('site.services.learn_more') }}</span>
                        <span class="material-symbols-outlined text-secondary group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform">{{ app()->isLocale('ar') ? 'arrow_left_alt' : 'arrow_right_alt' }}</span>
                    </div>--}}

                </div>

            @elseif ($index === 1)
                {{-- Second card: Wide horizontal --}}
                <div class="md:col-span-3 lg:col-span-8 row-span-1 glass-card p-8 rounded-[2.5rem] border border-white/60 shadow-xl flex items-center gap-8 group hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                    <div class="vibrant-orange-accent w-20 h-20 shrink-0 rounded-3xl flex items-center justify-center shadow-xl shadow-secondary/20">
                        <span dir="ltr" class="material-symbols-outlined text-white text-4xl">{{ $service->icon }}</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-primary font-black text-2xl mb-2">{{ $service->name }}</h3>
                        <p class="text-on-surface-variant text-base line-clamp-2">{{ $service->description }}</p>
                    </div>
                    <span dir="ltr" class="material-symbols-outlined text-secondary text-3xl group-hover:rotate-45 transition-transform">north_east</span>
                </div>

            @elseif ($index === $total - 1)
                {{-- Last card: Wide dark --}}
                <div class="md:col-span-6 lg:col-span-8 row-span-1 bg-primary p-8 rounded-[2.5rem] text-white flex items-center justify-between group hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-1/2 h-full bg-white/10 skew-x-12 translate-x-1/4"></div>
                    <div class="relative z-10 max-w-md">
                        <div class="bg-white/10 w-14 h-14 rounded-xl flex items-center justify-center mb-4 backdrop-blur-md">
                            <span dir="ltr" class="material-symbols-outlined text-white text-3xl">{{ $service->icon }}</span>
                        </div>
                        <h3 class="font-black text-2xl mb-2 text-white">{{ $service->name }}</h3>
                        <p class="text-white/70 text-base">{{ $service->description }}</p>
                    </div>
                    <button class="relative z-10 bg-white text-primary px-8 py-3 rounded-xl font-bold hover:bg-secondary hover:text-white transition-all active:scale-95">
                        {{ trans('site.services.consult_now') }}
                    </button>
                </div>

            @elseif ($index % 2 === 0)
                {{-- Even middle cards: small with border icon --}}
                <div class="md:col-span-3 lg:col-span-4 row-span-1 glass-card p-8 rounded-[2.5rem] border border-white/60 shadow-xl flex flex-col justify-center group hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl border-2 border-secondary flex items-center justify-center">
                            <span dir="ltr" class="material-symbols-outlined text-secondary text-2xl">{{ $service->icon }}</span>
                        </div>
                        <h3 class="text-primary font-black text-xl">{{ $service->name }}</h3>
                    </div>
                    <p class="text-on-surface-variant text-sm">{{ $service->description }}</p>
                </div>

            @else
                {{-- Odd middle cards: small with filled orange icon --}}
                <div class="md:col-span-3 lg:col-span-4 row-span-1 glass-card p-8 rounded-[2.5rem] border border-white/60 shadow-xl flex flex-col justify-center group hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl vibrant-orange-accent flex items-center justify-center shadow-lg shadow-secondary/20">
                            <span dir="ltr" class="material-symbols-outlined text-white text-2xl">{{ $service->icon }}</span>
                        </div>
                        <h3 class="text-primary font-black text-xl">{{ $service->name }}</h3>
                    </div>
                    <p class="text-on-surface-variant text-sm">{{ $service->description }}</p>
                </div>

            @endif

        @endforeach

    </div>

</section>
