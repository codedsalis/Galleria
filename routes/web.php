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

// Group routes for the app.galleria.ng subdomain
Route::group(['domain' => 'app.galleria.ng'], function () {
    
    // User dashboard
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Create a new webstore
    Route::middleware(['auth:sanctum', 'verified'])->get('/webstore/new', [
        App\Http\Controllers\Web\WebstoreController::class,
        'new'
    ])->name('webstore.new');

    // Webstore setup page
    Route::middleware(['auth:sanctum', 'verified'])->get('/webstore/{name}/setup', [
        App\Http\Controllers\Web\WebstoreController::class,
        'setup'
    ])->name('webstore.setup');
    
    Route::group(['prefix' => '{webstore}'], function () {
        // Webstore control panel
        Route::middleware(['auth:sanctum', 'verified'])->get('/controlpanel', [
            App\Http\Controllers\Web\WebstoreController::class,
            'controlPanel'
        ]);

        // Webstore categories
        Route::middleware(['auth:sanctum', 'verified'])->get('/categories', [
            App\Http\Controllers\Web\WebstoreController::class,
            'categories'
        ]);

        // Webstore Products items
        Route::middleware(['auth:sanctum', 'verified'])->get('/products', [
        App\Http\Controllers\Web\WebstoreController::class,
        'products'
        ]);
    });
});


Route::get('/', function () {
    return view('welcome');
});


// Webstore route. Strictly for registering 
// the webstores. eg galleria.ng/webstore-name
Route::get('{webstore}', [
    App\Http\Controllers\Web\WebstoreController::class,
    'webstore'
]);
