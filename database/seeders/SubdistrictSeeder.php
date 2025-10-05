<?php

namespace Database\Seeders;

use App\Models\Subdistrict;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [
                    ['kode' => 330201, 'name' => 'Lumbir'],
                    ['kode' => 330202, 'name' => 'Wangon'],
                    ['kode' => 330203, 'name' => 'Jatilawang'],
                    ['kode' => 330204, 'name' => 'Rawalo'],
                    ['kode' => 330205, 'name' => 'Kebasen'],
                    ['kode' => 330206, 'name' => 'Kemranjen'],
                    ['kode' => 330207, 'name' => 'Sumpiuh'],
                    ['kode' => 330208, 'name' => 'Tambak'],
                    ['kode' => 330209, 'name' => 'Somagede'],
                    ['kode' => 330210, 'name' => 'Kalibagor'],
                    ['kode' => 330211, 'name' => 'Banyumas'],
                    ['kode' => 330212, 'name' => 'Patikraja'],
                    ['kode' => 330213, 'name' => 'Purwojati'],
                    ['kode' => 330214, 'name' => 'Ajibarang'],
                    ['kode' => 330215, 'name' => 'Gumelar'],
                    ['kode' => 330216, 'name' => 'Pekuncen'],
                    ['kode' => 330217, 'name' => 'Cilongok'],
                    ['kode' => 330218, 'name' => 'Karanglewas'],
                    ['kode' => 330219, 'name' => 'Sokaraja'],
                    ['kode' => 330220, 'name' => 'Kembaran'],
                    ['kode' => 330221, 'name' => 'Sumbang'],
                    ['kode' => 330222, 'name' => 'Baturraden'],
                    ['kode' => 330223, 'name' => 'Kedungbanteng'],
                    ['kode' => 330224, 'name' => 'Purwokerto Selatan'],
                    ['kode' => 330225, 'name' => 'Purwokerto Barat'],
                    ['kode' => 330226, 'name' => 'Purwokerto Timur'],
                    ['kode' => 330227, 'name' => 'Purwokerto Utara'],
                ];

        foreach ($list as $item) {
            Subdistrict::create($item);
        }
    }
}
