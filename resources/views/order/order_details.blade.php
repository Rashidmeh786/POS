@extends('admin.admin_dashboard')
@section('admin')
<style>
  /* Add border-bottom to each tr element */
  table.table-borderless tr {
    border-bottom: 1px solid #dee2e6;
  }
 
</style>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<div class="content">
  <!-- Start Content -->
  <div class="container-fluid">
    <!-- Start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <a href="{{ route('all.sales') }}" class="btn btn-outline-primary btn-lg "> Back  </a>  

            </ol>
          </div>
          <h4 class="page-title">Order Details</h4>
        </div>
      </div>
    </div>
    <!-- End page title -->

    <div class="row">
      <div class="col-lg-8 col-xl-12">
        <div class="card">
          <div class="card-body">

            <!-- Start timeline content -->

            <div class="tab-pane" id="settings">
                <form method="post" action="{{ route('order.status.update') }}" enctype="multipart/form-data">
                    @csrf
        
                    <input type="hidden" name="id" value="{{ $order->id }}">

                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Order Details</h5>
              
                 <div class="card">
                  <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td><strong>Customer Image</strong></td>
                        <td>
                          <img style="height: 40px; width: 40px" src="{{ (!empty($order->customer->image)) ? url('upload/customer/'.$order->customer->image) : url('upload/no_image.jpg') }}" class=" avatar-lg img-thumbnail">
                        </td>
                        <td><strong>Customer Name</strong></td>
                        <td><p class="text-danger">{{ $order->customer->name }}</p></td>
                      </tr>
                      <tr>
                        <td><strong>Customer Email</strong></td>
                        <td><p class="text-danger">{{ $order->customer->email }}</p></td>
                        <td><strong>Customer Phone</strong></td>
                        <td><p class="text-danger">{{ $order->customer->phone }}</p></td>
                      </tr>
                      <tr>
                        <td><strong>Order Date</strong></td>
                        <td><p class="text-danger">{{ $order->order_date }}</p></td>
                        <td><strong>Order Invoice</strong></td>
                        <td><p class="text-danger">{{ $order->invoice_no }}</p></td>
                      </tr>
                      <tr>
                        <td><strong>Order Status</strong></td>
                        <td><p id="order_status" class="text-danger">{{ $order->order_status }}</p></td>
                        <td><strong>Payment Status</strong></td>
                        <td><p class="text-danger">{{ $order->payment_status }}</p></td>
                      </tr>
                      <tr>
                        <td><strong>Paid Amount</strong></td>
                        <td><p class="text-danger">{{ $order->pay }}</p></td>
                        <td><strong>Due Amount</strong></td>
                        <td><p class="text-danger">{{ $order->due }}</p></td>
                      </tr>
                    </tbody>
                  </table>
                </div> <!-- end table-responsive -->
                  </div>
                 </div>        
                <div class="text-end">
                  <button type="submit" class="btn btn-success waves-effect waves-light mt-2"

                  @if ($order->order_status === 'complete')
                  disabled
              @endif
                  ><i class="mdi mdi-content-save"></i> Complete Order</button>
                </div>
              </form>
            </div>
            <!-- End settings content -->

          </div>
        </div> <!-- end card -->
      </div> <!-- end col -->
    </div>
    <!-- End row -->

  </div> <!-- container -->
</div> <!-- content -->



<div class="col-12">
    <div class="card">
        <div class="card-body">


            <table class="table dt-responsive nowrap w-100">
                <thead>
                    <tr> 
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th> 
                    </tr>
                </thead>


<tbody>
    @foreach($orderItem as $item)
    <tr>
<td>
        <img style="height: 40px; width: 40px" src="{{ (!empty($item->product->product_image)) ? url('upload/product/'.$item->product->product_image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
    </td>
        <td>{{ $item->product->product_name }}</td>
        <td>{{ $item->product->product_code }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->product->selling_price }}</td>
        <td>{{ $item->total }}</td> 
    </tr>
    @endforeach
</tbody>
            </table>

        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->






@endsection
