<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => env('API_VERSION')], function () 
{
    // ---------------------------------------------------------------------
    // auth
    // ---------------------------------------------------------------------
    Route::post('/auth/authentication',[AuthController::class, 'login']);
    Route::post('/auth/signup',[AuthController::class, 'signUp']);

    Route::group(['middleware' => 'auth:api'], function() 
    {   
        // ---------------------------------------------------------------------
        // auth
        // ---------------------------------------------------------------------
        Route::post('/auth/logout',[AuthController::class, 'logout']);

        // ---------------------------------------------------------------------
        // roles
        // ---------------------------------------------------------------------
        Route::post('/roles',[RolesController::class, 'store']);
        Route::get('/roles/{id}',[RolesController::class, 'show']);

        // ---------------------------------------------------------------------
        // employees
        // ---------------------------------------------------------------------
        Route::post('/employees',[EmployeeController::class, 'store']);
        Route::put('/employees/{id}',[EmployeeController::class, 'update']);
        Route::get('/employees',[EmployeeController::class, 'index']);
        Route::post('/employees/bulk_upload_users',[EmployeeController::class, 'bulkUploadUsers']);

        // ---------------------------------------------------------------------
        // departments
        // ---------------------------------------------------------------------
        Route::post('/departments',[DepartmentController::class, 'store']);
        Route::put('/departments/{id}',[DepartmentController::class, 'update']);
        Route::get('/departments',[DepartmentController::class, 'index']);

        // ---------------------------------------------------------------------
        // Export
        // --------------------------------------------------------------------- 
        
        Route::get('/export/sample_file',[ExportController::class, 'exportSampleFile']);
        
    });
});
