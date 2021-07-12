<?php

namespace Kwreach\Ads\database\seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('App\Advertiser');

        for($i = 1 ; $i <= 50 ; $i++){
            DB::table('advertisers')->insert([
                'full_name' => $faker->firstName.' '. $faker->lastName,
                'email' => $faker->email(),
                'phone_number' => $faker->phoneNumber(),
                'created_at' => \Carbon\Carbon::now(),
                'Updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
