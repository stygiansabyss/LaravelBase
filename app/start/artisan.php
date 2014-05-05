<?php

Artisan::add(new InstallCommand);
Artisan::resolve('InstallCommand');

Artisan::add(new ConfigureCommand);
Artisan::resolve('ConfigureCommand');

Artisan::add(new SetupCommand);
Artisan::resolve('SetupCommand');

Artisan::add(new CleanCommand);
Artisan::resolve('CleanCommand');

Artisan::add(new DatabaseCommand);
Artisan::resolve('DatabaseCommand');

Artisan::add(new GulpCommand);
Artisan::resolve('GulpCommand');

Artisan::add(new UpdateCoreCommand);
Artisan::resolve('UpdateCoreCommand');