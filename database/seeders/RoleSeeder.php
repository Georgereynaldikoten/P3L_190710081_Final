<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'role_name' => 'admin',
                'redirect_to' => '/BerandaAdmin',
            ],
            [
                'id' => 2,
                'role_name'=> 'cashier',
                'redirect_to' => '/BerandaCashier',
            ],
            [
                'id' => 3,
                'role_name' => 'manager',
                'redirect_to' => '/BerandaManager',
            ],
            
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
