<?php

namespace Modules\Medicine\Database\Seeders;

use Illuminate\Database\Seeder;

class MedicineDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: If table exists and has data don' write to database
        $this->call([
            DoseFormSeeder::class,
            CategorySeeder::class
        ]);
    }
}
