<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Employee::truncate();
        Leave::truncate();

        $csvFile = fopen(base_path("database/data/employees.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Employee::create([
                    'nomor_induk' => $data[1],
                    'nama' => $data[2],
                    'alamat' => $data[3],
                    'tanggal_lahir' => $data[4],
                    'tanggal_masuk' => $data[5],
                ]);
            }
            $firstline = false;
        }

        $csvFile = fopen(base_path("database/data/leaves.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Leave::create([
                    'nomor_induk' => $data[1],
                    'tanggal_cuti' => $data[2],
                    'lama_cuti' => $data[3],
                    'keterangan' => $data[4],
                ]);
            }
            $firstline = false;
        }
    }
}
