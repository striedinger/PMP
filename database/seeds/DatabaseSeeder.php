<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use App\User;
use App\Area;
use App\Process;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Roles
    	DB::table('roles')->delete();
        $adminRole = Role::create([
        	'name' => 'Administrador',
        	'slug' => 'admin',
        	'description' => 'Administrador de la plataforma'
        ]);

        $userRole = Role::create([
        	'name' => 'Usuario',
        	'slug' => 'user',
        	'description' => 'Usuario de la plataforma'
        ]);

        //Users

		DB::table('users')->delete();
        $adminUser = User::create(['id' => 1, 'name' => 'Administrador', 'email' => 'hugostriedinger@hotmail.com', 'password' => Hash::make('qwerty')]);
        $adminUser->attachRole(1);

        $user = User::create(['id' => 2, 'name' => 'Usuario', 'email' => 'user@email.com', 'password' => Hash::make('qwerty')]);
        $user->attachRole(2);

        //Areas
        DB::table('areas')->delete();
        Area::create(['name' => 'Gestión de la Integración']);
        Area::create(['name' => 'Gestión del Alcance']);
        Area::create(['name' => 'Gestión del Tiempo']);
        Area::create(['name' => 'Gestión de los Costos']);
        Area::create(['name' => 'Gestión de la Calidad']);
        Area::create(['name' => 'Gestión de los Recursos Humanos']);
        Area::create(['name' => 'Gestión de las Comunicaciones']);
        Area::create(['name' => 'Gestión de los Riesgos']);
        Area::create(['name' => 'Gestión de las Adquisiciones']);
        Area::create(['name' => 'Gestión de los Interesados']);

        //Processes
        Process::create(['name' => 'Inicio']);
        Process::create(['name' => 'Planeación']);
        Process::create(['name' => 'Ejecución']);
        Process::create(['name' => 'Seguimiento y Control']);
        Process::create(['name' => 'Cierre']);
        Process::create(['name' => 'Ética y Responsabilidad']);
    }
}
