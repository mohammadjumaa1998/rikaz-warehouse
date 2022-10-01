<?php

namespace Database\Seeders;

use App\Models\Emport;
use Illuminate\Database\Seeder;

class EmportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Emport::factory()->count(5)->create();
    }
}
