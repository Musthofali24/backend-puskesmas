<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staffData = [
            [
                'name' => 'Bidan Dewi Kurniasih, Amd.Keb',
                'specialty' => 'Pelayanan KIA - KB',
                'description' => 'Berpengalaman dalam pemeriksaan ibu hamil, nifas, dan bayi baru lahir, serta pelayanan keluarga berencana.',
                'color' => 'bg-teal-500',
                'phone' => '081234567801',
                'email' => 'dewi.kurniasih@puskesmas.id',
                'whatsapp' => '081234567801',
                'instagram' => '@dewi_bidan',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Etih Kusniawati, Amd.Keb',
                'specialty' => 'Pelayanan KIA - KB',
                'description' => 'Berpengalaman dalam pemeriksaan ibu hamil, nifas, dan bayi baru lahir, serta pelayanan keluarga berencana.',
                'color' => 'bg-pink-400',
                'phone' => '081234567802',
                'email' => 'etih.kusniawati@puskesmas.id',
                'whatsapp' => '081234567802',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'drg. Raden Syefti Febriana',
                'specialty' => 'Pelayanan Gigi & Mulut',
                'description' => 'Dokter gigi berpengalaman dalam perawatan gigi dan mulut untuk seluruh keluarga.',
                'color' => 'bg-sky-400',
                'phone' => '081234567803',
                'email' => 'syefti.febriana@puskesmas.id',
                'whatsapp' => '081234567803',
                'instagram' => '@drg_syefti',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'dr. Ahmad Fauzi, Sp.PD',
                'specialty' => 'Dokter Spesialis Penyakit Dalam',
                'description' => 'Menangani berbagai penyakit dalam seperti diabetes, hipertensi, dan penyakit jantung dengan profesional.',
                'color' => 'bg-teal-500',
                'phone' => '081234567804',
                'email' => 'ahmad.fauzi@puskesmas.id',
                'whatsapp' => '081234567804',
                'linkedin' => 'https://linkedin.com/in/ahmad-fauzi',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'dr. Siti Nurhaliza, Sp.A',
                'specialty' => 'Dokter Spesialis Anak',
                'description' => 'Ahli dalam perawatan kesehatan anak dari bayi hingga remaja dengan pendekatan ramah anak.',
                'color' => 'bg-pink-400',
                'phone' => '081234567805',
                'email' => 'siti.nurhaliza@puskesmas.id',
                'whatsapp' => '081234567805',
                'instagram' => '@dr_siti_spa',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'dr. Budi Santoso, Sp.OG',
                'specialty' => 'Dokter Spesialis Kandungan',
                'description' => 'Spesialis dalam kesehatan reproduksi wanita, kehamilan, dan persalinan dengan pengalaman luas.',
                'color' => 'bg-sky-400',
                'phone' => '081234567806',
                'email' => 'budi.santoso@puskesmas.id',
                'whatsapp' => '081234567806',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'dr. Rina Susanti, Sp.M',
                'specialty' => 'Dokter Spesialis Mata',
                'description' => 'Menangani berbagai keluhan mata seperti katarak, glaukoma, dan gangguan penglihatan lainnya.',
                'color' => 'bg-teal-500',
                'phone' => '081234567807',
                'email' => 'rina.susanti@puskesmas.id',
                'whatsapp' => '081234567807',
                'facebook' => 'https://facebook.com/dr.rina.susanti',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Ns. Lilis Suryani, S.Kep',
                'specialty' => 'Perawat Profesional',
                'description' => 'Perawat berpengalaman dalam memberikan asuhan keperawatan berkualitas untuk semua pasien.',
                'color' => 'bg-pink-400',
                'phone' => '081234567808',
                'email' => 'lilis.suryani@puskesmas.id',
                'whatsapp' => '081234567808',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'dr. Hendra Wijaya',
                'specialty' => 'Dokter Umum',
                'description' => 'Melayani pemeriksaan kesehatan umum, konsultasi medis, dan penanganan penyakit ringan hingga sedang.',
                'color' => 'bg-sky-400',
                'phone' => '081234567809',
                'email' => 'hendra.wijaya@puskesmas.id',
                'whatsapp' => '081234567809',
                'instagram' => '@dr_hendra',
                'twitter' => '@dr_hendra_wijaya',
                'is_active' => true,
                'order' => 9,
            ],
        ];

        foreach ($staffData as $data) {
            Staff::create($data);
        }
    }
}
