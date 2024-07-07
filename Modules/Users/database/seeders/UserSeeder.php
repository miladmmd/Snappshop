<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $numberOfUsers = 10;

        $users = [];
        for ($i = 0; $i < $numberOfUsers; $i++) {
            $users[] = [
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'mobile' => $this->generateUniqueMobileNumber(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users);
    }

    protected function generateUniqueMobileNumber()
    {
        $mobile = '98912' . rand(1000000, 9999999);

        while (DB::table('users')->where('mobile', $mobile)->exists()) {
            $mobile = '98912' . rand(1000000, 9999999);
        }

        return $mobile;
    }


}
