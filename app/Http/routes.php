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

Route::get('/',['as'=>'home','uses'=>'WelcomeController@index']);
Route::get('/listeproduit/{id}',  ['as'=> 'listProd', 'uses'=>'WelcomeController@listProd']); 
Route::get('/listeproduit/detailproduit/{id}/{numb}',  ['as'=> 'detailProd', 'uses'=>'WelcomeController@detailProd']); 
Route::get('/listeproduit/picking/{id}',  ['as'=> 'picking', 'uses'=>'WelcomeController@picking']);
Route::get('/recapitulation/{id}',  ['as'=> 'recap', 'uses'=>'WelcomeController@Recap']);     

//Route::get('home', 'HomeController@index'); 

//Route::controllers(['auth' => 'Auth\AuthController','password' => 'Auth\PasswordController',]);
