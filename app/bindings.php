<?php

// Repositories
App::bind('NukaCode\Core\Repositories\Contracts\UserRepositoryInterface', 'NukaCode\Core\Repositories\UserRepository');
App::bind('NukaCode\Core\Repositories\Contracts\RoleRepositoryInterface', 'NukaCode\Core\Repositories\User\Permission\RoleRepository');
App::bind('NukaCode\Core\Repositories\Contracts\ActionRepositoryInterface', 'NukaCode\Core\Repositories\User\Permission\ActionRepository');
App::bind('NukaCode\Core\Repositories\Contracts\PreferenceRepositoryInterface', 'NukaCode\Core\Repositories\User\PreferenceRepository');