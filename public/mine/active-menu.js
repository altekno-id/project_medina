$(function () {
    var $menu = $('#layout-menu'); // ganti kalau id sidebar beda
    if (!$menu.length) return;

    function norm(url) {
        if (!url) return '';
        var a = document.createElement('a');
        a.href = url;
        var p = a.pathname || '';
        if (p.length > 1) p = p.replace(/\/+$/, '');
        return p;
    }

    var current = norm(location.href);

    // reset semua state
    $menu.find('li.menu-item').removeClass('active open');

    // 1) Aktifkan parent berdasarkan data-prefix (tidak tergantung child ada/tidak)
    var $parents = $menu.find('li.menu-item[data-prefix]').filter(function () {
        var pref = norm($(this).data('prefix'));
        return current === pref || current.indexOf(pref + '/') === 0;
    });

    // kalau ada beberapa yang match, biarkan semuanya open (atau ambil yang paling spesifik)
    if ($parents.length) {
        // ambil yang prefix paling panjang (paling spesifik)
        var $best = $parents.sort(function (a, b) {
            return $(b).data('prefix').length - $(a).data('prefix').length;
        }).first();

        $best.addClass('active');
        if ($best.children('ul.menu-sub').length) {
            $best.addClass('open');
        }
    }

    // 2) Kalau ada child link yang exact match, aktifkan child-nya juga
    var $link = $menu.find('a.menu-link[href]').filter(function () {
        var href = $(this).attr('href');
        if (!href || href === '#' || href.indexOf('javascript:') === 0) return false;
        return norm(href) === current;
    }).first();

    if ($link.length) {
        $link.closest('li.menu-item').addClass('active');
        // optional: pastikan parent yang menaungi submenu juga open (kalau belum)
        $link.parents('ul.menu-sub').first().closest('li.menu-item').addClass('active open');
    }
});
