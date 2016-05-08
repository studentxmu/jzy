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
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('/', 'HomeController@index');
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('/', 'Admin\AdminHomeController@index');
Route::get('home', 'Admin\AdminHomeController@index');
*/

Route::get('/', 'WelcomeController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('pages/{id}', 'PagesController@show');
Route::post('comment/store', 'CommentsController@store');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
  Route::get('/', 'AdminHomeController@index');
  Route::resource('pages', 'PagesController');
  Route::resource('comments', 'CommentsController');
  Route::resource('employees', 'EmployeesController');
  Route::get('logex/viewlog', 'LogexController@viewlog');
  Route::resource('logex', 'LogexController');
  Route::post('users/settings/{userid}', 'UsersController@settings');
  Route::resource('users', 'UsersController');
  Route::get('cars/latest', 'CarsController@latest');
  Route::post('cars/audit/{id}', 'CarsController@audit');
  Route::resource('cars', 'CarsController');
  Route::get('buyers/category', 'BuyersController@category');
  Route::get('buyers/latest/{buyerid}/{fromplace?}/{endplace?}', 'BuyersController@latest');
  Route::get('buyers/exportall', 'BuyersController@exportall');
  Route::post('buyers/setstatus', 'BuyersController@setstatus');
  Route::resource('buyers', 'BuyersController');
  Route::resource('catagorys', 'CatagorysController');
  Route::resource('workdays', 'WorkdaysController');
  Route::resource('transactions', 'TransactionsController');
  Route::get('details/search', 'DetailsController@search');
  Route::resource('details', 'DetailsController');
  Route::get('details/create/{transid}', 'DetailsController@create');
  Route::get('transactions/create/{transid}', 'TransactionsController@create');
  Route::get('transactions/latest/{carid}', 'TransactionsController@latest');
  Route::get('finances/search', 'FinancesController@search');
  Route::resource('finances', 'FinancesController');
  Route::get('finances/create/{typeid}', 'FinancesController@create');
  Route::get('finances/latest/{typeid}/{cateid?}/{fiid?}', 'FinancesController@latest');
  Route::get('finances/category/{typeid}', 'FinancesController@category');
  Route::get('employees/download/{id}/{type}', 'EmployeesController@download');
  Route::get('cars/download/{id}/{type}', 'CarsController@download');
});
