<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Car, App\Logex;
use Redirect, Input, Auth;

class CarsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $carsall = Car::All();
        $trucks = array();
        foreach ($carsall as $car) {
            $trucks[] = array(
                $car->code,
                strtolower($car->code),
                strtoupper($car->code),
                $car->id
            );
        }
        $cars = Car::paginate(25);
        $data = array(
            'cars' => $cars,
            'types' => Car::$types,
            'assurances' => Car::$assurances,
            'companys' => Car::$companys,
            'brands' => Car::$brands,
            'trucks' => json_encode($trucks),
            'count' => Car::count(),
        );
		return view('admin.cars.index', $data);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function latest()
	{
        $cars = Car::where('status', '<', date('Y'))->get();
        foreach ($cars as $key => $car) {
            $nowM = date('m');
            $carM = date('m', strtotime($car->buytime));
            if (!($carM >= $nowM && $carM <= $nowM + 2)) {
                unset($cars[$key]);
            }
        }
        $data = array(
            'cars' => $cars,
            'types' => Car::$types,
            'assurances' => Car::$assurances,
            'companys' => Car::$companys,
            'brands' => Car::$brands,
        );
		return view('admin.cars.latest', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $data = array(
            'types' => Car::$types,
            'assurances' => Car::$assurances,
            'brands' => Car::$brands,
            'companys' => Car::$companys,
        );
		return view('admin.cars.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
        if (Input::hasFile('drive'))
        {
            $file = Input::file('drive');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameDrive = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameDrive);
            }
        }
        if (Input::hasFile('normal'))
        {
            $file = Input::file('normal');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameNormal = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameNormal);
            }
        }
        if (Input::hasFile('assurance'))
        {
            $file = Input::file('assurance');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameAssurance = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameAssurance);
            }
        }
        if (Input::hasFile('comassurance'))
        {
            $file = Input::file('comassurance');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameComAssurance = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameComAssurance);
            }
        }
        $car = new Car;
        $logex = new Logex;
        $car->code = Input::get('code');
        $car->vicecode = Input::get('vicecode');
        $car->oilcard = Input::get('oilcard');
        $car->company_id = Input::get('company_id');
        $car->type_id = Input::get('type_id');
        $car->brand_id = Input::get('brand_id');
        $car->assurance_id = Input::get('assurance_id');
        $car->buytime = Input::get('buytime');
        !empty($newNameIamge) && $car->imageurl = $newNameIamge;
        !empty($newNameDrive) && $car->driveurl = $newNameDrive;
        !empty($newNameNormal) && $car->normalurl = $newNameNormal;
        !empty($newNameAssurance) && $car->assuranceurl = $newNameAssurance;
        !empty($newNameComAssurance) && $car->comassuranceurl = $newNameComAssurance;

        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '车辆录入';
        $logex->type = 'create';
        $logex->datafrom = 'null';
        $logex->datato = $car->toJson();

        if ($car->save()) {
            $logex->save();
            return Redirect::to('admin/cars')->withErrors('添加成功！');
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
        $data = array(
            'types' => Car::$types,
            'assurances' => Car::$assurances,
            'brands' => Car::$brands,
            'companys' => Car::$companys,
            'car' => Car::find($id),
        );
		return view('admin.cars.show', $data);
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
        $data = array(
            'types' => Car::$types,
            'assurances' => Car::$assurances,
            'brands' => Car::$brands,
            'companys' => Car::$companys,
            'car' => Car::find($id),
        );
		return view('admin.cars.edit', $data);
	}

	/**
	 * @param  int  $id
	 * @return Response
	 */
	public function download($id, $type)
	{
		//
        $car = Car::find($id);
        switch ($type) {
            case '1':
                {
                    $url = $car->imageurl;
                    $name = '-身份证-正面';
                    break;
                }
            case '2':
                {
                    $url = $car->driveurl;
                    $name = '-身份证-反面';
                    break;
                }
            case '3':
                {
                    $url = $car->normalurl;
                    $name = '-行驶证-正面';
                    break;
                }
            case '4':
            default:
                {
                    $url = $car->assuranceurl;
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
	public function update($id)
	{
		//
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
        if (Input::hasFile('drive'))
        {
            $file = Input::file('drive');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameDrive = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameDrive);
            }
        }
        if (Input::hasFile('normal'))
        {
            $file = Input::file('normal');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameNormal = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameNormal);
            }
        }
        if (Input::hasFile('assurance'))
        {
            $file = Input::file('assurance');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameAssurance = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameAssurance);
            }
        }
        if (Input::hasFile('comassurance'))
        {
            $file = Input::file('comassurance');
            if ($file->isValid()) {
                $clientName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); 
                $newNameComAssurance = md5(date('ymdhis').$clientName).".".$extension;
                $path = $file->move(storage_path() .'/upload', $newNameComAssurance);
            }
        }
        $car = Car::find($id);
        $logex = new Logex;
        $logex->datafrom = $car->toJson();
        $car->code = Input::get('code');
        $car->vicecode = Input::get('vicecode');
        $car->oilcard = Input::get('oilcard');
        $car->company_id = Input::get('company_id');
        $car->type_id = Input::get('type_id');
        $car->brand_id = Input::get('brand_id');
        $car->assurance_id = Input::get('assurance_id');
        $car->buytime = Input::get('buytime');
        !empty($newNameIamge) && $car->imageurl = $newNameIamge;
        !empty($newNameDrive) && $car->driveurl = $newNameDrive;
        !empty($newNameNormal) && $car->normalurl = $newNameNormal;
        !empty($newNameAssurance) && $car->assuranceurl = $newNameAssurance;
        !empty($newNameComAssurance) && $car->comassuranceurl = $newNameComAssurance;

        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '车辆修改';
        $logex->type = 'update';
        $logex->datato = $car->toJson();

        if ($car->save()) {
            $logex->save();
            return Redirect::to('admin/cars')->withErrors('编辑成功！');
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
        $car = Car::find($id);
        $car->delete();
        return Redirect::back()->withErrors('删除成功');
	}

	public function audit($id)
	{
		//
        $car = Car::find($id);
        $car->status = date('Y');
        $logex = new Logex;
        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '车辆删除';
        $logex->type = 'delete';
        $logex->datafrom= $car->toJson();
        $logex->datato = 'null';
        $logex->save();
        if ($car->save()) {
            return Redirect::to('admin/cars/latest')->withErrors('审车成功！');
        } else {
            return Redirect::back()->withErrors('保存失败');
        }
	}

}
