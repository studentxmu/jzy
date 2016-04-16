@extends('app')

@section('content')
		<script src="{{ asset('/js/jQuery.Hz2Py-min.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/createpeople.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/jquery.validationEngine-zh_CN.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/search.js') }}" type="text/javascript" charset="utf-8"></script>
        <link href="{{ asset('/css/validationEngine.jquery.css') }}" rel="stylesheet">
        <style type="text/css">
        
        </style>
			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/employees') }}">员工列表</a><b>/</b></li>
						<li><a href="#">新增工时</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">工时录入</span>
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

                    <form class="validate" action="{{ URL('admin/workdays') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<ul class="truckList">
                            <li class="user-wrap">
                                <span><em class="star">*</em>姓名：</span>
                                <input type="hidden" value="" name="employee_id" class="searchid">
                                <input id="driver" class="user-name validate[required]" placeholder="请输入拼音或者首字母"  type="text" value="" autocomplete="off" disableautocomplete>
                                <ul id="search-list" class='_thisList'></ul>
                            </li>
							<li>
								<span><em class="star">*</em> 类型：</span>
                                <input type="radio" name="type" value="1" id="jieRadio" class="validate[required]" style="width:25px">
                                <label for="jieRadio">上工</label>
                                <input type="radio" name="type" value="2" id="daiRadio" class="validate[required]" style="width:25px;margin-left:35px">
                                <label for="daiRadio">下工</label>
							</li>
							<li>
								<div class="datePicker fl">
									<span><em class="star">*</em>日期：</span>
									<input id="begintime" name="begintime" class="form-control validate[required,custom[date]],dateRange[grp1]]" style="width: 164px;" type="text" onclick="WdatePicker({el:'begintime'})"/>
<span onclick="WdatePicker({el:'begintime'})" class="dateImg"></span>
								</div>
							</li>
							<li>
								<span>原因备注：</span>
                                <input type="text" name="comments" class="form-control" style="width:360px">
							</li>
							<li class="button">
								<span>&nbsp;</span>
								 <button class="btn btn-lg btn-info">确认提交</button>
							</li>
						</ul>
					</form>
				</div>
			</div>
    <script type="text/javascript">
        echoUser(<?php echo $peoples?>);
    </script>
    @endsection
