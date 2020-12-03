<?php

use Illuminate\Database\Seeder;

class UsuarioTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuario')->insert([
            'Nombre' => 'Admin',
            'Apellido' => 'Administrador',
            'Correo' => 'admin@gestion-upt.com',
            'password' => bcrypt('admin'),
            'TipoUsuarioId' => 1
        ]);

        DB::table('usuario')->insert([
            'Nombre' => 'Diego',
            'Apellido' => 'Layme',
            'Correo' => 'diego@gmail.com',
            'password' => bcrypt('gestion'),
            'TipoUsuarioId' => 2
        ]);

        DB::table('usuario')->insert([
            'Nombre' => 'Yonathan',
            'Apellido' => 'Mamani',
            'Correo' => 'yonathan@gmail.com',
            'password' => bcrypt('gestion'),
            'TipoUsuarioId' => 3
        ]);

        DB::table('usuario')->insert([
            'Nombre' => 'Angel',
            'Apellido' => 'Gonzales',
            'Correo' => 'gonzales@gmail.com',
            'password' => bcrypt('gestion'),
            'TipoUsuarioId' => 3
        ]);

        DB::table('usuario')->insert([
            'Nombre' => 'Luis Angel',
            'Apellido' => 'Moreno',
            'Correo' => 'anngel@gmail.com',
            'password' => bcrypt('gestion'),
            'TipoUsuarioId' => 3
        ]);
    }
}
