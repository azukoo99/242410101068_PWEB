// ========== Hamburger Menu ==========
var hamburger = document.getElementById('hamburger');
var menu      = document.getElementById('navbar-menu');

hamburger.addEventListener('click', function () {
    menu.classList.toggle('menu-open');
    hamburger.classList.toggle('active');
});

// Tutup menu saat link diklik
document.querySelectorAll('.nav-link').forEach(function (link) {
    link.addEventListener('click', function () {
        menu.classList.remove('menu-open');
        hamburger.classList.remove('active');
    });
});
