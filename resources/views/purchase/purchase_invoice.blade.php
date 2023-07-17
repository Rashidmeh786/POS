@extends('admin.pos_layout')
@section('admin')
<style>
  .line-below {
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 10px;
  }
</style>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

 <div class="content">




    <div class="card">
        <div class="card-body">
          <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
              <div class="col-xl-9">
                <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>{{ $invoice_no }}</strong></p>
              </div>
              <div class="col-xl-3 float-end">
                {{-- <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                    class="fas fa-print text-primary"></i> Print</a> --}}
                    <a href="javascript:window.print()" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i  class="fas fa-print text-primary"></i> Print</a>

                <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                    class="far fa-file-pdf text-danger"></i> Export</a>
              </div>
              <hr>
            </div>
      
            <div class="container">
              <div class="col-md-12">
                <div class="text-center">
                  <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                  <p class="pt-0">Company.com</p>
                </div>
      
              </div>
      @php
            $supplier = App\Models\Supplier::find($supplier_id);
      @endphp
      
              <div class="row">
                <div class="col-xl-8">
                  <ul class="list-unstyled">
                    <li class="text-bold">To: <span style="color:#041824 ; font-weight: bold">{{ $supplier->name  ?? 'Opening balance' }}</span></li>
                    <li class="text-muted "> <i class="fas fa-address-book"></i>  {{ $supplier->address  ?? 'NA'}} , {{ $supplier->city }},</li>
                    <li class="text-muted ">   &nbsp;  &nbsp;  &nbsp;Pakistan .</li>
                    <li class="text-muted "><i class="fas fa-envelope"></i> {{ $supplier->email  ?? 'NA' }}</li>

                    <li class="text-muted "><i class="fas fa-phone"></i> {{ $supplier->phone   ?? 'NA'}}</li>
                  </ul>
                </div>
                <div class="col-xl-4">
                  <p class="text-muted">Purchase Invoice</p>
                  <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Invoice No:</span>{{ $invoice_no }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Creation Date: </span>{{ \Carbon\Carbon::now() }}</li>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                          class="me-1 fw-bold">Delivery Status:</span><span class="badge bg-warning text-black fw-bold">
                       {{ $del_status }}   </span></li>
                        
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Pay Status:</span><span class="badge bg-warning text-black fw-bold">
                        Unpaid</span></li>
                  </ul>
                </div>
              </div>
      
              <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                  <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Description</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Unit Price</th>
                      <th scope="col">total price</th>

                      {{-- <th scope="col">Amount</th> --}}
                    </tr>
                  </thead>
              <form class="px-3" method="post" id="payment-form" action="{{ url('/final-invoice/purchase') }}">

                  <tbody>
                    @foreach ($itemDetails['id'] as $index => $productId)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $itemDetails['name'][$index] }}</td>
                        <td>{{ $itemDetails['qty'][$index]}}</td>
                        <td>{{ $itemDetails['price'][$index] }}</td>
                        <td>{{ $itemDetails['qty'][$index] * $itemDetails['price'][$index] }}</td>
                    </tr>
                    <input type="hidden" name="itemDetails.id[]" value="{{ $productId }}">
    <input type="hidden" name="itemDetails.name[]" value="{{ $itemDetails['name'][$index] }}">
    <input type="hidden" name="itemDetails.qty[]" value="{{ $itemDetails['qty'][$index] }}">
    <input type="hidden" name="itemDetails.price[]" value="{{ $itemDetails['price'][$index] }}">
                @endforeach
                  </tbody>
      
                </table>
              </div>
              <div class="row">
                <div class="col-xl-8">
                  <p class="ms-3">{{ $note }}</p>
      
                </div>
                <div class="col-xl-3">
                  <ul class="list-unstyled">
                    <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>Rs.  {{ $totalamountv }}</li>
                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(%)</span>&nbsp;&nbsp; &nbsp;{{ $taxv ?? 0 }}'</li>
                    <li class="text-muted ms-3 mt-1"><span class="text-black me-4">Discount</span>Rs. {{ $discountv ?? 0}}</li>
                    <li class="text-muted ms-3 mt-1"><span class="text-black me-4">Shipping</span>Rs. {{ $shhippingv ?? 0}}</li>

                  </ul>
                  <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                      style="font-size: 20px; font-weight: bold">RS. {{$totalamountv-($taxv+$discountv+$shhippingv) }}</span></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-xl-10">
                  <p>Thank you for your purchase</p>
                </div>
                <div class="col-xl-6 text-end offset-6">
                  <button type="button" class="btn btn-primary text-capitalize " data-bs-toggle="modal" data-bs-target="#purchase-modal"
                    style="background-color:#60bdf3 ; ">Pay Now</button>
                    
                    <a  href="{{ route('add.purchase') }}" class="btn btn-primary text-capitalize bg-warning" >Cancel</a>
                    
                </div>
              </div>
      
            </div>
          </div>
        </div>
      </div>
    



    @php
      $amounTtoPay = $totalamountv - ($taxv + $discountv + $shhippingv);
//       $noofproducts = $itemDetails['qty'][$index];
// $noofproductsCount = count($noofproducts);
$qtyCount = count($itemDetails['qty']);
@endphp
      <div id="purchase-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Invoice</h5>
              <button type="button" class="close" data-dismiss="#purchase-modal" id="cancel-btn" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              {{-- <button class="btn btn-secondary" id="cancel-btn">Cancel</button> --}}
      
            </div>
            <div class="modal-body"> 
              <div class="text-center mt-2 mb-4">
                <div class="auth-logo">
                  <h3>Invoice Of {{ $Supplier->name  ?? 'WalkIn Customer'}}</h3>
                  <h3 id="total">Amount RS :{{ $amounTtoPay }}</h3>
                </div>
              </div>
                @csrf
                <div class="mb-3">
                  <label for="payment" class="form-label">Payment</label>
                  <select name="payment_status" class="form-select" id="example-select">
                    {{-- <option selected disabled>Select Payment</option> --}}
                    <option selected value="HandCash">Cash</option>
                    <option value="Cheque">Cheque</option>
                    <option value="Due">Due</option>
                  </select>
                </div>
      
                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label for="username" class="form-label">Pay Now</label>
                      <input id="payamount" class="form-control" type="text" name="pay" placeholder="Enter Amount to Pay..">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="username" class="form-label">Pay All</label>
                      <button id="payall" class="form-control btn btn-info" type="button" name="payall">Full Payment</button>
                    </div>
                  </div>
                </div>
      
                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label for="username" class="form-label">Due</label>
                      <input id="due" class="form-control" disabled type="text" name="due" placeholder="Due amount..">
                    </div>
                  </div>
                 
         <input type="hidden" name="supplier_id" value="{{ $supplier->id}}">
         <input type="hidden" name="delivery_date" value="{{ date('d-F-Y') }}">
         <input type="hidden" name="del_status" value="{{ $del_status }}">
         <input type="hidden" name="total_products" value="{{ $qtyCount }}">
         <input type="hidden" name="sub_total" value="{{$totalamountv }}"> 
         <input type="hidden" name="note" value="{{$note}}">
         <input type="hidden" name="tax" value="{{$taxv}}">
         <input type="hidden" name="discount" value="{{$discountv}}">
         <input type="hidden" name="invoice_no" value="{{$invoice_no}}">

         <input type="hidden" name="shipping" value="{{$shhippingv}}">
         <input type="hidden" name="payment_type" value="{{ $amounTtoPay }}"> 

         <input type="hidden" name="total" value="{{ $amounTtoPay }}"> 
      
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="username" class="form-label">Due All</label>
                      <button id="dueall" class="form-control btn btn-info" type="button" name="payall">Full Due</button>
                    </div>
                  </div>
                </div>
      
                <div class="mb-3 text-center">
                  <button class="btn btn-primary form-control" type="submit">Complete Order</button>
                </div>
                
                <!-- Cancel button -->
                <div class="text-center">
                </div>
                {{-- <button class="btn btn-secondary" id="cancel-btn">Cancel</button> --}}
      
              </form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      


      <script>
        $(document).ready(function() {
        
        
          $('#cancel-btn').click(function(e) {
                e.preventDefault(); // Prevent the form from submitting
                $('#purchase-modal').modal('hide');
                $("#payment-form")[0].reset();
            });
        
          
        
          // Copy total amount to pay amount
          $("#payall").click(function() {
            var totalAmount = $("#total").text().split(":")[1].trim();
            $("#payamount").val(totalAmount);
            $("#due").val(0);
          });
        
          // Copy total amount to due amount
          $("#dueall").click(function() {
            var totalAmount = $("#total").text().split(":")[1].trim();
            $("#due").val(totalAmount);
            $("#payamount").val(0);
          });
          // Update due amount based on pay amount
          $("#payamount").on("input", function() {
            var totalAmount = parseInt($("#total").text().split(":")[1].trim());
            var payAmount = parseInt($(this).val());
            var dueAmount = totalAmount - payAmount;
            if (!isNaN(dueAmount)) {
              $("#due").val(dueAmount);
            }
          });
        });
        </script>



@endsection
