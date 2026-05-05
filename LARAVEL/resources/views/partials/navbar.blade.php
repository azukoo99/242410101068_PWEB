<!-- NAVBAR -->
<header class="navbar">
    <div class="navbar-brand">
        <img src="{{ asset('images/logo.png') }}" alt="DiamondStore Logo" class="navbar-logo">
        <div class="navbar-title">
            <span class="brand-name">DiamondStore</span>
            <span class="brand-sub">Top Up Mobile Legends</span>
        </div>
    </div>

    <!-- Tombol hamburger (3 garis) — hanya tampil di HP -->
    <button class="hamburger" id="hamburger" aria-label="Buka menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Menu navigasi -->
    <nav class="navbar-menu" id="navbar-menu">
        <a href="#beranda" class="nav-link">🏠 Beranda</a>
        <a href="#topup" class="nav-link">💎 Top Up</a>
        <a href="#riwayat" class="nav-link">📋 Riwayat</a>
        <a href="#promo" class="nav-link">🎁 Promo</a>
        <a href="#inventaris" class="nav-link">💎 Kelola Stok</a>
        <!-- Masuk hanya muncul di dalam menu HP -->
        <a href="#" class="nav-link nav-masuk-mobile">Masuk</a>
    </nav>

    <!-- Tombol Masuk — hanya tampil di desktop -->
    <div class="navbar-action">
        <a href="#" class="btn-login">Masuk</a>
    </div>
</header>

<div class="navbar-spacer"></div>
