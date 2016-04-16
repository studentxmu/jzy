@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
@section('content')
			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/finances/category/1') }}">运单列表</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">运单列表<?php echo !empty($car) ? " - " .$car->code.'（分类账）':"";?></span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    <strong>恭喜!</strong> 
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        @if ($error == "添加成功！")
                            <a href="{{ URL('admin/transactions/create') }}">继续添加运单</a>
                        @endif
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox">
                        <div class="table-top clear">
                            <div>
                                当前共有记录{{$transactions->total()}}条
                            </div>
                        </div>
						<table class="tab">
							<thead>
								<tr>
									<th width="60">编号</th>
									<th width="96">日期</th>
									<th width="109">车号（科目）</th>
									<th width="70">司机</th>
									<th width="537">摘要</th>
									<th width="80">利润</th>
								</tr>
							</thead>
							<tbody>
                            @foreach ($transactions as $transaction)
								<tr>
									<td><a href="{{ URL('admin/transactions/'.$transaction->id) }}">{{$transaction->id}}</a></td>
									<td>{{$transaction->happendate}}</td>
									<td>{{$transaction->car->code}}</td>
									<td>{{$transaction->employee->name}}</td>
									<td style="text-align:left"><?php echo "&nbsp;&nbsp;&nbsp;"; ?>{{$transaction->fromplace . "-" . $transaction->endplace . "-" . $transaction->returnplace . "(" . $transaction->buyer->name . ")" . " 单价："  .$transaction->perprice . ", 开：" . $transaction->cost . ", 卡：" . $transaction->etc()}}</td>
									<td>{{$transaction->value - $transaction->cost}}</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                <div style="float: right;margin-top:50px;font-size:24px;">
                    <?php echo "合计余额：￥$totalValue"; ?>
                </div>
                <div class="paginate">
                    <?php echo $transactions->render(); ?>
                </div>
			</div>
@endsection
