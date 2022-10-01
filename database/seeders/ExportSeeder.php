<?php

namespace Database\Seeders;

use App\Models\Export;
use Illuminate\Database\Seeder;

class ExportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Export::factory()->count(5)->create();
    }
}
