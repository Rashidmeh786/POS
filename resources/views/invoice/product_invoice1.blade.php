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
            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #123-123</strong></p>
          </div>
    <div class="col-xl-3 float-end">
            <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                class="fas fa-print text-primary"></i> Print</a> 
           
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


          <div class="row">
            <div class="col-xl-8">
              <ul class="list-unstyled">
                <li class="text-bold">To: <span style="color:#041824 ; font-weight: bold">{{ $customer->name ?? 'WalkIn
                    Customer' }}</span></li>
                <li class="text-muted "> <i class="fas fa-address-book"></i> {{ $customer->address ?? 'NA'}} , {{
                  $customer->city ?? ''}},</li>
                <li class="text-muted "> &nbsp; &nbsp; &nbsp;Pakistan .</li>
                <li class="text-muted "><i class="fas fa-envelope"></i> {{ $customer->email ?? 'NA' }}</li>

                <li class="text-muted "><i class="fas fa-phone"></i> {{ $customer->phone ?? 'NA'}}</li>
              </ul>
            </div>
            <div class="col-xl-4">
              <p class="text-muted">Customer Invoice</p>
              <ul class="list-unstyled">
                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                    class="fw-bold">ID:</span>#123-456</li>
                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                    class="fw-bold">Creation Date: </span>{{ \Carbon\Carbon::now() }}</li>


                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
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
                  <th scope="col">Dsicount</th>

                  <th scope="col">Amount</th>
                </tr>
              </thead>
              <tbody>
                @php
                $sl = 1;
                @endphp

                @foreach($contents as $key=> $item)
                <tr>
                  <td>{{ $sl++ }}</td>
                  <td>
                    <b>{{ $item->name }}</b> <br />

                  </td>
                  <td>{{ $item->qty }}</td>
                  <td>{{ $item->price }}</td>
                  <td>{{ $item->options->discount ?? '0'}}</td>
                  <td class="">${{ $item->price*$item->qty }}</td>
                </tr>
                @endforeach
              </tbody>

            </table>
          </div>
          <div class="row">
            <div class="col-xl-8">
              <p class="ms-3">Add additional notes and payment information</p>

            </div>
            <div class="col-xl-3">
              <ul class="list-unstyled">
                {{-- <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>Rs. {{ $item->price*$item->qty
                  }}</li> --}}
                   {{-- pos_page1 code --}}
                  <li class="text-muted ms-3 mt-2"><span class="text-black me-4">SubTotal</span>Rs.{{Cart::priceTotal()}}</li>
                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(%)</span>&nbsp;&nbsp; &nbsp;0.00</li>
                <li class="text-muted ms-3 mt-1"><span class="text-black me-4">Discount</span>Rs. {{ $totaldiscountv ??
                  0}}</li>

              </ul>
              {{-- <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span>
                <span
                  style="font-size: 20px; font-weight: bold">RS. {{ Cart::total() }}
                </span>
              </p> --}}
                                      {{-- pos_page1 code--}}
              <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span>
                <span
                  style="font-size: 20px; font-weight: bold">RS. {{ Cart::total() - $totaldiscountv}}
                </span>
              </p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xl-10">
              <p>Thank you for your purchase</p>
            </div>
            <div class="col-xl-6 text-end offset-6">
              <button type="button" class="btn btn-primary text-capitalize " data-bs-toggle="modal"
                data-bs-target="#signup-modal" style="background-color:#60bdf3 ; ">Pay Now</button>
              <button type="button" class="btn btn-primary text-capitalize " data-bs-toggle="modal"
                data-bs-target="#installment-modal" style="background-color:#60bdf3 ; ">Pay On Installments</button>

              <a href="{{ url('pos') }}" class="btn btn-primary text-capitalize bg-warning">Cancel</a>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>






</div> <!-- content -->


<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Invoice</h5>
        <button type="button" class="close" data-dismiss="#signup-modal" id="cancel-btn" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{-- <button class="btn btn-secondary" id="cancel-btn">Cancel</button> --}}

      </div>
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <div class="auth-logo">
            <h3>Invoice Of {{ $customer->name ?? 'WalkIn Customer'}}</h3>
            <h3 id="total">Amount RS :{{ Cart::total()- $totaldiscountv }}</h3>
          </div>
        </div>
        <form class="px-3" method="post" action="{{ url('/final-invoice') }}">
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

            <input type="hidden" name="customer_id" value="{{ $customer->id}}">
            <input type="hidden" name="order_date" value="{{ date('d-F-Y') }}">
            <input type="hidden" name="order_status" value="pending">
            <input type="hidden" name="total_products" value="{{ Cart::count() }}">
            <input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
            <input type="hidden" name="totaldiscountv" value="{{ $totaldiscountv }}">

            <input type="hidden" name="vat" value="{{ Cart::tax() }}">
            <input type="hidden" name="total" value="{{ Cart::total()-$totaldiscountv }}">

            <div class="col-md-4">
              <div class="mb-3">
                <label for="username" class="form-label">Due All</label>
                <button id="dueall" class="form-control btn btn-info" type="button" name="payall">Full Due</button>
              </div>
            </div>
          </div>

          <div class="mb-3 text-center">
            <button class="btn btn-primary form-control" type="submit" onclick="printInvoice()">Complete Order</button>
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
  function printInvoice() {
      var invoiceWindow = window.open('{{ route('printInvoice') }}', '_blank');
     
  }
</script>





{{-- installment modal --}}

<div id="installment-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Installment</h5>
        <button type="button" class="close" data-dismiss="#installment-modal" id="cancel-btn-installment"
          aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <div class="auth-logo">
            <h3>Installment for {{ $product->name ?? 'Product Name'}}</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8  p-2">
            <form class="px-3" method="post" action="#" id="installment-form">
              @csrf
              <div class="mb-3">
                <label for="advance-amount" class="form-label">Advance Amount</label>
                <input id="advance-amount" class="form-control" type="number" name="advance_amount"
                  placeholder="Enter the Advance amount">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="markup" class="form-label"> Installment Markup % </label>
                    <input id="markup-amount" class="form-control" type="number" name="markup-amount">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="months" class="form-label">Duration in Months</label>
                    <input id="month-duration" class="form-control" type="number" name="month-duration">


                  </div>


                </div>
              </div>

              <div class="mb-3 text-center">
                <button class="btn btn-primary form-control" type="submit">Create Installment</button>
              </div>
            </form>
          </div>

          <div class="col-md-4 p-2 d-flex flex-column">
            <div class="mt-3 line-below d-flex justify-content-between align-items-end">
              <label for="orignal-amount" class="form-label">Original Amount</label>
              <span id="orignal-amount-label">1000</span>
            </div>
            <div class="mt-2 line-below d-flex justify-content-between align-items-end">
              <label for="Markup-amount" class="form-label">Markup </label>
              <span id="markup-amount-label">0</span>
            </div>
            <div class="mt-2 line-below d-flex justify-content-between align-items-end">
              <label for="installment-amount" class="form-label">Installment Amount</label>
              <span id="installment-amount-label">0</span>
            </div>
            <div class="mt-2 line-below d-flex justify-content-between align-items-end">
              <label for="advance-amount" class="form-label">Advance Amount</label>
              <span id="advance-amount-label">0</span>
            </div>
            <div class="mt-2 line-below d-flex justify-content-between align-items-end">
              <label for="due-amount" class="form-label">Due Installment Amount</label>
              <span id="due-amount-label">0</span>
            </div>
            <div class="mt-2 line-below d-flex justify-content-between align-items-end">
              <label for="installment-amount-per-month" class="form-label">Per Month Installment</label>
              <span id="installment-amount-per-month">0</span>
            </div>
          </div>
        </div>




      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
  $(document).ready(function() {


  $('#cancel-btn').click(function(e) {
        e.preventDefault(); // Prevent the form from submitting
        $('#signup-modal').modal('hide');
        $("#payment-form")[0].reset();
    });

    $('#cancel-btn-installment').click(function(e) {
        e.preventDefault(); // Prevent the form from submitting
        $('#installment-modal').modal('hide');
        $("#installment-form")[0].reset();
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





<script>
  $(document).ready(function() {
  $('#markup-amount').on('input', function() {
    var markupAmount = parseFloat($(this).val());
    var originalAmount = parseFloat($('#orignal-amount-label').text());
   
    var markupPercentage = (markupAmount / 100) * originalAmount;
    var installmentAmount = markupPercentage + originalAmount;
    
    $('#markup-amount-label').text(markupPercentage.toFixed(2));
    $('#installment-amount-label').text(installmentAmount.toFixed(2));
    
    updateDueAmount();
  });
  
  $('#advance-amount').on('input', function() {
    var advanceAmount = parseFloat($(this).val());
    $('#advance-amount-label').text(advanceAmount.toFixed(2));
    
    updateDueAmount();
  });
  
  $('#month-duration').on('input', function() {
    var installmentAmount = parseFloat($('#due-amount-label').text());
    var monthDuration = parseFloat($(this).val());
    var perMonth = installmentAmount / monthDuration;
    $('#installment-amount-per-month').text(perMonth.toFixed(2));
    
    //updateDueAmount();
  });
 
  function updateDueAmount() {
    var installmentAmount = parseFloat($('#installment-amount-label').text());
    var advanceAmount = parseFloat($('#advance-amount').val());
    var dueAmount = installmentAmount - advanceAmount;
    
    $('#due-amount-label').text(dueAmount.toFixed(2));
   // var installmentPerMonth=parseFloat($('#installment-amount-per-month').text());
  }
});

</script>


@endsection