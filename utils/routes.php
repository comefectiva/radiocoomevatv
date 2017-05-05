<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix'=>'test'), function(){
	Route::get('/', function(){
		$podcast = Podcast::all();
		$response = Response::json($podcast->toArray());
		$response->header('Content-Type', 'application/json');
		return $response;
	});
});

Route::get('/layout2', function(){
	$podcast=Podcast::orderBy(DB::raw('RAND()'))->take(10)->get();
	return View::make('front.layouts.layout2')->with(array(
															'podcast'=>$podcast
														));
});
Route::get('/', function(){
	ini_set('gd.jpeg_ignore_warning', 1);
	if(!Session::has('emisora')){
		Session::put('emisora', 'adulto');
	}
	$SEO=new stdClass();
	$SEO->title='Home';
	$XML=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7090/info_n_7090.xml');
	if(Session::get('emisora')=='adulto'){
		$XML=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7090/info_n_7090.xml');
	}elseif(Session::get('emisora')=='instrumental'){
		$XML=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7286/info_n_7286.xml');
	}elseif(Session::get('emisora')=='jovenes'){
		$XML=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7284/info_n_7284.xml');
	}else{
		$XML=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7090/info_n_7090.xml');
	}

	$level2=Level2::all();
	$podcast=Podcast::orderBy(DB::raw('RAND()'))->take(10)->get();
	return View::make('front.home')->with(array(
												'SEO'=>$SEO,
												'XML'=>$XML,
												'level2'=>$level2,
												'podcast'=>$podcast
										));
});
Route::group(array('prefix'=>'switch'), function(){
	Route::get('/adulto', function(){
		if(Session::has('emisora')){
		Session::put('emisora', 'adulto');
		}else{
			Session::set('emisora', 'adulto');
		}
		return Redirect::to('/');
	});
	Route::get('/instrumental', function(){
		if(Session::has('emisora')){
		Session::put('emisora', 'instrumental');
		}else{
			Session::set('emisora', 'instrumental');
		}
		return Redirect::to('/');
	});
	Route::get('/jovenes', function(){
		if(Session::has('emisora')){
		Session::put('emisora', 'jovenes');
		}else{
			Session::set('emisora', 'jovenes');
		}
		return Redirect::to('/');
	});
});


//FIX

Route::get('/get-xml-adulto', function(){
	$xml=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7090/info_n_7090.xml');
	$current=$xml->current;
	$next=$xml->next;
	$history=$xml->history;

	$CurrentAlbumArt='http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$current->album_art;
	$NextAlbumArt = 'http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$next->album_art;
	//Datetime handle
	//$currentDatetime=new DateTime($current->datetime); $currentDatetime->add(new DateInterval('PT' . 1 . 'M'));
	//$prevDatetime=new DateTime($history->datetime); $prevDatetime->add(new DateInterval('PT' . 1 . 'M'));
	$json=array(
				'current'=>array(
								'title'=>(string)$current->title,
								'artist'=>(string)$current->artist,
								'duration'=>(string)$current->duration,
								'album_art'=>$CurrentAlbumArt
								//'datetime'=>$currentDatetime->format('Y-m-d H:i')
							),
				'next'=>array(
								'title'=>(string)$next->title,
								'artist'=>(string)$next->artist,
								'duration'=>(string)$next->duration,
								'album_art'=>$NextAlbumArt,
							),
				'prev'=>array(
								'title'=>(string)$history->title,
								'artist'=>(string)$history->artist,
								'duration'=>(string)$history->duration,
								'album_art'=>(string)'http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$history->album_art
								//'datetime'=>$prevDatetime->format('Y-m-d H:i')
							)
			);
	$response=Response::json($json);
	$response->header('Content-Type', 'application/json');
	return $response;
});

Route::get('/get-xml-adulto-test', function(){
	$xml=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7090/info_n_7090.xml');
	$current=$xml->current;
	$next=$xml->next;
	$history=$xml->history;
	$CurrentAlbumArt = 'http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$current->album_art;
	$CurrentAlbumArt = str_replace(" ", "%20", $CurrentAlbumArt);

	 $ch = curl_init($CurrentAlbumArt);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($code == 200){
			 $status = true;
		}else{
			$status = false;
		}
		curl_close($ch);
	 return var_dump($status);


	$handle = curl_init('http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$next->album_art);
	return var_dump($handle);
	curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($handle);
	$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
	if($httpCode == 404) {
		$rand = rand(1,11);
	  $NextAlbumArt='http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$rand.'.jpg';
	}else{
		$NextAlbumArt='http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$next->album_art;
	}
	//Datetime handle
	//$currentDatetime=new DateTime($current->datetime); $currentDatetime->add(new DateInterval('PT' . 1 . 'M'));
	//$prevDatetime=new DateTime($history->datetime); $prevDatetime->add(new DateInterval('PT' . 1 . 'M'));
	curl_close($handle);
	$json=array(
				'current'=>array(
								'title'=>(string)$current->title,
								'artist'=>(string)$current->artist,
								'duration'=>(string)$current->duration,
								'album_art'=>$CurrentAlbumArt
								//'datetime'=>$currentDatetime->format('Y-m-d H:i')
							),
				'next'=>array(
								'title'=>(string)$next->title,
								'artist'=>(string)$next->artist,
								'duration'=>(string)$next->duration,
								'album_art'=>$NextAlbumArt,
							),
				'prev'=>array(
								'title'=>(string)$history->title,
								'artist'=>(string)$history->artist,
								'duration'=>(string)$history->duration,
								'album_art'=>(string)'http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$history->album_art
								//'datetime'=>$prevDatetime->format('Y-m-d H:i')
							)
			);
	$response=Response::json($json);
	$response->header('Content-Type', 'application/json');
	return $response;
});

//END FIX


Route::group(array('prefix'=>'/api/v1.0/'), function(){
	Route::group(array('prefix'=>'podcasts'), function(){
		Route::get('lista-categorias', function(){
			$listCategories = array(
				array('name'=>'A mi Colombia', 'image'=>'a-mi-colombia.jpg', 'URL'=>'a mi Colombia'),
				array('name'=>'Así son las cosas', 'image'=>'asi-son-las-cosas.jpg', 'URL'=>'Asi son las cosas'),
				array('name'=>'Bolerísimo', 'image'=>'bolerisimo.jpg', 'URL'=>'Bolerisimo'),
				array('name'=>'Balada Amor', 'image'=>'balada-amor.jpg', 'URL'=>'Balada Amor'),
				array('name'=>'Bandas Sonoras', 'image'=>'bandas-sonoras.jpg', 'URL'=>'Bandas Sonoras'),
				array('name'=>'Especiales Coomeva Salud', 'image'=>'especiales-salud.jpg', 'URL'=>'Especiales Coomeva Salud'),
				array('name'=>'Especiales Coomeva Conferencias', 'image'=>'especiales-conferencias.jpg', 'URL'=>'Especiales Coomeva Conferencias'),
				array('name'=>'Especiales Coomeva Institucional', 'image'=>'especiales-coomeva.jpg', 'URL'=>'Especiales Coomeva Institucional'),
				array('name'=>'Especiales Coomeva Personajes', 'image'=>'especiales-personajes.jpg', 'URL'=>'Especiales Coomeva Personajes'),
				array('name'=>'La voz del consumidor', 'image'=>'la-voz-del-consumidor.jpg', 'URL'=>'La voz del consumidor'),
				array('name'=>'Queremos Rock', 'image'=>'queremos-rock.jpg', 'URL'=>'Queremos Rock'),
				array('name'=>'Salsa y Melao', 'image'=>'salsa-melao.jpg', 'URL'=>'Salsa y Melao'),
				array('name'=>'Tengo Tango', 'image'=>'tengo-tango.jpg', 'URL'=>'Tengo Tango'),
				array('name'=>'Versiones', 'image'=>'versiones.jpg', 'URL'=>'Versiones'),
				array('name'=>'Verde Coomeva', 'image'=>'verde-coomeva.jpg', 'URL'=>'Verde Coomeva')
			);
			$response=Response::json($listCategories);
			$response->header('Content-Type', 'application/json');
			return $response;
		});
	});
	Route::group(array('prefix'=>'programas'), function(){
		Route::get('lista-programas', function(){
			$listCategories = array(
				array('name'=>'Momentos Empresariales', 'image'=>'http://radio.coomeva.com.co/radio-new/public/radiocoomevatv/momentos.jpg', 'URL'=>'momentos_empresariales'),
				array('name'=>'Dirigencia al día TV', 'image'=>'http://radio.coomeva.com.co/radio-new/public/radiocoomevatv/dirigencia.jpg', 'URL'=>'dirigencia_dia'),
				array('name'=>'Súmate a la Onda Saludable', 'image'=>'http://radio.coomeva.com.co/radio-new/public/radiocoomevatv/saludable.jpg', 'URL'=>'onda_saludable'),
			);
			$response=Response::json($listCategories);
			$response->header('Content-Type', 'application/json');
			return $response;
		});
		Route::get('programa', function(){
			return 'asd';
		});
		Route::get('programa/{program}', function($program){
			$programs = array(
				array('id'=>0, 'name'=>'Momentos Empresariales - Programa 1',
							'media'=>'http://www.letio.com/files/idc40/radiocoomevatv/momentos_empresariales300.mp4',
							'image'=>'http://radio.coomeva.com.co/radio-new/public/radiocoomevatv/momentos1.jpg',
							'catName'=>'Momentos Empresariales',
							'catKey'=>'momentos_empresariales'),
				array('id'=>1, 'name'=>'Momentos Empresariales - Programa 2',
							'media'=>'http://www.letio.com/files/idc40/radiocoomevatv/momentos_empresariales_2.mp4',
							'image'=>'http://radio.coomeva.com.co/radio-new/public/radiocoomevatv/momentos1.jpg',
							'catName'=>'Momentos Empresariales',
							'catKey'=>'momentos_empresariales'),
				array('id'=>2, 'name'=>'Dirigencia al día - Programa 1',
							'media'=>'http://letio.com/files/idc40/radiocoomevatv/dirigencia_al_dia.mp4',
							'image'=>'http://www.elpais.com.co/elpais/sites/default/files/2014/01/colp_hf199281.jpg',
							'catName'=>'Dirigencia al día',
							'catKey'=>'dirigencia_dia'),
				array('id'=>3, 'name'=>'Súmate a la Onda Saludable - Programa 1',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1395-1.mp3',
							'image'=>'http://radio.coomeva.com.co/.storage/podcast_27/thumb/comebienfinal.jpg',
							'catName'=>'Onda Saludable',
							'catKey'=>'onda_saludable'),
				array('id'=>4, 'name'=>'Súmate a la Onda Saludable - Programa 2',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1398-1.mp3',
							'image'=>'http://radio.coomeva.com.co/.storage/podcast_27/thumb/comebienfinal.jpg',
							'catName'=>'Onda Saludable',
							'catKey'=>'onda_saludable'),
				array('id'=>5, 'name'=>'Súmate a la Onda Saludable - Programa 3',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1414-1.mp3',
							'image'=>'http://radio.coomeva.com.co/.storage/podcast_27/thumb/comebienfinal.jpg',
							'catName'=>'Onda Saludable',
							'catKey'=>'onda_saludable'),
				array('id'=>1, 'name'=>'Anthony Strano',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_963-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/tc.jpg',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>2, 'name'=>'Miky Calero',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_964-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/mk.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>3, 'name'=>'Mabel Katz',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_966-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/vbu.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>4, 'name'=>'Flavia Dos Santos',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1069-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/flavia2.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>5, 'name'=>'Lilananda',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1173-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/34565pg  ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>6, 'name'=>'Enrique Simó Kadletz',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1174-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/0987.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>7, 'name'=>'César Escobar Exposer 2013',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1261-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/cesarnew.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>8, 'name'=>'Didi Santosh Exposer 2013',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1262-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/didi2new.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>9, 'name'=>'Santiago Rojas Exposer 2013',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1263-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/santiagonew.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>10, 'name'=>'Miguel Ruiz Exposer 2013',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1264-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/ruiz2new.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>11, 'name'=>'Walter Riso Exposer 2013',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1266-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/Rizonew.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>12, 'name'=>'Gabriel Rolón Exposer 2013',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1267-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/Rolonnew.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>13, 'name'=>'Tritul Rimpoché Exposer 2013',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1268-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/Trimponchenew.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>14, 'name'=>'Gonzalo Gallo Exposer 2013',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1269-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/Gonzalonew.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>15, 'name'=>'360 Grados de influencia',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1257-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/360.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>16, 'name'=>'Act Tributaria 2014',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1324-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/PROPUESTA%202%20JORGE.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>17, 'name'=>'Pilar Sordo Psicóloga',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1389-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/generando3.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>18, 'name'=>'María Mercedes Cuellar Economista',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1390-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/generando3.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>19, 'name'=>'Magnolia Giraldo López Emprendedora',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1391-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/generando3.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>20, 'name'=>'Walter Dresel',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1431-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/wal56789.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>21, 'name'=>'Shenyen Lama Jampa',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1435-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/lama6789.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>22, 'name'=>'Kennet O Donnell',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1436-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/don5678.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>23, 'name'=>'Luis Eduardo Peña',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1437-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/pe2334.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>24, 'name'=>'Alan Weisman',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1438-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/alan567789.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>25, 'name'=>'Caroline Ward',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1439-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/karo90765.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>26, 'name'=>'Eduardo Herrera',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1440-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/hedu7864.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>27, 'name'=>'Nawab William Pasnak',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1441-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/willi5678.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>28, 'name'=>'Rafael Santandreu',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1442-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/santa6764.jpg ',
							'catName'=>'Especiales Coomeva Conferecias',
							'catKey'=>'especiales_coomeva_conferencias'),
				array('id'=>5, 'name'=>'Salud Dental',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1315-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/cp_salus-dental.jpg ',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>6, 'name'=>'Envejecimiento',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1326-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_21875405512.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>7, 'name'=>'Cambios cognitivos',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1327-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_159078566.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>8, 'name'=>'Experiencias de Cuidadoras',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1328-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_155957624.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>9, 'name'=>'Familia y Cuidadores',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1329-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_168169370.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>10, 'name'=>'El trabajo con las familias',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1330-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_103733333.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>11, 'name'=>'La actividad física',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1331-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_100162733.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>12, 'name'=>'Maltrato al adulto mayor',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1333-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_232767421.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>13, 'name'=>'Manejo fonoaudiológo',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1334-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_183325655.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>14, 'name'=>'La dimensión emocional',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1335-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_161459390.jpg',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>15, 'name'=>'Jugando con la memoria',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1336-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_289538003.jpg ',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>16, 'name'=>'Codependencia en familiares',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1337-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_222324673.jpg ',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>17, 'name'=>'Aspectos jurídicos',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1338-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_217065631.jpg ',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>18, 'name'=>'EPOC',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1366-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/Logo_BuenrEspirar.jpg ',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>19, 'name'=>'Actividad física',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1369-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/shutterstock_26988608612.jpg ',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>20, 'name'=>'Video Calima',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1405-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/foto%20nota.jpg ',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
				array('id'=>21, 'name'=>'Informe de resultados plan de recuperación',
							'media'=>'http://www.letio.com/files/idc40/radiocoomeva/podcasts/audio/podcast_1409-1.mp4',
							'image'=>' http://radio.coomeva.com.co/.storage/podcast_27/thumb/foto%20Quinche.jpg ',
							'catName'=>'Especiales Coomeva Salud',
							'catKey'=>'especiales_coomeva_salud'),
			);
			$array = array();
			for($i=1; $i<count($programs); $i++){
				$search = array_search($program, $programs[$i]);
				if($search != false){
					$array[] = $programs[$i];
				}
			}
			$response=Response::json($array);
			$response->header('Content-Type', 'application/json');
			return $response;
		});
	});
	Route::group(array('prefix'=>'adulto'), function(){
		Route::get('/', function(){
			return 'asd';
		});
		Route::get('/get-source', function(){
			//$json = array( 'source' => 'http://i91.letio.com:17090/;stream.mp3', 'type' => 'audio/mpeg' );
			$json = array( 'source' => 'http://radio.coomeva.com.co:8090/adulto.mp3', 'type' => 'audio/mpeg' );
			$response=Response::json($json);
			$response->header('Content-Type', 'application/json');
			return $response;
		});
		Route::get('/get-xml', function(){
			$xml=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7090/info_n_7090.xml');
			$current=$xml->current;
			$next=$xml->next;
			$history=$xml->history;

			//Current
			//Check if file actually exists
			$CurrentAlbumArt = 'http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$current->album_art;
			$CurrentAlbumArt = str_replace(" ", "%20", $CurrentAlbumArt);

			 $ch = curl_init($CurrentAlbumArt);
				curl_setopt($ch, CURLOPT_NOBODY, true);
				curl_exec($ch);
				$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

				if($code != 200){
					$rand = rand(1,11);
					 $CurrentAlbumArt = 'http://radio.coomeva.com.co/emisoras/7090/caratulas/sin-caratula'.$rand.'.jpg';
				}
				curl_close($ch);

			//NEXT
			//Check if file actually exists
			$NextAlbumArt = 'http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$next->album_art;
			$NextAlbumArt = str_replace(" ", "%20", $NextAlbumArt);

			 $ch = curl_init($NextAlbumArt);
				curl_setopt($ch, CURLOPT_NOBODY, true);
				curl_exec($ch);
				$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

				if($code != 200){
						$rand = rand(1,11);
					 $NextAlbumArt = 'http://radio.coomeva.com.co/emisoras/7090/caratulas/sin-caratula'.$rand.'.jpg';
				}
				curl_close($ch);
			$json=array(
						'current'=>array(
										'title'=>(string)$current->title,
										'artist'=>(string)$current->artist,
										'duration'=>(string)$current->duration,
										'album_art'=>$CurrentAlbumArt,
										//'datetime'=>$currentDatetime->format('Y-m-d H:i:s')
									),
						'next'=>array(
										'title'=>(string)$next->title,
										'artist'=>(string)$next->artist,
										'duration'=>(string)$next->duration,
										'album_art'=>$NextAlbumArt,
									),
						'prev'=>array(
										'title'=>(string)$history->title,
										'artist'=>(string)$history->artist,
										'duration'=>(string)$history->duration,
										'album_art'=>(string)'http://radio.coomeva.com.co/emisoras/7090/caratulas/'.$history->album_art,
										//'datetime'=>$prevDatetime->format('Y-m-d H:i')
									)
					);
			$response=Response::json($json);
			$response->header('Content-Type', 'application/json');
			return $response;
		});
	});
	Route::group(array('prefix'=>'instrumental'), function(){
		Route::get('/get-source', function(){
			//$json = array( 'source' => 'http://i91.letio.com:17286/;stream.mp3', 'type' => 'audio/mpeg' );
			$json = array( 'source' => 'http://radio.coomeva.com.co:8090/instrumental.mp3', 'type' => 'audio/mpeg' );
			$response=Response::json($json);
			$response->header('Content-Type', 'application/json');
			return $response;
		});
		Route::get('/get-xml', function(){
			$xml=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7286/info_n_7286.xml');
			$current=$xml->current;
			$next=$xml->next;
			$history=$xml->history;

			//Check if file actually exists
			$CurrentAlbumArt = 'http://radio.coomeva.com.co/emisoras/7286/caratulas/'.$current->album_art;
			$CurrentAlbumArt = str_replace(" ", "%20", $CurrentAlbumArt);

			 $ch = curl_init($CurrentAlbumArt);
				curl_setopt($ch, CURLOPT_NOBODY, true);
				curl_exec($ch);
				$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

				if($code != 200){
					 $CurrentAlbumArt = 'http://radio.coomeva.com.co/emisoras/7286/caratulas/sin-caratula.jpg';
				}
				curl_close($ch);

			$NextAlbumArt = 'http://radio.coomeva.com.co/emisoras/7286/caratulas/'.$next->album_art;
			$NextAlbumArt = str_replace(" ", "%20", $NextAlbumArt);

			 $ch = curl_init($NextAlbumArt);
			 curl_setopt($ch, CURLOPT_NOBODY, true);
			 curl_exec($ch);
			 $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			 if($code != 200){
				 $NextAlbumArt = 'http://radio.coomeva.com.co/emisoras/7286/caratulas/sin-caratula.jpg';
			 }
			curl_close($ch);
			//Datetime handle
			//$currentDatetime=new DateTime($current->datetime); $currentDatetime->add(new DateInterval('PT' . 1 . 'M'));
			//$prevDatetime=new DateTime($history->datetime); $prevDatetime->add(new DateInterval('PT' . 1 . 'M'));
			$json=array(
						'current'=>array(
										'title'=>(string)$current->title,
										'artist'=>(string)$current->artist,
										'duration'=>(string)$current->duration,
										'album_art'=>(string)$CurrentAlbumArt,
										//'datetime'=>$currentDatetime->format('Y-m-d H:i')
									),
						'next'=>array(
										'title'=>(string)$next->title,
										'artist'=>(string)$next->artist,
										'duration'=>(string)$next->duration,
										'album_art'=>(string)$NextAlbumArt,
									),
						'prev'=>array(
										'title'=>(string)$history->title,
										'artist'=>(string)$history->artist,
										'duration'=>(string)$history->duration,
										'album_art'=>(string)'http://radio.coomeva.com.co/emisoras/7286/caratulas/'.$history->album_art,
										//'datetime'=>$prevDatetime->format('Y-m-d H:i')
									)
					);
			return Response::json($json);
		});
	});
	Route::group(array('prefix'=>'jovenes'), function(){
		Route::get('/get-source', function(){
			//$json = array( 'source' => 'http://i91.letio.com:17284/;stream.mp3', 'type' => 'audio/mpeg' );
			$json = array( 'source' => 'http://radio.coomeva.com.co:8090/jovenes.mp3', 'type' => 'audio/mpeg' );
			$response=Response::json($json);
			$response->header('Content-Type', 'application/json');
			return $response;
		});
		Route::get('/get-xml', function(){
			$xml=simplexml_load_file('http://radio.coomeva.com.co/emisoras/7284/info_n_7284.xml');
			$current=$xml->current;
			$next=$xml->next;
			$history=$xml->history;
			$handle = curl_init('http://radio.coomeva.com.co/emisoras/7284/caratulas/'.$current->album_art);
			curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($handle);
			$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			if($httpCode == 404){
			    $CurrentAlbumArt='http://radio.coomeva.com.co/live/media/sin-caratula.jpg';
			}else{
				$CurrentAlbumArt='http://radio.coomeva.com.co/emisoras/7284/caratulas/'.$current->album_art;
			}
			curl_close($handle);
			$handle = curl_init('http://radio.coomeva.com.co/emisoras/7284/caratulas/'.$next->album_art);
			curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($handle);
			$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			if($httpCode == 404) {
			    $NextAlbumArt='http://radio.coomeva.com.co/live/media/sin-caratula.jpg';
			}else{
				$NextAlbumArt='http://radio.coomeva.com.co/emisoras/7284/caratulas/'.$next->album_art;
			}
			//Datetime handle
			//$currentDatetime=new DateTime($current->datetime); $currentDatetime->add(new DateInterval('PT' . 1 . 'M'));
			//$prevDatetime=new DateTime($history->datetime); $prevDatetime->add(new DateInterval('PT' . 1 . 'M'));
			$json=array(
						'current'=>array(
										'title'=>(string)$current->title,
										'artist'=>(string)$current->artist,
										'duration'=>(string)$current->duration,
										'album_art'=>(string)'http://radio.coomeva.com.co/emisoras/7284/caratulas/'.$current->album_art,
										//'datetime'=>$currentDatetime->format('Y-m-d H:i')
									),
						'next'=>array(
										'title'=>(string)$next->title,
										'artist'=>(string)$next->artist,
										'duration'=>(string)$next->duration,
										'album_art'=>(string)'http://radio.coomeva.com.co/emisoras/7284/caratulas/'.$next->album_art,
									),
						'prev'=>array(
										'title'=>(string)$history->title,
										'artist'=>(string)$history->artist,
										'duration'=>(string)$history->duration,
										'album_art'=>(string)'http://radio.coomeva.com.co/emisoras/7284/caratulas/'.$history->album_art,
										//'datetime'=>$prevDatetime->format('Y-m-d H:i')
									)
					);
			return Response::json($json);
		});
	});
});

Route::get('/podcast', function(){
	ini_set('gd.jpeg_ignore_warning', 1);
	if(!Session::has('emisora')){
		Session::put('emisora', 'adulto');
	}
	$SEO=new stdClass();
	$SEO->title='Home';
	$podcast=Podcast::all();
	return View::make('front.podcast')->with(array(
													'SEO'=>$SEO,
													'podcast'=>$podcast
												));
});
/*******************************************************
********************************************************
***************TRATAMIENTO DE IMAGENES******************
********************************************************
*******************************************************/
Route::get('/_images', function(){
	$route=Input::get('route', '/images/fonz1.png');
	$width=Input::get('width', 200);
	$heigth=Input::get('heigth', 200);
	$extension=Input::get('extension', 'jpg');
	$image=App::make('ImageController')->GetImage($route,$width,$heigth,$extension);
	return $image;
});
/*******************************************************
********************************************************
*******************CONSULTA RADIOS**********************
********************************************************
*******************************************************/
Route::group(array('prefix'=>'/api/v1.0'), function(){
	Route::get('/radio-xml', function(){
		$radio=Input::get('radio', 7090);
		$XML=simplexml_load_file('http://radio.coomeva.com.co/emisoras/'.$radio.'/info_n_'.$radio.'.xml');
		return Response::json($XML);
	});
});
Route::get('last-api/podcast',function(){
	$podcast=Podcast::all();
	$array=array();

	foreach($podcast as $pod){
		array_push($array, array('id'=>$pod->id,'file'=>$pod->local_media));
	}

	return Response::json($array);
});
Route::get('last-api/podcast/{id}',function(){
	$podcast=Podcast::all();
	$array=array();

	foreach($podcast as $pod){
		array_push($array, array('id'=>$pod->id,'file'=>$pod->local_media));
	}

	return Response::json($array);
});
/*******************************************************
********************************************************
********************************************************
********************************************************
*******************************************************/
Route::group(array('prefix'=>'/api/v2.0'), function(){
	Route::post('post-audit',function(){
		$audit=new Audit();
		$audit->ip=$_POST['ip'];
		$audit->identifier=$_POST['identifier'];
		$audit->url=$_POST['url'];
		$audit->action=$_POST['action'];
		$audit->save();
		return $audit;
	});
	Route::get('get-audit',function(){
		return 'hola';
	});
});

   Route::get('visitas_idea_negocio_2016', function(){
      $selections = Audit::whereRaw('url LIKE "%Ingreso a Convertir Idea de Negocio%" AND created_at > "2016-08-30 00:00:00"')->orderBy('created_at')->groupBy('browser')->get();
      $data = array();
      foreach($selections as $select){
$time=0;
        $audis=Audit::whereRaw('browser="'.$select->browser.'" AND url="idea-negocio" AND action="continua" AND created_at > "2016-08-30 00:00:00"')->get();
        $time=$audis->count();
        $veces=Audit::whereRaw('url LIKE "%Ingreso a Convertir Idea de Negocio%" AND browser="'.$select->browser.'" AND created_at > "2016-08-30 00:00:00"')->count();
          $user = ContentControl::where('document', '=', $select->browser)->first();
          if(!$user){
              $data[] = array($select->browser, 'non', $select->created_at, $time, $veces);
          }else{
            $data[] = array($select->browser, $user->name, $select->created_at, $time, $veces);
          }
      }
      Excel::create('visitas_conferencia_idea_negocio-agosto-2016', function($xls) use($data){
        $xls->setTitle('Reporte Conferencia');
  			$xls->sheet('Reporte conferencia', function($sht) use($data){
  				$sht->fromArray($data);
  			});
      })->download('xls');
    });


   	Route::get('migration-podcast',function(){
   		$podcasts=Podcast::all();
   		$change=0;
   		$start=0;
   		$end=123;
   		foreach($podcasts as $podcast){
   			if($podcast->id>$end){
   				break;
   			}
   			if($podcast->id<$start){
   				continue;
   			}
   			$podcast->extension="m4a";
   			$podcast->save();
   			$change=$change+1;
   		}
   		return var_dump($change);
   	});



   	

   	Route::get('json-migration-categories',function(){
   		return Response::json(array('adulto_contemporaneo','jovenes','colaboradores','instrumental'));
   	});

   	Route::get('json-migration-subcategories',function(){
   		$return=Categoria::all();
   		return Response::json($return);
   	});

   	Route::get('json-migration-podcast',function(){
   		$return=Podcast::all(['id','titulo','descripcion','resumen','imagen_productor','categoria','subcategoria','extension']);
   		return Response::json($return);
   	});

   	Route::get('json-migration-noticias',function(){
   		$return=Noticia::all(['id','nombre','descripcion','resumen','imagen','estado','categoria','expira']);
   		return Response::json($return);
   	});

   	Route::get('json-migration-top10',function(){
   		$return=Song::whereRaw('1')->orderBy('posicion')->get();
   		return Response::json($return);
   	});


   	Route::get('primer-reporte-programa-reconocimiento',function(){
   		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
   		$audits=Audit::whereRaw('url="concentrese-programa-reconocimiento" AND created_at>="2016-10-12 12:00:00"')->groupBy('identifier')->orderBy('created_at')->get();
   		
   		return  View::make('report')->with('audits',$audits);
   	});

   	Route::get('reporte-final-programa-reconocimiento',function(){
   		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
   		$audits=Audit::whereRaw('url="concentrese-programa-reconocimiento" AND created_at>="2016-10-12 12:00:00"')->groupBy('identifier')->orderBy('created_at')->get();
   		
   		return  View::make('report-final-programa-reconocimiento')->with('audits',$audits);
   	});

   	Route::get('reporte-final-convertir-idea',function(){
   		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
   		$audits=Audit::whereRaw('url="convertir-idea-negocio" AND created_at>="2016-10-27 05:00:00" AND created_at<="2016-10-28 05:00:00"')->groupBy('identifier')->orderBy('created_at')->get();
   		//return var_dump($audits);
   		return  View::make('reporte-final-convertir-idea')->with('audits',$audits);
   	});

   	   	Route::get('reporte-final-atletas',function(){
   		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
   		$audits=Audit::whereRaw('url="atletas-empresariales" AND identifier <> "123" AND created_at>="2016-11-27 12:00:00"')->groupBy('identifier')->orderBy('created_at')->get();
   		//return var_dump($audits);

   		return  View::make('reporte-final-atletas')->with('audits',$audits);
   	});

   	Route::get('fix-podcast-extension/{id}/{ext}',function($id,$ext){
   		$podcast=Podcast::find($id);
   		$podcast->extension=$ext;
   		$podcast->save();
   		return var_dump($podcast);
   	});
   	Route::get('fix-podcast-extension-all',function(){
   		$podcast=Podcast::whereRaw("extension='mp3' AND id<950")->get();
   		foreach($podcast as $pod){
	   		$pod->extension="m4a";
	   		$pod->save();

   		}
   		return var_dump("OK");
   	});


   	   	/*TEMPLATE REPORTES*/

   	Route::get('reporte-final-elecciones-2016-1',function(){
   		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);

		//CON FECHA ESPECIFICA

   		$audits=Audit::whereRaw('url="elecciones_2016_1" AND created_at>="2016-11-11 22:59:00" AND identifier <> "12345"')->groupBy('identifier')->orderBy('created_at')->get(['identifier']);
   		

		//DESDE EL ORIGEN DE LOS TIEMPOS

   		//$audits=Audit::whereRaw('url="elecciones_2016_1"')->groupBy('identifier')->orderBy('created_at')->get();

   		//return var_dump($audits);
   		return  View::make('reporte-final-elecciones-2016-etapa1')->with('audits',$audits);
   	});

   	Route::get('reporte-final-programa-reconocimiento-wordsearch',function(){
   		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
   		$audits=Audit::whereRaw('url="wordsearch-programa-reconocimiento" AND created_at>="2016-11-03 12:00:00"')->groupBy('identifier')->orderBy('created_at')->get();
   		
   		return  View::make('report-final-programa-reconocimiento-wordsearch')->with('audits',$audits);
   	});


   	   	Route::get('reporte-final-elecciones-2016-1-2',function(){
   		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);

		//CON FECHA ESPECIFICA

   		$audits=Audit::whereRaw('url="elecciones_2016_1" AND created_at>="2016-11-11 22:59:00" AND identifier <> "12345"')->groupBy('identifier')->orderBy('created_at')->get(['identifier']);
   		

		//DESDE EL ORIGEN DE LOS TIEMPOS

   		//$audits=Audit::whereRaw('url="elecciones_2016_1"')->groupBy('identifier')->orderBy('created_at')->get();

   		//return var_dump($audits);
   		return  View::make('reporte-final-elecciones-2016-etapa1-2')->with('audits',$audits);
   	});
