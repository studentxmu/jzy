<?php namespace App\Http\Middleware;

use Closure, Auth;
use \App\User;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}

        $loginuserid = Auth::user()->id;
        $url = $request->path();
        $method = $request->method();
        $action = '';
        if ($url == 'admin') {
            $action = 'dashboard';
        }
        if ($url == 'admin/users' || $request->is('admin/users/*')) {
            $action = 'permission';
        }
        if ($request->is('admin/employees*')) {
            if ($url == 'admin/employees/create') {
                $action = 'user-add';
            } elseif ($request->is('admin/employees/*/edit')) {
               $action = 'user-edit';
            } else {
                $action = 'user-index';
            }
        }
        if ($request->is('admin/cars*')) {
            if ($url == 'admin/cars/create') {
                $action = 'car-add';
            } elseif ($request->is('admin/cars/*/edit')) {
               $action = 'car-edit';
            } else {
                $action = 'car-index';
            }
        }
        if ($request->is('admin/catagorys*')) {
            if ($url == 'admin/catagorys/create') {
                $action = 'cate-add';
            } elseif ($request->is('admin/catagorys/*/edit')) {
               $action = 'cate-edit';
            } else {
                $action = 'cate-index';
            }
        }
        if ($request->is('admin/buyers*')) {
            if ($url == 'admin/buyers/create') {
                $action = 'buyer-add';
            } elseif ($request->is('admin/buyers/*/edit')) {
               $action = 'buyer-edit';
            } else {
                $action = 'buyer-index';
            }
        }
        if ($request->is('admin/finances*')) {
            if ($request->is('admin/finances/create/*')) {
                $action = 'finance-add';
            } elseif ($request->is('admin/buyers/*/edit')) {
               $action = 'finance-edit';
            } elseif ($request->is('admin/finances/search*')) {
               $action = 'finance-search';
            } elseif ($request->is('admin/finances/latest*')) {
               $action = 'finance-latest';
            } else {
                $action = 'finance-list';
            }
        }
        if ($request->is('admin/transactions*')) {
            if ($request->is('admin/transactions/create/*')) {
                $action = 'trans-add';
            } elseif ($request->is('admin/transactions/*/edit')) {
               $action = 'trans-edit';
            } elseif ($request->is('admin/transactions/search*')) {
               $action = 'trans-search';
            } elseif ($request->is('admin/transactions/latest*')) {
               $action = 'trans-latest';
            } else {
                $action = 'trans-index';
            }
        }
        if (!empty($action) && !User::isLimit($action, $loginuserid)) {
            return response('您没有权限！请联系你的上级！', 401);
        }

		return $next($request);
	}

}
