<?php

Route::group(['module' => 'Category', 'middleware' => ['auth', 'web'], 'namespace' => 'App\Modules\Category\Controllers'], function() {
    Route::resource('category', 'CategoryController');
});
?>
