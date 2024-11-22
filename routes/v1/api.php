<?php



Route::prefix(config('callmeaf-base.api.prefix_url'))->as(config('callmeaf-base.api.prefix_route_name'))->middleware(config('callmeaf-base.api.middlewares'))->group(function() {
    Route::apiResource('continents',config('callmeaf-continent.controllers.continents'));
    Route::prefix('continents')->as('continents.')->controller(config('callmeaf-continent.controllers.continents'))->group(function() {
        Route::prefix('{continent}')->group(function() {
            Route::patch('/status','statusUpdate')->name('status_update');
        });
    });

    Route::apiResource('countries', config('callmeaf-country.controllers.countries'));
    Route::prefix('countries')->as('countries.')->controller(config('callmeaf-country.controllers.countries'))->group(function () {
        Route::prefix('{country}')->group(function () {
            Route::patch('/status', 'statusUpdate')->name('status_update');
        });
    });

    // Province
    Route::apiResource('provinces',config('callmeaf-province.controllers.provinces'));
    Route::prefix('provinces')->as('provinces.')->controller(config('callmeaf-province.controllers.provinces'))->group(function() {
        Route::prefix('{province}')->group(function() {
            Route::patch('/status','statusUpdate')->name('status_update');
        });
    });
});


