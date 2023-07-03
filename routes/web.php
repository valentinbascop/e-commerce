<?php

use Illuminate\Support\Facades\Route;

// Route côté frontend

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index'])->name('home');
    Route::get('products/{id}', ['as' => 'products.show', 'uses' => 'ProductController@show']);

    // Inscription
    Route::get('/register', 'AuthController@showRegistrationForm')->name('register');
    Route::post('/register', 'AuthController@register');

    // Connexion
    Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@showLoginForm']);
    Route::post('/login', 'AuthController@login');

    // Déconnexion
    Route::post('/logout', 'AuthController@logout')->name('logout')->middleware('auth');

    Route::get('/seeInfo', 'AuthController@seeInfo')->name('seeInfo')->middleware('auth');

    // Gestion du profil utilisateur
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit')->middleware('auth');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update')->middleware('auth');

    
    Route::get('/cart', 'CartController@showCart')->name('cart');
    Route::post('/cart/add/{product}', 'CartController@addToCart')->name('cart.add');
    Route::post('cart/pay', [CartController::class, 'pay'])->name('cart.pay');
    Route::delete('/cart/remove/{cartItem}', 'CartController@removeFromCart')->name('cart.remove');
});

// Route côté back
Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'backend.'], function () {
    // Inscription
    Route::get('/register', 'LoginController@showRegistrationForm')->name('register');
    Route::post('/register', 'LoginController@register');

    // Connexion
    Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('/login', 'LoginController@login');

    // Déconnexion
    Route::post('/logout', 'LoginController@logout')->name('logout')->middleware('admin');
    
    Route::delete('products/{productId}/images/{imageId}', 'ProductController@deleteImage')->name('products.deleteImage');

    
    Route::group(['middleware' => ['admin']], function () {
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show', 'create']);
    });
});
