@if (!empty($breadcrumb) && isset($breadcrumb))
<div class="my-2.5">

    <div class="kt-card">
    
        <div class="kt-card-content bg-breadcrumb px-3.5 p-2">

            <ol class="kt-breadcrumb">

                <!-- Home -->
                <li class="kt-breadcrumb-item">
                    <a href="{{ route('dashboard.admin.index') }}" class="kt-breadcrumb-link">
                        <!-- icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                            <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        </svg>
                    </a>
                </li>

                @foreach ($breadcrumb as $item)

                    <!-- separator -->
                    <li class="kt-breadcrumb-separator">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </li>

                    <!-- item -->
                    <li class="kt-breadcrumb-item">

                        @if (isset($item['route']) && $item['route'] !== "#")

                            <a class="kt-breadcrumb-link" href="{{ route($item['route'], $item['prams'] ?? []) }}">
                                {{ trans($item['trans']) }}
                            </a>

                        @else

                            <span class="kt-breadcrumb-page">
                                {{ trans($item['trans']) }}
                            </span>

                        @endif

                    </li>

                @endforeach

            </ol>

        </div>

    </div>

</div>

@endif