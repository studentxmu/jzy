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
						<li><a href="{{ URL('admin/users') }}">用户列表</a><b>/</b></li>
						<li><a href="#">新增用户</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">用户录入</span>
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

                    <form class="validate" action="{{ URL('admin/users') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<ul class="truckList">
							<li>
								<span><em class="star">*</em>用户名：</span>
                                <input type="text" name="name" class="mingzi form-control validate[required]">
							</li>
							<li>
								<span><em class="star">*</em>邮箱：</span>
                                <input type="text" name="email" class="mingzi form-control validate[required,custom[email]]">
							</li>
							<li>
								<span><em class="star">*</em>密码：</span>
                                <input type="password" id="password" name="password" class="mingzi form-control validate[required,minSize[6]]">
							</li>
							<li>
								<span><em class="star">*</em>确认密码：</span>
                                <input type="password" name="password_confirmation" class="mingzi form-control validate[required,equals[password]]">
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
