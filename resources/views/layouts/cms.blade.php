<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $settings = [];
        if (Schema::hasTable('settings')) {
            $pesantren = DB::table('settings')->where('type', 'pesantren')->first();
            if ($pesantren) {
                $settings['og_title'] = $pesantren->nama_pesantren ?? 'Pesantren CMS';
                $settings['og_description'] = $pesantren->isi ?? 'Pesantren CMS - Sistem Manajemen Pesantren Modern';
                // No image column; leave null to use default
                $settings['og_image'] = null;
                $settings['twitter_title'] = $settings['og_title'];
                $settings['twitter_description'] = $settings['og_description'];
                $settings['twitter_image'] = null;
            }
        }
        $ogTitle = $settings['og_title'] ?? 'Pesantren CMS';
        $ogDescription = $settings['og_description'] ?? 'Pesantren CMS - Sistem Manajemen Pesantren Modern';
        $ogImage = $settings['og_image'] ? asset('storage/'.$settings['og_image']) : asset('assets/img/og-image.jpg');
        $twitterTitle = $settings['twitter_title'] ?? $ogTitle;
        $twitterDescription = $settings['twitter_description'] ?? $ogDescription;
        $twitterImage = $settings['twitter_image'] ? asset('storage/'.$settings['twitter_image']) : asset('assets/img/twitter-image.jpg');
    @endphp

    <!-- SEO Meta Tags -->
    <title>@yield('title', $ogTitle)</title>
    <meta name="description" content="@yield('description', $ogDescription)">
    <meta name="keywords" content="@yield('keywords', 'pesantren, pendidikan islam, sekolah, Männer')">
    <meta name="author" content="Pesantren CMS">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('og_url', request()->url())">
    <meta property="og:title" content="@yield('og_title', $ogTitle)">
    <meta property="og:description" content="@yield('og_description', $ogDescription)">
    <meta property="og:image" content="@yield('og_image', $ogImage)">
    <meta property="og:site_name" content="Pesantren CMS">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="@yield('twitter_url', request()->url())">
    <meta property="twitter:title" content="@yield('twitter_title', $twitterTitle)">
    <meta property="twitter:description" content="@yield('twitter_description', $twitterDescription)">
    <meta property="twitter:image" content="@yield('twitter_image', $twitterImage)">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/ponpes.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ponpes-style.css') }}">

    <!-- CMS Specific Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/cms/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cms/components.css') }}">

    <!-- Page Specific Styles -->
    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="app">
        <!-- Header -->
        @include('cms.partials.header')

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('cms.partials.footer')
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- CMS Specific JS -->
    <script src="{{ asset('assets/js/cms/main.js') }}"></script>

    @yield('script')
</body>

</html>