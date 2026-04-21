<div class="flex items-center gap-2.5">
    
    @php($lists = ['1' => trans('admin.global.active'), '0' => trans('admin.global.inactive')])
    @php($length = [10 => 10, 25 => 25, 50 => 50, 100 => 100])

    <x-input.option :all='true' :choose='false' :$lists class="w-36" placeholder="{{ trans('admin.global.status') }}" id="select-status"/>

    <x-input.option :choose='false' :lists='$length' class="w-36" placeholder="{{ trans('admin.global.choose') }}" id="data-table-length"/>
    
    {{ $slot ?? '' }}
    
</div>