<?php

use NukaCode\Core\Models\User as BaseUser;
use Illuminate\Auth\UserInterface;

class User extends BaseUser implements UserInterface {}