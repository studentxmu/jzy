@extends('app')

@section('content')
		<script src="{{ asset('/js/jQuery.Hz2Py-min.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/createpeople.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/jquery.validationEngine-zh_CN.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8"></script>
        <link href="{{ asset('/css/validationEngine.jquery.css') }}" rel="stylesheet">

			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/employees') }}">员工列表</a><b>/</b></li>
						<li><a href="#">编辑员工</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">员工编辑</span>
					</div>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    <strong>不好!</strong> 出错了！
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif

                    <form class="validate" action="{{ URL('admin/employees/'.$employee->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<ul class="truckList">
							<li>
								<span><em class="star">*</em>姓名：</span>
                                <input type="text" name="name" class="mingzi form-control validate[required,custom[chinese]]" value="{{ $employee->name }}">
							</li>
							<li>
								<span><em class="star">*</em>拼音：</span>
                                <input type="text" name="alpha" class="pinyin form-control validate[required,custom[onlyLetterSp]]" value="{{ $employee->alpha }}">
							</li>
							<li>
								<span><em class="star">*</em>首字母：</span>
                                <input type="text" name="firstalpha" class="shouzimu form-control validate[required,custom[onlyLetterSp]]" value="{{ $employee->firstalpha }}">
							</li>
							<li>
								<span>性别：</span>
                                <input id="male" type="radio" name="sex" value="0" <?php echo $employee->sex == 0 ? "checked='checked'" : ""; ?>>
								<label for="male">男</label>
								<input id="female" type="radio" name="sex" value="1" <?php echo $employee->sex == 1 ? "checked='checked'" : ""; ?>>
								<label for="female">女</label>									
							</li>
                            <li>
                                <span> 所属部门：</span>
                                <select name="depart_id">
                                @foreach ($departs as $departid => $departname)
                                <option value ="{{$departid}}" <?php echo $employee->depart_id == $departid ? 'selected="selected"' : ""; ?>>{{$departname}}</option>
                                @endforeach
                                </select>
                            </li>
							<li>
								<span><em class="star"></em>手机号：</span>
                                <input type="text" name="mobile" class="form-control validate[custom[phone]]" value="{{ $employee->mobile==0 ? '' : $employee->mobile }}">
							</li>
							<li>
								<span><em class="star">*</em>身份证号：</span>
                                <input type="text" name="idcode" class="form-control validate[required,custom[chinaIdLoose]]" value="{{ $employee->idcode }}">
							</li>
							<li>
								<span><em class="star">*</em>驾驶证档案编号：</span>
                                <input type="text" name="drivecode" class="form-control validate[required,custom[onlyLetterNumber]]" value="{{ $employee->drivecode }}">
							</li>
							<li>
								<span>家庭住址：</span>
                                <input type="text" name="address" class="form-control" style="width:360px" value="{{ $employee->address }}">
							</li>
							<li>
                                <p class="warning">需要上传或者修改直接上传会覆盖，如果不需要请勿修改！</p>
							</li>
							<li>
								<span>照片：</span>
								<input type="file" name="image"/>
							</li>
							<li>
								<span>身份证：</span>
								<input type="file" name="idfront"/>
							</li>
							<li>
								<span>驾驶证：</span>
								<input type="file" name="drivefront"/>
							</li>
							<li>
								<span>资格证：</span>
								<input type="file" name="idend"/>
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
