<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        // Initialize meta tag values with defaults
        $metaOgTitle = 'Pesantren CMS';
        $metaOgDescription = 'Pesantren CMS - Sistem Manajemen Pesantren Modern';
        $metaOgImage = null;
        $metaTwitterTitle = 'Pesantren CMS';
        $metaTwitterDescription = 'Pesantren CMS - Sistem Manajemen Pesantren Modern';
        $metaTwitterImage = null;

        // Override with database values if available
        if (Schema::hasTable('settings')) {
            $pesantren = DB::table('settings')->where('type', 'pesantren')->first();
            if ($pesantren) {
                $metaOgTitle = $pesantren->nama_pesantren ?? 'Pesantren CMS';
                $metaOgDescription = $pesantren->isi ?? 'Pesantren CMS - Sistem Manajemen Pesantren Modern';
                // No image column; leave null to use default
                $metaOgImage = null;
                $metaTwitterTitle = $metaOgTitle;
                $metaTwitterDescription = $metaOgDescription;
                $metaTwitterImage = null;
            } else {
                // Fallback if no pesantren settings found
                $metaOgTitle = 'Pesantren CMS';
                $metaOgDescription = 'Pesantren CMS - Sistem Manajemen Pesantren Modern';
                $metaOgImage = null;
                $metaTwitterTitle = $metaOgTitle;
                $metaTwitterDescription = $metaOgDescription;
                $metaTwitterImage = null;
            }
        }

        $ogTitle = $metaOgTitle;
        $ogDescription = $metaOgDescription;
        $ogImage = $metaOgImage ? asset('storage/'.$metaOgImage) : asset('assets/img/og-image.jpg');
        $twitterTitle = $metaTwitterTitle;
        $twitterDescription = $metaTwitterDescription;
        $twitterImage = $metaTwitterImage ? asset('storage/'.$metaTwitterImage) : asset('assets/img/twitter-image.jpg');
    @endphp

    <!-- SEO Meta Tags -->
    <title>@yield('title', $ogTitle)</title>
    <meta name="description" content="@yield('description', $ogDescription)">
    <meta name="keywords" content="@yield('keywords', 'pesantren, pendidikan islam, sekolah, Männer')">
    <meta name="author" content="Pesantren CMS">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', request()->url())">
    <meta property="og:title" content="@yield('og_title', $ogTitle)">
    <meta property="og:description" content="@yield('og_description', $ogDescription)">
    <meta property="og:image" content="@yield('og_image', $ogImage)">
    <meta property="og:site_name" content="Pesantren CMS">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter -->
    <meta property="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
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