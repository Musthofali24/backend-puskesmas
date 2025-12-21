<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => '10 Tips Menjaga Kesehatan di Musim Hujan',
                'category' => 'artikel-kesehatan',
                'excerpt' => 'Musim hujan sering membawa berbagai penyakit. Berikut adalah 10 tips untuk menjaga kesehatan Anda dan keluarga selama musim hujan.',
                'content' => '<h2>Pentingnya Menjaga Kesehatan di Musim Hujan</h2><p>Musim hujan memang menyegarkan, tetapi juga membawa berbagai tantangan kesehatan. Kelembaban tinggi dan suhu yang berubah-ubah dapat membuat tubuh rentan terhadap penyakit.</p><h3>1. Konsumsi Makanan Bergizi</h3><p>Pastikan Anda mengonsumsi makanan yang kaya akan vitamin C, seperti jeruk, pepaya, dan sayuran hijau. Vitamin C membantu meningkatkan sistem kekebalan tubuh.</p><h3>2. Jaga Kebersihan</h3><p>Cuci tangan dengan sabun secara teratur, terutama sebelum makan dan setelah beraktivitas.</p><h3>3. Minum Air Putih yang Cukup</h3><p>Jangan tunggu sampai haus. Minum air putih minimal 8 gelas per hari untuk menjaga tubuh tetap terhidrasi.</p>',
                'author' => 'Dr. Ahmad Setiawan',
                'read_time' => 5,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views_count' => 125,
            ],
            [
                'title' => 'Program Imunisasi Gratis untuk Balita',
                'category' => 'berita-kesehatan',
                'excerpt' => 'Puskesmas kami mengadakan program imunisasi gratis untuk balita setiap hari Senin dan Rabu. Jangan lewatkan kesempatan ini!',
                'content' => '<h2>Program Imunisasi Gratis</h2><p>Dalam rangka meningkatkan cakupan imunisasi di wilayah kami, Puskesmas mengadakan program imunisasi gratis untuk balita.</p><h3>Jadwal Pelayanan</h3><ul><li>Senin: 08.00 - 12.00 WIB</li><li>Rabu: 08.00 - 12.00 WIB</li></ul><h3>Jenis Imunisasi yang Tersedia</h3><ul><li>BCG</li><li>Hepatitis B</li><li>Polio</li><li>DPT</li><li>Campak</li></ul><p>Untuk informasi lebih lanjut, hubungi bagian informasi Puskesmas kami.</p>',
                'author' => 'Admin Puskesmas',
                'read_time' => 3,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views_count' => 87,
            ],
            [
                'title' => 'Pentingnya Deteksi Dini Diabetes',
                'category' => 'promosi-kesehatan',
                'excerpt' => 'Diabetes adalah penyakit yang dapat dicegah dan dikendalikan jika terdeteksi sejak dini. Yuk, kenali gejala dan cara pencegahannya!',
                'content' => '<h2>Mengenal Diabetes</h2><p>Diabetes mellitus adalah penyakit kronis yang terjadi ketika pankreas tidak menghasilkan cukup insulin atau ketika tubuh tidak dapat menggunakan insulin yang dihasilkan secara efektif.</p><h3>Gejala Diabetes</h3><ul><li>Sering merasa haus</li><li>Sering buang air kecil</li><li>Mudah lelah</li><li>Luka yang sulit sembuh</li><li>Penglihatan kabur</li></ul><h3>Cara Pencegahan</h3><p>1. Menjaga berat badan ideal<br>2. Olahraga teratur<br>3. Konsumsi makanan sehat<br>4. Hindari stres<br>5. Cek gula darah secara rutin</p>',
                'author' => 'Dr. Siti Nurhaliza',
                'read_time' => 7,
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'views_count' => 203,
            ],
            [
                'title' => 'Kegiatan Senam Sehat Bersama Lansia',
                'category' => 'kegiatan-puskesmas',
                'excerpt' => 'Senam sehat untuk lansia diadakan setiap Jumat pagi di halaman Puskesmas. Gratis untuk semua peserta!',
                'content' => '<h2>Senam Sehat untuk Lansia</h2><p>Puskesmas kami rutin mengadakan kegiatan senam sehat khusus untuk para lansia setiap hari Jumat pagi.</p><h3>Detail Kegiatan</h3><p><strong>Hari/Tanggal:</strong> Setiap Jumat<br><strong>Waktu:</strong> 06.30 - 07.30 WIB<br><strong>Tempat:</strong> Halaman Puskesmas<br><strong>Biaya:</strong> GRATIS</p><h3>Manfaat Senam untuk Lansia</h3><ul><li>Meningkatkan kesehatan jantung</li><li>Menjaga kelenturan sendi</li><li>Meningkatkan keseimbangan tubuh</li><li>Mengurangi risiko osteoporosis</li><li>Meningkatkan kualitas tidur</li></ul><p>Ayo ajak orang tua dan kakek nenek Anda untuk bergabung!</p>',
                'author' => 'Admin Puskesmas',
                'read_time' => 4,
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'views_count' => 156,
            ],
            [
                'title' => 'Mengenal Lebih Dekat Gizi Seimbang',
                'category' => 'artikel-kesehatan',
                'excerpt' => 'Gizi seimbang adalah kunci hidup sehat. Mari kita pelajari apa itu gizi seimbang dan bagaimana menerapkannya dalam kehidupan sehari-hari.',
                'content' => '<h2>Apa itu Gizi Seimbang?</h2><p>Gizi seimbang adalah susunan makanan sehari-hari yang mengandung zat gizi dalam jenis dan jumlah yang sesuai dengan kebutuhan tubuh.</p><h3>Prinsip Gizi Seimbang</h3><ol><li>Mengonsumsi makanan yang beragam</li><li>Membiasakan perilaku hidup bersih</li><li>Melakukan aktivitas fisik</li><li>Memantau berat badan secara teratur</li></ol><h3>Piring Makan Sehat</h3><p>Dalam satu porsi makan, komposisi ideal adalah:<br>- 50% sayur dan buah<br>- 25% karbohidrat<br>- 25% protein<br>- Ditambah air putih yang cukup</p>',
                'author' => 'Ahli Gizi Puskesmas',
                'read_time' => 6,
                'is_published' => false,
                'published_at' => null,
                'views_count' => 0,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
