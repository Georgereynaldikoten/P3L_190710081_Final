<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users = [
        [
            'id' => 1,
            'name' => 'adminnyoba',
            'level' => 'admin',
            'email' => 'adminku@localhost',
            'password' => bcrypt('admin'),
            'updated_at' => '2021-05-04 00:19:06',
            'created_at' => '2021-05-04 00:19:06',
        ],
        [
            'id' => 2,
            'name' => 'cashier',
            'level' => 'cashier',
            'email' => 'cashierku@localhost',
            'password' => bcrypt('cashier'),
            'updated_at' => '2021-05-04 00:19:06',
            'created_at' => '2021-05-04 00:19:06',
        ],
        [
            'id' => 3,
            'name' => 'manager',
            'level' => 'manager',
            'email' => 'managerku@localhost',
            'password' => bcrypt('manager'),
            'updated_at' => '2021-05-04 00:19:06',
            'created_at' => '2021-05-04 00:19:06',
        ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
