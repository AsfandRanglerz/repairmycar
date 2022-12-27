<?php

namespace Database\Seeders;

use App\Models\ChildCategory;
use Illuminate\Database\Seeder;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChildCategory::factory()->times(20)->create();
    }
}
