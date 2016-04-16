@extends('app')
@section('content')
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/transactions/'.$transid) }}">运单详情</a><b>/</b></li>
						<li><a href="#">表单开支录入</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">
						    运单录入	
						</span>
					</div>
                    <form class="validate" action="{{ URL('admin/details') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="transid" value="{{ $transid }}">
				</div>
				
				<!--柴油数量及金额开始-->
				<div class="totalBox">
					<div class="total clear">
						<div><span>柴油数量及金额：</span></div>
						<div>
							<span>合计数量</span><input type="text" name="oilTotal" id="oilTotal" disabled/><span>升</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney" name="oilMoney" id="oilMoney" disabled/><span>元</span>
						</div>
					</div>
					<div class="totalList">
						<a href="javascript:void(0);" id="oilBtn">新增</a>
						<ul class="clear">
							<li>
								<span>加油方式：</span>
								<select name="oilType[]">
                                    @foreach ($oilTypes as $key => $oiltype)
									<option value="{{$key}}">{{$oiltype}}</option>
                                    @endforeach
								</select>
							</li>
							<li>
								<span>数量：</span><input type="text" class="oilNum" name="oilNum[]" id="oilNum"/>
							</li>
							<li>
								<span>金额：</span><input type="text" class="addMoney oilMoney"  name="oilMoney[]" id="oilMoney"/>
							</li>
							<li>
								<span>地址：</span><input type="text" class="oilAddress" name="oilAddress[]" id="oilAddress"/>
							</li>
							<li>
								<span>日期：</span><input id="oilDate" name="oilDate[]" type="text" onclick="WdatePicker({el:'oilDate'})"/><span onclick="WdatePicker({el:'oilDate'})" class="dateImg"></span>
							</li>
						</ul>
					</div>
				</div>
				<!--柴油数量及金额结束-->
				
				<!--过桥收费站开始-->
				<div class="totalBox">
					<div class="total clear">
						<div><span>过桥收费站名称及金额：</span></div>
						<div>
							<span>合计数量</span><input type="text" class="sumnum" name="tollTotal" id="tollTotal" disabled/><span>个</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney" name="tollFee" id="tollFee" disabled/><span>元</span>
						</div>
					</div>
					<div class="totalList lengthNum idToll">
						<a href="javascript:void(0);" id="tollBtn">新增</a>
						<ul class="clear" id="ulLength">
							<li>
								<span>收费类型：</span>
								<select name="tollType[]" class="tollType">
                                    @foreach ($roadTypes as $key => $roadtype)
									<option value="{{$key}}">{{$roadtype}}</option>
                                    @endforeach
								</select>
							</li>
							<li>
								<span>往返：</span>
								<select name="tollGoCome[]" class="tollGoCome">
                                    @foreach ($roadTrips as $key => $roadtrip)
									<option value="{{$key}}">{{$roadtrip}}</option>
                                    @endforeach
								</select>
							</li>
							<li>
								<span>名称：</span><input type="text" class="tollName" name="tollName[]" id="tollName"/>
							</li>
							<li>
								<span>金额：</span><input type="text" class="addMoney tollMoney"  name="tollMoney[]" id="tollMoney"/>
							</li>
							<li>
								<span>日期：</span><input id="tollDate" name="tollDate[]" type="text" onclick="WdatePicker({el:'tollDate'})"/><span onclick="WdatePicker({el:'tollDate'})" class="dateImg"></span>
							</li>
						</ul>
					</div>
				</div>
				<!--过桥收费站结束-->
				
				<!--修车及金额合计开始-->
				<div class="totalBox">
					<div class="total clear">
						<div><span>修车及金额合计：</span></div>
						<div>
							<span>修车</span><input type="text" class="sumnum" name="repairTotal" id="repairTotal" disabled/><span>次</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney" name="repairFee" id="repairFee" disabled/><span>元</span>
						</div>
					</div>
					<div class="totalList lengthNum">
						<a href="javascript:void(0);" id="repairBtn">新增</a>
						<ul class="clear">
							<li>
								<span>配件名称：</span><input type="text" class="repairName" name="repairName[]" id="repairName"/>
							</li>
							<li>
								<span>金额：</span><input type="text" class="addMoney repairMoney"  name="repairMoney[]" id="repairMoney"/>
							</li>
							<li>
								<span>地址：</span><input type="text" class="repairAddress" name="repairAddress[]" id="repairAddress"/>
							</li>
							<li>
								<span>日期：</span><input id="repairDate" name="repairDate[]" type="text" onclick="WdatePicker({el:'repairDate'})"/><span onclick="WdatePicker({el:'repairDate'})" class="dateImg"></span>
							</li>
						</ul>
					</div>
				</div>
				<!--修车及金额合计结束-->
				
				<!--罚款地点及金额合计开始-->
				<div class="totalBox">
					<div class="total clear">
						<div><span>罚款地点及金额合计：</span></div>
						<div>
							<span>罚款</span><input type="text" class="sumnum" name="fineTotal" id="fineTotal" disabled/><span>次</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney" name="fineFee" id="fineFee" disabled/><span>元</span>
						</div>
					</div>
					<div class="totalList lengthNum">
						<a href="javascript:void(0);" id="fineBtn">新增</a>
						<ul class="clear">
							<li>
								<span>罚款地点：</span><input type="text" class="fineAddress" name="fineAddress[]" id="fineAddress"/>
							</li>
							<li>
								<span>金额：</span><input type="text" class="addMoney fineMoney"  name="fineMoney[]" id="fineMoney"/>
							</li>
							<li>
								<span>日期：</span><input id="fineDate" name="fineDate[]" type="text" onclick="WdatePicker({el:'fineDate'})"/><span onclick="WdatePicker({el:'fineDate'})" class="dateImg"></span>
							</li>
						</ul>
					</div>
				</div>
				<!--罚款及金额合计结束-->
				
				<!--其他开支及金额合计开始-->
				<div class="totalBox otherBox">
					<div class="total clear">
						<div>
							<span>其他开支及金额合计：</span>
							<input type="text" class="sumMoney" name="otherFee" id="otherFee" disabled/><span>元</span>
						</div>
					</div>
					<div class="totalList">
						<a href="javascript:void(0);" id="otherBtn">新增</a>
						<ul class="clear">
							<li>
								<span>名称：</span><input type="text" class="otherName" name="otherName[]" id="otherName"/>
							</li>
							<li>
								<span>金额：</span><input type="text" class="addMoney otherMoney"  name="otherMoney[]" id="otherMoney"/>
							</li>
							<li>
								<span>日期：</span><input id="otherDate" name="otherDate[]" class="otherDate" type="text" onclick="WdatePicker({el:'otherDate'})"/><span onclick="WdatePicker({el:'otherDate'})" class="dateImg"></span>
							</li>
						</ul>
					</div>
				</div>
				
				</div>
				<!--其他开支及金额合计结束-->
				
				<!--总结开始-->
				<div class="sum clear">
					<ul class="sumMoney fr">
							<li class="button">
								<span>&nbsp;</span>
								 <button class="btn btn-lg btn-info">确认提交</button>
							</li>
					</form>
					</ul>
				</div>
				<!--总结结束-->
			</div>
		<script src="{{ asset('/js/table.js') }}" type="text/javascript" charset="utf-8"></script>
    @endsection
