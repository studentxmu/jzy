@extends('app')

@section('content')
		<script src="{{ asset('/js/jquery.validationEngine-zh_CN.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8"></script>
        <link href="{{ asset('/css/validationEngine.jquery.css') }}" rel="stylesheet">

			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/finances/latest/'.$typeid) }}">{{$types[$typeid]}} - 财务列表</a><b>/</b></li>
						<li><a href="#">编辑财务</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">财务录入({{$types[$typeid]}})</span>
					</div>

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    <strong>不好!</strong> 出错了！<br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif

                    <form class="validate" action="{{ URL('admin/finances/'. $finance->id) }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type_id" value="{{ $typeid }}">
						<ul class="truckList">
							<li>
								<div class="datePicker fl">
									<span><em class="star">*</em> 日期：</span>
									<input id="jointime" value="{{$finance->happendate}}" name="happendate" class="form-control validate[required,custom[date]]" style="width: 164px;" type="text" onclick="WdatePicker({el:'jointime'})"/>
<span onclick="WdatePicker({el:'jointime'})" class="dateImg"></span>
								</div>
							</li>
                            <li>
                                <span><em class="star">*</em> 科目：</span>
                                <select name="cate_id">
                                @foreach ($catagorys as $catagory)
                                    <option value ="{{$catagory->id}}"  <?php echo $finance->cate_id == $catagory->id ? 'selected="selected"' : ""; ?>>{{$catagory->name}}</option>
                                    <option value ="999999999" <?php echo $finance->cate_id == 999999999 ? 'selected="selected"' : ""; ?>>车辆开支</option>
                                @endforeach
                                </select>
                            </li>
							<li>
								<span><em class="star">*</em> 借贷：</span>
                                <input type="radio" name="status" value="0" id="jieRadio" class="validate[required]" style="width:25px" <?php echo $finance->status == 0 ? "checked" : ''; ?>>
                                <label for="jieRadio">借</label>
                                <input type="radio" name="status" value="1" id="daiRadio" class="validate[required]" style="width:25px;margin-left:35px" <?php echo $finance->status == 1 ? "checked" : ''; ?>>
                                <label for="daiRadio">贷</label>
							</li>
							<li>
								<span><em class="star">*</em> 摘要：</span>
                                <input type="text" name="desc" class="form-control validate[required]" value="{{$finance->desc}}">
							</li>
							<li>
								<span><em class="star">*</em> 金额：</span>
                                <input type="text" name="jine" class="form-control validate[required]" value="{{$finance->value}}">
							</li>
							<li class="button">
								<span>&nbsp;</span>
								 <button class="btn btn-lg btn-info">确认提交</button>
							</li>
						</ul>
					</form>
				</div>
			</div>
    @endsection
