<?php

use Illuminate\Database\Seeder;

class TipoUsuarioTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuario')->insert([
            'Nombre' => 'Administrador'
        ]);

        DB::table('tipo_usuario')->insert([
            'Nombre' => 'Jefe de Proyecto'
        ]);

        DB::table('tipo_usuario')->insert([
            'Nombre' => 'Miembro'
        ]);

        DB::table('tipo_usuario')->insert([
            'Nombre' => 'Cliente'
        ]);
    }
}
