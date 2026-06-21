<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Al-Hikmah Pesantren | Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@400;700&family=Lora:ital,wght@0,400;0,600;1,400&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@100..900&family=Lora:wght@100..900&display=swap" rel="stylesheet"/>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon_for_a_traditional_indonesian_pesantren_brand_named_heritage_organic.png') }}" type="image/png">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "inverse-on-surface": "#f0f1f2",
                        "tertiary-fixed": "#ffe088",
                        "surface-bright": "#f8f9fa",
                        "primary-container": "#00855c",
                        "secondary-container": "#ffa26a",
                        "surface": "#f8f9fa",
                        "surface-container-lowest": "#ffffff",
                        "error": "#ba1a1a",
                        "outline": "#6d7a72",
                        "surface-container": "#edeeef",
                        "on-surface": "#191c1d",
                        "error-container": "#ffdad6",
                        "inverse-primary": "#6bdba8",
                        "on-tertiary-container": "#4e3d00",
                        "tertiary": "#735c00",
                        "on-error": "#ffffff",
                        "surface-container-high": "#e7e8e9",
                        "on-primary-fixed": "#002114",
                        "on-surface-variant": "#3e4a42",
                        "on-background": "#191c1d"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "base": "4px",
                        "md": "1.5rem",
                        "lg": "2.5rem",
                        "gutter": "24px",
                        "sm": "1rem",
                        "touch-target": "48px",
                        "margin-mobile": "16px",
                        "xl": "4rem",
                        "xs": "0.5rem"
                    },
                    "fontFamily": {
                        "headline-sm": ["Kalam"],
                        "headline-md": ["Kalam"],
                        "headline-lg": ["Kalam"],
                        "body-sm": ["Lora"],
                        "body-md": ["Lora"],
                        "body-lg": ["Lora"],
                        "label-sm": ["Lora"],
                        "label-md": ["Lora"]
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js for interactive modals -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .cms-sidebar-active {
            background-color: #006948;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 105, 72, 0.2);
        }
        .cms-sidebar-active .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Sidebar collapsed responsive tweaks */
        .sidebar-collapsed .font-headline-sm {
            display: none;
        }
        .sidebar-collapsed .flex.items-center.gap-2 {
            display: none;
        }
        .sidebar-collapsed .flex.items-center.justify-between {
            flex-direction: column;
            align-items: center;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .sidebar-collapsed .flex.items-center.justify-between a#sidebar-toggle {
            margin-bottom: 0.5rem;
        }
        .organic-pattern {
            background-image: url("https://www.transparenttextures.com/patterns/natural-paper.png");
            opacity: 0.05;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(147, 75, 25, 0.1);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(147, 75, 25, 0.3);
            border-radius: 3px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(0, 105, 72, 0.05);
        }
        .glass-card:hover {
            box-shadow: 0 8px 24px rgba(0, 105, 72, 0.12);
        }
    </style>
    @yield('styles')
</head>
<body class="bg-background text-on-surface font-body-md custom-scrollbar">
<div class="flex h-screen overflow-hidden relative">
    <!-- Organic Texture Overlay -->
    <div class="fixed inset-0 organic-pattern pointer-events-none z-0"></div>

    <!-- Main Content Canvas -->
    <main class="flex-1 flex flex-col overflow-hidden bg-surface-bright/50 z-10">
        <!-- Top Bar -->
        <header class="h-20 bg-surface/80 backdrop-blur-md flex items-center justify-between px-8 border-b border-outline-variant/10">
            <div class="flex-1 max-w-xl">
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">search</span>
                    <input class="w-full bg-surface-container rounded-full border-none focus:ring-2 focus:ring-primary/20 pl-10 pr-4 py-2 text-sm font-body-md placeholder:text-outline-variant" placeholder="Search data santri, reports, or modules..." type="text"/>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <button class="relative p-2 text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">notifications</span>
                    @if(isset($notificationCount) && $notificationCount > 0)
                        <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
                    @endif
                </button>
                <div class="h-8 w-px bg-outline-variant/30"></div>
                <div class="flex items-center space-x-3 cursor-pointer group">
                    <div class="text-right">
                        <p class="font-label-md text-on-surface group-hover:text-primary transition-colors">{{ Auth::user()->santris->name ?? Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] font-bold text-primary uppercase tracking-tighter">{{ Auth::user()->role->name ?? Auth::user()->role_name ?? 'User' }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-primary/20 p-0.5 overflow-hidden">
                        @if(Auth::user()->santris && Auth::user()->santris->photo)
                            <img class="w-full h-full object-cover rounded-full" src="{{ asset('storage/photo/' . Auth::user()->santris->photo) }}" alt="{{ Auth::user()->santris->name }}"/>
                        @elseif(Auth::user()->photo)
                            <img class="w-full h-full object-cover rounded-full" src="{{ asset('storage/photo/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"/>
                        @else
                            <img class="w-full h-full object-cover rounded-full" src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="Avatar"/>
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="hidden" id="logout-form">
                    @csrf
                </form>
                <button onclick="document.getElementById('logout-form').submit()" class="p-2 text-on-surface-variant hover:text-error transition-colors" title="Logout">
                    <span class="material-symbols-outined">logout</span>
                </button>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            @yield('content')
        </div>

        <!-- Modal Container -->
        @stack('modal')
    </main>
</div>

<!-- Scripts -->
@stack('scripts')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@yield('scripts')
</body>
</html>