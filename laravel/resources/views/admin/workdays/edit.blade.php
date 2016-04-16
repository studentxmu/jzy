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
						<li><a href="{{ URL('admin/employees/'.$workday->employee_id) }}">员工页面</a><b>/</b></li>
						<li><a href="#">工时编辑</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">工时编辑</span>
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

                    <form class="validate" action="{{ URL('admin/workdays/'.$workday->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<ul class="truckList">
                            <li>
                                <span> 姓名：</span>
                                <select name="employee_id">
                                @foreach ($employees as $employee)
                                    <option value ="{{$employee->id}}" <?php echo $workday->employee_id == $employee->id ? 'selected="selected"' : ""; ?>>{{$employee->name}}</option>
                                @endforeach
                                </select>
                            </li>
							<li>
								<div class="datePicker fl">
									<span><em class="star">*</em>上工日期：</span>
									<input id="begintime" name="begintime" value="{{ $workday->begintime }}" class="form-control validate[required,custom[date]],dateRange[grp1]]" style="width: 164px;" type="text" onclick="WdatePicker({el:'begintime'})"/>
<span onclick="WdatePicker({el:'begintime'})" class="dateImg"></span>
								</div>
							</li>
							<li>
								<div class="datePicker fl">
									<span><em class="star">*</em>下工日期：</span>
									<input id="endtime" name="endtime" value="{{ $workday->endtime }}" class="form-control validate[required,custom[date],dateRange[grp1]]" style="width: 164px;" type="text" onclick="WdatePicker({el:'endtime'})"/>
<span onclick="WdatePicker({el:'endtime'})" class="dateImg"></span>
								</div>
							</li>
							<li>
								<span>原因备注：</span>
                                <input type="text" name="comments" value="{{ $workday->comments }}" class="form-control" style="width:360px">
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
