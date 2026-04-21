<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="{{ session('dir') }}" lang="{{ app()->getLocale() }}">

<head>
    <title>athrpro - Login Page</title>
    <meta charset="utf-8" />
    <meta content="follow, index" name="robots" />
    <link href="https://127.0.0.1:8001/metronic-tailwind-html/demo1/authentication/classic/sign-in/index.html" rel="canonical" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <meta content="Sign in page using Tailwind CSS" name="description" />
    <meta content="@keenthemes" name="twitter:site" />
    <meta content="@keenthemes" name="twitter:creator" />
    <meta content="summary_large_image" name="twitter:card" />
    <meta content="Metronic - Tailwind CSS Sign In" name="twitter:title" />
    <meta content="Sign in page using Tailwind CSS" name="twitter:description" />
    <meta content="admin_assets/media/app/og-image.png" name="twitter:image" />
    <meta content="https://127.0.0.1:8001/metronic-tailwind-html/demo1/authentication/classic/sign-in/index.html" property="og:url" />
    <meta content="en_US" property="og:locale" />
    <meta content="website" property="og:type" />
    <meta content="@keenthemes" property="og:site_name" />
    <meta content="Metronic - Tailwind CSS Sign In" property="og:title" />
    <meta content="Sign in page using Tailwind CSS" property="og:description" />
    <meta content="admin_assets/media/app/og-image.png" property="og:image" />
    <x-dashboard.admin.layout.auth.includes.styles />
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background">
    <!-- Theme Mode -->
    <x-dashboard.admin.layout.includes.default-theme-mode />
    <!-- End of Theme Mode -->
    <!-- Page -->
    <style>
        .page-bg {
            background-image: url('{{ asset('admin_assets/media/images/2600x1200/bg-10.png') }}');
        }

        .dark .page-bg {
            background-image: url('{{ asset('admin_assets/media/images/2600x1200/bg-10-dark.png') }}');
        }
    </style>

    {{ $slot ?? '' }}
    <!-- End of Page -->
    <!-- Scripts -->
    <x-dashboard.admin.layout.auth.includes.scripts />
    <!-- End of Scripts -->
</body>

</html>