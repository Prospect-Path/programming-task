<?php

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markets = \App\Market::all();

        $vendorData = [
            [
                'name' => 'HRMSSoft',
                'active' => true,
                'market_id' => $markets->where('name', 'HRMS')->first()->id,
            ],
            [
                'name' => 'ERPSoft',
                'active' => false,
                'market_id' => $markets->where('name', 'ERP')->first()->id,
            ],
        ];

        collect($vendorData)->each(function ($data) {
            \App\Vendor::create($data);
        });
    }
}
