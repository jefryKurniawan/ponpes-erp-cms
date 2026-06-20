<!DOCTYPE html>
<html lang="id" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CDN with plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-error-container": "#93000a",
                        "primary": "#006948",
                        "inverse-surface": "#2e3132",
                        "primary-fixed": "#88f8c3",
                        "surface-variant": "#e1e3e4",
                        "on-secondary-fixed-variant": "#753401",
                        "on-secondary-fixed": "#321200",
                        "on-secondary-container": "#783603",
                        "secondary-fixed-dim": "#ffb68c",
                        "surface-container-low": "#f3f4f5",
                        "tertiary-container": "#cba72f",
                        "on-tertiary-fixed-variant": "#574500",
                        "background": "#f8f9fa",
                        "on-primary-container": "#f5fff7",
                        "secondary-fixed": "#ffdbc9",
                        "on-tertiary-fixed": "#241a00",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#e9c349",
                        "focus-ring": "rgba(14, 148, 103, 0.2)",
                        "surface-container-highest": "#e1e3e4",
                        "text-main": "#212529",
                        "surface-tint": "#006c4a",
                        "surface-dim": "#d9dadb",
                        "on-primary-fixed-variant": "#005237",
                        "on-secondary": "#ffffff",
                        "secondary": "#934b19",
                        "outline-variant": "#bdcac0",
                        "divider-clay": "rgba(139, 69, 19, 0.1)",
                        "on-tertiary": "#ffffff",
                        "primary-fixed-dim": "#6bdba8",
                        "tertiary-fixed": "#ffe088",
                        "inverse-on-surface": "#f0f1f2",
                        "surface-bright": "#f8f9fa",
                        "primary-container": "#00855c",
                        "surface": "#f8f9fa",
                        "secondary-container": "#ffa26a",
                        "surface-container-lowest": "#ffffff",
                        "error": "#ba1a1a",
                        "outline": "#6d7a72",
                        "surface-container": "#edeeef",
                        "on-surface": "#191c1d",
                        "inverse-primary": "#6bdba8",
                        "error-container": "#ffdad6",
                        "on-tertiary-container": "#4e3d00",
                        "tertiary": "#735c00",
                        "on-error": "#ffffff",
                        "surface-container-high": "#e7e8e9",
                        "on-primary-fixed": "#002114",
                        "on-surface-variant": "#3e4a42",
                        "on-background": "#191c1d"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    spacing: {
                        md: "1.5rem",
                        base: "4px",
                        lg: "2.5rem",
                        gutter: "24px",
                        sm: "1rem",
                        "touch-target": "48px",
                        xl: "4rem",
                        "margin-mobile": "16px",
                        xs: "0.5rem"
                    },
                    fontFamily: {
                        "label-sm": ["Lora"],
                        "headline-sm": ["Kalam"],
                        "body-sm": ["Lora"],
                        "body-lg": ["Lora"],
                        "label-md": ["Lora"],
                        "headline-md": ["Kalam"],
                        "body-md": ["Lora"],
                        "headline-lg-mobile": ["Kalam"],
                        "headline-lg": ["Kalam"]
                    },
                    fontSize: {
                        "label-sm": ["12px", { "lineHeight": "1.2", "fontWeight": "600" }],
                        "headline-sm": ["24px", { "lineHeight": "1.4", "fontWeight": "400" }],
                        "body-sm": ["14px", { "lineHeight": "1.5", "fontWeight": "400" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "label-md": ["14px", { "lineHeight": "1.2", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "headline-md": ["32px", { "lineHeight": "1.3", "fontWeight": "400" }],
                        "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "headline-lg-mobile": ["32px", { "lineHeight": "1.2", "fontWeight": "700" }],
                        "headline-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }]
                    }
                }
            }
        };
    </script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon_for_a_traditional_indonesian_pesantren_brand_named_heritage_organic.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/cms/components.css') }}">
    @yield('styles')
</head>
<body class="font-body-md text-body-md custom-scrollbar bg-surface text-on-surface">
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('assets/js/cms/main.js') }}"></script>
    @yield('script')
</body>
</html>