<?php

use App\Market;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marketData = [
            [
                'name' => 'ERP',
            ],
            [
                'name' => 'HRMS',
            ],
        ];

        collect($marketData)->each(function ($data) {
            Market::create($data);
        });
    }
}
