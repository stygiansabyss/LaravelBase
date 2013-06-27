<?php
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseController extends Controller {

	protected $data      		= array();

	protected $pageTitle;

	protected $route;

	protected $activeUser;

	protected $layout;

	protected $redirectPath		= null;

	protected $skipView 		= false;

	/**
	 * Layouts array
	 *
	 * @var string[] $layouts Array of layout templates
	 */
	protected $layoutOptions = array(
		'default' => 'layouts.default',
		'ajax'    => 'layouts.ajax'
	);

	/**
	 * Create a new Controller instance.
	 * Assigns the active user
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Login required options
		if (Auth::check()) {
			$this->activeUser = Auth::user();
		}
	}

	public function missingMethod($parameters)
	{
		if (!$parameters[0]) {
			$action = 'index';
		} else {
			$action = $parameters[0];
		}

		$route = Route::getContainer()->router->currentRouteAction();
		$route = str_replace('missingMethod', $action, $route);

		// Need to check if view exists. If not abort.
		// App::abort(404, 'Page not found');

		$this->route = $this->cleanRoute($route);
	}

	protected function processResponse($router, $method, $response)
	{
		if (!$this->skipView) {
			$route                 = ($this->redirectPath != null ? $this->redirectPath : $this->route);
			$this->layout->content = View::make($route)->with($this->data);
		}
		return parent::processResponse($router, $method, $response);
	}

	/**
	 * Master template method
	 * Sets the template based on location and passes variables to the view.
	 *
	 * @param  string[] $data  An array of variables to pass to the view
	 * @param  string[] $route The route for the view
	 *
	 * @return void
	 */
	public function setupLayout()
	{
		if ( is_null($this->layout) ) {
			if ( Request::ajax() ) {
				$this->layout = View::make($this->layoutOptions['ajax']);
			} else {
				$this->layout = View::make($this->layoutOptions['default']);
			}
		} else {
			$this->layout = View::make($this->layout);
		}

		if ($this->route == null) {
			$route = Route::getContainer()->router->currentRouteAction();
			$this->route = $this->cleanRoute($route);
		}

		$this->data['activeUser'] = $this->activeUser;

		$this->layout->pageTitle  = $this->pageTitle;
		$this->layout->activeUser = $this->activeUser;
	}

	protected function cleanRoute($route)
	{
		$route         = str_replace('_', '.', $route);
		$routeParts    = explode('@', $route);
		$routeParts[1] = preg_replace('/^get/', '', $routeParts[1]);
		$routeParts[1] = preg_replace('/^post/', '', $routeParts[1]);
		$route         = strtolower(str_replace('Controller', '', implode('.', $routeParts)));

		return $route;
	}

	public function setViewData($text, $data)
	{
		$this->data[$text] = $data;
	}

	public function setViewAllData(array $data)
	{
		foreach ($data as $variable => $details) {
			$this->data[$variable] = $details;
		}
	}

	public function setViewPath($view)
	{
		$this->redirectPath = $view;
	}

	public function hasPermission($permissions)
	{
		if (Auth::check()) {
			if ($this->activeUser->is('DEVELOPER')) {
				return true;
			}
			$access = $this->activeUser->can($permissions);

			if ($access === true) {
				return true;
			}
		}
		Session::put('pre_login_url', Request::path());
		return false;
	}

	public function hasRole($roles)
	{
		if (Auth::check()) {
			if ($this->activeUser->is('DEVELOPER')) {
				return true;
			}
			$access = $this->activeUser->is($roles);

			if ($access === true) {
				return true;
			}
		}
		Session::put('pre_login_url', Request::path());
		return false;
	}

	public static function errorRedirect()
	{
		return Redirect::back()->with_errors(array('You lack the permission(s) required to view this area'))->send();
	}

	public static function redirect($location, $message = null, $back = null)
	{
		if ($message == null) {
			if ($back != null) {
				return Redirect::back()->send();
			}
			return Redirect::to($location)->send();
		} else {
			if ($back != null) {
				return Redirect::back()->with('message', $message)->send();
			}
			return Redirect::to($location)->with('message', $message)->send();
		}
	}

	public static function arrayToSelect($array, $key = 'id', $value = 'name', $first = 'Select One')
	{
		$results = array(
			$first
		);
		foreach ($array as $item) {
			$results[$item->{$key}] = stripslashes($item->{$value});
		}

		return $results;
	}

}