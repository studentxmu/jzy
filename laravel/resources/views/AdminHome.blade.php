@extends('app')

@section('content')
		<link rel="stylesheet" type="text/css" href="{{asset('/css/index.css')}}"/>
        <script src="{{ asset('/js/form.js') }}" type="text/javascript" charset="utf-8"></script>
			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="#">主页</a><b>/</b></li>
						<li><a href="#">DashBoard</a></li>
					</ul>
				</div>
				<div class="row">
					<ul class="clear">
						<li class="employee">
							<a href="{{ URL('admin/employees') }}">
								<div class="rowBorder">
									<div class="imgBg">
										<img src="{{ asset('/images/index-people.png') }}"/>
									</div>
									<div class="text">员工数</div>
									<div class="num">{{$employee_count}}</div>
								</div>
							</a>
						</li>
						<li class="car">
							<a href="{{ URL('admin/cars') }}">
								<div class="rowBorder">
									<div class="imgBg">
										<img src="{{ asset('/images/index-car.png') }}" width="32" height="30"/>
									</div>
									<div class="text">车辆数</div>
									<div class="num">{{$car_count}}</div>
								</div>
							</a>
						</li>
						<li class="balance">
							<a href="{{ URL('admin/finances/latest/1') }}">
								<div class="rowBorder">
									<div class="imgBg">
										<img src="{{ asset('/images/index-money.png') }}"/>
									</div>
									<div class="text">车队账面余额</div>
									<div class="num">￥{{$value_traffic}}</div>
								</div>
							</a>
						</li>
						<li class="readyDo">
							<a href="{{ URL('admin/finances/latest/2') }}">
								<div class="rowBorder">
									<div class="imgBg">
										<img src="{{ asset('/images/index-todo.png') }}"/>
									</div>
									<div class="text">公司账面余额</div>
									<div class="num">￥{{$value_campany}}</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">系统简介</span>
					</div>
					<div class="textWrap">
						<h1 class="textTitle">物流公司系统解决方案（Terminator）</h1>
						<p class="textCon">
							我们为物流行业中的佼佼者量身定制了一套完美的，信息化程度高，可操作性好又稳定的终极解决方案，整套信息系统包括运单管理，员工管理，车辆管理，货主管理，科目管理和高级查询，报表导出等一系列模块，可以包含公司日常运营的方方面面，除此之外我们还有完善的权限管理，环境扫描线上线下隔离机制等安全保障，您还可以选择性使用更高级的个性化定制功能，CEO报表预测图表，趋势推测，自动员工工资结算甚至自动商家打款等高级功能，作为行业系统解决方案的提供商和运营商，员工的满意是我们第一宗旨。
						</p>
					</div>
					<div class="textBtn clear">
						<a href="#">查看使用文档</a>
						<a href="#">快速联系我们</a>
					</div>
				</div>
				<div class="indexList clear">
					<!--运单动态开始-->
					<div  class="waybill fl">
						<p class="wh-bg">
							<span class="wh-fontBox">运单动态</span>
						</p>
						<ul>
							<li>
								<em>1.</em>
								<strong>北京--天津</strong>
								<span>2015/02/10</span>
							</li>
							<li>
								<em>2.</em>
								<strong>天津--唐山</strong>
								<span>2015/02/04</span>
							</li>
							<li>
								<em>3.</em>
								<strong>天津--内蒙古</strong>
								<span>2015/02/13</span>
							</li>
							<li>
								<em>4.</em>
								<strong>天津--山西</strong>
								<span>2015/02/09</span>
							</li>
							<li>
								<em>5.</em>
								<strong>天津--天津</strong>
								<span>2015/01/10</span>
							</li>
							<li>
								<em>5.</em>
								<strong>天津--天津</strong>
								<span>2015/01/10</span>
							</li>
						</ul>
					</div>
					<!--运单动态结束-->
					<!--车辆动态开始-->
					<div  class="truck fl">
						<p class="wh-bg">
							<span class="wh-fontBox">车辆动态</span>
						</p>
						<ul class="clear">
							<li>
								<em>新增</em>
								<strong>冀F4510</strong>
								<span>东风30吨</span>
							</li>
							<li>
								<em>新增</em>
								<strong>津H1346</strong>
								<span>一汽30吨</span>
							</li>
							<li>
								<em>新增</em>
								<strong>津F1234</strong>
								<span>东风10吨</span>
							</li>
							<li>
								<em>新增</em>
								<strong>津B4567</strong>
								<span>奔驰30吨</span>
							</li>
							<li>
								<em>新增</em>
								<strong>冀E5210</strong>
								<span>东风30吨</span>
							</li>
							<li>
								<em>新增</em>
								<strong>冀E5210</strong>
								<span>东风30吨</span>
							</li>
						</ul>
					</div>
					<!--车辆动态结束-->
					<!--员工动态开始-->
					<div  class="worker fl">
						<p class="wh-bg">
							<span class="wh-fontBox">员工动态</span>
						</p>
						<ul>
							<li>
								<img src="img/head.png" width="50" height="50"/>
								<strong>张立佳</strong>
								<span>入职</span>
							</li>
							<li>
								<img src="img/head.png" width="50" height="50"/>
								<strong>张少波</strong>
								<span>离职</span>
							</li>
							<li>
								<img src="img/head.png" width="50" height="50"/>
								<strong>孙瑞培</strong>
								<span>请假2天</span>
							</li>
							<li>
								<img src="img/head.png" width="50" height="50"/>
								<strong>杜亮飞</strong>
								<span>预支工资</span>
							</li>
						</ul>
					</div>
					<!--员工动态结束-->
				</div>
			
			</div>
@endsection
