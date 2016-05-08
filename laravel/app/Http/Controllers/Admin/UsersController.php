<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User, App\Workday, App\Permit;
use Redirect, Input, Auth;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $users = User::orderBy('id')->paginate(25);
        $data = array(
            'users' => $users,
            'count' => User::count(),
        );
		return view('admin.users.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        //dd(Input::all());
        $this->validate($request, [
            //'address'  => 'required|min:10',
        ]);
        $user = new User;
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = bcrypt(Input::get('password'));

        if ($user->save()) {
            $permit = new Permit;
            $permit->user_id = $user->id;
            $permit->data = '';
            $permit->save();
            return Redirect::to('admin/users')->withErrors('添加成功！');
        } else {
            return Redirect::back()->withErrors('保存失败');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = User::find($id);
        $permits = array();
        if (!empty($user->permit->data)) {
            $permits = explode(',', $user->permit->data);
        }
        $data = array(
            'user' => $user,
            'names' => User::$actionnames,
            'permits' => $permits,
        );
		return view('admin.users.show', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function settings($userid)
	{
        $permit = Permit::where('user_id', '=', $userid)->take(1)->get();
        if (!empty($permit) && isset($permit[0])) {
            $permit = $permit[0];
        }
        if (empty($permit->id)) {
            $permit = new Permit;
        }
        $permits = Input::get('permits');
        $permitsdata = '';
        if (!empty($permits) && is_array($permits)) {
            $actionnames = User::$actionnames;
            $permitsarray = array();
            foreach ($actionnames as $key=>$val) {
                $permitsarray[$val] = 0;
                if (isset($permits[$val]) && $permits[$val] == 1) {
                    $permitsarray[$val] = 1;
                }
            }
            $permitsdata = implode(',', $permitsarray);
        }

        $permit->user_id = $userid;
        $permit->data = $permitsdata;

        if ($permit->save()) {
            return Redirect::to('admin/users/'.$userid)->withErrors('编辑成功！');
        } else {
            return Redirect::back()->withErrors('保存失败');
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::find($id);
        $data = array(
            'user' => $user,
        );
		return view('admin.users.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//
        $user = User::find($id);
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $password = Input::get('password');
        if (!empty($password)) {
            if (strlen($password) < 6) {
                return Redirect::back()->withErrors('密码位数必须大于6');
            }
            $user->password = bcrypt($password);
        }

        if ($user->save()) {
            return Redirect::to('admin/users')->withErrors('编辑成功！');
        } else {
            return Redirect::back()->withErrors('保存失败');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $user = User::find($id);
        $user->delete();
        return Redirect::back()->withErrors('删除成功');
	}

}
