<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    /* Base styles for desktop */
    * {
        font-family: 'Poppins', sans-serif;
    }

    #header {
        padding: 30px 0;
        min-height: 100px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        /* Tambahkan shadow untuk efek lebih bagus */
    }

    .logo img {
        height: 65px !important;
        width: auto !important;
        max-height: none !important;
    }

    #navbar ul {
        list-style: none;
    }

    #navbar ul li {
        margin-left: 16px;
    }

    #navbar ul li a {
        font-size: 16px;
        font-weight: 600;
        color: #000;
        position: relative;
        padding: 10px 12px;
        text-decoration: none;
        transition: color 0.3s ease;
        display: inline-block;
    }

    #navbar ul li a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #0d6efd;
        transition: width 0.3s ease;
    }

    #navbar ul li a:hover::after,
    #navbar ul li a.active::after {
        width: 100%;
    }

    #navbar ul li a:hover,
    #navbar ul li a.active {
        color: #0d6efd;
    }

    /* Dropdown aktif */
    #navbar ul li.dropdown.active>a::after {
        width: 100%;
    }

    #navbar ul li.dropdown.active>a {
        color: #0d6efd;
    }

    /* Tombol Masuk - Styling Desktop */
    .login-btn {
        font-size: 14px;
        font-weight: 600;
        border: 1px solid #0d6efd;
        color: #0d6efd;
        border-radius: 4px;
        transition: all 0.3s ease;
        padding: 6px 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .login-btn:hover {
        background-color: #0d6efd;
        color: white;
    }

    /* Tombol Masuk - Styling Mobile */
    .login-btn-mobile {
        display: none;
        /* Sembunyikan di desktop */
    }

    /* Mobile specific styles */
    .mobile-nav-toggle {
        color: #000;
        font-size: 28px;
        cursor: pointer;
        display: none;
        line-height: 0;
        transition: 0.5s;
    }

    @media (max-width: 991px) {
        #navbar ul {
            display: none;
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100vh;
            background-color: #fff;
            flex-direction: column;
            justify-content: flex-start;
            padding-top: 80px;
            transition: right 0.3s ease-in-out;
            z-index: 999;
            overflow-y: auto;
            align-items: flex-start;
            padding-left: 0;
        }

        #navbar ul.navbar-mobile {
            right: 0;
        }

        #navbar ul li {
            margin: 0;
            width: 100%;
            padding: 10px 20px;
            border-bottom: 1px solid #eee;
        }

        #navbar ul li:last-of-type {
            border-bottom: none;
        }

        #navbar ul li a {
            padding: 10px 0;
            width: 100%;
            display: block;
            font-size: 18px;
        }

        #navbar ul li a::after {
            display: none;
        }

        #navbar ul li a:hover,
        #navbar ul li a.active {
            color: #0d6efd;
            background-color: #f8f9fa;
        }

        /* Dropdown specific styles for mobile */
        #navbar .dropdown ul {
            position: static;
            display: block;
            background-color: #f0f0f0;
            padding: 10px 0 10px 20px;
            margin-top: 5px;
            width: auto;
            height: auto;
            right: auto;
            transition: none;
            overflow: visible;
            list-style: none;
        }

        #navbar .dropdown .dropdown ul {
            padding-left: 40px;
        }

        #navbar .dropdown>.dropdown-active {
            display: block;
        }

        #navbar .dropdown>a .bi-chevron-down {
            float: right;
            transform: rotate(0deg);
            transition: 0.3s;
        }

        #navbar .dropdown.dropdown-active>a .bi-chevron-down {
            transform: rotate(180deg);
        }

        .mobile-nav-toggle {
            display: block;
        }

        #header .container {
            padding: 0 15px;
            justify-content: space-between;
        }

        /* Tombol "Masuk" mobile di dalam nav menu */
        .login-mobile {
            display: block;
            width: 100%;
            padding: 20px;
            border-top: 1px solid #eee;
            text-align: center;
        }

        .login-mobile .login-btn-mobile {
            width: 100%;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            background-color: #0d6efd;
            color: white;
            border: 1px solid #0d6efd;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .login-mobile .login-btn-mobile:hover {
            background-color: #0c5ed7;
            color: white;
        }
    }

    /* Overlay untuk mobile nav */
    body.mobile-nav-active {
        overflow: hidden;
    }

    body.mobile-nav-active:before {
        content: "";
        background: rgba(0, 0, 0, 0.6);
        position: fixed;
        inset: 0;
        z-index: 998;
    }
</style>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h1>
                <a href="/">
                    <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo">
                </a>
            </h1>
        </div>

        <nav id="navbar" class="navbar">
            <ul class="d-flex align-items-center m-0 p-0">
                <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : '' }}" href="/"><span>Beranda</span></a></li>

                <li class="dropdown {{ Request::is('sambutan', 'sejarah', 'visi-misi', 'perangkat-desa') ? 'active' : '' }}">
                    <a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="/sambutan" class="{{ Request::is('sambutan') ? 'active' : '' }}">Sambutan Kepala Puskesmas</a></li>
                        <li><a href="/sejarah" class="{{ Request::is('sejarah') ? 'active' : '' }}">Profil Puskesmas</a></li>
                        <li><a href="/visi-misi" class="{{ Request::is('visi-misi') ? 'active' : '' }}">Visi & Misi</a></li>
                        <li><a href="/perangkat-desa" class="{{ Request::is('perangkat-desa') ? 'active' : '' }}">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <li class="dropdown {{ Request::is('pengumuman', 'berita', 'gallery', 'berkas') ? 'active' : '' }}">
                    <a href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="/berita" class="{{ Request::is('berita') ? 'active' : '' }}">Berita</a></li>
                        <li><a href="/pengumuman" class="{{ Request::is('pengumuman') ? 'active' : '' }}">Pengumuman</a></li>
                        <li><a href="/agenda" class="{{ Request::is('agenda') ? 'active' : '' }}">Agenda</a></li>
                        <li><a href="/gallery" class="{{ Request::is('gallery') ? 'active' : '' }}">Galeri</a></li>
                        <li><a href="/berkas" class="{{ Request::is('berkas') ? 'active' : '' }}">Berkas</a></li>
                    </ul>
                </li>

                <li class="dropdown {{ Request::is('layanan', 'alur-pelayanan') ? 'active' : '' }}">
                    <a href="#"><span>Layanan Kesehatan</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="/layanan" class="{{ Request::is('layanan') ? 'active' : '' }}">Jenis Layanan</a></li>
                        <li><a href="/alur-pelayanan" class="{{ Request::is('alur-pelayanan') ? 'active' : '' }}">Alur Pelayanan</a></li>
                    </ul>
                </li>

                <li><a class="nav-link scrollto {{ Request::is('kontak') ? 'active' : '' }}" href="/kontak"><span>Kontak</span></a></li>

                <li class="ms-4">
                    <a href="/login"
                        class="login-btn"
                        onmouseover="this.style.backgroundColor='#0d6efd'; this.style.color='white';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#0d6efd';">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                    </a>
                </li>
            </ul>

            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>