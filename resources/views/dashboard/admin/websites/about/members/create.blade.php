<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.members') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.members') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card kt-card-grid min-w-full kt-card-accent mb-5">

            <form method="post" action="{{ route('dashboard.admin.websites.about.members.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="p-4 border rounded-xl bg-gray-50 flex justify-center items-center mt-5">

					<div class="w-full max-w-[220px] flex justify-center">
						<x-input.image />
					</div>

				</div>

                <div class="p-6">

                    {{-- Language Tabs --}}
                    <div class="kt-tabs kt-tabs-line mb-6" data-kt-tabs="true">
                        
                        @foreach (getLanguages() as $language)
                            
                            <button type="button" class="kt-tab-toggle py-3 flex items-center gap-2 {{ $loop->first ? 'active' : '' }}"  data-kt-tab-toggle="#members_tab_{{ $language->code }}">
                                
                                <img src="{{ asset('admin_assets/media/flags/' . $language->flag) }}" class="w-5 h-5 rounded-full object-cover" onerror="this.style.display='none'" alt="{{ $language->name }}" />
                                
                                {{ $language->name }}

                            </button>

                        @endforeach

                    </div>

                    @foreach (getLanguages() as $language)

                        <div id="members_tab_{{ $language->code }}" class="{{ $loop->first ? '' : 'hidden' }}">
                    
                            <div class="grid grid-cols-2 gap-4 mb-4">
                            
                                <x-input.text name="name[{{ $language->code }}]" label="global.name" :required="$loop->first" />
                        
                                <x-input.text name="position[{{ $language->code }}]" label="global.type" :required="$loop->first" />
                            
                            </div>

                            <x-input.textarea name="bio[{{ $language->code }}]" label="global.about" :required="false" />

                        </div>

                    @endforeach
    
                </div>
                
                <x-input.checkbox />

                <x-dashboard.admin.button.save />

            </form>

        </div>

    </div>

</x-dashboard.admin.layout.app>
