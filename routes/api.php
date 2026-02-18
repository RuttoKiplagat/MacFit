<?php

use App\Http\Controllers\BundleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GymController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

//Roles api
 
Route::post('/saveRole', [RoleController::class, 'createRole']);
Route::get('/getRoles', [RoleController::class, 'readAllRoles']);
Route::get('/getRoles/{id}', [RoleController::class, 'readRole']);
Route::post('/updateRole/{id}', [RoleController::class, 'updateRole']);
Route::delete('/deleteRole/{id}', [RoleController::class, 'deleteRole']);

Route::post('/saveCategory', [CategoryController::class, 'createCategory']);
Route::get('/getCategories', [CategoryController::class, 'readAllCategories']);
Route::get('/getCategories/{id}', [CategoryController::class, 'readCategory']);
Route::post('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);

Route::post('/saveGym', [GymController::class, 'createGym']);
Route::get('/getGyms', [GymController::class, 'readAllGyms']);
Route::get('/getGym/{id}', [GymController::class, 'readGym']);
Route::post('/updateGym/{id}', [GymController::class, 'updateGym']);
Route::delete('/deleteGym/{id}', [GymController::class, 'deleteGym']);

Route::post('/saveBundle', [BundleController::class, 'createBundle']);
Route::get('/getBundles', [BundleController::class, 'readAllBundles']);
Route::get('/getBundle/{id}', [BundleController::class, 'readBundle']);
Route::post('/updateBundle/{id}', [BundleController::class, 'updateBundle']);
Route::delete('/deleteBundle/{id}', [BundleController::class, 'deleteBundle']);
 