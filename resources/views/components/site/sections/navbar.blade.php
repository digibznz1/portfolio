<nav class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl shadow-sm" x-data="{ open: false }">

    <div class="flex justify-between items-center w-full px-8 py-4 max-w-8xl mx-auto">

        {{-- Brand --}}
        <a class="text-2xl font-black tracking-tighter text-primary" href="{{ route('home') }}">
            @setting('general', 'name')
        </a>

        {{-- Desktop Menu --}}
        <div class="hidden md:flex gap-6 items-center">
            @foreach (\App\Models\Menu::header()->get() as $menu)
                <a class="text-sm font-bold uppercase tracking-wider text-on-surface-variant/80 hover:text-primary transition-colors"
                   href="{{ $menu->link }}">{{ $menu->name }}</a>
            @endforeach
        </div>

        {{-- Right: lang + CTA + hamburger --}}
        <div class="flex items-center gap-4">

            <a href="{{ route('changeLanguage', app()->getLocale() === 'en' ? 'ar' : 'en') }}"
               class="text-on-surface-variant text-sm font-bold uppercase tracking-wider hover:text-primary transition-all">
                {{ app()->getLocale() === 'ar' ? trans('site.en') : trans('site.ar') }}
            </a>

            <a href="{{ route('contact.index') }}"
               class="hidden md:inline-flex signature-gradient text-white px-6 py-2.5 rounded-xl font-bold text-sm tracking-wide shadow-lg shadow-primary/20 active:scale-95 transition-transform">
                {{ trans('site.contact_nav') }}
            </a>

            {{-- Hamburger (mobile only) --}}
            <button type="button" class="md:hidden p-2 rounded-lg hover:bg-surface-container-high transition-colors"
                    @click="open = !open" aria-label="Menu">
                <span class="material-symbols-outlined text-primary" x-text="open ? 'close' : 'menu'">menu</span>
            </button>

        </div>

    </div>

    {{-- Mobile Drawer --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-white/95 backdrop-blur-xl border-t border-outline-variant/10 px-8 pb-6 pt-4 space-y-4"
         x-cloak>

        @foreach (\App\Models\Menu::header()->get() as $menu)
            <a class="block text-sm font-bold uppercase tracking-wider text-on-surface-variant hover:text-primary transition-colors py-2 border-b border-outline-variant/10"
               href="{{ $menu->link }}"
               @click="open = false">
                {{ $menu->name }}
            </a>
        @endforeach

        <a href="{{ route('contact.index') }}"
           class="block w-full text-center signature-gradient text-white px-6 py-3 rounded-xl font-bold text-sm tracking-wide shadow-lg shadow-primary/20 mt-4">
            {{ trans('site.contact_nav') }}
        </a>

    </div>

</nav>
