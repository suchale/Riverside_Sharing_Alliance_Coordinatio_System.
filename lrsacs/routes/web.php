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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('site', 'SiteController');


Route::resource('service','ServiceController');


Route::resource('shelter','ShelterController');


Route::resource('foodpantry','FoodPantryController');


Route::resource('user','UserController');


Route::resource('request','RequestController');


Route::resource('itemcategory','ItemCategoryController');


Route::resource('itemsubcategory','ItemSubCategoryController');


Route::resource('item','ItemController');


Route::resource('foodbank','FoodBankController');


Route::resource('foodbankinventory','FoodBankInventoryController');


Route::resource('soupkitchen','SoupKitchenController');


Route::resource('family','FamilyController');


Route::resource('roomwaitlist','RoomWaitListController');


Route::resource('client','ClientController');


Route::resource('checkin','CheckInController');



