<?php
/**
 *
 * Used to set valid routes for the api human readable pages.
 *
 */
Route::set('index.php', null, function () {
    Index::createView('Index');
});

Route::set('about', null, function () {
    About::createView('About');
});

Route::set('documentation', null, function () {
    Documentation::createView('Documentation');
});
/**
 *
 * This is the route to the api landing page localhost/api/.
 *
 */
Route::set('api', null, function () {
    Api::createView('Api');
});
/**
 *
 * This is the route to the api schedule page localhost/api/schedule/.
 *
 */
Route::set('api', 'schedule', function () {
    Api::createView('Api');
});
/**
 *
 * This is the route to the api presentations page localhost/api/presentations/.
 *
 */
Route::set('api', 'presentations', function () {
    Api::createView('Api');
});

Route::set('api', 'login', function () {
    Api::createView('Api');
});

Route::set('api', 'logout', function () {
    Api::createView('Api');
});
