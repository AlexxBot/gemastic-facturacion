<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('secret'),
            'Estado' => '1',
            'Id_Perfil' => '1', //foreign key 'perfiles'
            'Id_Negocio' => '1', //foreign key 'negocios'
            'UrlImagen' => 'www.admin1.com',
            'ID_Usuario' => '1',
        ]);
    }
}
