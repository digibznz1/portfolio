<a class="kt-btn kt-btn-primary"
   href="{{ route(
        $baseRoute
        . request()->segment(3) . '.'
        . request()->segment(4)
        . (request()->segment(6) ? '.' . request()->segment(6) : '')
        . '.create',
        $prams
   ) }}">    
   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2" data--h-bstatus="0OBSERVED"/><path d="M8 12h8" data--h-bstatus="0OBSERVED"/><path d="M12 8v8" data--h-bstatus="0OBSERVED"/></svg>
    {{ trans('admin.global.create') }}
</a>