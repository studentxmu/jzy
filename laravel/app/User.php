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

    public static $actions = array(
        'dashboard' => 0,
        'permission' => 1,
        'user-index' => 2,
        'user-add' => 3,
        'user-edit' => 4,
        'user-delete' => 5,
        'car-index' => 6,
        'car-add' => 7,
        'car-edit' => 8,
        'car-delete' => 9,
        'cate-index' => 10,
        'cate-add' => 11,
        'cate-edit' => 12,
        'cate-delete' => 13,
        'buyer-index' => 14,
        'buyer-add' => 15,
        'buyer-edit' => 16,
        'buyer-delete' => 17,
        'buyer-latest' => 18,
        'buyer-export' => 19,
        'trans-index' => 20,
        'trans-add' => 21,
        'trans-edit' => 22,
        'trans-delete' => 23,
        'trans-latest' => 24,
        'trans-search' => 25,
        'finance-list' => 26,
        'finance-add' => 27,
        'finance-edit' => 28,
        'finance-delete' => 29,
        'finance-latest' => 30,
        'finance-search' => 31,
        'car-audit' => 32,
        'log-view' => 33,
    );

    public static $actionnames = array(
        '首页' => 0,
        '权限' => 1,
        '员工列表' => 2,
        '员工新增' => 3,
        '员工编辑' => 4,
        '员工删除' => 5,
        '车辆列表' => 6,
        '车辆新增' => 7,
        '车辆编辑' => 8,
        '车辆删除' => 9,
        '分类列表' => 10,
        '分类新增' => 11,
        '分类编辑' => 12,
        '分类删除' => 13,
        '货主列表' => 14,
        '货主新增' => 15,
        '货主编辑' => 16,
        '货主删除' => 17,
        '货主分类账' => 18,
        '货主导出' => 19,
        '运单列表' => 20,
        '运单新增' => 21,
        '运单编辑' => 22,
        '运单删除' => 23,
        '运单分类账' => 24,
        '运单搜索' => 25,
        '财务分类帐' => 26,
        '财务新增' => 27,
        '财务编辑' => 28,
        '财务删除' => 29,
        '财务流水账' => 30,
        '财务搜索' => 31,
        '车辆审计' => 32,
        '操作日志' => 33,
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

    public function isAdmin()
    {
        return in_array($this->id, array(1, 2));
    }

    public function permit()
    {
        return $this->hasOne('App\Permit', 'user_id', 'id');
    }
    
    public static function isLimit($action, $userid)
    {
        $user = self::find($userid);
        if (!empty($user->permit->data)) {
            $permits = explode(',', $user->permit->data);
            if (isset(self::$actions[$action]) && isset($permits[self::$actions[$action]]) && $permits[self::$actions[$action]] == 1) {
                return true;
            }
        }
        return false;
    }

}
