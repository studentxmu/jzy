@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
@section('content')
<div class="content fl">
    <div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/buyers/category') }}">货主财务列表</a><b></b></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">货主 - 分类账</span>
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
                        @foreach ($buyers as $buyer)
                            <span class="tips"><a href="{{ URL('admin/buyers/latest/'. $buyer->id) }}">{{ $buyer->name}}</a></span>
                        @endforeach
					</div>
				</div>
			</div>
@endsection
