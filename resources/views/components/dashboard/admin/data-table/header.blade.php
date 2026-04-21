@if(!empty($columns))
    <thead>
    <tr>
        <th>
            <div class="animated-checkbox">
                <label>
                    <input type="checkbox" class="kt-checkbox kt-checkbox-sm" id="record__select-all">
                    <span class="label-text"></span>
                </label>
            </div>
        </th>
        
        @foreach($columns as $column)

            <th class="w-auto cursor-pointer"> 

                <div class="flex items-center gap-1"> 

                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down-up">
                        <path d="m3 16 4 4 4-4"/> 
                        <path d="M7 20V4"/> 
                        <path d="m21 8-4-4-4 4"/> 
                        <path d="M17 4v16"/> 
                    </svg> 

                    <span>{{ trans($column) }}</span> 

                </div> 

            </th>
            
        @endforeach

        <th class="w-auto cursor-pointer"> 

            <div class="flex items-center gap-1"> 

                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-down-up">
                    <path d="m3 16 4 4 4-4"/> 
                    <path d="M7 20V4"/> 
                    <path d="m21 8-4-4-4 4"/> 
                    <path d="M17 4v16"/> 
                </svg> 

                <span>{{ trans('admin.global.created_at') }}</span> 

            </div> 

        </th>
        <th class="w-auto text-center">{{ trans('admin.global.action') }}</th>
    </tr>
    </thead>
@endif