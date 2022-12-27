<?php

namespace Database\Seeders;

use App\Models\PaymentPercentage;
use Illuminate\Database\Seeder;

class PercentageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentPercentage::create([
            'id' => '1',
            'type' => 'withdraw',
            'percentage' => '20',
        ],
        [
            'id' => '2',
            'type' => 'order',
            'percentage' => '30',
        ],
        [
            'id' => '3',
            'type' => 'vat',
            'percentage' => '5',
        ]);
    }
    
}
