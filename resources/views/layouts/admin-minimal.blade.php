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
                        "on-background": "#191c1d",
                        "on-error-container": "#93000a",
                        "inverse-surface": "#2e3132",
                        "primary": "#006948",
                        "surface-variant": "#e1e3e4",
                        "primary-fixed": "#88f8c3",
                        "on-secondary-fixed-variant": "#753401",
                        "on-secondary-fixed": "#321200",
                        "on-secondary-container": "#783603",
                        "secondary-fixed-dim": "#ffb68c",
                        "surface-container-low": "#f3f4f5",
                        "on-tertiary-fixed-variant": "#574500",
                        "tertiary-container": "#cba72f",
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
                        "primary-fixed-dim": "#6bdba8",
                        "on-tertiary": "#ffffff"
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

    <!-- Sidebar Navigation -->
    <aside class="w-72 bg-surface-container-lowest border-r border-outline-variant/20 flex flex-col z-10 transition-all duration-300" id="sidebar">
        <!-- Sidebar Toggle Header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-outline-variant/10">
            <a href="#" data-toggle="sidebar" class="text-on-surface-variant hover:text-primary transition-colors" id="sidebar-toggle">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </a>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-xl">mosque</span>
                <span class="font-headline-sm text-headline-sm text-primary">Al-Hikmah</span>
            </div>
        </div>
        <nav class="flex-1 px-4 py-2 overflow-y-auto custom-scrollbar">
            <!-- Main -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">Main</p>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('home') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('home') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('home') ? '' : 'text-primary' }}">dashboard</span>
                    <span class="font-label-md">Dashboard</span>
                </a>
            </div>

            <!-- Santri / Academic -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">Academic</p>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('santri.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('santri.index') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('santri.*') ? '' : 'text-primary' }}">school</span>
                    <span class="font-label-md">Data Santri</span>
                </a>
            </div>

            <!-- User Management -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">User</p>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('pengguna.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('pengguna.index') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('pengguna.*') ? '' : 'text-primary' }}">manage_accounts</span>
                    <span class="font-label-md">Data Pengguna</span>
                </a>
            </div>

            <!-- Keuangan / Finance -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">Keuangan</p>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('biaya.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('biaya.index') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('biaya.*') ? '' : 'text-primary' }}">receipt_long</span>
                    <span class="font-label-md">Biaya Pembayaran</span>
                </a>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('keuangan.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('keuangan.index') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('keuangan.*') ? '' : 'text-primary' }}">payments</span>
                    <span class="font-label-md">Manajemen Keuangan</span>
                </a>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('buku-kas.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('buku-kas.index') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('buku-kas.*') ? '' : 'text-primary' }}">menu_book</span>
                    <span class="font-label-md">Buku Kas</span>
                </a>
            </div>

            <!-- Pembayaran (Dropdown) -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">Pembayaran</p>
                <button class="w-full flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('registration.*') || request()->routeIs('syahriah.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" onclick="this.nextElementSibling.classList.toggle('hidden')">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('registration.*') || request()->routeIs('syahriah.*') ? '' : 'text-primary' }}">receipt_long</span>
                    <span class="font-label-md">Pembayaran</span>
                    <span class="material-symbols-outlined ml-auto text-sm opacity-50 group-hover:rotate-90 transition-transform">chevron_right</span>
                </button>
                <div class="ml-10 mt-1 space-y-1 hidden">
                    <a class="block py-2 text-sm {{ request()->routeIs('registration.*') ? 'text-primary font-medium' : 'text-on-surface-variant hover:text-primary' }}" href="{{ route('registration.index') }}">Pendaftaran Baru</a>
                    <a class="block py-2 text-sm {{ request()->routeIs('syahriah.*') ? 'text-primary font-medium' : 'text-on-surface-variant hover:text-primary' }}" href="{{ route('syahriah.index') }}">Syahriah (SPP)</a>
                </div>
            </div>

            <!-- CMS Modules -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">CMS Modules</p>
                <button class="w-full flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.berita.*') || request()->routeIs('admin.galeri.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" onclick="this.nextElementSibling.classList.toggle('hidden')">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('admin.berita.*') || request()->routeIs('admin.galeri.*') ? '' : 'text-primary' }}">article</span>
                    <span class="font-label-md">Content</span>
                    <span class="material-symbols-outlined ml-auto text-sm opacity-50 group-hover:rotate-90 transition-transform">chevron_right</span>
                </button>
                <div class="ml-10 mt-1 space-y-1 hidden">
                    <a class="block py-2 text-sm {{ request()->routeIs('admin.berita.*') ? 'text-primary font-medium' : 'text-on-surface-variant hover:text-primary' }}" href="{{ route('admin.berita.index') }}">News & Updates</a>
                    <a class="block py-2 text-sm {{ request()->routeIs('admin.galeri.*') ? 'text-primary font-medium' : 'text-on-surface-variant hover:text-primary' }}" href="{{ route('admin.galeri.index') }}">Gallery</a>
                </div>
            </div>

            <!-- Settings -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">Settings</p>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.settings.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('admin.settings.index') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('admin.settings.*') ? '' : 'text-primary' }}">settings</span>
                    <span class="font-label-md">Settings</span>
                </a>
            </div>

            <!-- Administrasi -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">Administrasi</p>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('surat-masuk*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="/surat-masuk">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('surat-masuk*') ? '' : 'text-primary' }}">inbox</span>
                    <span class="font-label-md">Surat Masuk</span>
                </a>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('surat-keluar*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="/surat-keluar">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('surat-keluar*') ? '' : 'text-primary' }}">send</span>
                    <span class="font-label-md">Surat Keluar</span>
                </a>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('inventaris*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('inventaris.index') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('inventaris*') ? '' : 'text-primary' }}">inventory_2</span>
                    <span class="font-label-md">Inventaris</span>
                </a>
            </div>

            <!-- Logs -->
            <div class="mb-4">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">Logs</p>
                <a class="flex items-center px-4 py-3 rounded-lg transition-all {{ request()->routeIs('logs.*') ? 'cms-sidebar-active' : 'text-on-surface-variant hover:bg-primary-container/10 hover:text-primary' }}" href="{{ route('logs.index') }}">
                    <span class="material-symbols-outlined mr-3 {{ request()->routeIs('logs.*') ? '' : 'text-primary' }}">history</span>
                    <span class="font-label-md">Log Aktivitas</span>
                </a>
            </div>

            <!-- System (Bottom) -->
            <div class="mt-auto pt-8 border-t border-outline-variant/10">
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-outline mb-2">System</p>
            </div>
        <div class="p-4 bg-surface-container-low border-t border-outline-variant/10">
            <div class="flex items-center space-x-2">
                <span class="material-symbols-outlined text-secondary text-sm">lock_person</span>
                <span class="text-[11px] text-on-surface-variant italic">Logged in as <strong>{{ Auth::user()->santris->name ?? Auth::user()->name ?? 'Admin' }}</strong></span>
            </div>
        </div>
    </aside>

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
                    <span class="material-symbols-outlined">logout</span>
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
<script>
    // Sidebar Toggle Functionality
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const mainContent = document.querySelector('main');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', (e) => {
                e.preventDefault();
                sidebar.classList.toggle('sidebar-collapsed');

                // Store state in localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('sidebar-collapsed'));
            });

            // Restore state from localStorage
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('sidebar-collapsed');
            }
        }

        // Card hover effects
        const cards = document.querySelectorAll('.glass-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('shadow-md');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('shadow-md');
            });
        });
    });
</script>
<style>
    /* Collapsed Sidebar Styles */
    .sidebar-collapsed {
        width: 80px !important;
        overflow: hidden;
    }
    .sidebar-collapsed .font-label-md,
    .sidebar-collapsed .font-headline-sm,
    .sidebar-collapsed p.px-4,
    .sidebar-collapsed .material-symbols-outlined.ml-auto {
        display: none;
    }
    .sidebar-collapsed .flex.items-center.gap-2 {
        justify-content: center;
    }
    .sidebar-collapsed .material-symbols-outlined.mr-3 {
        margin-right: 0 !important;
    }
    .sidebar-collapsed .px-4 {
        padding-left: 12px !important;
        padding-right: 12px !important;
    }
    .sidebar-collapsed .cms-sidebar-active,
    .sidebar-collapsed .flex.items-center.px-4.py-3 {
        justify-content: center;
        padding: 12px !important;
    }
    /* Hide dropdown submenus when collapsed */
    .sidebar-collapsed .ml-10 {
        display: none !important;
    }

    /* Allow dropdowns to show when not hidden, even in collapsed sidebar */
    .sidebar-collapsed .ml-10:not(.hidden) {
        display: block !important;
    }
    /* Hide user footer text when collapsed */
    .sidebar-collapsed .p-4.bg-surface-container-low {
        display: none;
    }

    /* Active sidebar item styling when collapsed */
    .sidebar-collapsed .main-sidebar .sidebar-menu li.active-sidebar {
        background-color: var(--primary) !important;
        box-shadow: 0 4px 12px rgba(0, 105, 72, 0.2) !important;
        border-radius: 6px !important;
        margin: 4px 0 !important;
    }

    .sidebar-collapsed .main-sidebar .sidebar-menu li.active-sidebar .nav-link,
    .sidebar-collapsed .main-sidebar .sidebar-menu li.active-sidebar .nav-link [class*="fas"],
    .sidebar-collapsed .main-sidebar .sidebar-menu li.active-sidebar .nav-link [class*="far"] {
        color: var(--white) !important;
    }
</style>
</body>
</html>