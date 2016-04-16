@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
@section('content')
<div class="content fl">
    <div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="#">货主列表</a><b></b></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">货主列表</span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    <strong>恭喜!</strong> 
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        @if ($error == "添加成功！")
                            <a href="{{ URL('admin/buyers/create') }}">继续添加货主</a>
                        @endif
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox">
						<table class="tab">
							<thead>
								<tr>
									<th width="108">姓名</th>
									<th width="150">公司</th>
									<th width="90">手机号</th>
									<th width="355">邮寄地址</th>
									<th width="256">编辑</th >
								</tr>
							</tdead>
							<tbody>
                            @foreach ($buyers as $buyer)
								<tr>
									<td><a href="#" title="{{$buyer->infomation}}">{{ $buyer->name}}</a></td>
									<td style="text-align:left">{{ $buyer->campany }}</td>
									<td>{{ $buyer->telephone ? $buyer->telephone : '' }}</td>
									<td>{{ $buyer->address }}</td>
									<td>
										<a class="tableCreat btn-edit" href="{{ URL('admin/buyers/'.$buyer->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                                        <form class="btn-del-wrap" action="{{ URL('admin/buyers/'.$buyer->id) }}" method="POST" style="display: inline;">
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
                <?php echo $buyers->render(); ?>
                </div>
			</div>
@endsection
