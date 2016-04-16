@extends('app')
@section('content')
        <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
		<script src="{{ asset('/js/jquery.validationEngine-zh_CN.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/jquery.validationEngine.js') }}" type="text/javascript" charset="utf-8"></script>
        <link href="{{ asset('/css/validationEngine.jquery.css') }}" rel="stylesheet">
			<div class="content fl">
                <form class="validate" action="{{ URL('admin/transactions') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/transactions') }}">运单列表</a><b>/</b></li>
						<li><a href="#">表单录入</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">
						    运单录入	
						</span>
					</div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<ul id="list">
						<li class="listChild">
							<div class="date clear">
								<div class="datePicker fl">
									<span>日期：</span><input name="happendate" class="validate[required,custom[date]]" id="d12" style="width: 164px;" type="text" onclick="WdatePicker({el:'d12'})"/>
<span onclick="WdatePicker({el:'d12'})" class="dateImg"></span>
								</div>
								<div class="fr">
									<span>货物名称：</span><input type="text" name="goodsName" id="goodsName" class="validate[required]"/>
								</div>
								<div class="fr" id="truckpar">
									<span>车号：</span>
                                    <input type="hidden" name="truckNum" id="truckhid"/>
                                    <input type="text" id="truckNum"/>
                                    <ul id="trucklist"></ul> 
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</div>
							</div>
						</li>
						<li class="listChild">
							<ul>
								<li id="driverpar">
									<span>司机1：</span>
                                    <input type="hidden" name="driver" id="driverhid"/>
                                    <input type="text" id="driver"/>
                                    <ul id="driverlist"></ul> 
								</li>
								<li id="driver2par">
									<span>司机2：</span>
                                    <input type="hidden" name="driver2" id="driver2hid"/>
                                    <input type="text" id="driver2"/>
                                    <ul id="driver2list"></ul> 
								</li>
								<li id="goodspar">
									<span>货主：</span>
                                    <input type="hidden" name="owner" id="goodshid"/>
                                    <input type="text" id="owner"/>
                                    <ul id="goodslist"></ul> 
								</li>
							</ul>
						</li>
						<li class="listChild">
							<ul>
								<li>
									<span>起始地点：</span><input type="text" name="startPlace" id="startPlace" class="validate[required]"/>
								</li>
								<li>
									<span>到达地点：</span><input type="text" name="endPlace" id="endPlace" class="validate[required]"/>
								</li>
								<li>
									<span>返回地点：</span><input type="text" name="returnPlace" id="returnPlace" class="validate[required]"/>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
				<!--柴油数量及金额开始-->
				<div class="totalBox">
					<div class="total clear">
						<div><span>柴油数量及金额：（不纳入开支）</span></div>
						<div>
							<span>合计数量</span><input type="text" name="oilTotal" id="oilTotal" disabled/><span>升</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" name="oilMoney" id="oilMoney" disabled/><span>元</span>
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

				<!--柴油数量及金额开始-->
				<div class="totalBox">
					<div class="total clear">
						<div><span>公司报销柴油数量及金额：</span></div>
						<div>
							<span>合计里程</span><input type="text" name="licheng" id="lichengTotal" disabled/><span>公里</span>
						</div>
						<div>
							<span>合计金额</span><input type="text" class="sumMoney" name="companyMoney" id="companyMoney" disabled/><span>元</span>
						</div>
					</div>
					<div class="totalList comList">
						<a href="javascript:void(0);" id="companyBtn">新增</a>
						<ul class="clear">
							<li>
								<span>里程：</span><input type="text" class="licheng comInput" name="licheng[]"/>
							</li>
							<li>
								<span>油耗：</span><input type="text" class="youhao comInput" name="youhao[]"/>
							</li>
							<li>
								<span>单价：</span><input type="text" class="danjia comInput" name="danjia[]"/>
							</li>
							<li>
								<span>金额：</span><input type="text" class="addMoney comMoney"  name="comMoney[]" readonly/>
							</li>
							<li>
								<span>日期：</span><input id="comDate" name="comDate[]" type="text" onclick="WdatePicker({el:'comDate'})"/><span onclick="WdatePicker({el:'comDate'})" class="dateImg"></span>
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
					<ul class="sumNum fl">
						<li>
							<span>装货吨位：</span>
							<input type="text" id="beginweight" name="beginweight" class="validate[required,custom[number]]"/>
						</li>
						<li>
							<span>卸货吨位：</span>
							<input type="text" id="endweight" name="endweight" class="validate[required,custom[number]]"/>
						</li>
						<li>
							<span>每吨运价：</span>
							<input type="text" id="perprice" name="perprice" class="validate[required,custom[number]]"/>
							<span>元</span>
						</li>
					</ul>
					<ul class="sumMoney fr">
						<li>
							<span>开支总计：</span>
							<input type="text" id="payTotal" name="payTotal" class="validate[required,custom[number]]" readOnly/>
							<span>元</span>
						</li>
						<li>
							<span>合计运费：</span>
							<input type="text" id="freightTotal" name="freightTotal" class="validate[required,custom[number]]" readOnly/>
							<span>元</span>
						</li>
						<li>
							<span>剩余款数：</span>
							<input type="text" id="sumTotal" name="sumTotal" class="validate[required,custom[number]]" readOnly/>
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
		<script src="{{ asset('/js/table.js') }}" type="text/javascript" charset="utf-8"></script>
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
                    alert("司机、车号、货主信息不能为空！");
                }
            
            });
        </script>
    @endsection
