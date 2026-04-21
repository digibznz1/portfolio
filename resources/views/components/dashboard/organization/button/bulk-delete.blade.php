@if(permissionAdmin($permission))
    <form method="post" 
        action="{{ route(
                    $baseRoute
                    . request()->segment(3) . '.'
                    . request()->segment(4)
                    . (request()->segment(6) ? '.' . request()->segment(6) : '')
                    . '.bulk_delete',
                    $prams
                ) }}"
        style="display: inline-block;">
        @csrf
        @method('delete')
        <input type="hidden" name="record_ids" id="record-ids">
        <button type="submit" class="kt-btn kt-btn-destructive" id="bulk-delete" disabled="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-minus-icon lucide-clipboard-minus"><rect width="8" height="4" x="8" y="2" rx="1" ry="1" data--h-bstatus="0OBSERVED"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" data--h-bstatus="0OBSERVED"/><path d="M9 14h6" data--h-bstatus="0OBSERVED"/></svg>
             @lang('admin.global.bulk_delete')
        </button>
    </form><!-- end of form -->
@endif