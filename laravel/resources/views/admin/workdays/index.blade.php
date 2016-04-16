@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
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
						<table class="tab">
							<thead>
								<tr>
									<th width="64">姓名</th>
									<th width="50">性别</th>
									<th width="90">部门</th>
									<th width="186">身份证号</th>
									<th width="315">证件下载</th>
									<th width="256">编辑</th >
								</tr>
							</tdead>
							<tbody>
                            @foreach ($employees as $employee)
								<tr>
									<td><a href="{{ URL('admin/employees/'.$employee->id) }}">{{ $employee->name}}</a></td>
									<td>{{ $employee->sex == 0 ? '男' : '女'}}</td>
									<td><?php if (!($employee->depart_id === NULL))  echo $departs[$employee->depart_id]; else echo "暂无"; ?></td>
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
									<td>
										<a class="tableCreat btn-view" href="{{ URL('admin/employees/'.$employee->id) }}">
                                            <i class="fa fa-film" ></i>
											查看
										</a>
										<a class="tableCreat btn-edit" href="{{ URL('admin/employees/'.$employee->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
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
@endsection
