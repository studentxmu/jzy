@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@section('content')
<div class="content fl">
    <div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="#">员工列表</a><b></b></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">员工列表</span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    <strong>恭喜!</strong> 
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        @if ($error == "添加成功！")
                            <a href="{{ URL('admin/employees/create') }}">继续添加员工</a>
                        @endif
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox">
                        <div class="table-top clear">
                            <div class="fl">
                                当前共有员工{{$count}}人
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
									<th width="34">编号</th>
									<th width="84">姓名</th>
									<th width="50">性别</th>
									<th width="120">手机号 </th>
									<th width="186">身份证号</th>
									<th width="375">证件下载</th>
                                    @if (\App\User::isLimit('user-delete', Auth::user()->id))
									<th width="86">编辑</th >
                                    @endif
								</tr>
							</tdead>
							<tbody>
                            @foreach ($employees as $employee)
								<tr>
									<td>{{ $employee->id }}</td>
									<td><a href="{{ URL('admin/employees/'.$employee->id) }}">{{ $employee->name}}</a></td>
									<td>{{ $employee->sex == 0 ? '男' : '女'}}</td>
									<td>{{ $employee->mobile }}</td>
									<td>{{ $employee->idcode }}</td>
									<td>
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
									</td>
                                    @if (\App\User::isLimit('user-delete', Auth::user()->id))
									<td>
                                        <form class="btn-del-wrap" action="{{ URL('admin/employees/'.$employee->id) }}" method="POST" style="display: inline;">
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
                <?php echo $employees->render(); ?>
                </div>
			</div>
        <script>
            $("#driver").on("keyup focus",function(){
                    $(this).search({
                        url  : <?php echo '"', URL('admin/employees/'), '/"' ?>,  
                        user : <?php echo $peoples ?>,// 数组
                        par  : "driverpar",// 父级id
                        list : "yuangong",// 列表ul的id
                        hide : "driverhid"//hidden域id
                    });
                });
        </script>
@endsection
