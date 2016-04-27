<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    public $actions = array(
        'dashboard' => 0,
        'permission' => 1,
        'user-index' => 2,
        'user-view' => 3,
        'user-edit' => 4,
        'user-delete' => 5,
        'car-index' => 6,
        'car-view' => 7,
        'car-edit' => 8,
        'car-delete' => 9,
        'cate-index' => 10,
        'cate-view' => 11,
        'cate-edit' => 12,
        'cate-delete' => 13,
        'buyer-index' => 14,
        'buyer-view' => 15,
        'buyer-edit' => 16,
        'buyer-delete' => 17,
        'buyer-latest' => 18,
        'buyer-export' => 19,
        'trans-index' => 20,
        'trans-view' => 21,
        'trans-edit' => 22,
        'trans-delete' => 23,
        'trans-latest' => 24,
        'trans-search' => 25,
        'finance-list' => 26,
        'finance-view' => 27,
        'finance-edit' => 28,
        'finance-delete' => 29,
        'finance-latest' => 30,
        'finance-search' => 31,
    );

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

}
