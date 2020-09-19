<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Máximo Henrique',
            'email' => 'maximo@teste.com',
            'password' => bcrypt('123456'),
            'phone' => '(86)99999-9999',
            'master' => true
        ]);

        DB::table('sectors')->insert([
            'name' => 'Admin'
        ]);
        DB::table('sectors')->insert([
            'name' => 'Pessoal'
        ]);
        DB::table('sectors')->insert([
            'name' => 'Financeiro'
        ]);
        DB::table('sectors')->insert([
            'name' => 'Coordenação'
        ]);
    }
}
