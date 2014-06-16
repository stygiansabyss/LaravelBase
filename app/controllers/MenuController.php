<?php

class MenuController extends NukaCode\Core\Controllers\BaseController {

    public function getMenu()
    {
        // TLR Menu
        $this->menu = Menu::menu('mainLeft');

        $this->addMenuItem('Home', '/', 1);
        $this->addMenuItem('Memberlist', '/memberlist', 10000);

        $right = $this->menu->item('right');

        if (Auth::check()) {
            // Manage Menu
            if ($this->hasPermission('DEVELOPER')) {
                $this->addRightMenuItem('Management', 'javascript:void(0);');
                $this->addRightSubMenuItem('management', 'User Administration', '/admin/users');
            }

            // User Menu
            $this->addRightMenuItem($this->activeUser->username, '/user/view/' . $this->activeUser->uniqueId, null, 'user');
            $this->addRightSubMenuItem('user', 'Edit Profile', '/user/account');
            $this->addRightSubMenuItem('user', 'Logout', '/logout');
        } else {
            $this->addRightMenuItem('Login', '/login');
            $this->addRightMenuItem('Register', '/register');
            $this->addRightMenuItem('Forgot Password', '/forgotPassword');
        }
    }
}