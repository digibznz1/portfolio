<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.team') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.team') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.about.team.update', $team->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        @foreach (getLanguages() as $language)
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}"
                                    data-kt-tab-toggle="#team_tab_{{ $language->code }}">
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                                {{ $language->name }}
                            </button>
                        @endforeach
                    </div>

                    @foreach (getLanguages() as $language)
                        @php $lc = $language->code; @endphp
                        <div id="team_tab_{{ $lc }}" class="{{ $loop->first ? '' : 'hidden' }}">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <x-input.text name="name[{{ $lc }}]" label="global.name" :required="$loop->first"
                                    :value="$team->getTranslation('name', $lc)" />
                                <x-input.text name="position[{{ $lc }}]" label="admin.global.type" :required="$loop->first"
                                    :value="$team->getTranslation('position', $lc)" />
                            </div>
                            <x-input.textarea name="bio[{{ $lc }}]" label="global.about" :required="false"
                                :value="$team->getTranslation('bio', $lc)" />
                        </div>
                    @endforeach

                    {{-- Image + Status --}}
                    <div class="grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-border">
                        <x-input.image name="image" label="admin.global.image" :value="$team->image" />
                        <div class="flex items-end pb-2">
                            <x-input.checkbox :value="$team->status" />
                        </div>
                    </div>

                </div>

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
