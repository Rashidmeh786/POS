@extends('admin.admin_dashboard')
@section('admin')
<div class="content">
    @php
    $date = date('d-F-Y');
    $today_paid = App\Models\Order::where('order_date',$date)->sum('pay');
    $total_paid = App\Models\Order::sum('pay');
    $total_due = App\Models\Order::sum('due'); 
    $completeorder = App\Models\Order::where('order_status','complete')->get(); 
     $pendingorder = App\Models\Order::where('order_status','pending')->get(); 
   @endphp
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form class="d-flex align-items-center mb-3">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control border-0" id="dash-daterange">
                                <span class="input-group-text bg-blue border-blue text-white">
                                    <i class="mdi mdi-calendar-range"></i>
                                </span>
                            </div>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                <i class="mdi mdi-autorenew"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                <i class="mdi mdi-filter-variant"></i>
                            </a>
                        </form>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                                        <i class="fe-heart font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $total_paid }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Paid </p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->


            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                                    <i class="fe-shopping-cart font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                  <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $total_due  }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Due </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                    <i class="fe-bar-chart-line- font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                               <div class="text-end">
                                    <h3 class="text-dark mt-1"> <span data-plugin="counterup">{{ count($completeorder)  }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Complete Order </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                                    <i class="fe-eye font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                               <div class="text-end">
                                    <h3 class="text-dark mt-1"> <span data-plugin="counterup">{{ count($pendingorder)  }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Pending Order </p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
            </div>
        </div>
        <!-- end row-->

        <div class="row">
           

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body pb-2">
                        <div class="float-end d-none d-md-inline-block">
                            <div class="btn-group mb-2">
                                <button type="button" class="btn btn-xs btn-light">Today</button>
                                <button type="button" class="btn btn-xs btn-light">Weekly</button>
                                <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                            </div>
                        </div>

                        <h4 class="header-title mb-3">Sales Analytics</h4>

                        <div dir="ltr">
                            <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                        </div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col-->
        </div>
        <!-- end row -->

        <div class="row">

            @php
             $orders=App\models\Order::latest()->take(10)->get();
            @endphp


            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h4 class="header-title mb-3">Recent Sales</h4>

                        <div class="table-responsive">
                            <table class="table table-borderless table-nowrap table-hover table-centered m-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Invoice</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <h5 class="m-0 fw-normal">{{ $order->customer->name }}</h5>
                                            </td>
                                            
                                            <td>
                                                {{ $order->order_date }}
                                            </td>
                                            <td>
                                                <h5 class="m-0 fw-normal">{{$order->invoice_no }}</h5>
                                            </td>
                                            <td>
                                                ${{ $order->total }}
                                            </td>
                                            @php
                                            $paid = "Paid";
                                            $unpaid = "fulldue";
                                            $partial = "Partial";
                                        @endphp
                                        
                                        <td>
                                            @if ($order->total == $order->pay)
                                                <span class="badge bg-primary p-1">{{ $paid }}</span>
                                            @elseif ($order->total == $order->due)
                                                <span class="badge bg-danger p-1">{{ $unpaid }}</span>
                                            @else
                                                <span class="badge bg-danger p-1">{{ $partial }}</span>
                                            @endif
                                        </td>
                                            <td>
                                                <a href="{{ route('order.details',$order->id) }}" class="btn btn-xs btn-light"><i class="mdi mdi-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                         </div> <!-- end .table-responsive-->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->

</div> <!-- content -->

@endsection