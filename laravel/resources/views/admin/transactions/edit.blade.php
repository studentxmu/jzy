@extends('app')
@section('content')
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/yundan.css') }}" rel="stylesheet">
		<script src="{{ asset('/js/jquery.validationEngine-zh_CN.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/yundan.js') }}" type="text/javascript" charset="utf-8"></script>
        <link href="{{ asset('/css/validationEngine.jquery.css') }}" rel="stylesheet">
			<div class="content fl">
                <form class="validate" action="{{ URL('admin/transactions/'. $transaction->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/transactions') }}">运单列表</a><b>/</b></li>
						<li><a href="#">运单编辑</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">
						    运单编辑	
						</span>
					</div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<ul id="list">
                    <li class="listChild">
                        <div class="date clear">
								<div class="datePicker fl">
									<span>日期：</span><input name="happendate" value="{{$transaction->happendate}}" class="validate[required,custom[date]]" id="d12" type="text" onclick="WdatePicker({el:'d12'})"/>
<span onclick="WdatePicker({el:'d12'})" class="dateImg"></span>
								</div>
								<div class="fr">
									<span>货物名称：</span><input type="text" name="goodsName" value="{{$transaction->goodsname}}" id="goodsName" class="validate[required]"/>
								</div>
								<div class="fr" id="truckpar">
									<span>车号：</span>
                                    <input type="hidden" name="truckNum" id="truckhid" value="{{$transaction->car->id}}"/>
                                    <input type="text" value="{{$transaction->car->code}}" id="truckNum"/>
                                    <ul id="trucklist"></ul> 
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</div>
							</div>
						</li>
						<li class="listChild">
							<ul>
								<li id="driverpar">
									<span>司机1：</span>
                                    <input type="hidden" name="driver" id="driverhid" value="{{$transaction->employee->id}}"/>
                                    <input type="text" value="{{$transaction->employee->name}}" id="driver"/>
                                    <ul id="driverlist"></ul> 
								</li>
								<li id="driver2par">
									<span>司机2：</span>
                                    <input type="hidden" name="driver2" id="driver2hid" value="{{!empty($transaction->employee2->id) ? $transaction->employee2->id: ''}}"/>
                                    <input type="text" value="{{!empty($transaction->employee2->name) ? $transaction->employee2->name : ''}}" id="driver2"/>
                                    <ul id="driver2list"></ul> 
								</li>
								<li id="goodspar">
									<span>货主：</span>
                                    <input type="hidden" name="owner" id="goodshid" value="{{$transaction->buyer->id}}"/>
                                    <input type="text" value="{{$transaction->buyer->name}}" id="owner"/>
                                    <ul id="goodslist"></ul> 
								</li>
							</ul>
						</li>
						<li class="listChild">
							<ul>
                        <li>
									<span>起始地点：</span><input type="text" name="startPlace" value="{{$transaction->fromplace}}" id="startPlace" class="validate[required]"/>
								</li>
								<li>
									<span>到达地点：</span><input type="text" name="endPlace" value="{{$transaction->endplace}}" id="endPlace" class="validate[required]"/>
								</li>
								<li>
									<span>返回地点：</span><input type="text" name="returnPlace" value="{{$transaction->returnplace}}" id="returnPlace" class="validate[required]"/>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
				<!--柴油数量及金额开始-->
				<div id="oil-wrap" class="totalBox">
					<div class="total clear">
						<div><span>柴油数量及金额：（不纳入开支）</span></div>
						<div>
							<span>合计数量</span><input type="text" name="oilTotal" class="total-l" readonly/><span>升</span>
						</div>
                        <div>
                            <span>合计金额</span><input type="text" name="oilMoney" id="oilMoney" class="sumMoney" readonly/><span>元</span>
						</div>
					</div>
                    <!--
                    <a href="javascript:void(0);" id="oilBtn">新增</a>
					-->
                    <div class="totalList">
                        <div class="totalNav">
                            <p class="jiayou">加油方式</p>
                            <p class="chedui">车队</p>
                            <p class="chaiyou">柴油卡</p>
                            <p class="xianjin">现金</p>
                        </div>
						<ul class="clear">
							<li class="oilNum">
                                <p>数量</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="che"/>
                                    <span>升</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="che" />
                                    <span>升</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="oil" />
                                    <span>升</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="oil" />
                                    <span>升</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="oil" />
                                    <span>升</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="oil" />
                                    <span>升</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="cash" />
                                    <span>升</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="cash" />
                                    <span>升</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" data-attr="cash" />
                                    <span>升</span>
                                </div>
							</li>
							<li class="oilNum">
                                <p>单价</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="danjia" />
                                    <span>元</span>
                                </div>
							</li>
							<li class="oil-m">
                                <p>金额</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly />
                                    <span>元</span>
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" readonly/>
                                    <span>元</span>
                                </div>
							</li>
							<li class="on">
                                <p>地址</p>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
							</li>
							<li class="on">
                                <p>日期</p>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate1" onclick="WdatePicker({el:'oilDate1'})" readonly/>
                                </div>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate2" onclick="WdatePicker({el:'oilDate2'})" readonly/>
                                </div>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate3" onclick="WdatePicker({el:'oilDate3'})" readonly/>
                                </div>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate4" onclick="WdatePicker({el:'oilDate4'})" readonly/>
                                </div>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate5" onclick="WdatePicker({el:'oilDate5'})" readonly/>
                                </div>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate6" onclick="WdatePicker({el:'oilDate6'})" readonly/>
                                </div>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate7" onclick="WdatePicker({el:'oilDate7'})" readonly/>
                                </div>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate8" onclick="WdatePicker({el:'oilDate8'})" readonly/>
                                </div>
                                <div class="t-wrap">
                                    <input type="text" id="oilDate9" onclick="WdatePicker({el:'oilDate9'})" readonly/>
                                </div>
							</li>
						</ul>
					</div>
				</div>
				<!--柴油数量及金额结束-->

				<!--公司报销柴油数量及金额开始-->
				<div id="company-wrap" class="totalBox">
					<div class="total clear">
						<div><span>公司报销柴油数量及金额：</span></div>
						<div>
							<span>合计里程</span><input type="text" name="licheng" class="total-l" readonly/><span>公里</span>
						</div>
						<div>
							<span>柴油</span><input type="text" name="chaiyou" class="chaiyou" /><span>升</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney spend" name="companyMoney" id="companyMoney" /><span>元</span>
                        </div>
                    <!--	<a href="javascript:void(0);" id="companyBtn">新增</a> -->
					</div>
					<div class="totalList comList">
						<ul class="clear">
							<li class="on">
                                <p>公里数</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="shu" />
                                </div>
							</li>
							<li class="on">
                                <p>规定油耗</p>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
							</li>
							<li class="on">
                                <p>升数</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="sheng" />
                                </div>
							</li>
                        </ul>    
					</div>
				</div>
				<!--公司柴油数量及金额结束-->
				
				<!--现金过桥收费站开始-->
				<div id="cash-wrap" class="totalBox">
					<div class="total clear">
						<div><span>现金过桥收费站名称及金额：</span></div>
						<div>
							<span>合计数量</span><input type="text" class="sumnum" name="tollTotal" id="tollTotal" readonly/><span>个</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney spend" name="tollFee" id="tollFee" readonly/><span>元</span>
						</div>
						<!--<a href="javascript:void(0);" id="tollBtn">新增</a>-->
					</div>
					<div class="totalList clear" data-order = "0">
                        <p class="tollLeft">往</p>
                        <ul class="tollRight">
							<li class="on">
                                <p>名称</p>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
							</li>
							<li class="on">
                                <p>金额</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
							</li>
                            
                        </ul>
					</div>
					<div class="totalList clear" data-order = "1" style="margin-top:-1px;">
                        <p class="tollLeft">返</p>
                        <ul class="tollRight">
							<li class="on">
                                <p>名称</p>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
							</li>
							<li class="on">
                                <p>金额</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
							</li>
                            
                        </ul>
					</div>
				</div>
				<!--现金过桥收费站结束-->
				<!--ETC过桥收费站开始-->
				<div id="etc-wrap" class="totalBox">
                    <input type="hidden" name="tollType[]" value="2">
					<div class="total clear">
						<div><span>ETC过桥收费站名称及金额：</span></div>
						<div>
                            <span>合计数量</span><input type="text" class="sumnum" name="tollTotal-etc" id="tollTotal-etc" readonly/><span>个</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney" name="tollFee-etc" id="tollFee-etc" readonly/><span>元</span>
						</div>
						<!--<a href="javascript:void(0);" id="tollBtn">新增</a>-->
					</div>
					<div class="totalList clear" data-order = "0">
                        <p class="tollLeft">往</p>
                        <ul class="tollRight">
							<li class="on">
                                <p>名称</p>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
							</li>
							<li class="on">
                                <p>金额</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
							</li>
                            
                        </ul>
					</div>
					<div class="totalList clear" data-order = "1" style="margin-top:-1px;">
                        <p class="tollLeft">返</p>
                        <ul class="tollRight">
							<li class="on">
                                <p>名称</p>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
							</li>
							<li class="on">
                                <p>金额</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
							</li>
                            
                        </ul>
					</div>
				</div>
				<!--ETC过桥收费站结束-->
				
				<!--修车及金额合计开始-->
				<div id="repair-wrap" class="totalBox">
					<div class="total clear">
						<div><span>修车及金额合计：</span></div>
						<div>
							<span>修车</span><input type="text" class="sumnum" name="repairTotal" id="repairTotal" readonly/><span>次</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney spend" name="repairFee" id="repairFee" readonly/><span>元</span>
						</div>
						<!--<a href="javascript:void(0);" id="repairBtn">新增</a>-->
					</div>
					<div class="totalList lengthNum">
						<ul class="clear">
							<li class="on">
                                <p>金额</p>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" class="jine" />
                                </div>
							</li>
							<li class="on">
                                <p>名称</p>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
							</li>
                        </ul>    
					</div>
				</div>
				<!--修车及金额合计结束-->
				
				<!--罚款地点及金额合计开始-->
				<div id="fine-wrap" class="totalBox">
					<div class="total clear">
						<div><span>罚款地点及金额合计：</span></div>
						<div>
							<span>罚款</span><input type="text" class="sumnum" name="fineTotal" id="fineTotal" readonly/><span>次</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney spend" name="fineFee" id="fineFee" readonly/><span>元</span>
						</div>
						<!--<a href="javascript:void(0);" id="fineBtn">新增</a>-->
					</div>
					<div class="totalList lengthNum">
						<ul class="clear">
							<li class="on">
                            <p>罚款地点</p>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap">
                                    <input type="text" />
                                </div>
							</li>
							<li class="on">
                                <p>金额</p>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
							</li>
                        </ul>    
					</div>
				</div>
				<!--罚款及金额合计结束-->
				
				<!--其他开支及金额合计开始-->
				<div id="other-wrap" class="totalBox otherBox">
					<div class="total clear">
						<div>
							<span>其他开支及金额合计：</span>
							<input type="text" class="sumMoney spend" name="otherFee" id="otherFee" readonly/><span>元</span>
						</div>
						<!--<a href="javascript:void(0);" id="otherBtn">新增</a>-->
					</div>
					<div class="totalList">
						<ul class="clear">
							<li class="on">
                                <p>名称</p>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input type="text" />
                                </div>
							</li>
							<li class="on">
                                <p>金额</p>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                        </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
                                <div class="t-wrap t-money">
                                    <input class="jine" type="text" />
                                </div>
							</li>
                        </ul>    
					</div>
				</div>
				
				</div>
				<!--其他开支及金额合计结束-->
				
				<!--总结开始-->
				<div class="sum clear validate">
					<ul class="sumNum fl">
						<li>
							<span>装货吨位：</span>
							<input type="text" id="beginweight" name="beginweight" value="{{$transaction->beginweight}}" class="zong validate[required,custom[number]]"/>
						</li>
						<li>
							<span>卸货吨位：</span>
							<input type="text" id="endweight" name="endweight" value="{{$transaction->endweight}}" class="validate[required,custom[number]]"/>
						</li>
						<li>
							<span>每吨运价：</span>
							<input type="text" id="perprice" name="perprice" value="{{$transaction->perprice}}" class="zong validate[required,custom[number]]"/>
							<span>元</span>
						</li>
					</ul>
					<ul class="total-wrap fr">
						<li>
							<span>开支总计：</span>
							<input type="text" id="payTotal" name="payTotal" value="{{$transaction->cost}}" class="validate[required,custom[number]]" value="0" readOnly/>
							<span>元</span>
						</li>
						<li>
							<span>合计运费：</span>
							<input type="text" id="freightTotal" name="freightTotal" value="{{$transaction->value}}" class="validate[required,custom[number]]" readOnly/>
							<span>元</span>
						</li>
						<li>
							<span>剩余款数：</span>
							<input type="text" id="sumTotal" name="sumTotal" value="{{$transaction->value - $transaction->cost}}" class="validate[required,custom[number]]" readOnly/>
							<span>元</span>
						</li>
                        <li class="button">
                            <span>&nbsp;</span>
                             <!--<button id="sub-btn" class="btn btn-lg btn-info">确认提交</button>-->
                             <input type="submit" id="sub-btn" class="btn btn-lg btn-info" value="确认提交">
                        </li>
					</ul>
				</div>
				<!--总结结束-->
                </form>
			</div>
            <script>
            $("#driver").on("keyup focus",function(){
                    $(this).search({
                        user : <?php echo $peoples ?>,// 数组
                        par  : "driverpar",// 父级id
                        list : "driverlist",// 列表ul的id
                        hide : "driverhid"//hidden域id
                    });
                });
            $("#driver2").on("keyup focus",function(){
                    $(this).search({
                        user : <?php echo $peoples ?>,// 数组
                        par  : "driver2par",// 父级id
                        list : "driver2list",// 列表ul的id
                        hide : "driver2hid"//hidden域id
                    });
                });
            $("#owner").on("keyup focus",function(){
                    $(this).search({
                        user : <?php echo $customers ?>,// 数组
                        par  : "goodspar",// 父级id
                        list : "goodslist",// 列表ul的id
                        hide : "goodshid"//hidden域id
                    });
                });
            $("#truckNum").on("keyup focus",function(){
                    $(this).search({
                        user : <?php echo $trucks ?>,// 数组
                        par  : "truckpar",// 父级id
                        list : "trucklist",// 列表ul的id
                        hide : "truckhid"//hidden域id
                    });
                });
            $("#sub-btn").click(function(e){
                  //  e.preventDefault();
                if($("#driverhid").val() == "" || $("#truckhid").val() == "" || $("#goodshid").val() == ""){
                    e.preventDefault();
                }
            
            });
            //$("input[type='text']").attr("disabled",true);
            var results = JSON.parse('<?php echo json_encode($results, true) ?>');
            console.log( results instanceof Array);
            console.log( results);
            if("chaiyou" in results){
                //柴油
                var chaiyou = results['chaiyou'];
                var oilList = $("#oil-wrap").find("ul").children();
                //console.log(("2" in chaiyou));
                if('1' in chaiyou){
                    $.each(chaiyou['1'],function(index,val){
                            var self = chaiyou['1'];
                            var chaiIndex = index;
                            oilList.each(function(){
                                var index = $(this).index();
                                var tWrap = $(this).find(".t-wrap");
                                tWrap.eq(chaiIndex).find("input[type='text']").val(self[chaiIndex][index])         
                                });
                            }) 
                }
                if('2' in chaiyou){
                    $.each(chaiyou['2'],function(index,val){
                            var self = chaiyou['2'];
                            var chaiIndex = index;
                            oilList.each(function(){
                                var index = $(this).index();
                                var tWrap = $(this).find(".t-wrap");
                                tWrap.eq(chaiIndex+2).find("input[type='text']").val(self[chaiIndex][index])         
                            });
                    }) 

                }
                if('3' in chaiyou){
                    $.each(chaiyou['3'],function(index,val){
                            var self = chaiyou['3'];
                            var chaiIndex = index;
                            oilList.each(function(){
                                var index = $(this).index();
                                var tWrap = $(this).find(".t-wrap");
                                tWrap.eq(chaiIndex+6).find("input[type='text']").val(self[chaiIndex][index])         
                            });
                    }) 

                }
                //收费站
                var fine = results['guoqiao']; 
                if("guoqiao" in results){
                    if('1' in fine){
                        if('1' in fine['1']){
                            addCon(fine['1']['1'],$("#cash-wrap").children('.totalList').eq(0).find('li'))
                        }
                        if('2' in fine['1']){
                            addCon(fine['1']['2'],$("#cash-wrap").children('.totalList').eq(1).find('li'))
                        }
                    }
                    if('2' in fine){
                        if('1' in fine['2']){
                            addCon(fine['2']['1'],$("#etc-wrap").children('.totalList').eq(0).find('li'))
                        }
                        if('2' in fine['2']){
                            addCon(fine['2']['2'],$("#etc-wrap").children('.totalList').eq(1).find('li'))
                        }
                    }
                }
            }
            if('gongsi' in results){
                $("#companyMoney").val(results['gongsi']['0'][3]);
            }
            addCon(results['gongsi'],$("#company-wrap").find("ul").children())
            addCon(results['xiuche'],$("#repair-wrap").find("ul").children())
            addCon(results['fakuan'],$("#fine-wrap").find("ul").children())
            addCon(results['qita'],$("#other-wrap").find("ul").children())
            function addCon(arr,obj){
                if(!jsonisEmpty(results)){
                    if(arr instanceof Array && arr != "" && arr != undefined){
                        $.each(arr,function(index,val){
                                var self = arr;
                                var chaiIndex = index;
                                obj.each(function(){
                                    var index = $(this).index();
                                    var tWrap = $(this).find(".t-wrap");
                                    tWrap.eq(chaiIndex).find("input[type='text']").val(self[chaiIndex][index])         
                                });
                        }) 

                    }
                }
            }

            count($("#oil-wrap").find(".shu"),$("#oil-wrap").find(".total-l"));
            count($("#oil-wrap").find(".jine"),$("#oilMoney"));
            count($("#company-wrap").find(".shu"),$("#company-wrap").find(".total-l"));
            count($("#company-wrap").find(".sheng"),$("#company-wrap").find(".chaiyou"));
            len($("#cash-wrap").find(".jine"),$("#tollTotal"));
            count($("#cash-wrap").find(".jine"),$("#tollFee"));
            len($("#etc-wrap").find(".jine"),$("#tollTotal-etc"));
            count($("#etc-wrap").find(".jine"),$("#tollFee-etc"));
            len($("#repair-wrap").find(".jine"),$("#repairTotal"));
            count($("#repair-wrap").find(".jine"),$("#repairFee"));
            len($("#fine-wrap").find(".jine"),$("#fineTotal"));
            count($("#fine-wrap").find(".jine"),$("#fineFee"));
            count($("#other-wrap").find(".jine"),$("#otherFee"));
            function count(add,total){
                var num = 0;
                add.each(function(){
                    if($(this).val() == "")return;
                    num += parseFloat($(this).val());
                
                });
                total.val(num)
            }
            function len(add,total){
                var num = 0;
                add.each(function(){
                    if($(this).val() == "")return;
                    num += 1;
                
                });
                num = num == parseInt(num) ? num : num.toFixed(2);
                total.val(num)
            }

            function jsonisEmpty(json){
                if (typeof json === "object" && !(json instanceof Array)){  
                    var hasProp = true;  
                    for (var prop in json){  
                        hasProp = false;  
                        break;  
                    }  
                    return hasProp;
                }  
            }
            </script>
    @endsection
