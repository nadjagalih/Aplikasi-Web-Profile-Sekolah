<style>
  #footer {
    background: #0F8A4C !important;
    padding: 0 0 30px 0 !important;
  }

  #footer .footer-top {
    background: #0F8A4C !important;
    border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding: 60px 0 30px 0 !important;
  }

  #footer .container {
    max-width: 1320px !important;
    margin: 0 auto !important;
  }

  #footer .footer-info h3 {
    color: white !important;
    font-size: 24px !important;
    margin: 0 0 20px 0 !important;
    font-weight: 700 !important;
  }

  #footer .footer-info p {
    color: rgba(255, 255, 255, 0.9) !important;
    font-size: 14px !important;
    line-height: 24px !important;
  }

  #footer .footer-links h4 {
    color: white !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    margin-bottom: 15px !important;
  }

  #footer .footer-links ul {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
  }

  #footer .footer-links ul li {
    padding: 5px 0 !important;
  }

  #footer .footer-links ul li a {
    color: rgba(255, 255, 255, 0.85) !important;
    text-decoration: none !important;
    transition: 0.3s !important;
  }

  #footer .footer-links ul li a:hover {
    color: white !important;
    padding-left: 5px !important;
  }

  #footer .footer-links ul li i {
    color: rgba(255, 255, 255, 0.7) !important;
    font-size: 12px !important;
    margin-right: 8px !important;
  }

  #footer .copyright {
    color: rgba(255, 255, 255, 0.9) !important;
    border-top: 1px solid rgba(255, 255, 255, 0.2) !important;
    padding-top: 30px !important;
    text-align: center !important;
    font-size: 14px !important;
  }
</style>

<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-4 col-md-6 footer-info">
          <img src="{{ asset('storage/' . $logo->logo) }}" class="mb-2" alt="Logo" width="250">
          <h3>{{ $nm_puskesmas }}</h3>
          <p>
            Kecamatan {{ $kecamatan }}, Kabupaten {{ $kabupaten }}, <br> Provinsi {{ $provinsi }}, Kode Pos {{ $kode_pos }}<br><br>
            <strong>Nomor HP :</strong> {{ $no_hp }}<br>
            <strong>Email :</strong> {{ $email }}<br>
          </p>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Menu Utama</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="/">Beranda</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/kontak">Kontak</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Informasi</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="/berita">Berita</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/pengumuman">Pengumuman</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/agenda">Agenda</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/gallery">Galeri</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/berkas">Berkas</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Profil & Layanan</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="/sambutan">Sambutan</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/profil">Profil Puskesmas</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/visi-misi">Visi & Misi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/struktur-organisasi">Struktur Organisasi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/layanan">Jenis Layanan</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="/alur-pelayanan">Alur Pelayanan</a></li>
          </ul>
        </div>


      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      <strong>2025 &copy;</strong> Dinas Komunikasi dan Informatika Kab. Trenggalek &nbsp;
      |&nbsp; Created by: Interns from Brawijaya University and State University of Surabaya</a>
    </div>
  </div>
</footer><!-- End Footer -->