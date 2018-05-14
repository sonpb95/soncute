
	
	@extends('layouts.master2')
	
	@section('navigation')
	
	@extends('layouts.navigation')
		
		@section('leftnav')
			<li class="nav-header">
					<div class="dropdown profile-element"> <span>
								
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">ADMIN</strong>
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth::user()->name}} </strong>
						
					</div>
					
				</li>

			<li class="active">
				<a href="#"><i class="fa fa-edit"></i> <span class="nav-label"> QUẢN LÝ </span><span class="fa arrow"></a>
				<ul class="nav nav-second-level collapse">
				<li class="active">
					<a href="{{ url('campaignmanager/') }}">1. QUẢN LÝ DỰ ÁN</a>
				</li>
				<li >
					<a href="{{ url('users/usermanager/') }}">2. QUẢN LÝ NGƯỜI DÙNG</a> 
				</li>
				<li >
					<a href="{{ url('categorymanager') }}">2. DANH MỤC</a> 
				</li>
										
				</ul>
			</li>
		@endsection
	@endsection

	@section('content')
	
		
			
				<div class="row wrapper border-bottom white-bg page-heading">
					<div class="col-lg-9">
						<h2>	Admin</h2>
						<ol class="breadcrumb">
							<li>
								<a href="{{ url('') }}">Trang chủ</a>
							</li>
							<li>
								Dự án
							</li>
							<li class="active">
								<strong>	Quản lý dự án </strong>
							</li>
						</ol>
					</div>
				</div>
			
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    
                        <div class="ibox-content">
                            <h2>
                                <span class="text-navy">Quản Lý Dự Án</span>
                            </h2>
							<div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Bị Report</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Chuẩn Bị Chạy</a></li>
							<li class=""><a data-toggle="tab" href="#tab-3">Đang Chạy</a></li>
							<li class=""><a data-toggle="tab" href="#tab-4">Đã Kết Thúc</a></li>
							<li class=""><a data-toggle="tab" href="#tab-5">Đang Bị Ngưng</a></li>
							<li class=""><a data-toggle="tab" href="#tab-6">Dự Án Bị Hủy</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
								
								<div class="ibox-content">
								
								<table class="table table-striped table-bordered table-hover dataTables-example">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên Dự Án</th>
										<th>Chủ Dự Án</th>
										<th>Thời Gian</th>
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody>
										<?php foreach($report_campaigns as $report_campaign){ ?>
									<tr>
										
										<td><?= $report_campaign->campaign_id ?></td>
										<td><?= $report_campaign->campaigns->title ?></td>
										<td><?= $report_campaign->campaigns->user->name ?></td>
										<td><?= $report_campaign->campaigns->created_at ?></td>
										<td>
											<a data-toggle="tooltip" data-placement="top" title="Xem report dự án này" href="{{ url('reportmanager/'.$report_campaign->campaign_id) }}"><i class="fa fa-eye"></i></a>
											<button onclick="stop(this.id)" style="color: #337ab7;" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Ngưng dự án này" id="{{$report_campaign->campaign_id}}" "><i class="fa fa-minus-circle"></i></button>
											<button onclick="dele(this.id)" style="color: #337ab7;" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Hủy dự án này" id="{{$report_campaign->campaign_id}}" "><i class="fa fa-trash"></i></button>
										
										</td>
									</tr>
									
										<?php } ?>
									</tbody>
								</table>

								</div>
                                    
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    
								<div class="ibox-content">

								<table class="table table-striped table-bordered table-hover dataTables-example">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên Dự Án</th>
										<th>Thể Loại</th>
										<th>Chủ Dự Án</th>
										<th>Thời Gian</th>
										
									</tr>
									</thead>
									<tbody>
									<?php foreach($prepair_campaigns as $prepair_campaign){ ?>
									<tr>
										
										<td><?= $prepair_campaign->id ?></td>
										<td><?= $prepair_campaign->title ?></td>
										<td><?php try{ ?>
										<?= $prepair_campaign->category->name ?>
											<?php }catch (\Exception $e) { ?>
											NONE
											<?php } ?></td>
										<td><?= $prepair_campaign->user->name ?></td>
										
										
										<td><?= $prepair_campaign->created_at ?></td>
										
									</tr>
									
										<?php } ?>
									</tbody>
								</table>

								</div>
									
                                </div>
                            </div>
							
							<div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    
								<div class="ibox-content">

								<table class="table table-striped table-bordered table-hover dataTables-example">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên Dự Án</th>
										<th>Thể Loại</th>
										<th>Chủ Dự Án</th>
										<th>Thời Gian</th>
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($campaigns as $campaign){ ?>
									<tr>
										
										<td><?= $campaign->id ?></td>
										<td><?= $campaign->title ?></td>
										<?php try{ ?>
										<td><?= $campaign->category->name ?>
											<?php }catch (\Exception $e) { ?>
											NONE</td>
											<?php } ?>
										<td><?= $campaign->user->name ?></td>
										
										
										<td><?= $campaign->created_at ?></td>
										<td>
											<a data-toggle="tooltip" data-placement="top" title="Xem dự án này" href="{{ url('campaigns/'.$campaign->id) }}"><i class="fa fa-eye"></i></a>
											<button onclick="stop(this.id)" style="color: #337ab7;" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Ngưng dự án này" id="{{$campaign->id}}" "><i class="fa fa-minus-circle"></i></button>
											<button onclick="dele(this.id)" style="color: #337ab7;" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Hủy dự án này" id="{{$campaign->id}}" "><i class="fa fa-trash"></i></button>
										</td>
									</tr>
									
										<?php } ?>
									</tbody>
								</table>

								</div>
									
                                </div>
                            </div>
							
							<div id="tab-4" class="tab-pane">
                                <div class="panel-body">
                                    
										<div class="ibox-content">

								<table class="table table-striped table-bordered table-hover dataTables-example">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên Dự Án</th>
										<th>Thể Loại</th>
										<th>Chủ Dự Án</th>
										<th>Thời Gian</th>
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($end_campaigns as $end_campaign){ ?>
									<tr>
										
										<td><?= $end_campaign->id ?></td>
										<td><?= $end_campaign->title ?></td>
										<?php try{ ?>
										<td><?= $end_campaign->category->name ?></td>
											<?php }catch (\Exception $e) { ?>
											<td>NONE</td>
											<?php } ?>
										<td><?= $end_campaign->user->name ?></td>
										
										
										<td><?= $end_campaign->created_at ?></td>
										<td>
											<a data-toggle="tooltip" data-placement="top" title="Xem dự án này" href="{{ url('campaigns/'.$end_campaign->id) }}"><i class="fa fa-eye"></i></a>
											<button onclick="stop(this.id)" style="color: #337ab7;" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Ngưng dự án này" id="{{$end_campaign->id}}" "><i class="fa fa-minus-circle"></i></button>
											<button onclick="dele(this.id)" style="color: #337ab7;" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Hủy dự án này" id="{{$end_campaign->id}}" "><i class="fa fa-trash"></i></button>
										
										</td>
									</tr>
									
										<?php } ?>
									</tbody>
								</table>

								</div>
									
                                </div>
                            </div>
							
							<div id="tab-5" class="tab-pane">
                                <div class="panel-body">
                                    
										<div class="ibox-content">

								<table class="table table-striped table-bordered table-hover dataTables-example">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên Dự Án</th>
										<th>Thể Loại</th>
										<th>Chủ Dự Án</th>
										<th>Thời Gian</th>
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($stopped_campaigns as $stopped_campaign){ ?>
									<tr>
										
										<td><?= $stopped_campaign->id ?></td>
										<td><?= $stopped_campaign->title ?></td>
										<?php try{ ?>
										<td><?= $stopped_campaign->category->name ?></td>
											<?php }catch (\Exception $e) { ?>
											<td>NONE</td>
											<?php } ?>
										<td><?= $stopped_campaign->user->name ?></td>
										
										
										<td><?= $stopped_campaign->created_at ?></td>
										<td>
											<a data-toggle="tooltip" data-placement="top" title="Xem dự án này" href="{{ url('campaigns/'.$stopped_campaign->id) }}"><i class="fa fa-eye"></i></a>
											<a data-toggle="tooltip" data-placement="top" title="Chạy lại dự án này" href="{{ url('runcampaign/'.$stopped_campaign->id) }}"><i class="fa fa-play"></i></a>
											<button onclick="dele(this.id)" style="color: #337ab7;" class="btn btn-link" data-toggle="tooltip" data-placement="top" title="Hủy dự án này" id="{{$stopped_campaign->id}}" "><i class="fa fa-trash"></i></button>
										</td>
									</tr>
									
										<?php } ?>
									</tbody>
								</table>

								</div>
									
                                </div>
                            </div>
							
							<div id="tab-6" class="tab-pane">
                                <div class="panel-body">
                                    
										<div class="ibox-content">

								<table class="table table-striped table-bordered table-hover dataTables-example">
									<thead>
									<tr>
										
										<th>ID</th>
										<th>Tên Dự Án</th>
										<th>Thể Loại</th>
										<th>Chủ Dự Án</th>
										<th>Thời Gian</th>
										<th>Hành Động</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($cancel_campaigns as $cancel_campaign){ ?>
									<tr>
										
										<td><?= $cancel_campaign->id ?></td>
										<td><?= $cancel_campaign->title ?></td>
											<?php try{ ?>
										<td><?= $cancel_campaign->category->name ?></td>
											<?php }catch (\Exception $e) { ?>
											<td>NONE</td>
											<?php } ?>
										<td><?= $cancel_campaign->user->name ?></td>
										
										
										<td><?= $cancel_campaign->created_at ?></td>
										<td>
											<a data-toggle="tooltip" data-placement="top" title="Xem dự án này" href="{{ url('campaigns/'.$cancel_campaign->id) }}"><i class="fa fa-eye"></i></a>
										</td>
									</tr>
									
										<?php } ?>
									</tbody>
								</table>

								</div>
									
                                </div>
                            </div>
                        </div>
                            
                        </div>
                            
                        </div>
                            
							
					
							
                            
                        </div>
						
					
                    
                
        </div>
        </div>
		<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });
			
        });
		function stop(clicked_id){
			var me = $(this);	
			swal({
				title: "Bạn có muốn hoãn dự án này không?",
				text: "!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#66ff66",
				confirmButtonText: "Vâng, Tôi muốn!",
				cancelButtonText: "không !",
				closeOnConfirm: false,
				closeOnCancel: false },
				function (isConfirm) {
					if (isConfirm) {
					   window.location = "{{ url('stopcampaign/') }}" + "/" + clicked_id;
					} else {
						swal("Cancelled", "", "error");
					}
				}
			);}
		function dele(clicked_id){
			var me = $(this);	
			swal({
				title: "Bạn có muốn hủy dự án này không?",
				text: "!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#66ff66",
				confirmButtonText: "Vâng, Tôi muốn!",
				cancelButtonText: "không !",
				closeOnConfirm: false,
				closeOnCancel: false },
				function (isConfirm) {
					if (isConfirm) {
					   window.location = "{{ url('deletecampaign/') }}" + "/" + clicked_id;
					} else {
						swal("Cancelled", "", "error");
					}
				}
			);}
		
    </script>


   
		@endsection