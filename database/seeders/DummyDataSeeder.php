<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dummy_datas')->insert([
            [
                'nik' => '3171010101900001',
                'phone' => '6285848186286',
                'mother_name' => 'Siti Aminah',
                'kode_desa' => 3302032002
            ],
            [
                'nik' => '3201020202950002',
                'phone' => '6283104788904',
                'mother_name' => 'Dewi Lestari',
                'kode_desa' => 3302032002
            ],
            [
                'nik' => '3578030303880003',
                'phone' => '6285842643497',
                'mother_name' => 'Sri Wahyuni',
                'kode_desa' => 3302032002
            ],
            [
                'nik' => '5171040404990004',
                'phone' => '804567890123',
                'mother_name' => 'Rina Hartati',
                'kode_desa' => 3302261006
            ],
            [
                'nik' => '6271050505000005',
                'phone' => '805678901234',
                'mother_name' => 'Indah Permatasari',
                'kode_desa' => 3302261006
            ],
        ]);
        DB::table('dummy_jobs')->insert([
            [
                'name' => 'BELUM/TIDAK BEKERJA'
            ],
            [
                'name' => 'MENGURUS RUMAH TANGGA'
            ],
            [
                'name' => 'PELAJAR/MAHASISWA'
            ],
            [
                'name' => 'PENSIUNAN'
            ],
            [
                'name' => 'PEGAWAI NEGERI SIPIL (PNS)'
            ],
            [
                'name' => 'TENTARA NASIONAL INDONESIA (TNI)'
            ],
            [
                'name' => 'KEPOLISIAN RI (POLRI)'
            ],
            [
                'name' => 'PERDAGANGAN'
            ],
            [
                'name' => 'PETANI/PEKEBUN'
            ],
            [
                'name' => 'PETERNAK'
            ],
            [
                'name' => 'NELAYAN/PERIKANAN'
            ],
            [
                'name' => 'INDUSTRI'
            ],
            [
                'name' => 'KONSTRUKSI'
            ],
            [
                'name' => 'TRANSPORTASI'
            ],
            [
                'name' => 'KARYAWAN SWASTA'
            ],
            [
                'name' => 'KARYAWAN BUMN'
            ],
            [
                'name' => 'KARYAWAN BUMD'
            ],
            [
                'name' => 'KARYAWAN HONORER'
            ],
            [
                'name' => 'BURUH HARIAN LEPAS'
            ],
            [
                'name' => 'BURUH TANI/PERKEBUNAN'
            ],
            [
                'name' => 'BURUH NELAYAN/PERIKANAN'
            ],
            [
                'name' => 'BURUH PETERNAKAN'
            ],
            [
                'name' => 'PEMBANTU RUMAH TANGGA'
            ],
            [
                'name' => 'TUKANG CUKUR'
            ],
            [
                'name' => 'TUKANG LISTRIK'
            ],
            [
                'name' => 'TUKANG BATU'
            ],
            [
                'name' => 'TUKANG KAYU'
            ],
            [
                'name' => 'TUKANG SOL SEPATU'
            ],
            [
                'name' => 'TUKANG LAS/PANDAI BESI'
            ],
            [
                'name' => 'TUKANG JAHIT'
            ],
            [
                'name' => 'TUKANG GIGI'
            ],
            [
                'name' => 'PENATA RIAS'
            ],
            [
                'name' => 'PENATA BUSANA'
            ],
            [
                'name' => 'PENATA RAMBUT'
            ],
            [
                'name' => 'MEKANIK'
            ],
            [
                'name' => 'SENIMAN'
            ],
            [
                'name' => 'TABIB'
            ],
            [
                'name' => 'PARAJI'
            ],
            [
                'name' => 'PERANCANG BUSANA'
            ],
            [
                'name' => 'PENTERJEMAH'
            ],
            [
                'name' => 'IMAM MASJID'
            ],
            [
                'name' => 'PENDETA'
            ],
            [
                'name' => 'PASTOR'
            ],
            [
                'name' => 'WARTAWAN'
            ],
            [
                'name' => 'USTADZ/MUBALIGH'
            ],
            [
                'name' => 'JURU MASAK'
            ],
            [
                'name' => 'PROMOTOR ACARA'
            ],
            [
                'name' => 'ANGGOTA DPR-RI'
            ],
            [
                'name' => 'ANGGOTA DPD'
            ],
            [
                'name' => 'ANGGOTA BPK'
            ],
            [
                'name' => 'PRESIDEN'
            ],
            [
                'name' => 'WAKIL PRESIDEN'
            ],
            [
                'name' => 'ANGGOTA MAHKAMAH KONSTITUSI'
            ],
            [
                'name' => 'ANGGOTA MENTERI KABINET'
            ],
            [
                'name' => 'DUTA BESAR'
            ],
            [
                'name' => 'GUBERNUR'
            ],
            [
                'name' => 'WAKIL GUBERNUR'
            ],
            [
                'name' => 'BUPATI'
            ],
            [
                'name' => 'WAKIL BUPATI'
            ],
            [
                'name' => 'WALIKOTA'
            ],
            [
                'name' => 'WAKIL WALIKOTA'
            ],
            [
                'name' => 'ANGGOTA DPRD PROVINSI'
            ],
            [
                'name' => 'ANGGOTA DPRD KABUPATEN/KOTA'
            ],
            [
                'name' => 'DOSEN'
            ],
            [
                'name' => 'GURU'
            ],
            [
                'name' => 'PILOT'
            ],
            [
                'name' => 'PENGACARA'
            ],
            [
                'name' => 'NOTARIS'
            ],
            [
                'name' => 'ARSITEK'
            ],
            [
                'name' => 'AKUNTAN'
            ],
            [
                'name' => 'KONSULTAN'
            ],
            [
                'name' => 'DOKTER'
            ],
            [
                'name' => 'BIDAN'
            ],
            [
                'name' => 'PERAWAT'
            ],
            [
                'name' => 'APOTEKER'
            ],
            [
                'name' => 'PSIKIATER/PSIKOLOG'
            ],
            [
                'name' => 'PENYIAR TELEVISI'
            ],
            [
                'name' => 'PENYIAR RADIO'
            ],
            [
                'name' => 'PELAUT'
            ],
            [
                'name' => 'PENELITI'
            ],
            [
                'name' => 'SOPIR'
            ],
            [
                'name' => 'PIALANG'
            ],
            [
                'name' => 'PARANORMAL'
            ],
            [
                'name' => 'PEDAGANG'
            ],
            [
                'name' => 'PERANGKAT DESA'
            ],
            [
                'name' => 'KEPALA DESA'
            ],
            [
                'name' => 'BIARAWATI'
            ],
            [
                'name' => 'WIRASWASTA'
            ],
        ]);
        DB::table('dummy_educations')->insert([
            [
                'name' => 'BELUM MASUK TK/KELOMPOK BERMAIN'
            ],
            [
                'name' => 'SEDANG TK/KELOMPOK BERMAIN'
            ],
            [
                'name' => 'TIDAK PERNAH SEKOLAH'
            ],
            [
                'name' => 'SEDANG SD/SEDERAJAT'
            ],
            [
                'name' => 'TIDAK TAMAT SD/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG SLTP/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG SLTA/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG D-1/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG D-2/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG D-3/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG S-1/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG S-2/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG S-3/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG SLB A/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG SLB B/SEDERAJAT'
            ],
            [
                'name' => 'SEDANG SLB C/SEDERAJAT'
            ],
            [
                'name' => 'TIDAK DAPAT MEMBACA/MENULIS HURUF LATIN/ARAB'
            ],
            [
                'name' => 'TIDAK SEDANG SEKOLAH'
            ]
        ]);
    }
}
