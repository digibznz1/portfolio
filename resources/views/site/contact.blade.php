<x-site.layout.app>

    <x-site.sections.navbar />

    <main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">

        {{-- Hero --}}
        <header class="mb-20 flex flex-col md:flex-row justify-between items-end gap-8">
            <div class="max-w-2xl">
                <span class="text-secondary font-bold tracking-widest text-xs uppercase mb-4 block">
                    @setting('contact', 'badge')
                </span>
                <h1 class="text-primary font-montserrat font-black text-5xl md:text-7xl leading-tight tracking-tighter mb-6">
                    @setting('contact', 'title')
                </h1>
                <p class="text-on-surface-variant text-lg leading-relaxed max-w-xl">
                    @setting('contact', 'description')
                </p>
            </div>
            <div class="flex items-center gap-4 pb-4 shrink-0">
                <div class="h-px w-12 bg-outline-variant"></div>
                <span class="text-on-surface-variant text-sm font-medium">
                    @setting('contact', 'headquarters')
                </span>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- Left: Calendar + Map --}}
            <section class="lg:col-span-5">
                <livewire:site.appointment-calendar />
            </section>

            {{-- Right: Contact Forms --}}
            <section class="lg:col-span-7">
                <livewire:site.contact-form />
            </section>

        </div>

    </main>

    <x-site.sections.footer />

</x-site.layout.app>
