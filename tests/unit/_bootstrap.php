<?php
// Here you can initialize variables that will be used for your tests
 
$projectDir = \Codeception\Configuration::projectDir();
require $projectDir . '/vendor/autoload.php';

\Illuminate\Support\ClassLoader::register();

if (is_dir($workbench = $projectDir . 'workbench')) {
    \Illuminate\Workbench\Starter::start($workbench);
}
$unitTesting = true;
$testEnvironment = 'testing';
$app = require $projectDir . 'bootstrap/start.php';
$app->boot();