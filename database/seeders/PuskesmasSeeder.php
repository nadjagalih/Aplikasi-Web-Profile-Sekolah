<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PuskesmasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Poliklinik
        DB::table('poliklinik')->insert([
            [
                'nama_poliklinik' => 'Poliklinik Umum',
                'deskripsi' => 'Poliklinik umum memberikan pelayanan kesehatan dasar untuk berbagai keluhan kesehatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Gigi',
                'deskripsi' => 'Poliklinik gigi memberikan pelayanan kesehatan gigi dan mulut',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poliklinik' => 'Poliklinik KIA (Kesehatan Ibu dan Anak)',
                'deskripsi' => 'Poliklinik KIA memberikan pelayanan kesehatan untuk ibu hamil, ibu menyusui, dan anak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_poliklinik' => 'Poliklinik Gizi',
                'deskripsi' => 'Poliklinik gizi memberikan konsultasi dan pelayanan terkait gizi dan nutrisi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Layanan Kesehatan
        DB::table('layanan_kesehatan')->insert([
            [
                'nama_layanan' => 'Pemeriksaan Kesehatan Umum',
                'slug' => 'pemeriksaan-kesehatan-umum',
                'deskripsi' => 'Pelayanan pemeriksaan kesehatan umum untuk berbagai keluhan penyakit',
                'biaya' => 'Gratis dengan BPJS',
                'persyaratan' => 'KTP, Kartu Keluarga, Kartu BPJS (jika ada)',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Imunisasi',
                'slug' => 'imunisasi',
                'deskripsi' => 'Pelayanan imunisasi untuk bayi dan anak',
                'biaya' => 'Gratis',
                'persyaratan' => 'KTP, Kartu Keluarga, Buku KIA',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Pemeriksaan Ibu Hamil (ANC)',
                'slug' => 'pemeriksaan-ibu-hamil',
                'deskripsi' => 'Pelayanan pemeriksaan kehamilan dan konsultasi untuk ibu hamil',
                'biaya' => 'Gratis',
                'persyaratan' => 'KTP, Kartu Keluarga, Buku KIA',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'KB (Keluarga Berencana)',
                'slug' => 'keluarga-berencana',
                'deskripsi' => 'Pelayanan konsultasi dan pemasangan alat kontrasepsi',
                'biaya' => 'Gratis dengan BPJS',
                'persyaratan' => 'KTP, Kartu Keluarga, Kartu BPJS',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Pemeriksaan Laboratorium',
                'slug' => 'pemeriksaan-laboratorium',
                'deskripsi' => 'Pelayanan pemeriksaan laboratorium seperti cek darah, urine, dll',
                'biaya' => 'Sesuai jenis pemeriksaan',
                'persyaratan' => 'KTP, Rujukan dokter',
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Sambutan
        DB::table('sambutan')->insert([
            'jabatan' => 'Kepala Puskesmas',
            'nama' => 'dr. Ahmad Hidayat',
            'isi_sambutan' => 'Dengan memanjatkan puji syukur kehadirat Allah SWT, kami sampaikan selamat datang di website resmi Puskesmas yang merupakan Organisasi Perangkat Daerah (OPD) Pemerintah Daerah. Website ini bertujuan sebagai sarana publikasi pelaksanaaan kegiatan di Puskesmas dan media informasi untuk masyarakat sebagai bahan evaluasi dalam rangka mewujudkan good governance yang siap menjamin transparansi, efisiensi dan efektivitas penyelenggaraan pemerintahan melalui Teknologi Informasi dan Komunikasi (TIK). Oleh karena itu, kritik dan saran yang positif dan membangun sangat kami harapkan untuk perbaikan pelayanan guna membangun daerah ke arah yang lebih baik dan berkembang sebagaimana harapan kita bersama.',
            'tempat' => 'Puskesmas',
            'tanggal' => now(),
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Survei Kepuasan Masyarakat
        DB::table('survei_kepuasan_masyarakat')->insert([
            'nama_survei' => 'Survei Kepuasan Masyarakat Triwulan 1 2025',
            'periode' => 'Triwulan 1 Tahun 2025',
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai' => '2025-03-31',
            'nilai_skm' => 95.50,
            'predikat' => 'Sangat Baik (A)',
            'keterangan' => 'Survei Kepuasan Masyarakat periode Januari - Maret 2025',
            'total_responden' => 0,
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
