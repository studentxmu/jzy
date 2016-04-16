@extends('app')
@section('content')
        <style>
            #trucklist {
                left: 70px!important;
            }
        </style>
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
        <script src="{{ asset('/js/interest.js') }}" type="text/javascript" charset="utf-8"></script>
			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/transactions') }}">运单列表</a><b>/</b></li>
						<li><a href="#">高级查询</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">
						    财务高级查询	
						</span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    </div>
                    @endif
                    <form class="validate" action="{{ URL('admin/finances/search') }}" method="GET" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<ul id="list">
						<li class="listChild">
							<ul>
								<li class="datePicker fl">
                                    <?php $types = \App\Catagory::$types; ?>
                                        <span>财务类型：</span>
                                    <select name="typeid">
                                        <option value ="0" <?php echo $condition['typeid'] == 0 ? 'selected="selected"' : ""; ?>>请选择科目</option>
                                    @foreach ($types as $typeid => $typename)
                                        <option value ="{{$typeid}}" <?php echo $condition['typeid'] == $typeid ? 'selected="selected"' : ""; ?>>{{$typename}}</option>
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
								<li id="categorypar">
									<span>科目：</span>
                                    <input type="hidden" name="categoryid" id="categoryhid" value="{{$condition['categoryid']}}"/>
                                    <input type="text" name="categoryname" id="category" value="{{$condition['categoryname']}}"/>
                                    <ul id="categorylist"></ul> 
								</li>
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
							</ul>
						</li>
						<li class="listChild">
							<ul>
								<li>
									<span>摘要搜索：</span><input type="text" name="desc" id="startPlace" value="{{$condition['desc']}}"/>
								</li>
								<li id="goodspar">
									<span>货主：</span>
                                    <input type="hidden" name="buyerid" id="goodshid" value="{{$condition['buyerid']}}"/>
                                    <input type="text" name="buyername" id="owner" value="{{$condition['buyername']}}"/>
                                    <ul id="goodslist"></ul> 
								</li>
                                <li>
                                    <button class="fin-search">确认查询</button>
                                </li>
							</ul>
						</li>
					</ul>
				</div>
				</form>
                @if (!empty($finances))
					<div class="tableBox">
                        <div class="table-top clear">
                            <div>
                                当前共有记录{{$finances->total()}}条
                            </div>
                        </div>
						<table class="tab" id="tab">
							<thead>
								<tr>
									<th width="50">编号</th>
									<th width="110">日期</th>
									<th width="110">科目</th>
									<th width="410">摘要</th>
									<th width="70">借方</th>
									<th width="70">贷方</th>
									<th width="166">编辑</th >
								</tr>
							</tdead>
							<tbody>
                            @foreach ($finances as $finance)
								<tr>
                                    @if ($finance->trans_id)
									<td><a href="{{ URL('admin/transactions/'.$finance->trans_id) }}">{{ $finance->id }}</a></td>
                                    @else
									<td>{{ $finance->id }}</td>
                                    @endif
									<td class="data">{{ $finance->happendate }}</td>
                                    @if ($finance->trans_id)
                                        <td><a href="{{ URL('admin/transactions/latest/'.$finance->car_id) }}">{{ $finance->car->code }}</a></td>
                                    @else
                                        @if ($finance->car_id)
                                            <td><a href="{{ URL('admin/transactions/latest/'.$finance->car_id) }}">{{ $finance->car->code }}</a></td>
                                        @else
                                            <td><a href="{{ URL('admin/finances/latest/'.$finance->cate_id) }}">{{ $finance->category->name }}</a></td>
                                        @endif
                                    @endif
									<td style="text-align:left"><?php if ($finance->status) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?>{{ $finance->desc }}</td>
                                    @if ($finance->status == 0)
                                        <td class="money">{{ $finance->value }}</td>
                                    @else
                                        <td class="money"></td>
                                    @endif
                                    @if ($finance->status == 1)
                                        <td class="money">{{ $finance->value }}</td>
                                    @else
                                        <td class="money"></td>
                                    @endif
									<td>
                                    @if ($finance->trans_id)
										<a class="tableCreat btn-edit" href="{{ URL('admin/transactions/'.$finance->trans_id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                                        <form class="btn-del-wrap" action="{{ URL('admin/transactions/'.$finance->trans_id) }}" method="POST" style="display: inline;">
                                            <a class="btn-del-bg" href="javascript:void(0):">
                                                <i class="fa fa-trash" ></i>
                                                删除
                                            </a>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-del"> </button>
                                        </form>
                                    @else
										<a class="tableCreat btn-edit" href="{{ URL('admin/finances/'.$finance->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                                        <form class="btn-del-wrap" action="{{ URL('admin/finances/'.$finance->id) }}" method="POST" style="display: inline;">
                                            <a class="btn-del-bg" href="javascript:void(0):">
                                                <i class="fa fa-trash" ></i>
                                                删除
                                            </a>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-del"> </button>
                                        </form>
                                    @endif
									</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
                <div style="float: right;margin-top:50px;font-size:24px;">
                    <?php echo "合计余额：￥$totalValue"; ?>
                </div>
                <div id="div1">
                    <input type="button" name="btn" id="btn" value="查看利息" />
                </div>
                <div class="paginate">
                    <?php echo $finances->appends($_GET)->render(); ?>
                </div>
                @endif
			</div>
        <script>
            $("#category").on("keyup focus",function(){
                    $(this).search({
                        user : <?php echo $categorys?>,// 数组
                        par  : "categorypar",// 父级id
                        list : "categorylist",// 列表ul的id
                        hide : "categoryhid"//hidden域id
                    });
                });
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
                $("#btn").interest({
                    tableid    : "tab",// 表格id
                    dateclass  : "data",//tr中日期的class
                    moneyclass : "money",//tr中金额的class
                    btnparid   : "div1",//按钮父级的id
                });
        </script>
    @endsection
