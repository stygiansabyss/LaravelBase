<?php

class MenuController extends NukaCode\Core\Controllers\BaseController
{

	public function getMenu()
	{
		Menu::handler('main')
			->add('/', 'Home');

		if (Auth::check()) {
			// Manage Menu
			if ($this->hasPermission('DEVELOPER')) {
				Menu::handler('mainRight')
					->add('javascript:void(0);', 'Management', Menu::items()
						->add('/admin/users', 'User Administration'));
			}

			// User Menu
			Menu::handler('mainRight')
				->add('/user/view/'. $this->activeUser->id, $this->activeUser->username, Menu::items()
					->add('/user/account', 'Edit Profile')
					->add('/logout', 'Logout'));
		} else {
			Menu::handler('mainRight')
				->add('/login', 'Login')
				->add('/register', 'Register')
				->add('/forgotPassword', 'Forgot Password');
		}

		Menu::handler('main')
			->add('/memberlist', 'Memberlist');
	}

	public function setAreaDetails($area)
	{
		$location = (Request::segment(2) != null ? ': '. ucwords(Request::segment(2)) : '');

		if ($area != null) {
			$this->pageTitle = ucwords($area).$location;
		} else {
			$this->pageTitle = Config::get('app.siteName'). (Request::segment(1) != null ? ': '.ucwords(Request::segment(1)) : '');
		}
	}
}