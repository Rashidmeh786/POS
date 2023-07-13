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

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pending Due</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Order Date</th>
                                <th>Payment</th>
                                <th>Invoice</th>
                                <th>Total</th>

                                <th>Pay</th>
                                <th>Due</th>
                                {{-- <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</th> --}}
                                <th>Action</th>

                            </tr>
                        </thead>


        <tbody>
        	@foreach($alldue as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                {{-- <td> <img src="{{ asset($item->customer->image) }}" style="width:50px; height: 40px;"> </td> --}}
                <td>   <img style="height: 40px; width: 40px" src="{{ (!empty($item->customer->image)) ? url('upload/customer/'.$item->customer->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
                </td>
                <td>{{ $item['customer']['name'] }}</td>
                <td>{{ $item->order_date }}</td>
                <td>{{ $item->payment_status }}</td>
                <td>{{ $item->invoice_no }}</td>
                <td> <span class="badge bg-info p-1"> {{  $item->total  }}</span> </td>
                <td> <span class="badge bg-info p-1 "> {{ round($item->pay) }}</span> </td>
               <td> <span class="badge bg-warning p-1"> {{ round($item->due) }}</span> </td>
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
                            <a href="{{ route('order.details',$item->id) }}" class="dropdown-item">
                                <i class="fe-eye text-warning me-1"></i>
                                <span> Order Details</span>
                            </a>
        
                            <!-- item-->
                            <a href="{{ route('order.invoiceprint',$item->id)}}" class="dropdown-item">
                                <i class="fe-bar-chart-line- me-1 text-warning"></i>
                                <span>Print invoice</span>
                            </a>
        
                            <!-- item-->
                           
        
                            <div class="dropdown-divider"></div>
        
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
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
    <!-- end row-->




                    </div> <!-- container -->

                </div> <!-- content -->





            </div> <!-- content -->



            <!-- Signup modal content -->
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

           <form class="px-3" method="post" action="{{ route('update.due') }}">
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
           url: '/order/due/'+id,
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






@endsection 
