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
						<span class="wh-fontBox">{{$types[$typeid]}} - 流水账 <?php echo $catename ? '-' : '';?> {{$catename}}</span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    <strong>恭喜!</strong> 
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                            <a href="{{ URL('admin/finances/create/'. $typeid) }}">继续添加账目</a>
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox">
                        <div class="table-top clear">
                            <div>
                                当前共有记录{{$finances->total()}}条
                            </div>
                        </div>
						<table class="tab">
							<thead>
								<tr>
									<th width="50">编号</th>
									<th width="90">日期</th>
									<th width="90">科目</th>
									<th width="480">摘要</th>
									<th width="80">借方</th>
									<th width="80">贷方</th>
									<th width="76">查看</th >
								</tr>
							</tdead>
							<tbody>
                            @foreach ($finances as $finance)
								<tr>
                                    @if ($finance->trans_id)
									<td><a href="{{ URL('admin/transactions/'.$finance->trans_id) }}">{{ $finance->id }}</a></td>
                                    @else
									<td><a href="{{ URL('admin/finances/'.$finance->id.'/edit') }}">{{ $finance->id }}</a></td>
                                    @endif
									<td>{{ $finance->happendate }}</td>
                                    @if ($finance->trans_id)
                                        <td>{{ $finance->car->code }}</td>
                                    @else
                                        @if ($finance->car_id)
                                            <td>{{ $finance->car->code }}</td>
                                        @else
                                            <td>{{ $finance->category->name }}</td>
                                        @endif
                                    @endif
                                    @if ($finance->trans_id)
                                    <?php $transaction = $finance->transaction;?>
                                        <td style="text-align:left"><?php if ($finance->status) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?>{{ $transaction->fromplace . "-" . $transaction->endplace . "-" . $transaction->returnplace . "(" . $transaction->buyer->name . ")" . " 单价："  .$transaction->perprice . ", 开：" . $transaction->cost . ", 卡：" . $transaction->etc() }}</td>
                                    @else
                                        <td style="text-align:left"><?php if ($finance->status) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?>{{ $finance->desc }}</td>
                                    @endif
                                    @if ($finance->status == 0)
                                        <td>{{ $finance->value }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if ($finance->status == 1)
                                        <td>{{ $finance->value }}</td>
                                    @else
                                        <td></td>
                                    @endif
									<td>
										<a class="tableCreat btn-edit" href="javascript:;" data-data = "{{$finance->id}}">
											查看
										</a>
									</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                <div style="float: right;margin-top:50px;font-size:24px;">
                    <?php echo "合计余额：￥$totalValue"; ?>
                </div> <div class="paginate"> <?php echo $finances->render(); ?>
                </div>
			</div>
            <div id="check-wrap">
                <div class="check-con" style="height:100px;margin-top:-50px;">
                    <a class="close" href="javascript:;">X</a>
                    <p class="txt" style="font-size:20px; text-align:center;line-height:100px;"></p>
                </div>
            </div>
            <script>
                var check = $("#check-wrap");
                $(".tab").on("click",".tableCreat",function(){
                    var data = $(this).attr("data-data");
                    var u = "<?php echo URL('admin/finances/latest/'. $typeid . '/' . $cateid) . '/' ?>" + data;
                    $.ajax({
                        type : "GET",
                         url : u,
                        data : "",
                        dataType : "json",
                        success : function(data){
                            check.show();
                            check.find(".txt").text("截止当前剩余金额：" + data.leftmoney);
                        }
                        
                    }); 
                });
                check.on("click",".close",function(){
                    check.hide();
                })
                check.on("click",function(){
                    $(this).hide();
                });
                check.on("click",".check-con",function(e){
                    e.stopPropagation();
                });

            </script>

@endsection
