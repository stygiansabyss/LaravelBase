## Installation
- composer create-package nukacode/laravel-base PROJECT_NAME --prefer-dist --dev
    - Replace PROJECT_NAME with the name you want the folder to be 
- Once this finishes, create an .env.local.php and add the following as needed.

```php
<?php

return [
    'database_host' => 'HOST',
    'database_name' => 'NAME',
    'database_user' => 'USER',
    'database_pass' => 'PASS',
 
    'remote_host' => 'HOST',
    'remote_user' => 'USER',
    'remote_pass' => 'PASS',
    'remote_key' => 'KEY',
    'remote_phrase' => 'PHRASE',
    'remote_home' => 'HOME',
];
```

- cd PROJECT_NAME
- Run the following commands

```bash
php artisan migrate:install
php artisan nuka:database
```

- Once finished, make sure to edit the details in app/configs/packages/nukacode/core/config.php

## Core
This package uses NukaCode/Core for most of the heavy lifting.  Core includes a full user, permission, preference and front end set up.  See that package for more details.

- [Github Project](https://github.com/NukaCode/core)
