<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendors = \App\Vendor::all();

        $userData = [
            [
                'name' => 'Jack',
                'email' => 'jack@example.com',
                'password' => bcrypt('password'),
                'vendor_id' => $vendors->where('name', 'HRMSSoft')->first()->id,
                'api_token' => 'hrms',
            ],
            [
                'name' => 'Jess',
                'email' => 'jess@example.com',
                'password' => bcrypt('password'),
                'vendor_id' => $vendors->where('name', 'ERPSoft')->first()->id,
                'api_token' => 'erp',
            ],
        ];

        collect($userData)->each(function ($data) {
            \App\User::create($data);
        });
    }
}
