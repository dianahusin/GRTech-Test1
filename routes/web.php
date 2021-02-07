<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// dd(Auth::user()->name);
// if(Auth::user()->name == 'admin'){
// Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::group(['middleware' => ['auth','admin']], function () {
        //Companies
        Route::get('/companies', 'App\Http\Controllers\CompaniesController@index')->name('companies.index');
        Route::post('/companies', 'App\Http\Controllers\CompaniesController@create')->name('companies.create');
        Route::put('/companies/update/{company}', 'App\Http\Controllers\CompaniesController@update')->name('companies.update');
        Route::delete('/companies/delete/{company}', 'App\Http\Controllers\CompaniesController@destroy')->name('companies.delete');

        //Ajax
        Route::get('/companies/getcompanydata', 'App\Http\Controllers\CompaniesController@getCompanyData')->name('companies.getCompanyData');

        //Employees
        Route::get('/employees', 'App\Http\Controllers\EmployeesController@index')->name('employees.index');
        Route::post('/employees', 'App\Http\Controllers\EmployeesController@create')->name('employees.create');
        Route::put('/employees/update/{employee}', 'App\Http\Controllers\EmployeesController@update')->name('employees.update');
        Route::delete('/employees/delete/{employee}', 'App\Http\Controllers\EmployeesController@destroy')->name('employees.delete');

        //Ajax
        Route::get('/employees/getemployeedata', 'App\Http\Controllers\EmployeesController@getEmployeeData')->name('employees.getEmployeeData');
    });
