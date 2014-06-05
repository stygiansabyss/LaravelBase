<?php

include_once(base_path('vendor/nukacode/core/src/routes.php'));

// Landing page
Route::controller('/', 'HomeController');

require_once('start/local.php');
