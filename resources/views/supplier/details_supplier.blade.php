@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>



     <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                            <li class="breadcrumb-item"><a class="btn btn-outline-info" href="{{ route('all.supplier') }}">Back</a></li>

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Supplier Detail</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-5">
    
                                              
    
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <ul class="nav nav-pills nav-fill navtab-bg">
                                                            {{-- <li class="nav-item">
                                                                <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                                    About Me
                                                                </a>
                                                            </li> --}}
                                                            <li class="nav-item">
                                                                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                                    Profile
                                                                </a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                                    Settings
                                                                </a>
                                                            </li> --}}
                                                        </ul>
                                                        <img  style="height: 190px; width: 190px" src="{{ (!empty($supplier->image)) ? url('upload/supplier/'.$supplier->image) : url('upload/no_image.jpg') }}" class="rounded- circle avatar-lg mt-2 img-thumbnail">
            
                
                                                       
                                                        <div class="text-start mt-3 ">
                                                            <h4 class="font-13 text-uppercase">About Me :</h4>
                                                            <p class="text-muted font-13 mb-3 text-bold">
                                                              this is supplier page here add additional info about supplier or company.
                                                              </p>
                                                            <p class="text mb-2 font-14  text-bold"><strong>Supplier Name :</strong> <span class="ms-2">{{$supplier->name}}</span></p>
                                                        
                                                            <p class="text mb-2 font-14  text-bold"><strong>Mobile :</strong><span class="ms-2">{{$supplier->phone}}</span></p>
                                                        
                                                            <p class="text mb-2 font-14  text-bold"><strong>Email :</strong> <span class="ms-2">{{$supplier->email}}</span></p>
                                                        
                                                            <p class="text mb-1 font-14  text-bold"><strong>Location :</strong> <span class="ms-2">{{$supplier->city}}</span></p>
                                                        </div>                                    
                
                                                        <ul class="social-list list-inline mt-3 mb-4">
                                                            <li class="list-inline-item">
                                                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                                            </li>
                                                        </ul>   
                                                    </div>                                 
                                                </div>
                                        
                                            </div> <!-- end col -->
                                            <div class="col-lg-7">
                                            
                                                <div class="card">
                                                    <div class="card-body">
                                                
                                                
                                                
                                                        <ul class="nav nav-pills nav-fill navtab-bg">
                                                            {{-- <li class="nav-item">
                                                                <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                                    About Me
                                                                </a>
                                                            </li> --}}
                                                            <li class="nav-item">
                                                                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                                    Additional Details
                                                                </a>
                                                            </li>
                                                            {{-- <li class="nav-item">
                                                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                                    Settings
                                                                </a>
                                                            </li> --}}
                                                        </ul>
                                                
                                                    <!-- end timeline content-->
                                                
                                                    <div class="tab-pane" id="settings">
                                                        <form method="post" action="{{ route('supplier.update') }}" enctype="multipart/form-data">
                                                            @csrf
                                                
                                                           <input type="hidden" name="id" value="{{ $supplier->id }}"> 
                                                
                                                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Details Supplier</h5>
                                                
                                                            <div class="row">
                                                
                                                
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Supplier Name</label>
                                                            <p class="text-danger">{{ $supplier->name }}</p>
                                                        </div>
                                                    </div>
                                                
                                                
                                                              <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Supplier Email</label>
                                                               <p class="text-danger">{{ $supplier->email }}</p>
                                                
                                                        </div>
                                                    </div>
                                                
                                                
                                                
                                                
                                                              <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Supplier Phone    </label>
                                                             <p class="text-danger">{{ $supplier->phone }}</p>
                                                        </div>
                                                    </div>
                                                
                                                
                                                      <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Supplier Address    </label>
                                                             <p class="text-danger">{{ $supplier->address }}</p>
                                                        </div>
                                                    </div>
                                                
                                                
                                                
                                                      <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Supplier Shop Name    </label>
                                                             <p class="text-danger">{{ $supplier->shopname }}</p>
                                                        </div>
                                                    </div>
                                                
                                                
                                                      <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Supplier Type   </label>
                                                             <p class="text-danger">{{ $supplier->type }}</p>
                                                        </div>
                                                    </div>
                                                
                                                
                                                
                                                
                                                
                                                 <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Account Holder    </label>
                                                
                                                
                                                             <p class="text-danger">{{ $supplier->account_holder }}</p>
                                                        </div>
                                                    </div>
                                                
                                                     <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Account Number    </label>
                                                
                                                              <p class="text-danger">{{ $supplier->account_number }}</p>
                                                        </div>
                                                    </div>
                                                
                                                      <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Bank Name    </label>
                                                
                                                              <p class="text-danger">{{ $supplier->bank_name }}</p>
                                                        </div>
                                                    </div>
                                                
                                                
                                                      <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Bank Branch    </label>
                                                
                                                             <p class="text-danger">{{ $supplier->bank_branch }}</p>
                                                        </div>
                                                    </div>
                                                
                                                
                                                     <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="firstname" class="form-label">Supplier City    </label>
                                                            <p class="text-danger">{{ $supplier->city }}</p>
                                                        </div>
                                                    </div>
                                                
                                                
                                                 
                                                                              
                                                            </div> <!-- end row -->
   
                                                        </form>
                                                    </div>
  
                                                                                    </div>
                                                                                </div> <!-- end card-->
                                                

                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
    
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="page-title-box">
                                                    <div class="page-title-right">
                                                        {{-- <a href="{{ route('add.supplier') }}" class="btn btn-danger waves-effect waves-lightt"> <i class="mdi mdi-plus-circle me-1"></i>Add New </a>   --}}
                                                    </div>
                                                    <h4 class="page-title">All Supplies</h4>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-12">
                                            <div class="card">
                                            <div class="card-body">
                                                {{-- <h4 class="header-title">All suppliers</h4> --}}
                                            
                                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Order Date</th>
                            
                                                            <th>Payment</th>
                                                            <th>Invoice</th>
                                                            <th>Order Status</th>
                            
                                                            <th>Total</th>
                            
                                                            <th>Pay</th>
                                                           
                                                            <th>Due</th>
                                                            <th>Payment Status</th>
                                                            {{-- <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</th> --}}
                                                            <th>Action</th>
                            
                                                        </tr>
                                                    </thead>
                            
                            
                                    <tbody>
                                        @foreach($allspurchases as $key=> $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            {{-- <td> <img src="{{ asset($item->customer->image) }}" style="width:50px; height: 40px;"> </td> --}}
                                            <td>
                                                <img style="height: 40px; width: 40px" src="{{ (!empty($item->supplier) && !empty($item->supplier->image)) ? url('upload/supplier/'.$item->supplier->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
                                            </td>
                                            
                                            <td>{{ $item['supplier']['name'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->order_date)->format('m/d/Y') }}</td>
                                            {{-- <td>{{ $item->order_date }}</td> --}}
                            
                                            <td>{{ $item->payment_status }}</td>
                                            <td>{{ $item->invoice_no }}</td>
                                            {{-- <td><span class="badge bg-info p-1 "> {{ $item->order_status }}</span></td> --}}
                                            <td>
                                                <span class="badge {{ $item->order_status === 'received' ? 'bg-primary' : 'bg-danger' }} p-1">
                                                  {{ $item->order_status }}
                                                </span>
                                              </td>
                                              
                                            <td> <span class="badge bg-info p-1"> {{  $item->total  }}</span> </td>
                                            <td> <span class="badge bg-info p-1 "> {{ round($item->pay) }}</span> </td>
                                           <td> <span class="badge bg-warning p-1"> {{ round($item->due) }}</span> </td>
                            
                                           @php
                                           $paid = "Paid";
                                           $unpaid = "fulldue";
                                           $partial = "Partial";
                                       @endphp
                                       
                                       <td>
                                           @if ($item->total == $item->pay)
                                               <span class="badge bg-primary p-1">{{ $paid }}</span>
                                           @elseif ($item->total == $item->due)
                                               <span class="badge bg-danger p-1">{{ $unpaid }}</span>
                                           @else
                                               <span class="badge bg-danger p-1">{{ $partial }}</span>
                                           @endif
                                       </td>
                                            {{-- <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paydue-modal" id="{{ $item->id }}" onclick="orderDue(this.id)" >Pay Due </button> 
                                                <a href="{{ route('order.details',$item->id) }}" class="btn btn-blue btn-sm"> Details </a> 
                                                <a href=" #" class="btn btn-info btn-sm"> Print pdf </a> 
                            
                                            </td> --}}
                                            <td>
                                                <li class="dropdown d-none d-xl-block">
                                                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v text-warning text-lg"></i>
                                                        {{-- <i class="mdi mdi-chevron-down"></i>  --}}
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <!-- item-->
                                                        <a href=""data-bs-toggle="modal" data-bs-target="#paydue-modal" id="{{ $item->id }}" onclick="orderDue(this.id)" class="dropdown-item">
                                                            <i class="fas fa-dollar-sign text-warning me-1"></i>
                                                            <span> Pay Due </span>
                                                        </a>
                                    
                                                        <!-- item-->
                                                        <a href="{{ route('purchaseorder.details',$item->id) }}" class="dropdown-item">
                                                            <i class="fe-eye text-warning me-1"></i>
                                                            <span> Order Details</span>
                                                        </a>
                                    
                                                        <!-- item-->
                                                        <a href="{{ route('purchase.invoicePrint',$item->id) }}" class="dropdown-item">
                                                            <i class="fe-bar-chart-line- me-1 text-warning"></i>
                                                            <span>Print invoice</span>
                                                        </a>
                                    
                                                        <!-- item-->
                                                       
                                    
                                                        <div class="dropdown-divider"></div>
                                    
                                                        <!-- item-->
                                                        <a href="{{ route('return.purchaseorder',$item->id) }}" class="dropdown-item">
                                                            <i class="fe-headphones me-1 text-warning"></i>
                                                            <span>Return</span>
                                                        </a>
                                    
                                                    </div>
                                                </li>
                                    
                                            </td>
                            
                                           
                                        </tr>
                                        @endforeach
                                    </tbody>
                                                </table>
                            
                                            
                                            </div> <!-- end card body-->
                                            </div> <!-- end card -->
                                            </div><!-- end col-->
                                            </div>
                                      
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                        
                    </div> <!-- container -->

                </div>




                <div id="paydue-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                       <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pay Due</h5>
                    
                        <button type="button" class="close" data-dismiss="#paydue-modal" id="cancel-btn-paydue" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                           <div class="modal-body"> 
                               <div class="text-center mt-2 mb-4 ">
                                       <div class="auth-logo">
                    
                                           <h3> Pay Due Amount </h3>
                                       </div>
                               </div>
                    
                               <form class="px-3" method="post" action="{{ route('updatePurchase.due') }}">
                                   @csrf
                                   <input type="hidden" name="id" id="order_id">
                                   <input type="hidden" name="pay" id="pay">
                      <div class="mb-3">
                            <label for="username" class="form-label">Pay Now</label>
                    <input class="form-control" type="text" name="due" id="due"  >
                         </div>
                    
                    
                                   <div class="mb-3 text-center">
                    <button class="btn btn-primary" type="submit">Update Due  </button>
                                   </div>
                    
                               </form>
                    
                           </div>
                       </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    
                    
                    <script type="text/javascript">
                       
                       function orderDue(id) {
                           $.ajax({
                               type: 'GET',
                               url: '/purchase/due/'+id,
                               dataType: 'json',
                               success:function(data){
                                   // console.log(data)
                                   $('#due').val(data.due);
                                   $('#pay').val(data.pay);
                                   $('#order_id').val(data.id);
                               }
                           })
                       }
                    
                    
                       $('#cancel-btn-paydue').click(function(e) {
                            e.preventDefault(); // Prevent the form from submitting
                            $('#paydue-modal').modal('hide');
                            // $("#paydue-form")[0].reset();
                        });
                    </script> 
                    
                    
                    <script>
                        $(document).ready(function() {
                            var dataTable = $('#basic-datatable1').DataTable();
                    
                            $('#statusFilter').change(function() {
                              
                                var selectedStatus = $('#statusFilter').val();
                    
                                dataTable.column(6).search(selectedStatus).draw();
                            });
                        });
                    </script>
                    
                    <script>
                        $(document).ready(function() {
                            var dataTable = $('#basic-datatable1').DataTable();
                    
                            $('#paymentFilter').change(function() {
                              
                                var selectedStatus = $('#paymentFilter').val();
                    
                                dataTable.column(10).search(selectedStatus).draw();
                            });
                        });
                    </script>
                     


@endsection
  