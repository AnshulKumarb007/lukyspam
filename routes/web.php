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

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');


Route::group(['middleware'=>['auth', 'acl'], 'is'=>'admin'], function() {

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/dashboard', 'SuperAdmin\DashboardController@index')->name('home');
    Route::get('service-customer', 'SuperAdmin\ServiceCustomerController@index')->name('servicecustomer');
    Route::get('service-customers/{id}', 'SuperAdmin\ServiceCustomerController@customers')->name('srcustomers');
    Route::get('service-customers-details/{id}', 'SuperAdmin\ServiceCustomerController@details')->name('service-customers-details');
    Route::get('vendor-details/{id}','SuperAdmin\DashboardController@details')->name('vendor-details');
    Route::get('subscribe', 'SuperAdmin\SubscribeController@index')->name('subscribe');
    Route::get('update-status/{id}/{status}', 'SuperAdmin\DashboardController@update_status')->name('update-status');
   
    Route::get('partner-exports','SuperAdmin\PartnerController@exports')->name('partner-exports');
    Route::get('servicecsutomer-exports','SuperAdmin\ServiceCustomerController@export')->name('servicecsutomer');
    Route::group(['prefix' => 'category'], function () {
//        Route::get('/', 'SuperAdmin\CategoryController@index')->name('category.list');
//        Route::get('edit/{id}', 'SuperAdmin\CategoryController@edit')->name('category.edit');
//        Route::post('update/{id}', 'SuperAdmin\CategoryController@update')->name('category.update');
        //service
        Route::get('services', 'SuperAdmin\ServiceController@services')->name('category.service.list');
        Route::get('service-edit/{id}', 'SuperAdmin\ServiceController@serviceedit')->name('category.service.edit');
        Route::post('service-update/{id}', 'SuperAdmin\ServiceController@serviceupdate')->name('category.service.update');
    });

    Route::group(['prefix'=>'orders'], function(){
        Route::get('/','SuperAdmin\OrderController@index')->name('orders.list');
        Route::get('details/{id}','SuperAdmin\OrderController@details')->name('orders.details');
        Route::get('view-image/{id}','SuperAdmin\OrderController@image')->name('orders.image');

    });


    Route::group(['prefix'=>'partner'], function(){
        Route::get('/','SuperAdmin\PartnerController@index')->name('partner.list');
        Route::get('create','SuperAdmin\PartnerController@create')->name('partner.create');
        Route::post('store','SuperAdmin\PartnerController@store')->name('partner.store');
        Route::get('edit/{id}','SuperAdmin\PartnerController@edit')->name('partner.edit');
        Route::post('update/{id}','SuperAdmin\PartnerController@update')->name('partner.update');
        Route::get('details/{id}','SuperAdmin\PartnerController@details')->name('partner.details');
        Route::get('service-list/{id}/{partner_id}','SuperAdmin\PartnerController@service')->name('partner.services');
        Route::get('visit-charges/{id}/{partner_id}','SuperAdmin\PartnerController@visit')->name('partner.visit');
        Route::post('visit-charges-store/{id}','SuperAdmin\PartnerController@visitStore')->name('partner.visit.store');
        Route::post('partner-charges-update','SuperAdmin\PartnerController@serviceCharge')->name('partner.update.charges');
        Route::post('document/{id}','SuperAdmin\PartnerController@document')->name('partner.document');
        Route::post('add-document/{id}','SuperAdmin\PartnerController@document')->name('partner.document');
        Route::get('det-document/{id}','SuperAdmin\PartnerController@deleteDocument')->name('partner.document.delete');

    });

    Route::group(['prefix'=>'complaint'], function(){
        Route::get('/','SuperAdmin\ComplaintController@index')->name('complaint.list');
        Route::get('send/{id}','SuperAdmin\ComplaintController@sendForm')->name('complaint.send');
        Route::post('send-message/{id}','SuperAdmin\ComplaintController@sendMessage')->name('complaint.send.message');

    });

    Route::group(['prefix'=>'feedback'], function(){
        Route::get('/','SuperAdmin\FeedbackController@index')->name('feedback.list');
        Route::get('delete/{id}','SuperAdmin\FeedbackController@delete')->name('feedback.delete');

    });

    Route::group(['prefix'=>'rating'], function(){
        Route::get('/','SuperAdmin\RatingController@index')->name('rating.list');

    });

});

require __DIR__.'/auth.php';


Route::get('privacy','CommonController@privacy');
Route::get('term','CommonController@term');
