@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
@section('content')
<div class="content fl">
    <div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/finances/category/'. $typeid) }}">{{$types[$typeid]}} - 财务列表</a><b></b></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">{{$types[$typeid]}} - 分类账</span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    <strong>恭喜!</strong> 
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox clear">
                        @if ($typeid == 1)
                        @foreach ($cars as $car)
                            <span class="tips"><a href="{{ URL('admin/finances/latest/999999999/'. $car->id) }}">{{ $car->code}}</a></span>
                        @endforeach
                        @endif
                        @foreach ($catagorys as $catagory)
                            <span class="tips"><a href="{{ URL('admin/finances/latest/'. $typeid . '/' . $catagory->id) }}">{{ $catagory->name}}</a></span>
                        @endforeach
					</div>
				</div>
			</div>
@endsection
