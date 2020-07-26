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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth'],], function() {
    //Produits
Route::get('/produits',['as' => 'product.index', 'uses' => 'ProductController@index']);
Route::post('/recherche-produit',['as' => 'product.indexRequest', 'uses' => 'ProductController@index']);
Route::post('/produits',['as' => 'product.active', 'uses' => 'ProductController@active'])->middleware('activeProduct');
Route::get('/ajout-produit',['as' => 'product.create', 'uses' => 'ProductController@create']);
Route::post('/ajout-produit',['as' => 'product.postcreate', 'uses' => 'ProductController@store']);
Route::get('/produit/{produit}',['as' => 'product.edit', 'uses' => 'ProductController@edit']);
Route::post('/produit/{produit}',['as' => 'product.update', 'uses' => 'ProductController@update']);
//Categorie Produit
Route::get('/ajout-categorie',['as' => 'category.create', 'uses' => 'ProductCategoryController@create']);
Route::post('/ajout-categorie',['as' => 'category.postcreate', 'uses' => 'ProductCategoryController@store']);
Route::get('/categories-produits',['as' => 'category.product.index', 'uses' => 'ProductCategoryController@index']);
Route::post('/categories-produits',['as' => 'category.product.indexRequest', 'uses' => 'ProductCategoryController@index']);

Route::get('/categorie-produits/{categorie}',['as' => 'category.product.edit', 'uses' => 'ProductCategoryController@edit']);
Route::post('/categorie-produits/{categorie}',['as' => 'category.product.update', 'uses' => 'ProductCategoryController@update']);

Route::get('/mon-commerce',['as' => 'shop.show', 'uses' => 'ShopController@show']);
Route::post('/mon-commerce',['as' => 'shop.updateShop', 'uses' => 'ShopController@updateShop']);

Route::get('/commandes', ['as' => 'order.index', 'uses' => 'OrderController@index']);
Route::get('/commande/{commande}', ['as' => 'order.show', 'uses' => 'OrderController@show']);
Route::post('/commande/{commande}', ['as' => 'order.validate', 'uses' => 'OrderController@validateOrder']);
});

//Utilisateur


// Etat Commande
Route::get('/api/orders', 'OrderController@stateOrder');


//S'enregistrer
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('hasInvitation');
Route::post('register', 'Auth\RegisterController@register')->middleware('createUser');

Route::group(['middleware' => ['auth', 'admin'],], function() {
    //Commerces
    Route::get('/ajout-commerce',['as' => 'shop.create', 'uses' => 'ShopController@create']);
    Route::post('/ajout-commerce',['as' => 'shop.postcreate', 'uses' => 'ShopController@store']);
    Route::get('/commerces',['as' => 'shop.index', 'uses' => 'ShopController@index']);
    Route::post('/commerces',['as' => 'shop.indexRequest', 'uses' => 'ShopController@index']);
    Route::get('/commerce/{commerce}',['as' => 'shop.edit', 'uses' => 'ShopController@edit']);
    Route::post('/commerce/{commerce}',['as' => 'shop.update', 'uses' => 'ShopController@update']);
    Route::get('/invitations', 'InvitationsController@index')->name('showInvitations');
    Route::post('/invitations', 'InvitationsController@store')->name('storeInvitation');
    Route::get('/ajout-categorie-commerce',['as' => 'category.shop.create', 'uses' => 'ShopCategoryController@create']);
    Route::post('/ajout-categorie-commerce',['as' => 'category.shop.postcreate', 'uses' => 'ShopCategoryController@store']);
    Route::get('/categories-commerces',['as' => 'category.shop.index', 'uses' => 'ShopCategoryController@index']);
    Route::post('/categories-commerces',['as' => 'category.shop.indexRequest', 'uses' => 'ShopCategoryController@index']);
    Route::get('/categorie-commerces/{categorie}',['as' => 'category.shop.edit', 'uses' => 'ShopCategoryController@edit']);
    Route::post('/categorie-commerces/{categorie}',['as' => 'category.shop.update', 'uses' => 'ShopCategoryController@update']);
    Route::get('register/request', 'Auth\RegisterController@requestInvitation')->name('requestInvitation');
    Route::get('/utilisateurs',['as' => 'user.index', 'uses' => 'UserController@index']);
    Route::post('/utilisateurs',['as' => 'user.indexRequest', 'uses' => 'UserController@index']);
    Route::get('/produits-commerce/{commerce}',['as' => 'admin.product.index', 'uses' => 'Admin\ProductController@index']);
    Route::post('/recherche-commerce/{commerce}',['as' => 'admin.product.indexRequest', 'uses' => 'Admin\ProductController@index']);
    Route::get('/intro-commerce/{commerce}',['as' => 'admin.intro.index', 'uses' => 'Admin\ProductController@intro']);
    Route::get('/admin/ajout-produit/{commerce}',['as' => 'admin.product.create', 'uses' => 'Admin\ProductController@create']);
    Route::post('/admin/ajout-produit/{commerce}',['as' => 'admin.product.store', 'uses' => 'Admin\ProductController@store']);
    Route::get('/admin/commerce/{commerce}/produit/{produit}',['as' => 'admin.product.edit', 'uses' => 'Admin\ProductController@edit']);
    Route::post('/admin/commerce/{commerce}/produit/{produit}',['as' => 'admin.product.update', 'uses' => 'Admin\ProductController@update']);
    Route::post('/produits-commerce/{commerce}',['as' => 'admin.product.active', 'uses' => 'Admin\ProductController@active']);
    Route::get('/rechercher-commerce',['as' => 'shop.search.get', 'uses' => 'ShopController@search']);
    Route::post('/rechercher-commerce',['as' => 'shop.search', 'uses' => 'ShopController@searchPost']);

    Route::get('categories-produits/{commerce}',['as' => 'admin.category.index', 'uses' => 'Admin\ProductCategoryController@index']);
    Route::post('categories-produits/{commerce}',['as' => 'admin.category.indexRequest', 'uses' => 'Admin\ProductCategoryController@index']);
    Route::get('/ajout-categorie-produit/{commerce}',['as' => 'category.product.create', 'uses' => 'Admin\ProductCategoryController@create']);
    Route::post('/ajout-categorie-produit/{commerce}',['as' => 'category.product.postcreate', 'uses' => 'Admin\ProductCategoryController@store']);
    Route::get('/admin/commerce/{commerce}/categorie/{categorie}',['as' => 'admin.category.edit', 'uses' => 'Admin\ProductCategoryController@edit']);
    Route::post('/admin/commerce/{commerce}/categorie/{categorie}',['as' => 'admin.category.update', 'uses' => 'Admin\ProductCategoryController@update']);
    Route::get('/api/shops', 'Api\ShopController@index');

    Route::get('/clients',['as' => 'customer.index', 'uses' => 'Admin\CustomerController@index']);
    Route::post('/clients',['as' => 'customer.indexRequest', 'uses' => 'Admin\CustomerController@index']);
    Route::get('/admin/commandes', ['as' => 'admin.order.index', 'uses' => 'Admin\OrderController@index']);
    Route::get('/admin/commande/{commande}', ['as' => 'admin.order.show', 'uses' => 'Admin\OrderController@show']);
    Route::post('/admin/commande/{commande}', ['as' => 'admin.order.validate', 'uses' => 'Admin\OrderController@validateOrder']);
    Route::get('/api/admin/orders', 'Admin\OrderController@stateOrder');

});




