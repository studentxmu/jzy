<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Catagory;
use Redirect, Input, Auth;

use Illuminate\Http\Request;

class CatagorysController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('admin.catagorys.index')->withCatagorys(Catagory::paginate(25));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.catagorys.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
        $this->validate($request, [
            'name'  => 'required|min:2',
        ]);
        $catagory = new Catagory;
        $catagory->name = Input::get('name');
        $catagory->alpha = Input::get('alpha');
        $catagory->firstalpha = Input::get('firstalpha');
        $catagory->infomation = Input::get('infomation');
        $catagory->parent_id = Input::get('parent_id');
        $catagory->type_id = Input::get('type_id');

        if ($catagory->save()) {
            return Redirect::to('admin/catagorys')->withErrors('添加成功！');
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
		//
        return view('admin.catagorys.show')->withCatagory(Catagory::find($id));
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
        return view('admin.catagorys.edit')->withCatagory(Catagory::find($id));
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
            'name'  => 'required|min:2',
        ]);
        $catagory = Catagory::find($id);
        $catagory->name = Input::get('name');
        $catagory->alpha = Input::get('alpha');
        $catagory->firstalpha = Input::get('firstalpha');
        $catagory->infomation = Input::get('infomation');
        $catagory->parent_id = Input::get('parent_id');
        $catagory->type_id = Input::get('type_id');

        if ($catagory->save()) {
            return Redirect::to('admin/catagorys')->withErrors('添加成功！');
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
        $catagory = Catagory::find($id);
        $catagory->delete();
        return Redirect::back()->withErrors('删除成功');
	}

}
