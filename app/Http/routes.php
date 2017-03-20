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

Route::get('login',[
	'uses'=>'PublickController@loginPage',
	'as'=>'login'
]);

Route::get('logout',[
	'uses'=>'PublickController@logout',
	'as'=>'logout'
]);

// Route::get('generate_cluster','PublickController@generateCluster');
// Route::get('generate_user','PublickController@generateUser');

Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
	Route::get('/beranda',[
		'uses'=>'GeneralController@berandaPage',
		'as'=>'beranda'
	]);	

	Route::get('/subkontraktor',[
		'uses'=>'GeneralController@subkontraktorPage',
		'as'=>'subkontraktor'
	]);

	Route::get('/cluster',[
		'uses'=>'GeneralController@clusterPage',
		'as'=>'cluster'
	]);

	Route::get('/barang',[
		'uses'=>'GeneralController@barangPage',
		'as'=>'barang'
	]);

	Route::get('/pengumuman',[
		'uses'=>'GeneralController@pengumumanPage',
		'as'=>'pengumuman'
	]);
});