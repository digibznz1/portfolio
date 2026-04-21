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

                    </x-dashboard.admin.layout.includes.sidebar.menu-group-item>

                @endif

                @if(permissionAdmin('read-organizations') || permissionAdmin('read-organization_types'))
                    {{-- organizations --}}
                    {{--<x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.models.institutions" svg="websites" show="dashboard.admin.institutions.*">

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.organizations" active="dashboard.admin.institutions.organizations.*" route="dashboard.admin.institutions.organizations.index" permission="read-organizations"/>

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.organization_types" active="dashboard.admin.institutions.organization_types.*" route="dashboard.admin.institutions.organization_types.index" permission="read-organization_types"/>

                    </x-dashboard.admin.layout.includes.sidebar.menu-group-item>--}}

                @endif

                @if(permissionAdmin('read-standards') || permissionAdmin('read-fields'))
                    {{-- categories --}}
                    {{--<x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.models.categories" svg="categories" show="dashboard.admin.categories.*">

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.standards" active="dashboard.admin.categories.standards.*" route="dashboard.admin.categories.standards.index" permission="read-standards"/>

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.models.fields" active="dashboard.admin.categories.fields.*" route="dashboard.admin.categories.fields.index" permission="read-fields"/>

                    </x-dashboard.admin.layout.includes.sidebar.menu-group-item>--}}

                @endif

                @if(permissionAdmin('read-initial_evaluations') || permissionAdmin('read-self_evaluations') || permissionAdmin('read-languages'))
                    {{-- evaluations --}}
                    {{--<x-dashboard.admin.layout.includes.sidebar.menu-group-item trans="admin.models.evaluations" svg="evaluations" show="dashboard.admin.evaluations.*">

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.evaluations.initial_evaluations.model" active="dashboard.admin.evaluations.initial_evaluations.*" route="dashboard.admin.evaluations.initial_evaluations.index" permission="read-initial_evaluations"/>

                        <x-dashboard.admin.layout.includes.sidebar.menu-item trans="admin.evaluations.self_evaluations.model" active="dashboard.admin.evaluations.self_evaluations.*" route="dashboard.admin.evaluations.self_evaluations.index" permission="read-self_evaluations"/>

                    </x-dashboard.admin.layout.includes.sidebar.menu-group-item>--}}

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