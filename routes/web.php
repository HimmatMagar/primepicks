<?php

use App\Http\Controllers\payment\PaymentController;
use App\Http\Controllers\cart\AddToCartHandler;
use App\Http\Controllers\main\AllPageController;
use App\Http\Controllers\cart\CommentController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\main\HandleAuthController;
use App\Http\Controllers\cart\ProductController;
use App\Http\Controllers\SellerMailController;
use App\Http\Middleware\CheckAuthenticated;
use Illuminate\Support\Facades\Route;

Route::controller(AllPageController::class) -> group(function() {

    Route::middleware(CheckAuthenticated::class) -> group(function() {
        Route::get('become a seller', 'becomeAsellerPage') -> name('seller');
        Route::get('help and support', 'helpAndSupportPage') -> name('help');
        Route::post('sendmail', [SellerMailController::class, 'sendRequest']) -> name('seller.apply');
        Route::post('contactmail', [ContactRequestController::class, 'sendRequest']) -> name('contact');
        Route::get('profile', 'profile') -> name('profile');
        Route::resource('product', ProductController::class);
        Route::get('editProduct', 'editProduct') -> name('editProduct');
        
        Route::controller(AddToCartHandler::class) -> group(function() {
            Route::get('cart', 'showCartProduct') -> name('cart');
            Route::post('/cart/{postId}', 'addProduct') -> name('cart.product');
            Route::delete('remove/{id}', 'removeProduct') -> name('cart.remove');  
            Route::post('cart/checkout', 'checkout') -> name('checkout');
        });

        Route::get('/paypal/checkout', [PaymentController::class, 'checkout'])->name('paypal.checkout');
        Route::get('/paypal/success', [PaymentController::class, 'paymentSuccess'])->name('paypal.success');
        Route::get('/paypal/cancel', [PaymentController::class, 'paymentCancel'])->name('paypal.cancel');
        
        Route::get('/order/{id}', [AllPageController::class, 'showOrder']) -> name('order');
        #For Comment
        Route::post('product/comment/{product}', [CommentController::class, 'comment']) -> name('comment');
    });
    
        Route::get('/', 'homePage') -> name('home');
        Route::controller(HandleAuthController::class) -> group(function() {
            Route::get('signup', 'signupPage') -> name('signupPage');
            Route::get('signin', 'signinPage') -> name('signinPage');

            Route::post('signup', 'signup') -> name('signup');
            Route::post('signin', 'signin') -> name('signin');
            Route::post('logout', 'signout') -> name('logout');
        });
        Route::get('single product/index={id}', 'showSelectedProduct') -> name('product.view');

});

