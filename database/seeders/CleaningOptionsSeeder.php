<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CleaningOptionsSeeder extends Seeder
{
    /**
     * Seed the cleaning_options table.
     *
     * @return void
     */
    public function run()
    {
        // Insert sample data into the cleaning_options table
        DB::table('cleaning_options')->insert([
            [
                'form_field_id' => 18, // Assuming a form_field_id of 1 exists
                'name' => 'Option 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'form_field_id' => 18, // Assuming a form_field_id of 1 exists
                'name' => 'Option 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'form_field_id' => 22, // Assuming a form_field_id of 2 exists
                'name' => 'Option 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
