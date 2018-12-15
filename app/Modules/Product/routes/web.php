<?php
Route::group(['module' => 'Product', 'middleware' => ['auth','web'], 'namespace' => 'App\Modules\Product\Controllers'], function() {
    Route::get('/product/skuvalidation/{id}', array('as' => 'product.skuvalidation', 'uses' => 'ProductController@skuvalidation'));
    Route::resource('product', 'ProductController');
});
?>
