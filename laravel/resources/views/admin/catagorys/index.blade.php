@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
@section('content')
<div class="content fl">
    <div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="#">科目列表</a><b></b></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">科目列表</span>
					</div>
                    @if (count($errors) > 0)
                    <div class="alert alert-success">
                    <strong>恭喜!</strong> 
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                        @if ($error == "添加成功！")
                            <a href="{{ URL('admin/catagorys/create') }}">继续添加科目</a>
                        @endif
                    @endforeach
                    </div>
                    @endif
					<div class="tableBox">
						<table class="tab">
							<thead>
								<tr>
									<th width="128">科目名称</th>
									<th width="100">科目类型</th>
									<th width="160">父级科目名称</th>
									<th width="395">备注</th>
                                    @if (\App\User::isLimit('cate-edit', Auth::user()->id) || \App\User::isLimit('cate-delete', Auth::user()->id))
									<th width="206">编辑</th >
                                    @endif
								</tr>
							</tdead>
							<tbody>
                            @foreach ($catagorys as $catagory)
								<tr>
									<td><a href="#" title="{{$catagory->infomation}}">{{ $catagory->name}}</a></td>
									<td>{{ empty($catagory->type_id) ? '暂无' : \App\Catagory::$types[$catagory->type_id]}}</td>
                                    <?php $fukemu = \App\Catagory::find($catagory->parent_id); ?>
									<td>{{ $catagory->parent_id == 0 ? '暂无' : $fukemu->name}}</td>
									<td>{{ $catagory->infomation}}</td>
                                    @if (\App\User::isLimit('cate-edit', Auth::user()->id) || \App\User::isLimit('cate-delete', Auth::user()->id))
									<td>
                                        @if (\App\User::isLimit('cate-edit', Auth::user()->id))
										<a class="tableCreat btn-edit" href="{{ URL('admin/catagorys/'.$catagory->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                                        @endif
                                        @if (\App\User::isLimit('cate-delete', Auth::user()->id))
                                        <form class="btn-del-wrap" action="{{ URL('admin/catagorys/'.$catagory->id) }}" method="POST" style="display: inline;">
                                            <a class="btn-del-bg" href="javascript:void(0):">
                                                <i class="fa fa-trash" ></i>
                                                删除
                                            </a>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-del"> </button>
                                        </form>
                                        @endif
									</td>
                                    @endif
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                <div class="paginate">
                <?php echo $catagorys->render(); ?>
                </div>
			</div>
@endsection
