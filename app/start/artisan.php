<?php

// 
// vendor/NukaCode/core/src/commands
//

Artisan::add(App::make('NukaCode\Core\Commands\InstallCommand'));
Artisan::resolve('NukaCode\Core\Commands\InstallCommand');

Artisan::add(App::make('NukaCode\Core\Commands\ThemeCommand'));
Artisan::resolve('NukaCode\Core\Commands\ThemeCommand');

Artisan::add(App::make('NukaCode\Core\Commands\SetupCommand'));
Artisan::resolve('NukaCode\Core\Commands\SetupCommand');

Artisan::add(App::make('NukaCode\Core\Commands\CleanCommand'));
Artisan::resolve('NukaCode\Core\Commands\CleanCommand');

Artisan::add(App::make('NukaCode\Core\Commands\DatabaseCommand'));
Artisan::resolve('NukaCode\Core\Commands\DatabaseCommand');

Artisan::add(App::make('NukaCode\Core\Commands\GulpCommand'));
Artisan::resolve('NukaCode\Core\Commands\GulpCommand');

Artisan::add(App::make('NukaCode\Core\Commands\UpdateCoreCommand'));
Artisan::resolve('NukaCode\Core\Commands\UpdateCoreCommand');