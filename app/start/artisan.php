<?php

// 
// vendor/nukacode/core/src/NukaCode/Core/Commands
//
 Artisan::add(App::make('NukaCode\Core\Commands\ThemeCommand'));
 Artisan::resolve('NukaCode\Core\Commands\ThemeCommand');

 Artisan::add(App::make('NukaCode\Core\Commands\DatabaseCommand'));
 Artisan::resolve('NukaCode\Core\Commands\DatabaseCommand');