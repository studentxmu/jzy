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
						<li><a href="{{ URL('admin/employees') }}">员工列表</a><b>/</b></li>
						<li><a href="#">查看员工</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">查看员工</span>
					</div>
                    <div class="user-info-wrap">
                        <h3 class="user-info-tit clear">
                            <span class="user-name fl">{{$employee->name}}
										<a class="tableCreat btn-edit" href="{{ URL('admin/employees/'.$employee->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                            </span>
                            <span class="user-id fr">员工ID：<span>{{$employee->id}}</span></span>
                        </h3>
                        <div class="user-info">
                            <img class="user-info-pic" src="{{ URL('images/'.$employee->imageurl) }}">
                            <ul class="user-info-list">
                                <li><span>身份证号：</span><p>{{$employee->idcode}}</p><input class="copy-btn" type="button" value="复制"></li>
                                <li><span>档案编号：</span><p>{{$employee->drivecode}}</p><input class="copy-btn" type="button" value="复制"></li>
                                <li><span>部门：</span><p>{{$departs[$employee->depart_id]}}</p></li>
                                <li>
                                    <span>证件下载：</span>
                                    <div class="down-id">
                                        @if (!empty($employee->idfronturl))
										<a href="{{ URL('admin/employees/download/'.$employee->id.'/1') }}">
											身份证
										</a>
                                        @endif
                                        @if (!empty($employee->drivefronturl))
										<a href="{{ URL('admin/employees/download/'.$employee->id.'/3') }}">
											驾驶证
										</a>
                                        @endif
                                        @if (!empty($employee->idendurl))
										<a href="{{ URL('admin/employees/download/'.$employee->id.'/2') }}">
											资格证 
										</a>
                                        @endif
                                    </div>
                                </li>
                                <li><span>手机号：</span><p>{{$employee->mobile}}</p></li>
                                <li><span>家庭住址：</span><p style="width:640px">{{$employee->address}}</p></li>
                            </ul>
                        </div>
                    </div>
                    <div class="user-info-wrap">
                        <h3 class="user-info-tit clear">
                            <span class="user-name fl">考勤记录：</span>
                            <?php 
                                $total = 0;
                                foreach ($workdays as $workday) {
                                    $total += $workday->days;
                                }
                            ?>
                            <span class="user-id fr">上工总天数：<span>{{$total}}</span></span>
                        </h3>
					<div class="tableBox">
						<table class="tab">
							<thead>
								<tr>
									<th width="100">上工日期</th>
									<th width="100">下工日期</th>
									<th width="50">天数</th>
									<th width="386">备注</th>
									<th width="256">编辑</th >
								</tr>
							</tdead>
							<tbody>
                                @foreach ($workdays as $workday) 
								<tr>
									<td>{{$workday->begintime}}</td>
									<td>{{$workday->endtime}}</td>
									<td>{{$workday->days}}</td>
									<td>{{$workday->comments}}</td>
									<td>
										<a class="tableCreat btn-edit" href="{{ URL('admin/workdays/'.$workday->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                                        <form class="btn-del-wrap" action="{{ URL('admin/workdays/'.$workday->id) }}" method="POST" style="display: inline;">
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
					</div>
                        
                    </div>
                </div>
			</div>
    <script>
    $(function(){
        alert(3)
    })
    </script>
    @endsection
