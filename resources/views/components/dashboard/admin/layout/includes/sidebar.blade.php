<!-- Sidebar -->
<div class="kt-sidebar bg-background border-e border-e-border fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0 [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]" data-kt-drawer="true" data-kt-drawer-class="kt-drawer kt-drawer-start top-0 bottom-0" id="sidebar">
    <div class="kt-sidebar-header hidden lg:flex items-center relative justify-between px-3 lg:px-6 shrink-0" id="sidebar_header">
        <a class="dark:hidden" href="html/demo1.html">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('admin_assets/media/app/default-logo.svg') }}" />
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('admin_assets/media/app/mini-logo.svg') }}" />
        </a>
        <a class="hidden dark:block" href="html/demo1.html">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('admin_assets/media/app/default-logo-dark.svg') }}" />
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('admin_assets/media/app/mini-logo.svg') }}" />
        </a>
        <button class="kt-btn kt-btn-outline kt-btn-icon size-[30px] absolute start-full top-2/4 -translate-x-2/4 -translate-y-2/4 rtl:translate-x-2/4" data-kt-toggle="body" data-kt-toggle-class="kt-sidebar-collapse" id="sidebar_toggle">
            <i class="ki-filled ki-black-left-line kt-toggle-active:rotate-180 transition-all duration-300 rtl:translate rtl:rotate-180 rtl:kt-toggle-active:rotate-0"></i>
        </button>
    </div>
    <div class="kt-sidebar-content flex grow shrink-0 py-5 pe-2" id="sidebar_content">

        <div class="kt-scrollable-y-hover grow shrink-0 flex ps-2 lg:ps-5 pe-1 lg:pe-3" data-kt-scrollable="true" data-kt-scrollable-dependencies="#sidebar_header" data-kt-scrollable-height="auto" data-kt-scrollable-offset="0px" data-kt-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
            <!-- Sidebar Menu -->
            <div class="kt-menu flex flex-col grow gap-1" data-kt-menu="true" data-kt-menu-accordion-expand-all="false" id="sidebar_menu">

                <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.global.dashboard" active="dashboard.admin.index" route="dashboard.admin.index" permission="read-admins"/>

                @if(permissionAdmin('read-admins') || permissionAdmin('read-roles') || permissionAdmin('read-languages'))
                    {{-- managements --}}
                    <x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.models.managements" svg="websites" show="dashboard.admin.managements.*">

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.admins" active="dashboard.admin.managements.admins.*" route="dashboard.admin.managements.admins.index" permission="read-admins"/>

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.roles" active="dashboard.admin.managements.roles.*" route="dashboard.admin.managements.roles.index" permission="read-roles"/>
                        
                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.languages" active="dashboard.admin.managements.languages.*" route="dashboard.admin.managements.languages.index" permission="languages"/>

                    </x-dashboard.admin.layout.includes.sidebar.menu-group-item>

                @endif

                @if(permissionAdmin('read-banners') || permissionAdmin('read-clients') || permissionAdmin('read-blogs')
                    || permissionAdmin('read-galleries')
                    || permissionAdmin('read-abouts')
                    || permissionAdmin('read-branches')
                    || permissionAdmin('read-stats')
                    )
                        {{-- websites --}}

                        <x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.models.websites" svg="websites" show="dashboard.admin.websites.*">
                                
                            {{--<x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.websites.banner" active="dashboard.admin.websites.banners.*" route="dashboard.admin.websites.banners.index" permission="read-banners"/>--}}

                            {{--<x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.clients" active="dashboard.admin.websites.clients.*" route="dashboard.admin.websites.clients.index" permission="read-clients"/>--}}
                            
                            {{--<x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.blogs" active="dashboard.admin.websites.blogs.*" route="dashboard.admin.websites.blogs.index" permission="read-blogs"/>--}}

                            {{--<x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.abouts" active="dashboard.admin.websites.abouts.*" route="dashboard.admin.websites.abouts.index" permission="read-abouts"/>--}}

                            {{--<x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.branches" active="dashboard.admin.websites.branches.*" route="dashboard.admin.websites.branches.index" permission="read-branches"/>--}}
                            
                            {{--<x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.stats" active="dashboard.admin.websites.stats.*" route="dashboard.admin.websites.stats.index" permission="read-stats"/>--}}
                            
                            {{--<x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.testimonials" active="dashboard.admin.websites.testimonials.*" route="dashboard.admin.websites.testimonials.index" permission="read-testimonials"/>--}}
                            
                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.websites.hero" active="dashboard.admin.websites.hero.*" route="dashboard.admin.websites.hero.index" permission="read-hero"/>
                            
                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.websites.about" active="dashboard.admin.websites.about.*" route="dashboard.admin.websites.about.index" permission="read-about"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.services" active="dashboard.admin.websites.services.*" route="dashboard.admin.websites.services.index" permission="read-services"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.websites.why_us" active="dashboard.admin.websites.why_us.*" route="dashboard.admin.websites.why_us.index" permission="read-why_us"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.websites.cta" active="dashboard.admin.websites.cta.*" route="dashboard.admin.websites.cta.index" permission="read-cta"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.websites.about" svg="websites" show="dashboard.admin.websites.about.*">

                                <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.websites.about_page" active="dashboard.admin.websites.about.setting.*" route="dashboard.admin.websites.about-page.index" permission="read-about-page"/>

                                <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.members" active="dashboard.admin.websites.about.members.*" route="dashboard.admin.websites.about.members.index" permission="read-members"/>

                            </x-dashboard.admin.layout.includes.sidebar.menu-group-item>

                            <x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.models.contacts" svg="websites" show="dashboard.admin.websites.contacts.*">
    
                                <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.contacts" active="dashboard.admin.websites.contacts.*" route="dashboard.admin.websites.contacts.index" permission="read-contacts"/>
                                
                                <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.appointments" active="dashboard.admin.websites.contacts.appointments.*" route="dashboard.admin.websites.contacts.appointments.index" permission="read-appointments"/>
                                
                            </x-dashboard.admin.layout.includes.sidebar.menu-group-item>

                        </x-dashboard.admin.layout.includes.sidebar.menu-group-item>

                    @endif

                    @if(permissionAdmin('read-settings'))
                        {{-- settings --}}

                        <x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.models.settings" svg="settings" show="dashboard.admin.settings.*">

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.general" active="dashboard.admin.settings.general.*" route="dashboard.admin.settings.general.index" permission="read-settings"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.menus" active="dashboard.admin.settings.menus.*" route="dashboard.admin.settings.menus.index" permission="read-menus"/>
                                
                            {{--<x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.meta" active="dashboard.admin.settings.meta.*" route="dashboard.admin.settings.meta.index" permission="read-settings"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.menus" active="dashboard.admin.settings.menus.*" route="dashboard.admin.settings.menus.index" permission="read-menus"/>
                            
                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.pages" active="dashboard.admin.settings.pages.*" route="dashboard.admin.settings.pages.index" permission="read-pages"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.category_banner" active="dashboard.admin.settings.category_banner.*" route="dashboard.admin.settings.category_banner.index" permission="read-settings"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.links" active="dashboard.admin.settings.links.*" route="dashboard.admin.settings.links.index" permission="read-links"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.websit" active="dashboard.admin.settings.websit.*" route="dashboard.admin.settings.websit.index" permission="read-settings"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.videos" active="dashboard.admin.settings.videos.*" route="dashboard.admin.settings.videos.index" permission="read-settings"/>
                            
                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.visions" active="dashboard.admin.settings.visions.*" route="dashboard.admin.settings.visions.index" permission="read-settings"/>

                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.contact" active="dashboard.admin.settings.contact.*" route="dashboard.admin.settings.contact.index" permission="read-settings"/>
                            
                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.partners" active="dashboard.admin.settings.partner.*" route="dashboard.admin.settings.partner.index" permission="read-settings"/>
                            
                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.titles" active="dashboard.admin.settings.titles.*" route="dashboard.admin.settings.titles.index" permission="read-settings"/>
                            
                            <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.settings.titles_pages" active="dashboard.admin.settings.titles_pages.*" route="dashboard.admin.settings.titles_pages.index" permission="read-settings"/>--}}

                        </x-dashboard.admin.layout.includes.sidebar.menu-group-item>

                    @endif

                @auth('admin')

                    {{-- auth --}}
                    <x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.auth.profile" svg="profiles" show="dashboard.admin.auth.accounts.*">
                            
                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.auth.edit_profile" active="dashboard.admin.auth.accounts.profile.*" route="dashboard.admin.auth.accounts.profile.edit" permission="read-home"/>

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.auth.edit_password" active="dashboard.admin.auth.accounts.password.*" route="dashboard.admin.auth.accounts.password.edit" permission="read-home"/>

                    </x-dashboard.admin.layout.includes.sidebar.menu-group-item>
                
                @endauth

            </div>
            <!-- End of Sidebar Menu -->
        </div>

    </div>
    
</div>
<!-- End of Sidebar -->