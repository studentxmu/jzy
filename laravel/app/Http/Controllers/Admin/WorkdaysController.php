<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Workday;
use App\Employee, App\Logex;
use Redirect, Input, Auth, DB;

class WorkdaysController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $employees = Employee::All();
        $peoples = array();
        foreach ($employees as $employee) {
            $peoples[] = array(
                $employee->name,
                $employee->alpha,
                $employee->firstalpha,
                $employee->id
            );
        }
        $data = array(
            'employees' => $employees,
            'peoples' => json_encode($peoples),
        );
		return view('admin.workdays.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $workday = new Workday();
        $logex = new Logex();
        $begintime = Input::get('begintime');
        $type = Input::get('type');
        $workday->employee_id = Input::get('employee_id');
        $workday->begintime = $begintime;
        $workday->type = $type;
        $workday->comments = Input::get('comments');
        $thisyear = date('Y');
        $begindate = "$thisyear-01-01";
        $enddate = "$thisyear-12-31";
        $lasttype = Workday::whereRaw('employee_id = ? and begintime between ? and ?', array($workday->employee_id, $begindate, $begintime))->orderBy('begintime', 'desc')->take(1)->get();
        if (empty($lasttype) && $type != 1) {
            return Redirect::back()->withErrors('请检查当前上工类型，必须先上工');
        }
        if (!empty($lasttype[0]) && $lasttype[0]->type == $type) {
            return Redirect::back()->withErrors('请检查当前上工类型，和上次重复');
        }
    
        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '上工录入';
        $logex->type = 'create';
        $logex->datafrom = 'null';
        $logex->datato = $workday->toJson();

        if ($workday->save()) {
            $logex->save();
            return Redirect::to('admin/employees')->withErrors('添加成功！');
        } else {
            return Redirect::back()->withErrors('保存失败');
        }
        /*
        $Date_List_a1 = explode("-" , $begintime);
        $Date_List_a2 = explode("-" , $endtime);
        $d1 = mktime(0, 0, 0, $Date_List_a1[1], $Date_List_a1[2], $Date_List_a1[0]);
        $d2 = mktime(0, 0, 0, $Date_List_a2[1], $Date_List_a2[2], $Date_List_a2[0]);
        $days = round(($d2 - $d1)/3600/24) + 1;
        */
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $employees = Employee::All();
        $peoples = array();
        foreach ($employees as $employee) {
            $peoples[$employee->id] = array(
                $employee->name,
                $employee->alpha,
                $employee->firstalpha,
            );
        }
        $data = array(
            'employees' => $employees,
            'peoples' => $peoples,
            'workday' => Workday::find($id),
        );
		return view('admin.workdays.edit', $data);
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
        $workday = Workday::find($id);
        $logex = new Logex;
        $logex->datafrom = $workday->toJson();
        $begintime = Input::get('begintime');
        $endtime = Input::get('endtime');
        $Date_List_a1 = explode("-" , $begintime);
        $Date_List_a2 = explode("-" , $endtime);
        $d1 = mktime(0, 0, 0, $Date_List_a1[1], $Date_List_a1[2], $Date_List_a1[0]);
        $d2 = mktime(0, 0, 0, $Date_List_a2[1], $Date_List_a2[2], $Date_List_a2[0]);
        $days = round(($d2 - $d1)/3600/24) + 1;
        $workday->employee_id = Input::get('employee_id');
        $workday->begintime = $begintime;
        $workday->endtime = $endtime;
        $workday->days = $days;
        $workday->comments = Input::get('comments');

        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '上工修改';
        $logex->type = 'update';
        $logex->datato = $workday->toJson();

        if ($workday->save()) {
            $logex->save();
            return Redirect::to('admin/employees/'.Input::get('employee_id'))->withErrors('编辑成功！');
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
        $workday = Workday::find($id);
        $workday->delete();
        $logex = new Logex;
        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '上工删除';
        $logex->type = 'delete';
        $logex->datafrom= $workday->toJson();
        $logex->datato = 'null';
        $logex->save();
        return Redirect::back()->withErrors('删除成功');
	}

}
