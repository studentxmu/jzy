<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>金正阳科技</title>
        <link href="{{ asset('/css/public.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/record.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
		<script src="{{ asset('/js/jquery-1.10.2.min.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/datePicker/WdatePicker.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/public.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('/js/zyh.js') }}" type="text/javascript" charset="utf-8"></script>
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        </head>
	<body>
		<div class="header">
			<a class="navbar-brand fl" href="/admin">
				<img src="{{ asset('/images/logo20.png') }}" alt="logo" />
				<span>金正阳物流公司系统</span>
			</a>
			<div class="btn-group fr" tabindex="1">
				<button class="btn">
					<span class="btn-text">当前登录用户{{Auth::user()->name}}</span>
					<strong class="btn-caret"></strong>
				</button>
				<ul class="btn-menu">
					<li class="menuLast"><a href="/auth/logout">退出</a></li>
				</ul>
			</div>
		</div>
		<div class="wrap clear">
			<div class="leftMenu fl">
				<h3 class="leftTitle">功能导航</h3>
				<ul class="leftList">
					<li>
						<a href="javascript:void(0);" class="leftLink {{(Request::path() == 'admin') ? 'setOn' : ''}}">
							<em></em>
							<span>系统首页</span>
						</a>
						<ul>
							<li>
								<a href="{{ URL('admin') }}">Dashboard</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="{{ URL('users') }}">权限首页</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="leftLink {{(strstr(Request::url(), 'finances') !== false && strstr(Request::url(), 'search') === false) ? 'setOn' : ''}}">
							<em></em>
							<span>财务信息</span>
						</a>
						<ul>
							<li>
								<a href="{{ URL('admin/finances/latest/2') }}">公司流水账目</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="{{ URL('admin/finances/category/2') }}">公司分类账目</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="{{ URL('admin/finances/create/2') }}">录入公司账目</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="{{ URL('admin/finances/latest/1') }}">车队流水账目</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="{{ URL('admin/finances/category/1') }}">车队分类账目</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="{{ URL('admin/finances/create/1') }}">录入车队账目</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="leftLink {{(strstr(Request::url(), 'transaction') !== false) ? 'setOn' : ''}}">
							<em></em>
							<span>运单信息</span>
						</a>
						<ul>
							<li>
								<a href="{{ URL('admin/transactions') }}">运单列表</a>
							</li>
							<li>
								<a href="{{ URL('admin/transactions/create') }}">运单录入</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="leftLink {{((strstr(Request::url(), 'employee') !== false) || (strstr(Request::url(), 'workday') !== false)) ? 'setOn' : ''}}">
							<em></em>
							<span>员工管理</span>
						</a>
						<ul>
							<li>
								<a href="{{ URL('admin/employees') }}">员工列表</a>
							</li>
							<li>
								<a href="{{ URL('admin/employees/create') }}">员工录入</a>
							</li>
							<li>
								<a href="{{ URL('admin/workdays/create') }}">工时录入</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="leftLink {{(strstr(Request::url(), 'cars') !== false) ? 'setOn' : ''}}">
							<em></em>
							<span>车辆管理</span>
						</a>
						<ul>
							<li>
								<a href="{{ URL('admin/cars') }}">车辆列表</a>
							</li>
							<li>
								<a href="{{ URL('admin/cars/create') }}">车辆录入</a>
							</li>
							<li>
								<a href="{{ URL('admin/cars/latest') }}">待审车辆</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="leftLink {{(strstr(Request::url(), 'buyer') !== false) ? 'setOn' : ''}}">
							<em></em>
							<span>货主管理</span>
						</a>
						<ul>
							<li>
								<a href="{{ URL('admin/buyers/category') }}">分类账目</a>
							</li>
							<li>
								<a href="{{ URL('admin/buyers/exportall') }}">货主导出</a>
							</li>
							<li>
								<a href="{{ URL('admin/buyers') }}">货主列表</a>
							</li>
							<li>
								<a href="{{ URL('admin/buyers/create') }}">货主录入</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="leftLink {{(strstr(Request::url(), 'catagory') !== false) ? 'setOn' : ''}}">
							<em></em>
							<span>科目管理</span>
						</a>
						<ul>
							<li>
								<a href="{{ URL('admin/catagorys') }}">科目列表</a>
							</li>
							<li>
								<a href="{{ URL('admin/catagorys/create') }}">科目录入</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="leftLink {{(strstr(Request::url(), 'search') !== false) ? 'setOn' : ''}}">
							<em></em>
							<span>高级查询</span>
						</a>
						<ul>
							<li>
								<a href="{{ URL('admin/finances/search') }}">财务高级查询</a>
							</li>
							<li>
								<a href="{{ URL('admin/details/search') }}">运单开支查询</a>
							</li>
							<li>
								<a href="#">报表导出</a>
							</li>
							<li>
								<a href="#">工资明细</a>
							</li>
							<li>
								<a href="http://www.hcharts.cn/demo/index.php" target="_blank">图表预测</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>

	@yield('content')
    
			<!--页脚开始-->
			<div class="footer fl">
				 <p class="copyright">
				 	© <a href="http://tjjinzhengyang.com" target="_blank">金正阳物流有限公司</a> 1997 - 2015
				 </p>
				<p class="powered-by">
					Powered by: <a href="http://tjjinzhengyang.com">Studentxmu</a>
				</p>
			</div>
			<!--页脚结束-->
		</div>
	</body>
</html>
