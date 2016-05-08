@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
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
                        <div class="table-top clear">
                            <div class="fl">
                                当前共有车辆{{$count}}辆
                            </div>
                            <div class="search-wrap fr">
                                    <div id="driverpar">
                                        <input type="hidden" name="driver" id="driverhid"/>
                                        <input type="text" id="driver"/>
                                        <ul id="yuangong"></ul> 
                                    </div>
                                <a class="search-btn fl" href="#"><img class="search-btn-bg" src="../images/search-pic.jpg"></a>
                            </div>
                        </div>
						<table class="tab">
							<thead>
								<tr>
									<th width="150">车牌号</th>
									<th width="110">挂车牌号</th>
									<th width="110">所属公司</th>
									<th width="120">购车日期</th>
									<th width="420">证件下载</th>
                                    @if (\App\User::isLimit('car-delete', Auth::user()->id))
									<th width="86">编辑</th >
                                    @endif
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
											交强保险
										</a>
                                        @endif
                                        @if (!empty($car->comassuranceurl))
										<a href="{{ URL('admin/cars/download/'.$car->id.'/5') }}">
											商业保险
										</a>
                                        @endif
									</td>
                                    @if (\App\User::isLimit('car-delete', Auth::user()->id))
									<td>
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
                                    @endif
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
        <script>
            $("#driver").on("keyup focus",function(){
                    $(this).search({
                        url  : <?php echo '"', URL('admin/cars/'), '/"' ?>,  
                        user : <?php echo $trucks?>,// 数组
                        par  : "driverpar",// 父级id
                        list : "yuangong",// 列表ul的id
                        hide : "driverhid"//hidden域id
                    });
                });
        </script>
@endsection
