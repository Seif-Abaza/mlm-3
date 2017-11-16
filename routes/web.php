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
    //return redirect('/nella/members/');
    return view('home.index');
});

Auth::routes();

Route::get('/home/', function (){
    if (\Illuminate\Support\Facades\Auth::user()->role_id == null){
        return redirect('/');
    }
    if (\Illuminate\Support\Facades\Auth::user()->role_id == 4){
        return redirect('/my-account');
    }elseif (\Illuminate\Support\Facades\Auth::user()->role_id < 3){
        return redirect('/nella/members/');
    }else{
        return redirect('/');
    }
});
Route::get('/contact', function (){
    return view('home.contact');
});
Route::get('/about', function (){
    return view('home.about');
});
Route::get('/gallery', function (){
    return view('home.gallery');
});
Route::get('/how-to-join', function (){
    return view('home.opportunity');
});
Route::resource('/my-account', 'AccountController');
Route::post('/subscribe-newsletter', 'AccountController@subscribe');
Route::post('/send-message', 'AccountController@sendMessage');

//only for admins

/*Route::get('/nella', function (){
    if (Auth::user()->role_id == 6){
        Route::get('/home', 'HomeController@index')->name('home');
    }
});*/
Route::get('/nella/payouts/generate-old-payouts', 'PayoutsController@makeOldPayouts');

Route::resource('/nella/', 'MembersController');
Route::resource('/nella/dashboard', 'MembersController');
Route::resource('/nella/continents', 'ContinentsController');
Route::resource('/nella/countries', 'CountriesController');
Route::resource('/nella/regions', 'RegionsController');

Route::resource('/nella/members', 'MembersController');
Route::resource('/nella/withdraw-requests', 'WithdrawRequestsController');
Route::resource('/nella/payouts', 'PayoutsController');
Route::resource('/nella/shares', 'SharesController');

Route::get('/nella/members/{id}/renew', 'MembersController@renew');
Route::get('/nella/shares/{id}/renew', 'SharesController@renew');

