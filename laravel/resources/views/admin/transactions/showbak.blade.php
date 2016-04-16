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
						<li><a href="{{ URL('admin/transactions') }}">运单列表</a><b>/</b></li>
						<li><a href="#">查看运单</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">查看运单</span>
					</div>
                    <div class="user-info-wrap">
                        <h3 class="user-info-tit clear">
                            <span class="user-name fl">{{$transaction->car->code}}
										<a class="tableCreat btn-edit" href="{{ URL('admin/transactions/'.$transaction->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                            </span>
                            <span class="user-id fr">运单ID：<span>{{$transaction->id}}</span></span>
                        </h3>
                        <div class="user-info">
                            <img class="user-info-pic" src="{{ URL('images/'.$transaction->employee->imageurl) }}">
                            <ul class="user-info-list">
                                <li><span>日期：</span><p>{{$transaction->happendate}}</p></li>
                                <li><span>司机：</span><p>{{$transaction->employee->name}}</p></li>
                                <li><span>货物名称：</span><p>{{$transaction->goodsname}}</p></li>
                                <li><span>货主：</span><p>{{$transaction->buyer->name}}</p></li>
                                <li><span>地点（起始-到达-返回）：</span><p>{{$transaction->fromplace."-".$transaction->endplace."-".$transaction->returnplace}}</p></li>
                                <li><span>装货吨数（单价）-卸货吨数：</span><p>{{$transaction->beginweight."吨(￥".$transaction->perprice.")-".$transaction->endweight}}吨</p></li>
                            </ul>
                        </div>
                    </div>
                    <div class="user-info-wrap">
                        <h3 class="user-info-tit clear">
                            <span class="user-name fl">详细开支记录：
										<a class="tableCreat btn-edit" href="{{ URL('admin/details/create/'.$transaction->id) }}">
                                            <i class="fa fa-edit" ></i>
											新增开支
										</a>
                            </span>
                            <?php 
                                $total = 0;
                                foreach ($details as $detail) {
                                    $total += $detail->value;
                                }
                            ?>
                            <span class="user-id fr">开支总金额：<span>￥{{$total}}</span></span>
                        </h3>
					<div class="tableBox">
						<table class="tab">
							<thead>
								<tr>
									<th width="100">日期</th>
									<th width="130">开支类型</th>
									<th width="80">数量</th>
									<th width="110">收费/往返</th>
									<th width="306">名称/地址</th>
									<th width="70">金额</th>
									<th width="86">编辑</th >
								</tr>
							</tdead>
							<tbody>
                                @foreach ($details as $detail) 
								<tr>
									<td>{{$detail->happendate}}</td>
									<td>{{isset($types[$detail->type_id]) ? $types[$detail->type_id] : ''}}开支</td>
									<td>{{$detail->desc}}</td>
									<td>{{isset($oilTypes[$detail->cate_id]) ? $oilTypes[$detail->cate_id]."/" : ''}} {{isset($roadTypes[$detail->cate_id]) ? (" ".$roadTypes[$detail->cate_id])."/" : ''}} {{(($detail->trip_id && isset($roadTrips[$detail->trip_id])) ? (" ".$roadTrips[$detail->trip_id]) : '')}}</td>
									<td>{{$detail->address}}</td>
									<td>{{$detail->value}}</td>
									<td>
                                        <form class="btn-del-wrap" action="{{ URL('admin/details/'.$detail->id) }}" method="POST" style="display: inline;">
                                            <a class="btn-del-bg" href="javascript:void(0):">
                                                <i class="fa fa-trash" ></i>
                                                删除
                                            </a>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-del"> </button>
                                        </form>
									</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
                        <div style="float: right;margin-top:50px;font-size:24px;">
                            <?php $lirun = $transaction->value - $total;?>
                            <?php echo "本次利润：￥$lirun"; ?>
                        </div>
					</div>
                        
                    </div>
                </div>
			</div>
    @endsection
