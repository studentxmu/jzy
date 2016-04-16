@extends('app')

@section('content')

			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/employees') }}">员工列表</a><b>/</b></li>
						<li><a href="#">查看员工</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">查看员工</span>
					</div>
                    姓名：{{ $employee->name}}
                    <br/>
                    部门：
                    <?php if (!($employee->depart_id === NULL))  echo $departs[$employee->depart_id]; ?>
                    <br/>
                    身份证号：{{ $employee->idcode}}
                    <br/>
                    驾驶证号：{{ $employee->drivecode}}
                    <br/>
                    @if (!empty($employee->imageurl))
                    头像：
                    <img src="{{'/images/'.$employee->imageurl}}" width="180" height="180"/>
                    @endif
                    <br/>
				</div>
			</div>
    @endsection
