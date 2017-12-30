<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */

    /* private function seedUsers()
    {
    DB::table('users')->delete();
    DB::table('users')->truncate();
    $users = factory(App\User::class, 50)->create();
    } */

    public function run()
    {
        /* self::seedCatalog();
        $this->command->info('Tabla    catálogo inicializada con datos!');

        self::seedUsers();
        $this->command->info('Tabla usuarios inicializada con datos!'); */

        // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);
        // Movie seeder.
        $this->call(MovieTableSeeder::class);

    }
}
