<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="{{ session('dir') }}" lang="{{ app()->getLocale() }}">

<head>
    <title>{{ trans('admin.global.app_name') . ' - ' . $title ?? '' }}</title>
    <meta charset="utf-8" />
    <meta content="follow, index" name="robots" />
    <link href="https://127.0.0.1:8001/metronic-tailwind-html/demo1/index.html" rel="canonical" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="@keenthemes" name="twitter:site" />
    <meta content="@keenthemes" name="twitter:creator" />
    <meta content="summary_large_image" name="twitter:card" />
    <meta content="{{ trans('admin.global.app_name') }}" name="twitter:title" />
    <meta content="" name="twitter:description" />
    <meta content="admin_assets/media/app/og-image.png" name="twitter:image" />
    <meta content="{{ url('/') }}" property="og:url" />
    <meta content="ar_SA" property="og:locale" />
    <meta content="website" property="og:type" />
    <meta content="@keenthemes" property="og:site_name" />
    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="{{ trans('admin.global.app_name') }}" property="og:title" />
    <meta content="{{ trans('admin.global.app_name') }}" property="og:description" />
    <meta content="{{ asset('admin_assets/media/app/logo.png') }}" property="og:image" />
    <x-dashboard.admin.layout.includes.styles />
    {{ $styles ?? '' }}
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background demo1 kt-sidebar-fixed kt-header-fixed">
    <!-- Theme Mode -->
    <x-dashboard.admin.layout.includes.default-theme-mode />
    <!-- End of Theme Mode -->
    <!-- Page -->
    <!-- Main -->
    <div class="flex grow">

        <x-dashboard.admin.layout.includes.sidebar />

        <x-dashboard.admin.layout.includes.session />

        <!-- Wrapper -->
        <div class="kt-wrapper flex grow flex-col">

            <!-- Header -->
            <x-dashboard.admin.layout.includes.header />
            <!-- End of Header -->

            <!-- Content -->
            <main class="grow pb-5 kt-card kt-card-accent" id="content" role="content">
                
                <!-- Container -->
                <div class="kt-container-fixed">

                    {{ $slot ?? '' }}

                </div>
                <!-- End of Container -->
                
            </main>
            <!-- End of Content -->
            <!-- Footer -->
            <x-dashboard.admin.layout.includes.footer />
            <!-- End of Footer -->
        </div>
        <!-- End of Wrapper -->
    </div>
    <!-- End of Main -->
    <!-- End of Page -->

    <!-- Scripts -->
    
    <x-dashboard.admin.layout.includes.scripts />
    
    {{ $scripts ?? '' }}

    <!-- End of Scripts -->

</body>

</html>