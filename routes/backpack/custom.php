<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('group', 'GroupCrudController');
    Route::crud('item', 'ItemCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('supplier', 'SupplierCrudController');
    Route::crud('export', 'ExportCrudController');
    Route::crud('emport', 'EmportCrudController');
    Route::get('item/{id}/change', 'ItemCrudController@change');
    Route::get('inactveitems', 'AdminController@inactveitems');

}); // this should be the absolute last line of this file