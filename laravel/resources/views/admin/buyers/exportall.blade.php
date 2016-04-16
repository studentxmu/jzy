@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
        <style>
            .tab>tbody tr:last-child td{
                border:0;
            }
            #excel-btn{line-height:32px; font-size:12px;}
            #excel-btn:hover{color:#fff;}
            .validate>ul{
                height:32px;
                line-height:32px;
            }
            .validate>ul input[type="text"]{
                height:32px;
            }
            .validate>ul label{
                cursor:pointer;
            }
        </style>
@section('content')
			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/buyers/category') }}">货主列表</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">货主（分类账）</span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox">
                        <div class="table-top clear">
                        <form class="validate" action="{{Request::url()}}" method="GET" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<ul>
								<li class="datePicker fl">
									<span>开始日期：</span><input name="begindate" id="d12" type="text" onclick="WdatePicker({el:'d12'})"  value="{{$condition['begindate']}}"/>
<span onclick="WdatePicker({el:'d12'})" class="dateImg"></span>
								</li>
								<li class="datePicker fl">
									<span>结束日期：</span><input name="enddate" id="d13" type="text" onclick="WdatePicker({el:'d13'})" value="{{$condition['enddate']}}"/>
<span onclick="WdatePicker({el:'d13'})" class="dateImg"></span>
								</li>
                                
                                <li>
                                &nbsp;&nbsp;
                                    <input type="checkbox" id="hedui" name="hedui" value="1" <?php echo ($condition['hedui'] == 1) ? "checked=true" : '' ?>><label for="hedui">已核对</label></>
                                &nbsp;&nbsp;
                                    <input type="checkbox" id="kaipiao" name="kaipiao" value="1" <?php echo ($condition['kaipiao'] == 1) ? "checked=true" : '' ?>><label for="kaipiao">已开票</label></>
                                &nbsp;&nbsp;
                                    <input type="checkbox" id="jiesuan" name="jiesuan" value="1" <?php echo ($condition['jiesuan'] == 1) ? "checked=true" : '' ?>><label for="jiesuan">已结算</label></>
                                &nbsp;&nbsp;
                                    <input type="checkbox" id="nojiesuan" name="nojiesuan" value="2" <?php echo ($condition['nojiesuan'] == 2) ? "checked=true" : '' ?>><label for="nojiesuan">未结算</label></>
                                    <a href="javascript:;" id="excel-btn" class="fin-search" style="float: right;">导出EXCEL</a>
                                    <button class="fin-search" style="float: right;">查询</button>
                                </li>
							</ul>
                        </form>
                        </div>
						<table class="tab">
							<thead>
								<tr>
									<th width="116">货主</th>
									<th width="76">装货数</th>
									<th width="76">卸货数</th>
									<th width="130">运费金额</th>
								</tr>
							</thead>
							<tbody>
                            @foreach ($transactions as $transaction)
								<tr>
									<td>{{$transaction->buyer->name}}</td>
									<td>{{$transaction->begin}}</td>
									<td>{{$transaction->end}}</td>
									<td>{{$transaction->value}}</td>
								</tr>
                                @endforeach
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
                    </form>
					</div>
				</div>
			</div>
            <script>
               $("#excel-btn").click(function(){
                    var url = "<?php echo Request::url().'?'.$_SERVER['QUERY_STRING']; ?>" + "&download=true";
                    if(confirm("确定下载吗？")){
                        window.location = url;
                    }
               }); 
            </script>
@endsection
