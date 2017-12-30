<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->truncate();
        $role_client = Role::where('name', 'client')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $client = new User();
        $client->name = 'Client Name';
        $client->email = 'client@videoclub.com';
        $client->password = bcrypt('secret');
        $client->save();
        $client->roles()->attach($role_client);

        $admin = new User();
        $admin->name = 'Angel';
        $admin->email = 'admin@videoclub.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
