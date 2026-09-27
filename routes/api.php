<?php

use App\Http\Controllers\api\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('regulars',[MainController::class , 'regs']);
Route::get('users',[MainController::class , 'users']);
Route::get('experts',[MainController::class , 'experts']);
Route::get('regular/{id}',[MainController::class , 'reg']);
Route::get('user/{id}',[MainController::class , 'user']);
Route::post('expertinfo',[MainController::class , 'expertinfo']);
Route::get('expert/{id}',[MainController::class , 'expert']);
//------------------------------------------------------------

Route::post('regulars',[MainController::class , 'insert_regs']);
Route::post('users',[MainController::class , 'insert_users']);
Route::post('experts',[MainController::class , 'insert_experts']);

//-------------------------------------------------------------
Route::post('regular/{id}',[MainController::class , 'update_reg']);
Route::post('user/{id}',[MainController::class , 'update_user']);
Route::post('expert/{id}',[MainController::class , 'update_expert']);

//---------------------------------------------------------------




Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    //////////////////////////////
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
    /////////////////////////////

//-------------------------------------------------------------

});
Route::post('savereg',[MainController::class,'savereg']) ;
Route::post('saveexp',[MainController::class,'saveexp']) ;
//----------------------------------------------------------

Route::post('getbyname',[MainController::class,'getname']);
Route::post('getbynamefromcategory',[MainController::class,'advancedSearch']);

Route::post('getByEmail',[MainController::class,'getByEmail']);
Route::post('getbycon',[MainController::class,'getcon']);


//---------------------------------------------------
Route::post('getAllUseresForCon/{id}',[MainController::class,'getAllUseresForCon']);
Route::post('pick/{id}/{type}',[MainController::class,'pick']);
// Route::get('getfav/{id}',[MainController::class,'getfav']);
// Route::post('pickfav/{id}',[MainController::class,'pickfav']);
//-----------------------------------------------------

Route::post('rate/{id}/{request1}',[MainController::class,'rate']);
//----------------------------------------------------------
// Route::get('show',[MainController::class,'show']);
// Route::post('store',[MainController::class,'store']);
//================================shehab============================
Route::get('categories',[CategoriesController::class , 'get_categories'])->name('categories.get_categories');
Route::get('category/{label}',[CategoriesController::class , 'get_category'])->name('category.label.get_category');
Route::post('category',[CategoriesController::class , 'insert_category'])->name('category.insert_category');
Route::delete('category/{label}',[CategoriesController::class , 'delete_category'])->name('category.label.delete_category');


    Route::get('toggle_favorite/{userId}/{expert_id}', [MainController::class, 'toggleFavorite'])->name('toggle_favorite.toggleFavorite');
    Route::get('favorite_list/{id}', [MainController::class, 'favoriteList'])->name('favorite_list.favoriteList');
    Route::get('is_favored/{user_id}/{expert_id}', [MainController::class, 'isFavoredById'])->name('is_favored.expert.isFavoredById');
    Route::post('make_appointment/{id}/{type}', [MainController::class, 'makeAppointment'])->name('make_appointment.makeAppointment');




