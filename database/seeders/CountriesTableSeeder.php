<?php

namespace Database\Seeders;
use App\Models\Country;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            'India',
            'Japan',
            'Germany',
            'France',
            'China'          
         ];

        foreach ($countries as $country) {
            Country::create(['name' => $country]);
        }
    }
}
