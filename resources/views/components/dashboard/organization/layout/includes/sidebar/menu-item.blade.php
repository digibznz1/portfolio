@if(permissionAdmin($permission))
    <div class="kt-menu-item {{ request()->routeIs($active) ? 'active' : '' }}">
        <a href="{{ route($route) }}" class="kt-menu-link gap-[10px] ps-[10px] pe-[10px] py-[6px] border border-transparent kt-menu-item-active:bg-accent/60 dark:menu-item-active:border-border kt-menu-item-active:rounded-lg hover:bg-accent/60 hover:rounded-lg" tabindex="0">
            <span class="kt-menu-icon items-start text-muted-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary w-[20px]">
                <i class="ki-filled ki-calendar-tick text-lg"></i>
            </span>
            <span class="kt-menu-title text-sm font-medium text-foreground kt-menu-item-active:text-primary kt-menu-link-hover:!text-primary">
                {{ trans($trans) }}
            </span>
        </a>
    </div>
@endif