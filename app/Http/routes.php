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

// Route::post('tes_email','GeneralController@invite');
// Route::post('/invite',[
// 	'uses'=>'PengumumanController@invite',
// 	'as'=>'invite'
// ]);

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

Route::post('register_check',[
	'uses'=>'PublickController@registerCheck',
	'as'=>'register_check'
]);
// Route::get('gc','PublickController@generateCluster');
// Route::get('gu','PublickController@generateUser');


// HARUS LOGIN SEBAGAI ADMIN DAN PIC
Route::group(['prefix'=>'intern','as'=>'intern.','middleware'=>['pic_admin_only']],function(){

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

	// ADMIN ONLY CAN ACCESS
	Route::group(['middleware'=>'admin_only'],function(){
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


		// PIC
		Route::get('/pic',[
			'uses'=>'GeneralController@picPage',
			'as'=>'pic'
		]);
		Route::get('/pic_data',[
			'uses'=>'PicController@getData',
			'as'=>'pic_data'
		]);
		Route::get('/pic_data/{id?}',[
			'uses'=>'PicController@getSingleData',
			'as'=>'pic_single_data'
		]);
		Route::post('/pic','PicController@addData');
		Route::patch('/pic/{id?}','PicController@editData');
		Route::delete('/pic/{id?}','PicController@deleteData');	


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



		// BARANG
		Route::get('/barang',[
			'uses'=>'GeneralController@barangPage',
			'as'=>'barang'
		]);
		Route::get('/barang_data',[
			'uses'=>'BarangController@getData',
			'as'=>'barang_data'
		]);
		Route::get('/barang_data/{id?}',[
			'uses'=>'BarangController@getSingleData',
			'as'=>'barang_single_data'
		]);
		Route::post('/barang','BarangController@addData');
		Route::patch('/barang/{id?}','BarangController@editData');
		Route::delete('/barang/{id?}','BarangController@deleteData');
		Route::delete('/gambar_barang/{id?}',[
			'as'=>'remove_gambar_barang',
			'uses'=>'BarangController@removeGambar'
		]);
		Route::delete('/pdf_barang/{id?}',[
			'as'=>'remove_pdf_barang',
			'uses'=>'BarangController@removePdf'
		]);
	});

	// PENGUMUMAN
	Route::get('/pengumuman',[
		'uses'=>'GeneralController@pengumumanPage',
		'as'=>'pengumuman'
	]);
	Route::get('pengumuman_data',[
		'uses'=>'PengumumanController@getData',
		'as'=>'pengumuman_data'
	]);
	// DOWNLOAD FILE EXCEL PENGUMUMAN
	Route::get('get_file_excel/{file_excel?}',[
		'uses'=>'PengumumanController@getFileExcel',
		'as'=>'get_file_excel'
	]);
	Route::post('/pengumuman','PengumumanController@addData');
	// Route::delete('/pengumuman/{id?}','PengumumanController@deleteData');

	// MONITORING
	Route::get('/monitoring','GeneralController@monitoringPage');
	Route::get('/monitoring/{kode}','GeneralController@detailPengumumanPage');
});