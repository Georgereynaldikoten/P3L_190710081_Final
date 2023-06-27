<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $employees = [
        [
            'id' => 1,
            'id_role' => 1,
            'id_user' => 1,
            'employee_name' => 'adminnyoba',
            'employee_addreess' => 'Jl. Admin No V',
            'employee_gender' => 'pria',
            'employee_phone_number' => '081234567890',
            'employee_birth_date' => '2000-01-01',
            'employee_email' => 'adminku@localhost',
            'employee_password' => bcrypt('admin'),
            'updated_at' => '2021-05-04 00:19:06',
            'created_at' => '2021-05-04 00:19:06',
        ],
        [
            // make for cashier
            'id' => 2,
            'id_role' => 2,
            'id_user' => 2,
            'employee_name' => 'cashier',
            'employee_addreess' => 'Jl. Cashier No V',
            'employee_gender' => 'pria',
            'employee_phone_number' => '081234567890',
            'employee_birth_date' => '2000-01-01',
            'employee_email' => 'cashierku@localhost',
            'employee_password' => bcrypt('cashier'),
            'updated_at' => '2021-05-04 00:19:06',
            'created_at' => '2021-05-04 00:19:06',
        ],
        [
            //make for manager
            'id' => 3,
            'id_role' => 3,
            'id_user' => 3,
            'employee_name' => 'manager',
            'employee_addreess' => 'Jl. Manager No V',
            'employee_gender' => 'wanita',
            'employee_phone_number' => '081234567890',
            'employee_birth_date' => '2000-01-01',
            'employee_email' => 'managerku@localhost',
            'employee_password' => bcrypt('manager'),
            'updated_at' => '2021-05-04 00:19:06',
            'created_at' => '2021-05-04 00:19:06',
        ],
    ];

    }
}
