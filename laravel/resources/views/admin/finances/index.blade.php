@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
@section('content')
<div class="content fl">
    <div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="#">车辆列表</a><b></b></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">车辆列表</span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    <strong>恭喜!</strong> 
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        @if ($error == "添加成功！")
                            <a href="{{ URL('admin/cars/create') }}">继续添加车辆</a>
                        @endif
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox">
						<table class="tab">
							<thead>
								<tr>
									<th width="110">车牌号</th>
									<th width="110">挂车牌号</th>
									<th width="110">所属公司</th>
									<th width="120">购车日期</th>
									<th width="320">证件下载</th>
									<th width="256">编辑</th >
								</tr>
							</tdead>
							<tbody>
                            @foreach ($cars as $car)
								<tr>
									<td><a href="{{ URL('admin/cars/'.$car->id) }}">{{ $car->code}}</a></td>
									<td>{{ $car->vicecode}}</td>
									<td><?php echo $companys[$car->company_id]?></td>
									<td>{{ $car->buytime }}</td>
									<td>
                                        @if (!empty($car->driveurl))
										<a href="{{ URL('admin/cars/download/'.$car->id.'/2') }}">
											行驶证 |
										</a>
                                        @endif
                                        @if (!empty($car->normalurl))
										<a href="{{ URL('admin/cars/download/'.$car->id.'/3') }}">
											营运证 |
										</a>
                                        @endif
                                        @if (!empty($car->assuranceurl))
										<a href="{{ URL('admin/cars/download/'.$car->id.'/4') }}">
											保险
										</a>
                                        @endif
									</td>
									<td>
										<a class="tableCreat btn-view" href="{{ URL('admin/cars/'.$car->id) }}">
                                            <i class="fa fa-film" ></i>
											查看
										</a>
										<a class="tableCreat btn-edit" href="{{ URL('admin/cars/'.$car->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                                        <form class="btn-del-wrap" action="{{ URL('admin/cars/'.$car->id) }}" method="POST" style="display: inline;">
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
                <div class="paginate">
                    <?php echo $cars->render();?>
                </div>
			</div>
@endsection
