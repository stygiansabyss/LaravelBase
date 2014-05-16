<?php

// 
// vendor/NukaCode/core/src/commands
// 

Artisan::add(App::make('NukaCode\Core\Commands\InstallCommand'));
Artisan::resolve('InstallCommand');

Artisan::add(App::make('NukaCode\Core\Commands\SetupCommand'));
Artisan::resolve('SetupCommand');

Artisan::add(App::make('NukaCode\Core\Commands\CleanCommand'));
Artisan::resolve('CleanCommand');

Artisan::add(App::make('NukaCode\Core\Commands\DatabaseCommand'));
Artisan::resolve('DatabaseCommand');

Artisan::add(App::make('NukaCode\Core\Commands\GulpCommand'));
Artisan::resolve('GulpCommand');

Artisan::add(App::make('NukaCode\Core\Commands\UpdateCoreCommand'));
Artisan::resolve('UpdateCoreCommand');