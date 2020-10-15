<?php

use Illuminate\Database\Seeder;
use  App\Movie;
use  App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    private $arrayPeliculas = array(
	    	[
	    		'title'=>'La momia',
		    	'year'=>'2017',
		    	'director'=>'Alex Kurtzman',
		    	'poster'=>'20201004203102.jpg',
		    	'rented'=>'0',
		    	'synopsis'=>'Ahmanet, una antigua princesa egipcia maldita, despierta en su cripta y, furiosa y malvada, siembra el terror entre los humanos. La única persona que puede detenerla y evitar que arrase Londres es un intrépido mercenario.'
	    	],
	    	[
	    		'title'=>'Indiana Jones y los cazadores del arca perdida',
		    	'year'=>'1981',
		    	'director'=>'Steven Spielberg',
		    	'poster'=>'20201004203101.jpeg',
		    	'rented'=>'0',
		    	'synopsis'=>'El arqueólogo Indiana Jones necesita encontrar el Arca de la Alianza, una reliquia bíblica que contiene los Diez Mandamientos y que convierte en invencible a su poseedor. Jones deberá adelantarse a los nazis, quienes también buscan el Arca.'
	    	],
	    	[
	    		'title'=>'Robin Hood: El príncipe de los ladrones',
		    	'year'=>'1991',
		    	'director'=>'Kevin Reynolds',
		    	'poster'=>'20201004203104.jpg',
		    	'rented'=>'0',
		    	'synopsis'=>'Un noble fugitivo se une a los campesinos oprimidos, en la lucha contra un tirano, en la Inglaterra del siglo XII.'
	    	],
	    	[
	    		'title'=>'Jurassic Park 3D',
		    	'year'=>'1993',
		    	'director'=>'Steven Spielberg',
		    	'poster'=>'20201004203103.jpg',
		    	'rented'=>'0',
		    	'synopsis'=>'Tres expertos y otras personas son invitados a un parque de diversiones, donde se encuentran dinosaurios creados en base al ADN.'
	    	],
	    	[
	    		'title'=>'Rápidos y furiosos 8',
		    	'year'=>'2017',
		    	'director'=>'F. Gary Gray',
		    	'poster'=>'20201004231303.jpg',
		    	'rented'=>'0',
		    	'synopsis'=>'Con Dom y Letty de luna de miel, Brian y Mia retirados y el resto de la pandilla viviendo en paz, parece que todo está tranquilo. Sin embargo, una misteriosa mujer seducirá a Dom para adentrarlo en el mundo del crimen y traicionar a la pandilla. Ahora tendrán que unirse para traer a casa al hombre que los convirtió en una familia y detener a Cipher de desatar el caos.'
	    	]
	    );

	 private $arrayUsuarios = array(
	    	[
	    		'nombre'=>'fgbonta',
		    	'email'=>'fgbonta@gmail.com',
		    	'password'=>'12345678'		    	
	    	],
	    	[
	    		'nombre'=>'fgbonta2',
		    	'email'=>'fgbonta2@gmail.com',
		    	'password'=>'12345678'
	    	]);   

    public function run()
    {        
        $this->seedCatalog();
        $this->command->info('Tabla catálogo inicializada con datos!');	

        $this->seedUsers();
        $this->command->info('Tabla usuario inicializada con datos!');

    }

    private function seedCatalog()
    {	    	
    	
    	Movie::truncate();

    	foreach( $this->arrayPeliculas as $pelicula ) {

			$p = new Movie;

			$p->title = $pelicula['title'];
			$p->year = $pelicula['year'];
			$p->director = $pelicula['director'];
			$p->poster = $pelicula['poster'];
			$p->rented = $pelicula['rented'];
			$p->synopsis = $pelicula['synopsis'];

			$p->save();

		}

    }

    private function seedUsers()
    {

    	User::truncate();

    	foreach ( $this->arrayUsuarios as $usuario) {

    		$u = new User;

    		$u->name = $usuario['nombre'];
    		$u->email = $usuario['email'];
    		$u->password = bcrypt($usuario['password']);

    		$u->save();
    	}
    }

}
