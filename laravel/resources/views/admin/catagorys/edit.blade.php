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
						<li><a href="{{ URL('admin/catagorys') }}">科目列表</a><b>/</b></li>
						<li><a href="#">编辑科目</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">科目编辑</span>
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

                    <form class="validate" action="{{ URL('admin/catagorys/'.$catagory->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<ul class="truckList">
							<li>
								<span><em class="star">*</em>科目名称：</span>
                                <input type="text" name="name" class="mingzi form-control validate[required,custom[chinese]]" value="{{ $catagory->name }}">
							</li>
							<li>
								<span><em class="star">*</em>拼音：</span>
                                <input type="text" name="alpha" class="pinyin form-control validate[required,custom[onlyLetterSp]]" value="{{ $catagory->alpha }}">
							</li>
							<li>
								<span><em class="star">*</em>首字母：</span>
                                <input type="text" name="firstalpha" class="shouzimu form-control validate[required,custom[onlyLetterSp]]" value="{{ $catagory->firstalpha }}">
							</li>
                            <li>
                                <?php $types = \App\Catagory::$types; ?>
                                <span> 科目类型：</span>
                                <select name="type_id">
                                @foreach ($types as $typeid => $typename)
                                    <option value ="{{$typeid}}" <?php echo $catagory->type_id == $typeid ? 'selected="selected"' : ""; ?>>{{$typename}}</option>
                                @endforeach
                                </select>
                            </li>
                            <li>
                                <span> 父级科目：</span>
                                <?php  $kemus = \App\Catagory::All(); ?>
                                <select name="parent_id">
                                @foreach ($kemus as $kemu)
                                    <option value ="{{$kemu->id}}" <?php echo $kemu->id == $catagory->parent_id ? 'selected="selected"' : ""; ?>>{{$kemu->name}}</option>
                                @endforeach
                                </select>
                            </li>
							<li>
								<span>备注信息：</span>
                                <input type="text" name="infomation" class="form-control" style="width:360px" value="{{$catagory->infomation}}">
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
