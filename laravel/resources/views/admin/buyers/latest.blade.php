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
						<span class="wh-fontBox">货主<?php echo !empty($buyer) ? " - " .$buyer->name.'（分类账）':"";?></span>
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
                            <div>
                                当前共有记录{{$transactions->total()}}条
                            </div>
                        </div>
                        <div class="table-top clear">
                            <div>
                            @if (!empty($addressTypes))
                                <a href="{{ URL('admin/buyers/latest/'.$buyer->id) }}">全部</a> &nbsp;&nbsp;&nbsp;&nbsp;
                            @foreach ($addressTypes as $addressType)
                                <a href="{{ URL('admin/buyers/latest/'.$buyer->id.'/'.$addressType->fromplace.'/'.$addressType->endplace) }}">{{$addressType->fromplace}}-{{$addressType->endplace}}</a> &nbsp;&nbsp;&nbsp;&nbsp;
                            @endforeach
                            @endif
                            </div>

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
                <form class="validate clear" action="{{ URL('admin/buyers/setstatus') }}" method="POST" autocomplete="off">
						<table class="tab">
							<thead>
								<tr>
									<th width="60">编号</th>
									<th width="116">日期</th>
									<th width="109">车号</th>
									<th width="96">起始地</th>
									<th width="96">目的地</th>
									<th width="76">装货数</th>
									<th width="76">卸货数</th>
									<th width="80">单价</th>
									<th width="130">运费金额</th>
									<th width="76" class="check-wrap"><input type="checkbox">核对</></th >
									<th width="56" class="check-wrap"><input type="checkbox">开票</th >
									<th width="56" class="check-wrap"><input type="checkbox">结算</th >
									<th width="56">备注</th >
								</tr>
							</thead>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<tbody>
                            @foreach ($transactions as $transaction)
                                @if (!empty($transaction->buyercheck->jiesuan) && $transaction->buyercheck->jiesuan == 1)
								<tr class="active">
                                @else
								<tr>
                                @endif
									<td><a href="{{ URL('admin/transactions/'.$transaction->id) }}">{{$transaction->id}}</a></td>
									<td>{{$transaction->happendate}}</td>
									<td>{{$transaction->car->code}}</td>
									<td>{{$transaction->fromplace}}</td>
									<td>{{$transaction->endplace}}</td>
									<td>{{$transaction->beginweight}}</td>
									<td>{{$transaction->endweight}}</td>
									<td>{{$transaction->perprice}}</td>
									<td>{{$transaction->value}}</td>
									<td><input type="checkbox" <?php echo (!empty($transaction->buyercheck->hedui) && $transaction->buyercheck->hedui == 1) ? "checked=true" : '' ?> name="hedui[]" value="{{$transaction->id}}"/></td>
									<td><input type="checkbox" <?php echo !empty($transaction->buyercheck->kaipiao) && $transaction->buyercheck->kaipiao == 1 ? "checked=true" : '' ?> name="kaipiao[]" value="{{$transaction->id}}"/></td>
									<td><input type="checkbox"  <?php  echo (!empty($transaction->buyercheck->jiesuan) && $transaction->buyercheck->jiesuan == 1) ? "checked=true" : '' ?> name="jiesuan[]" value="{{$transaction->id}}"/></td>
                                    <input type="hidden" name="trans_id[]" value="{{$transaction->id}}"></input>
									<td><a class="see-btn" href="javascript:;">查看</a><input type="hidden" name="comments[]" value="<?php  echo (!empty($transaction->buyercheck->comment)) ? $transaction->buyercheck->comment : '' ?>"/></td>
								</tr>
                                @endforeach
								<tr>
									<td>总计</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>{{$beginTotalWeight}}吨</td>
									<td>{{$endTotalWeight}}吨</td>
									<td></td>
									<td>￥{{$totalValue}}</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
                                </tr>
							</tbody>
						</table>
                        <input type="hidden" name="buyerid" value="{{$buyer->id}}"></input>
                        <button class="fin-search" style="float: right;">确认提交</button>
                    </form>
					</div>
				</div>
                <div style="float: right;margin-top:50px;font-size:24px;">
                    <?php echo "合计金额（应收运费）：￥$totalValue"; ?>
                </div>
                <div class="paginate">
                    <?php echo $transactions->render(); ?>
                </div>
			</div>
            <div id="check-wrap">
                <div class="check-con">
                    <a class="close" href="javascript:;">X</a>
                    <textarea></textarea>
                    <input class="confirm-btn" type="button" value="确认"/>
                </div>
            </div>
            <script>
            $(".tab").find(".check-wrap").children("input[type='checkbox']").click(function(){
               var par = $(this).parent(), index = par.index();
               var tr = $(".tab>tbody").children("tr");
               tr.each(function(){
                    var child = $(this).children();
                    var check = child.eq(index).children("input[type='checkbox']");
                    var flag = check.prop("checked");
                    check.prop("checked",!flag);
               });
            });
            
            var pop = $("#check-wrap");
            var txt = pop.find("textarea");
            var inp;
            $(".tab").on("click",".see-btn",function(){
                inp = $(this).siblings("input[type='hidden']");
                pop.show();
                txt.val(inp.val()); 
            });
            pop.on("click",".close",function(){
                txt.val("");
                pop.hide();
            })
            pop.on("click",".confirm-btn",function(){
                var val = txt.val();
                inp.val(val);
                txt.val("");
                pop.hide();
            });

           $("#excel-btn").click(function(){
                var url = "<?php echo Request::url().'?'.$_SERVER['QUERY_STRING']; ?>" + "&download=true";
                if(confirm("确定下载吗？")){
                    window.location = url;
                }
           }); 
            </script>
@endsection
