@extends('app')

@section('content')
 <link href="{{ asset('/css/show.css') }}" rel="stylesheet">
 <link href="{{ asset('/css/table.css') }}" rel="stylesheet">
 <script src="{{ asset('/js/jquery.zclip.min.js') }}" type="text/javascript" charset="utf-8"></script>
 <script src="{{ asset('/js/copy.js') }}" type="text/javascript" charset="utf-8"></script>

			<div class="content fl">
				<div>
					<ul class="breadcrumb">
						<li><a href="{{ URL('admin') }}">主页</a><b>/</b></li>
						<li><a href="{{ URL('admin/cars') }}">车辆列表</a><b>/</b></li>
						<li><a href="#">查看车辆</a></li>
					</ul>
				</div>
				<div class="inputCon">
					<div class="wh-bg">
						<span class="wh-fontBox">查看车辆</span>
					</div>
                    <div class="user-info-wrap">
                        <h3 class="user-info-tit clear">
                            <span class="user-name fl">{{$car->code}}</span>
										<a class="tableCreat btn-edit" href="{{ URL('admin/cars/'.$car->id.'/edit') }}">
                                            <i class="fa fa-edit" ></i>
											编辑
										</a>
                            <span class="user-id fr">挂车牌号：<span>{{$car->vicecode}}</span></span>
                        </h3>
                        <div class="user-info">
                            <img class="user-info-pic" src="{{ URL('images/'.$car->imageurl) }}">
                            <ul class="user-info-list">
                                <li><span>所属公司：</span><p>{{$companys[$car->company_id]}}</p></li>
                                <li><span>车辆类型：</span><p>{{$types[$car->type_id]}}</p></li>
                                <li><span>车辆品牌：</span><p>{{$brands[$car->brand_id]}}</p></li>
                                <li><span>保险公司：</span><p>{{$assurances[$car->assurance_id]}}</p></li>
                                <li><span>加油卡号：</span><p>{{$car->oilcard}}</p></li>
                                <li><span>购买日期：</span><p>{{$car->buytime}}</p></li>
                                <?php
                                    $timestamp = strtotime($car->buytime); 
                                    $nextyear = mktime(0, 0, 0, date("m", $timestamp), date("d", $timestamp)-1, date("Y", $timestamp)+1);
                                    $nexttime = date('Y-m-d', $nextyear);
                                ?>
                                <li><span>下次审核日期：</span><p>{{$nexttime}}</p></li>
                                <li>
                                    <span>证件下载：</span>
                                    <div class="down-id">
                                        @if (!empty($car->imageurl))
										<a target="_blank" href="{{ URL('images/'.$car->imageurl) }}">
										    车辆照片
										</a>
                                        @endif
                                        @if (!empty($car->driveurl))
										<a href="{{ URL('admin/cars/download/'.$car->id.'/2') }}">
										    行驶证
										</a>
                                        @endif
                                        @if (!empty($car->normalurl))
										<a href="{{ URL('admin/cars/download/'.$car->id.'/3') }}">
											营运证
										</a>
                                        @endif
                                        @if (!empty($car->assuranceurl))
										<a href="{{ URL('admin/cars/download/'.$car->id.'/4') }}">
											交强保险
										</a>
                                        @endif
                                        @if (!empty($car->comassuranceurl))
										<a href="{{ URL('admin/cars/download/'.$car->id.'/5') }}">
											商业保险
										</a>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
			</div>
    @endsection
