@extends('app')
        <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
@section('content')
<div class="content fl">
    <div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="#">日志列表</a><b></b></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
					</div>
					<div class="tableBox">
                        <div class="table-top clear">
                        </div>
						<table class="tab">
							<thead>
								<tr>
									<th width="70">编号</th>
									<th width="80">用户</th>
									<th width="120">时间</th>
									<th width="180">类型</th>
									<th width="90">动作</th>
									<th width="96">查看</th >
								</tr>
							</tdead>
							<tbody>
                            @foreach ($logexs as $logex )
                                <tr>
                                        <td>{{$logex->id}}</td>
                                        <td>{{$logex->user->name}}</td>
                                        <td>{{$logex->updated_at}}</td>
                                        <td>{{$logex->what}}</td>
                                        <td>{{$logex->type}}</td>
									<td>
										<a class="tableCreat btn-edit" href="javascript:;" data-data = "">
											查看
										</a>
                                        <input type="hidden" name="viewlog" value="{{$logex->datafrom}}" />
                                        <input type="hidden" name="viewlog" value="{{$logex->datato}}" />
									</td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
                <div style="float: right;margin-top:50px;font-size:24px;">
                </div> 
                <div class="paginate"> 
                <?php echo $logexs->render(); ?>
                </div>
			</div>
            <div id="check-wrap">
                <div class="check-con">
                    <a class="close" href="javascript:;">X</a>
                    <p class="txt-before fl">
                    </p>
                    <p class="txt-after fl">
                    </p>
                </div>
            </div>
            <script>
                var check = $("#check-wrap");
                $(".tab").on("click",".tableCreat",function(){
                    var inp = $(this).siblings("input[type='hidden']");
                    var val_b =inp.eq(0).val()
                    var val_a =inp.eq(1).val()
                    var str_b = "";
                    var str_a = "";
                    $(".txt-before").html("修改前：</br>" + val_b)
                    $(".txt-after").html("修改后：</br>" + val_a)
                    check.show();  
                });
                check.on("click",".close",function(){
                    check.hide();
                })
                check.on("click",function(){
                    $(this).hide();
                });
                check.on("click",".check-con",function(e){
                    e.stopPropagation();
                });

            </script>

@endsection
