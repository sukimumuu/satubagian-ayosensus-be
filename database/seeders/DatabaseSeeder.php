<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\VillageSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\SubdistrictSeeder;
use Database\Seeders\RoleAndPermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([RoleAndPermissionSeeder::class, SubdistrictSeeder::class, VillageSeeder::class]);
        $superadmin = User::create([
                        'name' => 'superadmin',
                        'password' => Hash::make('password'),
                      ]);
        $superadmin->assignRole('superadmin');
    }
}
