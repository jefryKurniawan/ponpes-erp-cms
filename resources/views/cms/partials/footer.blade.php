<footer class="footer">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4 class="footer-title">Tentang Pesantren</h4>
                        <p class="footer-description">
                            Pesantren adalah lembaga pendidikan Islam yang fokus pada pengajaran Al-Qur'an dan Hadis,
                            serta pengembangan karakter santri berdasarkan nilai-nilai keislaman yang luhur.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="footer-title">Navigasi</h4>
                        <ul class="footer-links list-unstyled">
                            <li><a href="{{ route('cms.home') }}">Beranda</a></li>
                            <li><a href="{{ route('cms.about') }}">Tentang Kami</a></li>
                            <li><a href="{{ route('cms.news.index') }}">Berita</a></li>
                            <li><a href="{{ route('cms.psb') }}">Pendaftaran</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="footer-title">Layanan</h4>
                        <ul class="footer-links list-unstyled">
                            <li><a href="#">Program Hafalan Qur'an</a></li>
                            <li><a href="#">Kelas Bahasa Arab</a></li>
                            <li><a href="#">Pengajian Keluarga</a></li>
                            <li><a href="#">Konseling Santri</a></li>
                            <li><a href="#">Program Beasiswa</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h4 class="footer-title">Ikuti Kami</h4>
                        <div class="footer-social">
                            <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-tiktok"></i></a>
                        </div>
                        <div class="footer-contact mt-3">
                            <p><i class="fas fa-map-marker-alt me-2"></i> Desa Pesantren, Kabupaten XXX</p>
                            <p><i class="fas fa-phone me-2"></i> +62 812-3456-7890</p>
                            <p><i class="fas fa-envelope me-2"></i> info@pesantren.example.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">
                        Pesantren CMS &copy; {{ date('Y') }}. All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="footer-menu">
                        <a href="{{ route('cms.about') }}">About</a>
                        <a href="{{ route('cms.psb') }}">PSB</a>
                        <a href="{{ route('cms.news.index') }}">News</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>