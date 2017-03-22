<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('tes_email','GeneralController@htmlmail');

Route::get('/',[
	'uses'=>'PublickController@homePage',
	'as'=>'home'
]);

Route::get('tentang',[
	'uses'=>'PublickController@tentangPage',
	'as'=>'tentang'
]);

Route::get('kontak',[
	'uses'=>'PublickController@kontakPage',
	'as'=>'kontak'
]);

Route::post('login',[
	'uses'=>'PublickController@loginCheck',
	'as'=>'login'
]);

Route::get('logout',[
	'uses'=>'PublickController@logout',
	'as'=>'logout'
]);

// Route::get('gc','PublickController@generateCluster');
// Route::get('gu','PublickController@generateUser');

Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['admin_only']],function(){
	Route::get('/validate_input/{name?}',[
		'uses'=>'GeneralController@validateInput',
		'as'=>'validate'
	]);

	Route::get('/beranda',[
		'uses'=>'GeneralController@berandaPage',
		'as'=>'beranda'
	]);	

	Route::get('/subkontraktor',[
		'uses'=>'GeneralController@subkontraktorPage',
		'as'=>'subkontraktor'
	]);
	Route::get('/subkontraktor_data',[
		'uses'=>'SubkontraktorController@getData',
		'as'=>'subkontraktor_data'
	]);
	Route::post('/subkontraktor',[
		'uses'=>'SubkontraktorController@addData'
	]);

	Route::get('/cluster',[
		'uses'=>'GeneralController@clusterPage',
		'as'=>'cluster'
	]);
	Route::get('/cluster_data',[
		'uses'=>'ClusterController@getData',
		'as'=>'cluster_data'
	]);

	Route::get('/barang',[
		'uses'=>'GeneralController@barangPage',
		'as'=>'barang'
	]);
	Route::get('/barang_data',[
		'uses'=>'BarangController@getData',
		'as'=>'barang_data'
	]);

	Route::get('/pengumuman',[
		'uses'=>'GeneralController@pengumumanPage',
		'as'=>'pengumuman'
	]);
});