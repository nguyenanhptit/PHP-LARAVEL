<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;
Route::get('/', function() {
    $crawler = Goutte::request('GET', 'https://dantri.com.vn/su-kien.htm');
    $crawler->filter('a.fon6')->each(function ($node) {
     echo $node->text() . "</br>";
    });
    
});

//Route::get('/admin','AdminController@login');
Route::match(['get','post'],'/admin','AdminController@login');
//Route::get('/admin/dashboard','AdminController@dashboard');

Route::group(['middleware'=> ['auth']], function(){

	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd', 'AdminController@chkPassword');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
	
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout','AdminController@logout');



Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=> 'TheLoai'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach')->name('TheLoai.danhsach');
		
		Route::get('them','TheLoaiController@getThem');
		Route::post('them','TheLoaiController@postThem');
		Route::get('sua/{id}','TheLoaiController@getSua');
		Route::post('sua/{id}','TheLoaiController@postSua');

		Route::get('xoa/{id}','TheLoaiController@getXoa');

	});

	Route::group(['prefix'=> 'LoaiTin'],function(){
		Route::get('danhsach','LoaiTinController@getDanhSach')->name('LoaiTin.danhsach');
		
		Route::get('them','LoaiTinController@getThem');
		Route::post('them','LoaiTinController@postThem');
		Route::get('sua/{id}','LoaiTinController@getSua');
		Route::post('sua/{id}','LoaiTinController@postSua');

		Route::get('xoa/{id}','LoaiTinController@getXoa');


	});

	Route::group(['prefix'=> 'TinTuc'],function(){
		Route::get('danhsach','TinTucController@getDanhSach')->name('TinTuc.danhsach');
		
		Route::get('them','TinTucController@getThem');
		Route::post('them','TinTucController@postThem');
		Route::get('sua/{id}','TinTucController@getSua');
		Route::post('sua/{id}','TinTucController@postSua');

		Route::get('xoa/{id}','TinTucController@getXoa');

	});
Route::group(['prefix'=> 'ajax'],function(){
	Route::get('LoaiTin/{idTheLoai}','AjaxController@getLoaiTin');
	});
});


Route::get('trangchu','PagesController@trangchu');
Route::get('lienhe','PagesController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaitin');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html','PagesController@tintuc');

