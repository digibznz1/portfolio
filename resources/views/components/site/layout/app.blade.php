<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title ?? setting('meta')->title }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&family=Tajawal:wght@300;400;500;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-tint": "#5D318C",
                        "background": "#f6fafe",
                        "inverse-on-surface": "#edf1f5",
                        "error": "#ba1a1a",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#efdbff",
                        "primary-container": "#5d318c",
                        "on-error": "#ffffff",
                        "on-surface": "#171c1f",
                        "surface-variant": "#dfe3e7",
                        "on-tertiary": "#ffffff",
                        "outline": "#757682",
                        "on-secondary-container": "#572000",
                        "on-tertiary-fixed": "#001e2d",
                        "on-secondary-fixed": "#351000",
                        "on-tertiary-container": "#009ad3",
                        "on-error-container": "#93000a",
                        "secondary-fixed-dim": "#ffb693",
                        "surface-container-low": "#f0f4f8",
                        "surface-container-highest": "#dfe3e7",
                        "surface-container": "#eaeef2",
                        "tertiary-fixed": "#c6e7ff",
                        "secondary": "#FF4E00",
                        "error-container": "#ffdad6",
                        "outline-variant": "#c5c6d2",
                        "on-secondary": "#ffffff",
                        "primary": "#5D318C",
                        "tertiary": "#001623",
                        "on-secondary-fixed-variant": "#7a3000",
                        "inverse-surface": "#2c3134",
                        "primary-fixed-dim": "#dbb8ff",
                        "on-tertiary-fixed-variant": "#004c6b",
                        "on-primary-fixed-variant": "#5c308b",
                        "surface-dim": "#d6dade",
                        "on-primary-fixed": "#2b0052",
                        "secondary-fixed": "#ffdbcc",
                        "surface": "#ffffff",
                        "on-primary": "#ffffff",
                        "surface-container-high": "#e4e9ed",
                        "surface-bright": "#ffffff",
                        "inverse-primary": "#dbb8ff",
                        "tertiary-fixed-dim": "#81cfff",
                        "on-primary-container": "#dbb8ff",
                        "tertiary-container": "#002c40",
                        "secondary-container": "#FF4E00",
                        "on-surface-variant": "#444650",
                        "on-background": "#171c1f",
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px",
                    },
                    spacing: {},
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Inter"],
                        label: ["Inter"],
                        montserrat: ["Montserrat"],
                        cairo: ["Cairo"],
                    },
                },
            },
        };
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .signature-gradient {
            background: linear-gradient(135deg, #5D318C 0%, #3a1e58 100%);
        }

        .hero-gradient-overlay {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
        }

        .vibrant-orange-accent {
            background: linear-gradient(135deg, #FF4E00 0%, #FF7C32 100%);
        }

        .purple-glow-overlay {
            background: linear-gradient(135deg, rgba(93, 49, 140, 0.05) 0%, rgba(255, 78, 0, 0.02) 100%);
        }

        /* Arabic typography */
        [dir="rtl"] body {
            font-family: 'Tajawal', sans-serif;
            font-weight: 400;
            letter-spacing: 0;
        }

        [dir="rtl"] h1,
        [dir="rtl"] h2,
        [dir="rtl"] h3,
        [dir="rtl"] h4,
        [dir="rtl"] h5 {
            font-family: 'Tajawal', sans-serif;
            font-weight: 800;
            letter-spacing: 0;
        }

        [dir="rtl"] .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal !important;
        }
    </style>

    {{ $style ?? '' }}
</head>

<body class="bg-white text-on-surface font-body selection:bg-primary-container/30">

    {{ $slot }}

    {{ $scripts ?? '' }}
    
</body>

</html>
