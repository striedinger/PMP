<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use App\User;
use App\Area;
use App\Process;
use App\Exam;
use App\Question;
use App\Session;
use App\Answer;
use App\Plan;
use App\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

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
        DB::table('processes')->delete();
        Process::create(['name' => 'Inicio']);
        Process::create(['name' => 'Planeación']);
        Process::create(['name' => 'Ejecución']);
        Process::create(['name' => 'Seguimiento y Control']);
        Process::create(['name' => 'Cierre']);
        Process::create(['name' => 'Ética y Responsabilidad']);

        //Plans
        DB::table('plans')->delete();
        Plan::create(['name' => '30 Días', 'duration' => 30, 'price' => "15000", 'active' => true]);
        Plan::create(['name' => '60 Días', 'duration' => 60, 'price' => "30000", 'active' => true]);
        Plan::create(['name' => '90 Días', 'duration' => 90, 'price' => "60000", 'active' => true]);

        //Exams
        DB::table('exams')->delete();
        Exam::create(['name' => 'Examen Aleatorio', 'questions' => 10, 'duration' => 10, 'type' => 'Aleatorio']);
        Exam::create(['name' => 'Examen por Area', 'questions' => 10, 'duration' => 10, 'type' => 'Area']);
        Exam::create(['name' => 'Examen por Proceso', 'questions' => 10, 'duration' => 10, 'type' => 'Proceso']);

        //Questions
        DB::table('questions')->delete();
        for($i=0;$i<200;$i++){
            Question::create([
                'question' => $faker->text, 
                'description' => $faker->text, 
                'optionA' => $faker->randomNumber, 
                'optionB' => $faker->randomNumber, 
                'optionC' => $faker->randomNumber, 
                'optionD' => $faker->randomNumber, 
                'answer' => $faker->randomElement($array = array('A', 'B', 'C', 'D')),
                 'process_id' => $faker->numberBetween(1, 6), 
                 'area_id' => $faker->numberBetween(1, 10), 
                 'active' => true
                ]);
        } 

        //Sessions
        DB::table('sessions')->delete();
        Session::create(['user_id' => 2, 'exam_id' => 1]); 

        //Answers
        DB::table('answers')->delete();
        $n = $faker->numberBetween(1,40);
        for($i=1;$i<=10;$i++){
            Answer::create([
                'session_id' => 1,
                'question_id' => $n+$i,
                'number' => $i
            ]);
        }     
    }
}
