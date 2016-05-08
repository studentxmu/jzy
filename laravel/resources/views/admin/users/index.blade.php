@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@section('content')
<div class="content fl">
    <div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="#">用户列表</a><b></b></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">用户列表</span>
					</div>
                    <br/>
					<div class="">
                        &nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ URL('admin/users/create') }}">+添加用户</a>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    <strong>恭喜!</strong> 
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        @if ($error == "添加成功！")
                            <a href="{{ URL('admin/users/create') }}">继续添加用户</a>
                        @endif
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox">
						<table class="tab">
							<thead>
								<tr>
									<th width="34">编号</th>
									<th width="184">姓名</th>
									<th width="380">邮箱</th>
									<th width="84">身份</th>
									<th width="120">权限 </th>
									<th width="186">编辑</th >
								</tr>
							</tdead>
							<tbody>
                            @foreach ($users as $user)
								<tr>
									<td>{{ $user->id }}</td>
									<td><a href="javascript:;">{{ $user->name}}</a></td>
									<td>{{ $user->email}}</td>
									<td>{{ $user->isAdmin() ? '管理员' : '普通用户'}}</td>
									<td><a href="{{ URL('admin/users/'.$user->id) }}">设置权限</a></td>
									<td>
                                        @if (!$user->isAdmin())
										<a class="tableCreat btn-edit" href="{{ URL('admin/users/'.$user->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                                        <form class="btn-del-wrap" action="{{ URL('admin/users/'.$user->id) }}" method="POST" style="display: inline;">
                                            <a class="btn-del-bg" href="javascript:void(0):">
                                                <i class="fa fa-trash" ></i>
                                                删除
                                            </a>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-del"> </button>
                                        @endif
                                        </form>
									</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                <div class="paginate">
                <?php echo $users->render(); ?>
                </div>
			</div>
@endsection
