<?php

/**
* Agregamos un usuario nuevo a la base de datos.
*/
class UsersTableSeeder extends Seeder {
    public function run(){
        User::create(array(
            'usuario'  => 'admin',
            'email'     => 'admin@admin.com',
            'nombre'=> 'Administrator',
            'password' => Hash::make('admin') // Hash::make() nos va generar una cadena con nuestra contraseña encriptada
        ));
    }
}