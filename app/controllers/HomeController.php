<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	public function postRegistro(){

		$data = Input::all();
		return Response::json($data);
	}
	public function postCarreras(){

		$data = [
			1=>"ADMINISTRACION",
			2=>"ADMINISTRACION DE NEGOCIOS TURISTICOS Y HOTELEROS",
			3=>"ARQUITECTURA",
			4=>"CIENCIAS DE LA COMUNICACIÓN",
			5=>"CONTABILIDAD",
			6=>"DERECHO",
			7=>"ECONOMIA",
			8=>"ENFERMERIA",
			9=>"GASTRONOMIA",
			10=>"INGENIERIA AGROINDUSTRIAL",
			11=>"INGENIERIA CIVIL",
			12=>"INGENIERIA DE SISTEMAS",
			13=>"INGENIERIA DE SISTEMAS Y TELECOMUNICACIONES",
			14=>"INGENIERIA ELECTRONICA",
			15=>"INGENIERIA INDUSTRIAL",
			16=>"MARKETING",
			17=>"MEDICINA HUMANA",
			18=>"NUTRICION",
			19=>"OBSTETRICIA",
			20=>"ODONTOLOGIA",
			21=>"PSICOLOGIA"
		];
		return Response::json($data);
	}
	public function postAsignaturas(){
		$carreraId = Input::get('carrera_id');

		$file = public_path()."/asignaturas.json";

        if (File::exists($file)) {
            $json = File::get($file);
        }
		
		$json = json_decode($json, true);
		$asignaturas=[];
        foreach ($json as $key => $value)
        {
        	if ($carreraId==$value['id']) {
        		$asignaturas = $value['asignaturas'];
        		
        		//var_dump($value['asignaturas']);
        		break;
        	}
        }

		return $asignaturas;
	}
	public function getAsignaturas(){
		$carreraId = Input::get('carrera_id');

		$file = public_path()."/asignaturas.json";

        if (File::exists($file)) {
            $json = File::get($file);
        }
		
		$json = json_decode($json, true);

        foreach ($json as $key => $value)
        {
        	$asignaturas = $value['asignaturas'];
        	if ($carreraId==$value['id']) {
        		
        		var_dump($value['asignaturas']);
        		break;
        	}
        }

		return $asignaturas;
	}
}
