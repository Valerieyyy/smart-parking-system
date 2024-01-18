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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index');

// edit_profile
Route::get('/edit_profile', 'HomeController@getProfile')->name('edit_profile');
Route::post('/save-profile', 'HomeController@saveProfile')->name('save.profile');

// admin account
Route::get('/admin_account', 'HomeController@adminAccount')->name('admin_account');
Route::post('/save-admin', 'HomeController@AdminCreate')->name('/save.admin');

// user-info-driver 
Route::get('/user_history', 'HomeController@userHistory')->name('user_history');
Route::get('/user-add/{id}', 'HomeController@userInput')->name('userhistory.user-add');
Route::get('/user_history/user-create', 'HomeController@USDcreate')->name('userhistory.user_history-create');
Route::post('/user_history/usdstore', 'HomeController@USDstore')->name('userhistory.usdstore');
// edit user info

Route::get('/user_history/view_history/{id}', 'HomeController@userhistoryView')->name('userhistory.user_history-view');
Route::get('/user_history/store/{id}', 'HomeController@userhistoryEdit')->name('userhistory.user_history-edit');
Route::post('/user_history/update/{id}', 'HomeController@Userupdate')->name('user_history.update');
Route::get('/user_history/delete/{id}', 'HomeController@Userdestroy')->name('user_history.delete');


// reciept

Route::get('/receipt', 'RecieptController@Reciept')->name('receipt');
Route::post('/receipt/Receiptstore', 'RecieptController@receiptStore')->name('receipt.Receiptstore');

// parking slot 
Route::get('/parking-slot', 'ParkingController@parkingSlot')->name('parking-slot');
Route::get('/parking-slot/parking-create', 'ParkingController@parkingCreate')->name('parking.parking-slot-create');
Route::post('/parking-slot/parkingStore', 'ParkingController@parkingStore')->name('parking.parkingStore');
//edit
Route::get('/parking-slot/store/{id}', 'ParkingController@parkingEdit')->name('parking.parking-slot-edit');
Route::post('/parking-slot/update/{id}', 'ParkingController@parkingUpdate')->name('parking.update');
Route::get('/parking-slot/delete/{id}', 'ParkingController@Parkingdestroy')->name('parking.delete');


// categories
Route::get('/category', 'CategoryController@categories')->name('category');
Route::get('/category/category-create', 'CategoryController@createCategories')->name('categories.category-create');
Route::post('/category/categoryStore', 'CategoryController@categoriesStore')->name('category.categoriesStore');
//edit
Route::get('/category/store/{id}', 'CategoryController@categoriesEdit')->name('categories.category-edit');
Route::post('/category/update/{id}', 'CategoryController@categoriesUpdate')->name('category.update');
Route::get('/category/delete/{id}', 'CategoryController@categoriesDestroy')->name('category.delete');

//payment

Route::get('/payment', 'PaymentController@paymentIndex')->name('payment');
Route::get('/payment/payment-create', 'PaymentController@PaymentCreate')->name('rates.payment-create');
Route::post('/payment/paymentStore', 'PaymentController@paymentStore')->name('payment.paymentStore');

//edit
Route::get('/payment/store/{id}', 'PaymentController@paymentEdit')->name('rates.payment-edit');
Route::post('/payment/update/{id}', 'PaymentController@paymentUpdate')->name('payment.update');
Route::get('/payment/delete/{id}', 'PaymentController@paymentDestroy')->name('payment.delete');

// parking 

Route::get('/parking-manag', 'ParkingController@parkingManagement')->name('parking');
Route::get('/parking-manag/parking-create', 'ParkingController@parkingmanageCreate')->name('parkingmanagement.parking-manag-create');
Route::post('/parking-manag/parkingManageStore', 'ParkingController@parkingManageStore')->name('parkingmanagement.parkingManageStore');

// scanning

Route::get('/attendance', 'ParkingController@getAttendance')->name('attendance');
Route::post('/log-me', 'ParkingController@saveAttendance')->name('log-me');

Route::get('/attendance-out', 'ParkingController@getAttendanceTimeout')->name('attendance-out');
Route::post('/log-out', 'ParkingController@saveAttendanceTimeout')->name('log-out');

// user Account 
Route::get('/user_account', 'HomeController@userAccount')->name('user_account');
Route::post('/save-user', 'HomeController@UserCreate')->name('/save.user');

// record of driver

Route::get('/record-of-driver/{id}', 'HomeController@hmedit')->name('hm_inventory.hm_edit');
Route::get('/user-registered', 'HomeController@userIndex')->name('user-registered');
Route::get('/user-slot/{id}', 'HomeController@userReserve')->name('userhistory.user-slot');