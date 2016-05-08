@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">

@section('content')
 <link href="{{ asset('/css/show.css') }}" rel="stylesheet">
 <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
 <script src="{{ asset('/js/jquery.zclip.min.js') }}" type="text/javascript" charset="utf-8"></script>
 <script src="{{ asset('/js/copy.js') }}" type="text/javascript" charset="utf-8"></script>

			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/users') }}">用户列表</a><b>/</b></li>
						<li><a href="#">查看用户</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">查看用户</span>
					</div>
                    <div class="user-info-wrap">
                        <h3 class="user-info-tit clear">
                            <span class="user-name fl">{{$user->name}}
										<a class="tableCreat btn-edit" href="{{ URL('admin/users/'.$user->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                            </span>
                            <div class="rules-choose-wrap fl">
                                <div><label><input id="rules-all" type="checkbox" name="rules"/>全选</label></div>
                                <div><label><input id="rules-other" type="checkbox" name="rules"/>反选</label></div>
                            </div>
                        </h3>
                        <div class="user-info">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif
                    <form class="validate" action="{{ URL('admin/users/settings/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <ul id="rules-list" class="rules-list clear">
                            @foreach ($names as $key => $val)
                                <li>
                                   <label> <input name="permits[{{$val}}]" type="checkbox" value="1" <?php echo (isset($permits) && isset($permits[$val]) && $permits[$val] == 1) ?  "checked=checked" : "" ?>/>{{$key}} &nbsp;&nbsp;</label>
                                </li>
                            @endforeach
						</ul>
                         <button id="rules-btn">确认提交</button>
					</form>
                        </div>
                    </div>
                </div>
			</div>


<script>
var radio = $("#rules-list").find("input[type='checkbox']");
$("#rules-all").on("click",function(){
    if($(this).prop("checked")){
        $("#rules-other").prop("checked",false);radio.prop("checked",true) 
    }else{
        radio.prop("checked",false);
    }
        
});
$("#rules-other").on("click",function(){
    $("#rules-all").prop("checked",false);
    radio.prop("checked",function(){return !$(this).prop("checked")});
});

</script>
    @endsection
