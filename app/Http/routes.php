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

// HARUS LOGIN SEBAGAI ADMIN
Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['admin_only']],function(){
	
	// VALIDASI UMUM
	Route::get('/validate_input/{name?}',[
		'uses'=>'GeneralController@validateInput',
		'as'=>'validate'
	]);
	Route::post('/validate_input/{name?}',[
		'uses'=>'GeneralController@validateInput',
		'as'=>'validate'
	]);

	// HALAMAN BERANDA
	Route::get('/beranda',[
		'uses'=>'GeneralController@berandaPage',
		'as'=>'beranda'
	]);	


	// SUB KONTRAKTOR
	Route::get('/subkontraktor',[
		'uses'=>'GeneralController@subkontraktorPage',
		'as'=>'subkontraktor'
	]);
	Route::get('/subkontraktor_data',[
		'uses'=>'SubkontraktorController@getData',
		'as'=>'subkontraktor_data'
	]);
	Route::get('/subkontraktor_data/{id?}',[
		'uses'=>'SubkontraktorController@getSingleData',
		'as'=>'subkontraktor_single_data'
	]);
	Route::post('/subkontraktor','SubkontraktorController@addData');
	Route::patch('/subkontraktor/{id?}','SubkontraktorController@editData');
	Route::delete('/subkontraktor/{id?}','SubkontraktorController@deleteData');



	// CLUSTER
	Route::get('/cluster',[
		'uses'=>'GeneralController@clusterPage',
		'as'=>'cluster'
	]);
	Route::get('/cluster_data',[
		'uses'=>'ClusterController@getData',
		'as'=>'cluster_data'
	]);
	Route::get('/cluster_data/{id?}',[
		'uses'=>'ClusterController@getSingleData',
		'as'=>'cluster_single_data'
	]);
	Route::post('/cluster','ClusterController@addData');
	Route::patch('/cluster/{id?}','ClusterController@editData');
	Route::delete('/cluster/{id?}','ClusterController@deleteData');




	Route::get('/barang',[
		'uses'=>'GeneralController@barangPage',
		'as'=>'barang'
	]);
	Route::get('/barang_data',[
		'uses'=>'BarangController@getData',
		'as'=>'barang_data'
	]);
	Route::post('/barang','BarangController@addData');
	Route::delete('/barang/{id?}','BarangController@deleteData');

	Route::get('/pengumuman',[
		'uses'=>'GeneralController@pengumumanPage',
		'as'=>'pengumuman'
	]);
});