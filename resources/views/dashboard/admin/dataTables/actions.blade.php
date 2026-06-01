<div class="flex items-center gap-1"> 

    @if($buttons->contains('show') && !empty($permissions['show']))
        <a href="{{ $parameters ? route($baseRoute . '.show', $parameters) : route($baseRoute . '.show', $model->id) }}" class="kt-btn kt-btn-icon kt-btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" data--h-bstatus="0OBSERVED"/><circle cx="12" cy="12" r="3" data--h-bstatus="0OBSERVED"/></svg>        
        </a>
    @endif

    @if($buttons->contains('update') && !empty($permissions['update']))
        <a href="{{ $parameters ? route($baseRoute . '.edit', $parameters) : route($baseRoute . '.edit', $model->id) }}" class="kt-btn kt-btn-icon kt-btn-mono">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil-icon lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" data--h-bstatus="0OBSERVED"/><path d="m15 5 4 4" data--h-bstatus="0OBSERVED"/></svg>
            {{--@lang('admin.global.edit')--}}
        </a>
    @endif

    @if($buttons->contains('delete') && !empty($permissions['delete']))
        <form action="{{ $parameters ? route($baseRoute . '.destroy', $parameters) : route($baseRoute . '.destroy', $model->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="kt-btn kt-btn-icon kt-btn-destructive delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-icon lucide-trash"><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" data--h-bstatus="0OBSERVED"/><path d="M3 6h18" data--h-bstatus="0OBSERVED"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" data--h-bstatus="0OBSERVED"/></svg>
                {{--@lang('admin.global.delete')--}}
            </button>
        </form>
    @endif
    
</div>