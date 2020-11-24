<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $roleAdmin = Role::create([
            'name' => 'Manager'
        ]);

        $roleUser = Role::create([
            'name' => 'Customer'
        ]);
        
        $userAdmin = User::create ([
            'username' => "reynaldodev",
            'email' => "rey@manager.com",
            'password' => bcrypt('admin'),
            'address' => "-",
            'gender' => "M",
            'dob' => "2000/03/22"
        ]);

        $userAdmin->roles()->attach($roleAdmin->id);
        // $this->call(UserSeeder::class);
    }
}
