## Installation
- composer create-package nukacode/laravel-base <project name> --prefer-dist --dev
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

- cd <project name>
- Run the following commands

```bash
php artisan migrate:install
php artisan nuka:database
```

- Once finished, make sure to edit the details in app/configs/packages/nukacode/core/config.php
