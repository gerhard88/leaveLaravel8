<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create(
          [
              "name"        => "Testing",
              "surname"     => "Testing",
              "email"       => "testing@testing.co.za",
              "password"    => bcrypt('password'),
              "role_id"     => 01,
              "company_id"  => 01,
              "createRole"  => "Y",
              "updateRole"  => "Y",
              "deleteRole"  => "Y",
              "addUser"     => "Y",
              "updateUser"  => "Y",
              "deleteUser"  => "Y",
              "settings"    => "Y",
          ]
        );
    }
}
