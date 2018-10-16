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

Route::get('/', function() {
    $crawler = Goutte::request('GET', 'https://dantri.com.vn/su-kien.htm');
    $crawler->filter('a.fon6')->each(function ($node) {
     echo $node->text() . "</br>";
    });
    
});

Route::get('/admin','AdminController@login');