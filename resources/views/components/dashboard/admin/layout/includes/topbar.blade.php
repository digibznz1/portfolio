<div class="flex items-center gap-2.5">
    <!-- User -->
    <div class="shrink-0" data-kt-dropdown="true" data-kt-dropdown-offset="10px, 10px" data-kt-dropdown-offset-rtl="-20px, 10px" data-kt-dropdown-placement="bottom-end" data-kt-dropdown-placement-rtl="bottom-start" data-kt-dropdown-trigger="click">
        <div class="cursor-pointer shrink-0" data-kt-dropdown-toggle="true">
            <img class="size-9 rounded-full border-2 border-green-500 shrink-0" src="{{ auth('admin')->user()->image_path }}" />
        </div>
        <div class="kt-dropdown-menu w-[250px]" data-kt-dropdown-menu="true">
            <div class="flex items-center justify-between px-2.5 py-1.5 gap-1.5">
                <div class="flex items-center gap-2">
                    <img alt="" class="size-9 shrink-0 rounded-full border-2 border-green-500" src="{{ auth('admin')->user()->image_path }}" />
                    <div class="flex flex-col gap-1.5">
                        <span class="text-sm text-foreground font-semibold leading-none">
                            {{ auth('admin')->user()->name }}
                        </span>
                        <span class="text-sm text-foreground font-semibold leading-none">
                            {{ auth('admin')->user()->email }}
                        </span>
                    </div>
                </div>
                <span class="kt-badge kt-badge-sm kt-badge-primary kt-badge-outline">
                    Role
                </span>
            </div>
            <ul class="kt-dropdown-menu-sub">
                <li>
                    <div class="kt-dropdown-menu-separator"></div>
                </li>
                <li>
                    <a class="kt-dropdown-menu-link" href="{{ route('dashboard.admin.auth.accounts.profile.edit') }}">
                        <i class="ki-filled ki-profile-circle"></i>
                        {{ trans('admin.auth.profile') }}
                    </a>
                </li>
            </ul>
            <div class="px-2.5 pt-1.5 mb-2.5 flex flex-col gap-3.5">
                <div class="flex items-center gap-2 justify-between">
                    <span class="flex items-center gap-2">
                        <i class="ki-filled ki-moon text-base text-muted-foreground"></i>
                        <span class="font-medium text-2sm">
                            {{ trans('admin.auth.dark_mode') }}
                        </span>
                    </span>
                    <input class="kt-switch" data-kt-theme-switch-state="dark" data-kt-theme-switch-toggle="true" name="check" type="checkbox" value="1" />
                </div>
                <form action="{{ route('dashboard.admin.auth.logout') }}" method="POST">
                    @csrf

                    <button class="kt-btn kt-btn-outline justify-center w-full">
                        {{ trans('admin.auth.logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- End of User -->
</div>