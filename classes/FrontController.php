<?php
/**
 * 
 * Used to set valid routes for the api human readable pages.
 * 
 */
Route::set('index.php', NULL, function() {
    Index::createView('Index');
});

Route::set('about', NULL, function() {
    About::createView('About');
});

Route::set('documentation', NULL, function() {
    Documentation::createView('Documentation');
});
/**
 * 
 * This is the route to the api landing page localhost/api/.
 * 
 */
Route::set('api', NULL, function() {
    Api::createView('Api');
    Api::printMasterQuery();
});
/**
 * 
 * This is the route to the api schedule page localhost/api/schedule/.
 * 
 */
Route::set('api', 'schedule', function() {
    Api::createView('Api');
});
/**
 * 
 * This is the route to the api presentations page localhost/api/presentations/.
 * 
 */
Route::set('api', 'presentations', function() {
    Api::createView('Api');
});

Route::set('api', 'login', function() {
    Api::createView('Api');
});

?>