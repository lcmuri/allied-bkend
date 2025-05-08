<?php

namespace Modules\Medicine\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: If table exists and has data don' write to database
        // $this->call([
        //     DoseFormSeeder::class,
        //     CategorySeeder::class
        // ]);
        if (DB::table('dose_forms')->count() === 0) {
            $this->call(DoseFormSeeder::class);
        }

        if (DB::table('categories')->count() === 0) {
            $this->call(CategorySeeder::class);
        }
    }
}
