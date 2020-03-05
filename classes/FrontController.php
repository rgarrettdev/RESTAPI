<?php
/**
 * 
 * Used to set valid routes for the api human readable pages.
 * 
 */
Route::set('index.php', NULL, NULL, NULL, function() {
    Index::createView('Index');
});

Route::set('about', NULL, NULL, NULL, function() {
    About::createView('About');
});

Route::set('documentation', NULL, NULL, NULL, function() {
    Documentation::createView('Documentation');
});
/**
 * 
 * This is the route to the api landing page localhost/api/.
 * 
 */
Route::set('api', NULL, NULL, NULL, function() {
    Api::createView('Api');
    Api::printMasterQuery();
});
/**
 * 
 * This is the route to the api schedule page localhost/api/schedule/.
 * 
 */
Route::set('api', 'schedule', ':session', NULL, function() {
    Api::createView('Api');
    Api::printScheduleQuery();
});

?>