@extends('app')

@section('content')
		<script src="{{ asset('/js/jquery.validationEngine-zh_CN.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8"></script>
        <link href="{{ asset('/css/validationEngine.jquery.css') }}" rel="stylesheet">

			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/cars') }}">车辆列表</a><b>/</b></li>
						<li><a href="#">新增车辆</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">车辆录入</span>
					</div>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    <strong>不好!</strong> 出错了！<br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif

                    <form class="validate" action="{{ URL('admin/cars') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<ul class="truckList">
							<li>
								<span><em class="star">*</em>车牌号：</span>
                                <input type="text" name="code" class="form-control validate[required]">
							</li>
							<li>
								<span><em class="star"></em>挂车牌照：</span>
                                <input type="text" name="vicecode" class="form-control">
							</li>
							<li>
								<span><em class="star"></em>加油卡号：</span>
                                <input type="text" name="oilcard" class="form-control validate[custom[onlyLetterNumber]]">
							</li>
                            <li>
                                <span> 所属公司：</span>
                                <select name="company_id">
                                @foreach ($companys as $companyid => $companyname)
                                <option value ="{{$companyid}}">{{$companyname}}</option>
                                @endforeach
                                </select>
                            </li>
                            <li>
                                <span> 车辆类型：</span>
                                <select name="type_id">
                                @foreach ($types as $typeid => $typename)
                                <option value ="{{$typeid}}">{{$typename}}</option>
                                @endforeach
                                </select>
                            </li>
                            <li>
                                <span> 品牌：</span>
                                <select name="brand_id">
                                @foreach ($brands as $brandid => $brandname)
                                <option value ="{{$brandid}}">{{$brandname}}</option>
                                @endforeach
                                </select>
                            </li>
                            <li>
                                <span> 保险公司：</span>
                                <select name="assurance_id">
                                @foreach ($assurances as $assuranceid => $assurancename)
                                <option value ="{{$assuranceid}}">{{$assurancename}}</option>
                                @endforeach
                                </select>
                            </li>
							<li>
								<div class="datePicker fl">
									<span><em class="star">*</em>购买日期：</span>
									<input id="jointime" name="buytime" class="form-control validate[required,custom[date]]" style="width: 164px;" type="text" onclick="WdatePicker({el:'jointime'})"/>
<span onclick="WdatePicker({el:'jointime'})" class="dateImg"></span>
								</div>
							</li>
							<li>
								<span>车辆照片：</span>
								<input type="file" name="image"/>
							</li>
							<li>
								<span>行驶证：</span>
								<input type="file" name="drive"/>
							</li>
							<li>
								<span>营运证：</span>
								<input type="file" name="normal"/>
							</li>
							<li>
								<span>车辆交强险：</span>
								<input type="file" name="assurance"/>
							</li>
							<li>
								<span>车辆商业险：</span>
								<input type="file" name="comassurance"/>
							</li>
							<li class="button">
								<span>&nbsp;</span>
								 <button class="btn btn-lg btn-info">确认提交</button>
							</li>
						</ul>
					</form>
				</div>
			</div>
    @endsection
