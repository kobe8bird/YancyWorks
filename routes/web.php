<?php

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
    return redirect()->route('admin.login');
});

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::post('/login', 'LoginController@authenticate')->name('submit.login');
    Route::get('/login', 'LoginController@index')->name('admin.login');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:web']], function() {
        Route::get('logout', 'LoginController@logout')->name('admin.logout');
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
        
        //Employee 
        Route::post('employee/listings', 'EmployeeController@listings')->name('admin.employee.listings');
        Route::resource('employees', 'EmployeeController', [
            'names' => [
                'index' => 'admin.employee.index',
                'create' => 'admin.employee.create',
                'store' => 'admin.employee.store',
                'show' => 'admin.employee.show',
                'edit' => 'admin.employee.edit',
                'update' => 'admin.employee.update',
                'destroy' => 'admin.employee.destroy'
               
            ]
        ]);

        //Company
        Route::post('company/listings', 'CompanyController@listings')->name('admin.company.listings');
        Route::resource('companies', 'CompanyController', [
            'names' => [
                'index' => 'admin.company.index',
                'create' => 'admin.company.create',
                'store' => 'admin.company.store',
                'show' => 'admin.company.show',
                'edit' => 'admin.company.edit',
                'update' => 'admin.company.update',
                'destroy' => 'admin.company.destroy'
            ]
        ]);
         


    });

});