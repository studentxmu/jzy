@extends('app')
@section('content')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
        <style>
            #trucklist {
                left: 70px!important;
            }
        </style>
			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/transactions') }}">运单列表</a><b>/</b></li>
						<li><a href="#">运单开支查询</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">
						    运单开支查询	
						</span>
					</div>
                    <form class="validate" action="{{ URL('admin/details/search') }}" method="GET" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<ul id="list">
						<li class="listChild">
							<ul>
								<li class="datePicker fl">
                                    <?php $types = \App\Transaction::$types; ?>
                                        <span>开支类型：</span>
                                    <select name="typeid">
                                        <option value ="0" <?php echo $condition['typeid'] == 0 ? 'selected="selected"' : ""; ?>>所有开支</option>
                                    @foreach ($types as $typeid => $typename)
                                        <option value ="{{$typeid}}" <?php echo $condition['typeid'] == $typeid ? 'selected="selected"' : ""; ?>>{{$typename}}开支</option>
                                    @endforeach
                                    </select>
								</li>
								<li class="datePicker fl">
									<span>开始日期：</span><input name="begindate" id="d12" type="text" onclick="WdatePicker({el:'d12'})" value="{{$condition['begindate']}}"/>
<span onclick="WdatePicker({el:'d12'})" class="dateImg"></span>
								</li>
								<li class="datePicker fl">
									<span>结束日期：</span><input name="enddate" id="d13" type="text" onclick="WdatePicker({el:'d13'})" value="{{$condition['enddate']}}"/>
<span onclick="WdatePicker({el:'d13'})" class="dateImg"></span>
								</li>
							</ul>
						</li>
						<li class="listChild">
							<ul>
								<li id="driverpar">
									<span>司机：</span>
                                    <input type="hidden" name="employeeid" id="driverhid" value="{{$condition['employeeid']}}"/>
                                    <input type="text" name="employeename" id="driver" value="{{$condition['employeename']}}"/>
                                    <ul id="driverlist"></ul> 
								</li>
								<li class="fr" id="truckpar">
									<span>车号：</span>
                                    <input type="hidden" name="carid" id="truckhid" value="{{$condition['carid']}}"/>
                                    <input type="text"  name="carcode" id="truckNum" value="{{$condition['carcode']}}"/>
                                    <ul id="trucklist"></ul> 
								</li>
								<li id="goodspar">
									<span>货主：</span>
                                    <input type="hidden" name="buyerid" id="goodshid" value="{{$condition['buyerid']}}"/>
                                    <input type="text" name="buyername" id="owner" value="{{$condition['buyername']}}"/>
                                    <ul id="goodslist"></ul> 
								</li>
							</ul>
						</li>
						<li class="listChild">
							<ul>
								<li>
									<span>起始地：</span><input type="text" name="fromplace" id="startPlace" value="{{$condition['fromplace']}}"/>
								</li>
								<li>
									<span>到达地：</span><input type="text" name="endplace" id="startPlace" value="{{$condition['endplace']}}"/>
								</li>
								<li>
									<span>返回地：</span><input type="text" name="returnplace" id="startPlace" value="{{$condition['returnplace']}}"/>
								</li>
							</ul>
						</li>
						<li class="listChild">
							<ul>
								<li class="datePicker fl">
                                    <?php $oiltypes = \App\Transaction::$oilTypes; ?>
                                        <span>加油方式：</span>
                                    <select name="oiltypeid">
                                        <option value ="0" <?php echo $condition['oiltypeid'] == 0 ? 'selected="selected"' : ""; ?>>不限</option>
                                    @foreach ($oiltypes as $otypeid => $otypename)
                                        <option value ="{{$otypeid}}" <?php echo $condition['oiltypeid'] == $otypeid ? 'selected="selected"' : ""; ?>>{{$otypename}}</option>
                                    @endforeach
                                    </select>
								</li>
								<li>
									<span>摘要搜索：</span><input type="text" name="desc" id="startPlace" value="{{$condition['desc']}}"/>
								</li>
                                <li>
                                    <button class="fin-search">确认查询</button>
                                </li>
							</ul>
						</li>
					</ul>
				</div>
                </form>
				<!--总结结束-->
                @if (!empty($details))
					<div class="tableBox">
                        <div class="table-top clear">
                            <div>
                                当前共有记录{{$details->total()}}条
                            </div>
                        </div>
						<table class="tab">
							<thead>
								<tr>
									<th width="50">编号</th>
									<th width="110">日期</th>
									<th width="110">车号</th>
									<th width="60">司机</th>
									<th width="60">货主</th>
									<th width="410">摘要</th>
									<th width="90">金额</th>
									<th width="96">编辑</th >
								</tr>
							</tdead>
							<tbody>
                            @foreach ($details as $detail)
								<tr>
									<td><a href="{{ URL('admin/transactions/'.$detail->trans_id) }}">{{ $detail->id }}</a></td>
									<td>{{ $detail->happendate }}</td>
									<td><a href="{{ URL('admin/transactions/'.$detail->car_id) }}">{{ $detail->carname }}</a></td>
									<td><a href="{{ URL('admin/transactions/'.$detail->employee_id) }}">{{ $detail->employeename }}</a></td>
                                    <td>{{ $detail->buyername}}</td>
									<td style="text-align:left">（{{$detail->fromplace}}-{{$detail->endplace}}-{{$detail->returnplace}}）{{ $detail->address }}（{{$detail->goodsname}}）</td>
									<td>{{ $detail->value }}</td>
									<td>
										<a class="tableCreat btn-edit" href="{{ URL('admin/transactions/'.$detail->trans_id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
									</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
                <div style="float: right;margin-top:50px;font-size:24px;">
                    <?php echo "合计余额：￥$totalValue"; ?>
                </div>
                <div class="paginate">
                    <?php echo $details->appends($_GET)->render(); ?>
                </div>
                @endif
			</div>
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
