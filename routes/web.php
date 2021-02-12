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
        Route::get('/companies', 'App\Http\Controllers\CompanyController@index')->name('companies.index');
        Route::post('/companies', 'App\Http\Controllers\CompanyController@create')->name('companies.create');
        Route::put('/companies/update/{company}', 'App\Http\Controllers\CompanyController@update')->name('companies.update');
        Route::delete('/companies/delete/{company}', 'App\Http\Controllers\CompanyController@destroy')->name('companies.delete');

        //Ajax
        Route::get('/companies/getcompanydata', 'App\Http\Controllers\CompanyController@getCompanyData')->name('companies.getCompanyData');

        //Employees
        Route::get('/employees', 'App\Http\Controllers\EmployeeController@index')->name('employees.index');
        Route::post('/employees', 'App\Http\Controllers\EmployeeController@create')->name('employees.create');
        Route::put('/employees/update/{employee}', 'App\Http\Controllers\EmployeeController@update')->name('employees.update');
        Route::delete('/employees/delete/{employee}', 'App\Http\Controllers\EmployeeController@destroy')->name('employees.delete');

        //Ajax
        Route::get('/employees/getemployeedata', 'App\Http\Controllers\EmployeeController@getEmployeeData')->name('employees.getEmployeeData');
        Route::get('/employees/getcustomfilterdata', 'App\Http\Controllers\EmployeeController@getCustomFilterData')->name('employees.getCustomFilterData');
    });
