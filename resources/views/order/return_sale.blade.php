@extends('admin.admin_dashboard')
@section('admin')
<style>


    input,select
    {
        height: 45px;
        border-radius: 20px;
    }


  
    #searchContainer {
        position: relative;
        margin-bottom: 20px;
    }

    #searchResults {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        padding: 20px;
        
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        display: none;
    }

    .searchResult {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #fff;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .searchResult:hover {
        background-color: blue;
        color: #fff;
        cursor: pointer;
    }




</style>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                      <a href="{{ route('all.sales') }}" class="btn btn-outline-primary btn-lg "> Back  </a>  

                    </div>
                    <h2 class="page-title">Sale  Return</h2>
                </div>
            </div>
        </div> 
    </div>

    <div class="container mt-3 p-5 bg-white"  style="border-radius: 10px">
        
        <form method="POST" action="">
          @csrf
          <!-- First Row -->
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="purchaseDate" class="form-label  @error('date') is-invalid @enderror">Ordered Date: <span class="text text-danger">*</span></label>
              <input type="date" class="form-control" id="purchaseDate" name="date" value="{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}">
              @error('date')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
           
            <div class="col-md-4">
              <label for="customer" class="form-label">Customer:<span class="text text-danger">*</span></label>
              <select class="form-select   @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
              
               
                <option value="{{ $order->customer->id }}" selected>{{ $order->customer->name }}</option>
            
              </select> 
              
           
              @error('customer_id')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>

            <div class="col-md-4">
              <label for="" class="form-label">  Invoice No :<span class="text text-danger">*</span></label>
              <select class="form-select bg-light @error('del_status') is-invalid @enderror" id="del_status" name="del_status">
                <option value="{{ $order->invoice_no }}" selected>{{ $order->invoice_no }}</option>

                 
              </select>
              @error('del_status')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          
          </div>
      
          <!-- Second Row -->
       
          <div class="row mt-2">
            <div class="col-md-12 mt-2">
            <label for="items" class="form-label">Sale Items <span class="text text-danger">*</span></label>

                <div class="table-responsive table-sm">
                    <table class="table table-borderless table-nowrap table-centered mb-0" style="height: 150px" id="basic-table">
                        <thead class="table-light">
                          <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Sale qty</th>
                            <th>Return Qty</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Sub Total</th>
                            <th style="width: 50px;"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItem as $item)
                          <tr>

                            <td>1</td>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->product->selling_price }}</td>
                            <td> <span class="badge bg-pink p-2 text-lg text-bold">{{ $item->quantity }}</span></td>
                            <td>
                              <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-lg btn-primary increase-quantity"><i class="fas fa-plus"></i></button>
                                <input type="text" min="0" value="0" max="{{ $item->quantity }}" name="quantity" class="form-control update-qty quantity-input" placeholder="Qty" style="width: 59px; height: 44px; "> {{--   style="width: 59px; height: 44px; "--}}
                                <button type="button" class="btn btn-lg btn-primary decrease-quantity"><i class="fas fa-minus"></i></button>
                              </div>
                            </td>                                                                                                          
                            <td>0.00</td>
                            <td>0.00</td>
                            <td>{{ $item->product->selling_price *  $item->quantity }}  </td>
                            <td>
                              <a href="#" class="action-icon text-danger"><i class="mdi mdi-close-outline"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      
                  </div>
            </div>
          </div>

          



          <!-- Third Row -->
          <div class="row mb-3">
            <div class="offset-md-8 col-md-4">
              <!-- Table with 3 columns -->
              <table class="table table-striped mt-2">
                <thead>
                  {{-- <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                  </tr> --}}
                </thead>
                <tbody>
              
                  <tr>
                    <td>Total Amount</td> 
                    <td id="total-amount">{{ $order->sub_total }}</td> 
                    <input type="hidden" name="totalamountv" >


                  </tr>

                  <tr>
                    <td>order Tax</td> 
                    <td id="taxvalue">{{ $order->vat }}</td> 
                  

                  </tr>
                  <tr>
                    <td>Discount</td> 
                    <td id="discountvalue">{{ $order->discount}}</td> 
                 
                  </tr>
                  <tr>
                    <td>Shipping</td> 
                    <td id="shippingvalue">{{ $order->shipping }}</td> 
                  

                  </tr>
                  <tr>
                    <td> Grand Total </td> 
                    <td id="grandtotal">{{ $order->total }}</td> 
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      
          <!-- Fourth Row -->
          <div class="row mb-3">
            
            <div class="col-md-4">
                <label for="tax" class="form-label">Tax:</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="tax" name="text"  value="{{ $order->vat }}" placeholder="Enter tax amount">
                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
              </div>
              <div class="col-md-4">
                <label for="discount" class="form-label">Discount:</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="discount" value="{{ $order->discount }}" name="discount" placeholder="Enter discount">
                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
              </div>


              <div class="col-md-4">
                <label for="shipping" class="form-label">Shipping Charges:</label>
                <div class="input-group">
                  <input type="text"  class="form-control" id="shippingcharges"  value="{{ $order->shipping }}"  name="shipping" placeholder="Enter shipping charges">
                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
              </div>


          
              
              
               
          </div>
      
          <!-- Fifth Row -->
          <div class="row mb-3">
            <div class="col-md-12 mt-2">
                <label for="product-description" class="form-label"> Note <span class="text-danger"></span></label>
                <textarea class="ckeditor form-control @error('note') is-invalid @enderror"  cols="2"  name="note" style="width: 1175px">{{ old('note') }}</textarea>
                @error('note')
                <span class="text-danger"> {{ $message }} </span>
                    
                @enderror
            </div>
          </div>
      
          <!-- Sixth Row -->
          <div class="row">
            <div class="col-md-12 text-end mt-2">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="button" class="btn btn-secondary">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    
                </div> <!-- content -->
             


                <script>
                    $(document).ready(function() {
                      // Increase quantity
                      $(document).on('click', '.increase-quantity', function() {
                        var input = $(this).closest('tr').find('.quantity-input');
                        var quantity = parseInt(input.val());
                        input.val(quantity + 1);

                        var maxQuantity = input.attr('max');

                        if (quantity >= maxQuantity) {
                        // alert('The quantity exceeds the available stock.');
                        Swal.fire(
                        'Alert!',
                        'The quantity exceeds the sale Qty.',
                       
                        )
                       input.val(maxQuantity); // Reset the input value to the stockValue
                        }

                      

                      });

                      $(document).on('input', '.update-qty', function() {
                        var input = $(this).closest('tr').find('.quantity-input');
                        var quantity = parseInt(input.val());
                        // input.val(quantity + 1);

                        var maxQuantity = input.attr('max');

                        if (quantity >= maxQuantity) {
                        // alert('The quantity exceeds the available stock.');
                        Swal.fire(
                        'Alert!',
                        'The quantity exceeds the sale Qty.',
                       
                        )
                       input.val(maxQuantity); // Reset the input value to the stockValue
                        }

                      

                      });
                  
                      // Decrease quantity
                      $(document).on('click', '.decrease-quantity', function() {
                        var input = $(this).siblings('.quantity-input');
                        var quantity = parseInt(input.val(), 10);
                        if (quantity > 0) {
                          input.val(quantity - 1);
                        }
                      });
                    });


     
                    $('#tax').on('input', function() {
                  var taxAmount = $(this).val();
                  $('#taxvalue').text(taxAmount);
               
                });
                
                $('#discount').on('input', function() {
                  var discountAmount = $(this).val();
                  $('#discountvalue').text(discountAmount);
                });

                $('#shippingcharges').on('input', function() {
                  var shippingcharges = $(this).val();
                  $('#shippingvalue').text(shippingcharges);
                });










                
                  </script>
                  



                  


@endsection