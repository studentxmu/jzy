@extends('app')
@section('content')
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/transactions') }}">运单列表</a><b>/</b></li>
						<li><a href="#">运单编辑</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">
						    运单编辑	
						</span>
					</div>
                    <form class="validate" action="{{ URL('admin/transactions/'. $transaction->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<ul id="list">
						<li class="listChild">
							<div class="date clear">
								<div class="datePicker fl">
									<span>日期：</span><input name="happendate" id="d12" style="width: 164px;" type="text" onclick="WdatePicker({el:'d12'})" value="{{$transaction->happendate}}"/>
<span onclick="WdatePicker({el:'d12'})" class="dateImg"></span>
								</div>
								<div class="fr" id="truckpar">
									<span>车号：</span>
                                    <input type="hidden" name="truckNum" id="truckhid" value="{{$transaction->car_id}}"/>
                                    <input type="text" id="truckNum" value="{{$transaction->car->code}}"/>
                                    <ul id="trucklist"></ul> 
								</div>
							</div>
						</li>
						<li class="listChild">
							<ul>
								<li id="driverpar">
									<span>司机：</span>
                                    <input type="hidden" name="driver" id="driverhid" value="{{$transaction->employee_id}}"/>
                                    <input type="text" id="driver" value="{{$transaction->employee->name}}"/>
                                    <ul id="driverlist"></ul> 
								</li>
								<li>
									<span>货物名称：</span><input type="text" name="goodsName" id="goodsName" value="{{$transaction->goodsname}}"/>
								</li>
								<li id="goodspar">
									<span>货主：</span>
                                    <input type="hidden" name="owner" id="goodshid" value="{{$transaction->buyer_id}}"/>
                                    <input type="text" id="owner" value="{{$transaction->buyer->name}}"/>
                                    <ul id="goodslist"></ul> 
								</li>
							</ul>
						</li>
						<li class="listChild">
							<ul>
								<li>
									<span>起始地点：</span><input type="text" name="startPlace" id="startPlace" value="{{$transaction->fromplace}}"/>
								</li>
								<li>
									<span>到达地点：</span><input type="text" name="endPlace" id="endPlace" value="{{$transaction->endplace}}"/>
								</li>
								<li>
									<span>返回地点：</span><input type="text" name="returnPlace" id="returnPlace" value="{{$transaction->returnplace}}"/>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
				<!--总结开始-->
				<div class="sum clear" style="padding-left:0px;">
					<ul class="sumNum fl">
						<li>
							<span>装货吨位：</span>
							<input type="text" id="beginweight" name="beginweight" value="{{$transaction->beginweight}}"/>
						</li>
						<li>
							<span>卸货吨位：</span>
							<input type="text" id="endweight" name="endweight" value="{{$transaction->endweight}}"/>
						</li>
						<li>
							<span>每吨运价：</span>
							<input type="text" id="perprice" name="perprice" value="{{$transaction->perprice}}"/>
							<span>元</span>
						</li>
					</ul>
					<ul class="sumMoney fr">
						<li>
							<span>合&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</span>
							<input type="text" id="sumTotal" name="sumTotal" readOnly value="{{$transaction->value - $transaction->cost}}"/>
							<span>元</span>
						</li>
						<li>
							<span>开支总计：</span>
							<input type="text" id="payTotal" name="payTotal" readOnly value="{{$transaction->cost}}"/>
							<span>元</span>
						</li>
						<li>
							<span>合计运费：</span>
							<input type="text" id="freightTotal" name="freightTotal" readOnly value="{{$transaction->value}}"/>
							<span>元</span>
						</li>
							<li class="button">
								<span>&nbsp;</span>
								 <button class="btn btn-lg btn-info">确认提交</button>
							</li>
					</form>
					</ul>
				</div>
				<!--总结结束-->
			</div>
		<script src="{{ asset('/js/table.js') }}" type="text/javascript" charset="utf-8"></script>
        <script>
            $("#driver").on("keyup focus",function(){
                    $(this).search({
                        user : <?php echo $peoples ?>,// 数组
                        par  : "driverpar",// 父级id
                        list : "driverlist",// 列表ul的id
                        hide : "driverhid"//hidden域id
                    });
                });
            $("#owner").on("keyup focus",function(){
                    $(this).search({
                        user : <?php echo $customers ?>,// 数组
                        par  : "goodspar",// 父级id
                        list : "goodslist",// 列表ul的id
                        hide : "goodshid"//hidden域id
                    });
                });
            $("#truckNum").on("keyup focus",function(){
                    $(this).search({
                        user : <?php echo $trucks ?>,// 数组
                        par  : "truckpar",// 父级id
                        list : "trucklist",// 列表ul的id
                        hide : "truckhid"//hidden域id
                    });
                });
        </script>
    @endsection
