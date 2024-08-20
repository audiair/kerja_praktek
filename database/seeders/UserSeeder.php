<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     [
        //         'name' => 'admin1',
        //         'email' => 'admin@gmail.com',
        //         'password' => Hash::make('password'),
        //     ]
        // ]);

        $faker = Faker::create('id_ID');

        for ($i=0; $i < 30; $i++) { 
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make($faker->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
