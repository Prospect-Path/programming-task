<?php

use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $markets = \App\Market::all();

        $leadData = [
            [
                'company_name' => 'Electron',
                'market_id' => $markets->where('name', 'HRMS')->first()->id,
                'description' => 'Electron are looking for a new HRMS system to help them to manage their company.',
                'number_of_employees' => 100,
                'revenue' => '100000',
                'cloud' => true,
            ],
            [
                'company_name' => 'Equinox',
                'market_id' => $markets->where('name', 'ERP')->first()->id,
                'description' => 'Equinox are looking for a new ERP system to help them to manage their company.',
                'number_of_employees' => 135,
                'revenue' => '200000',
                'cloud' => false,
            ],
        ];

        collect($leadData)->each(function ($data) {
            \App\Leads\Lead::create($data);
        });
    }
}
