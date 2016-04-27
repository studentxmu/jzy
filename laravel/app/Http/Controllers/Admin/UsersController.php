<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User, App\Workday;
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
        $employees = Employee::orderBy('id')->paginate(25);
        $departs = Employee::$departs;
        $data = array(
            'employees' => $employees,
            'departs' => $departs,
            'count' => Employee::count(),
            'peoples' => json_encode($peoples),
        );
		return view('admin.employees.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('admin.employees.create');
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
        if (Input::hasFile('image'))
        {
            $file = Input::file('image');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameIamge = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move('images', $newNameIamge);
            }
        }
        if (Input::hasFile('idfront'))
        {
            $file = Input::file('idfront');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameIdfront = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameIdfront);
            }
        }
        if (Input::hasFile('idend'))
        {
            $file = Input::file('idend');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameIdend = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameIdend);
            }
        }
        if (Input::hasFile('drivefront'))
        {
            $file = Input::file('drivefront');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameDrivefront = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameDrivefront);
            }
        }
        $employee = new Employee;
        $employee->name = Input::get('name');
        $employee->alpha = Input::get('alpha');
        $employee->firstalpha = Input::get('firstalpha');
        $employee->sex = Input::get('sex');
        $employee->mobile = intval(Input::get('mobile'));
        $employee->idcode = Input::get('idcode');
        $employee->drivecode = Input::get('drivecode');
        $employee->jointime = '2000-01-01';
        $employee->lefttime = '2099-01-01';
        $employee->address = Input::get('address');
        $employee->depart_id = Input::get('depart_id');
        !empty($newNameIamge) && $employee->imageurl = $newNameIamge;
        !empty($newNameIdfront) && $employee->idfronturl = $newNameIdfront;
        !empty($newNameIdend) && $employee->idendurl = $newNameIdend;
        !empty($newNameDrivefront) && $employee->drivefronturl = $newNameDrivefront;

        if ($employee->save()) {
            return Redirect::to('admin/employees')->withErrors('添加成功！');
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
        $employee = Employee::find($id);
        $departs = Employee::$departs;
        $workdays = $employee->liushui();
        $kaoqins = $employee->kaoqin();
        $data = array(
            'employee' => $employee,
            'departs' => $departs,
            'workdays' => $workdays,
            'kaoqins' => $kaoqins,
        );
		return view('admin.employees.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $employee = Employee::find($id);
        $departs = Employee::$departs;
        $data = array(
            'employee' => $employee,
            'departs' => $departs,
        );
		return view('admin.employees.edit', $data);
	}

	/**
	 * @param  int  $id
	 * @return Response
	 */
	public function download($id, $type)
	{
		//
        $employee = Employee::find($id);
        switch ($type) {
            case '1':
                {
                    $url = $employee->idfronturl;
                    $name = '-身份证-正面';
                    break;
                }
            case '2':
                {
                    $url = $employee->idendurl;
                    $name = '-身份证-反面';
                    break;
                }
            case '3':
                {
                    $url = $employee->drivefronturl;
                    $name = '-行驶证-正面';
                    break;
                }
            case '4':
            default:
                {
                    $url = $employee->driveendurl;
                    $name = '-行驶证-反面';
                    break;
                }
        }
        if (!empty($url)) {
            $pathToFile = storage_path() . '/upload/' . $url;
            return response()->download($pathToFile);
        }
        
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
        $this->validate($request, [
           // 'address'  => 'required|min:10',
        ]);
        if (Input::hasFile('image'))
        {
            $file = Input::file('image');
            if ($file->isValid()) {
                $allowed_extensions = ["png", "jpg", "gif"];
                if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                    return Redirect::back()->withErrors('You may only upload png, jpg or gif.');
                }
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameIamge = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move('images', $newNameIamge);
            }
        }
        if (Input::hasFile('idfront'))
        {
            $file = Input::file('idfront');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameIdfront = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameIdfront);
            }
        }
        if (Input::hasFile('idend'))
        {
            $file = Input::file('idend');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameIdend = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameIdend);
            }
        }
        if (Input::hasFile('drivefront'))
        {
            $file = Input::file('drivefront');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameDrivefront = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameDrivefront);
            }
        }
        $employee = Employee::find($id);
        $employee->name = Input::get('name');
        $employee->alpha = Input::get('alpha');
        $employee->firstalpha = Input::get('firstalpha');
        $employee->sex = Input::get('sex');
        $employee->mobile = intval(Input::get('mobile'));
        $employee->idcode = Input::get('idcode');
        $employee->drivecode = Input::get('drivecode');
        $employee->jointime = '2000-01-01';
        $employee->lefttime = '2099-01-01';
        $employee->address = Input::get('address');
        $employee->depart_id = Input::get('depart_id');
        !empty($newNameIamge) && $employee->imageurl = $newNameIamge;
        !empty($newNameIdfront) && $employee->idfronturl = $newNameIdfront;
        !empty($newNameIdend) && $employee->idendurl = $newNameIdend;
        !empty($newNameDrivefront) && $employee->drivefronturl = $newNameDrivefront;

        if ($employee->save()) {
            return Redirect::to('admin/employees')->withErrors('编辑成功！');
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
        $employee = Employee::find($id);
        $employee->delete();
        return Redirect::back()->withErrors('删除成功');
	}

}
