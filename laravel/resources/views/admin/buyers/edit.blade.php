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
						<li><a href="{{ URL('admin/buyers') }}">货主列表</a><b>/</b></li>
						<li><a href="#">编辑货主</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">货主编辑</span>
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

                    <form class="validate" action="{{ URL('admin/buyers/'.$buyer->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<ul class="truckList">
							<li>
								<span><em class="star">*</em>姓名：</span>
                                <input type="text" name="name" class="mingzi form-control validate[required,custom[chinese]]" value="{{ $buyer->name }}">
							</li>
							<li>
								<span><em class="star">*</em>拼音：</span>
                                <input type="text" name="alpha" class="pinyin form-control validate[required,custom[onlyLetterSp]]" value="{{ $buyer->alpha }}">
							</li>
							<li>
								<span><em class="star">*</em>首字母：</span>
                                <input type="text" name="firstalpha" class="shouzimu form-control validate[required,custom[onlyLetterSp]]" value="{{ $buyer->firstalpha }}">
							</li>
							<li>
								<span><em class="star"></em>手机号：</span>
                                <input type="text" name="telephone" class="form-control validate[custom[phone]]" value="{{$buyer->telephone}}">
							</li>
							<li>
								<span><em class="star"></em>传真号：</span>
                                <input type="text" name="phonenum" class="form-control" value="{{$buyer->phonenum}}">
							</li>
							<li>
								<span><em class="star"></em>公司名称：</span>
                                <input type="text" name="campany" class="form-control" value="{{$buyer->campany}}">
							</li>
							<li>
								<span>邮寄地址：</span>
                                <input type="text" name="address" class="form-control" style="width:360px" value="{{$buyer->address}}">
							</li>
							<li>
								<span>备注信息：</span>
                                <input type="text" name="infomation" class="form-control" style="width:360px" value="{{$buyer->infomation}}">
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
