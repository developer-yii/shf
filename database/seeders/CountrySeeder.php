<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = database_path('countries.sql');
        $sql = File::get($filePath);

        // Execute the SQL query
        DB::statement($sql);

        \Log::info('SQL file executed successfully.');
    }
}
