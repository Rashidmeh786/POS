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
        font-size: 20px;font-weight: bold;
        font-family:'Times New Roman', Times, serif
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
                      <a href="{{ route('all.purchase') }}" class="btn btn-outline-primary btn-lg "> Back  </a>  

                    </div>
                    <h2 class="page-title">Product Sale</h2>
                </div>
            </div>
        </div> 
    </div>

    <div class="container mt-3 p-5 bg-white"  style="border-radius: 10px">
        
        <form method="POST" action="{{ route('store.sale') }}">
          @csrf
          <!-- First Row -->
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="purchaseDate" class="form-label  @error('date') is-invalid @enderror">Date: <span class="text text-danger">*</span></label>
              <input type="date" class="form-control" id="purchaseDate" name="date">
              @error('date')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
         @php
        $visitor=app\Models\Customer::findorFail(1);
           
         @endphp

            <div class="col-md-4">
                <label for="customer" class="form-label">Customer:<span class="text text-danger">*</span></label>
                <select class="form-select  @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                  <option value="{{ $visitor->id }}">{{ $visitor->name }}</option>

                  @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
                </select>
                @error('customer_id')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>

            <div class="col-md-4">
              <label for="" class="form-label">Delivery Status:<span class="text text-danger">*</span></label>
              <select class="form-select @error('del_status') is-invalid @enderror" id="del_status" name="del_status">
                  <option value="pending" selected >Pending</option>
                 
              </select>
              @error('del_status')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          
          </div>
      
          <!-- Second Row -->
          <label for="searchProduct" class="form-label">Search by Product:<span class="text text-danger">*</span></label>

          <div id="searchContainer">

            <div class="row mb-1">
                <div class="col-md-12">
                    <input type="text" class="form-control  @error('qty') is-invalid @enderror " id="searchProduct" name="product" placeholder=" Enter Product name to search" style="font-family: 'Font Awesome 5 Free';">
                </div>
            </div>
            @error('qty')
<span class="text-danger">{{ $message }}</span>
@enderror
            <div id="searchResults" style=""></div>
        </div>

          <div class="row mt-2">
            <div class="col-md-12 mt-2">
            <label for="items" class="form-label">Purchase Items <span class="text text-danger">*</span></label>

                <div class="table-responsive table-sm">
                    <table class="table table-borderless table-nowrap table-centered mb-0" style="height: 150px" id="basic-table">
                      <thead class="table-light">
                        <tr>
                          <th>#</th>

                          <th>Product</th>
                          <th>Price</th>
                          <th>Stock</th>
                          <th>Quantity</th>
                          <th> Discount </th>
                          <th> Tax </th>
      
                          <th>Sub Total</th>
                          <th style="width: 50px;"></th>
                        </tr>
                      </thead>
                      <tbody>   
                        
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
                    <td id="total-amount">0.000</td> 
                    <input type="hidden" name="totalamountv" >


                  </tr>

                  <tr>
                    <td>order Tax</td> 
                    <td id="taxvalue">0.000</td> 
                  

                  </tr>
                  <tr>
                    <td>Discount</td> 
                    <td id="discountvalue">0.000</td> 
                 
                  </tr>
                  <tr>
                    <td>Shipping</td> 
                    <td id="shippingvalue">0.000</td> 
                  

                  </tr>
                  <tr>
                    <td> Grand Total </td> 
                    <td id="grandtotal">0.000</td> 
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
                  <input type="text" class="form-control" id="tax" name="text" placeholder="Enter tax amount">
                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
              </div>
              <div class="col-md-4">
                <label for="discount" class="form-label">Discount:</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="discount"  name="discount" placeholder="Enter discount">
                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                </div>
              </div>


              <div class="col-md-4">
                <label for="shipping" class="form-label">Shipping Charges:</label>
                <div class="input-group">
                  <input type="text"  class="form-control" id="shippingcharges"  name="shipping" placeholder="Enter shipping charges">
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
                      var searchResults = $('#searchResults');
                        var tableBody = $('#basic-table tbody');
                
                      $('#searchProduct').on('input', function() {
                          var searchTerm = $(this).val();
                
                          if (searchTerm !== '') {
                              $.ajax({
                                  url: "{{ url('searchSaleProduct') }}",
                                  type: "GET",
                                  data: {
                                      term: searchTerm
                                  },
                                  success: function(response) {
                                      var results = '';
                
                                      $.each(response, function(index, product) {
                                         results += '<div class="searchResult" data-product-id="' + product['id'] + '">' + product['product_name'] + '</div>';
                                          
                                      });
                
                                      // Display the search results
                                      searchResults.html(results);
                                      searchResults.show(); // Show the results container
                                      updateGrandTotal();
                                  }
                              });
                          } else {
                              // Clear the search results if search term is empty
                              searchResults.html('');
                              searchResults.hide(); // Hide the results container
                          }
                      });
                
                 // Add event listener for the dynamically generated search result items
                 searchResults.on('click', '.searchResult', function() {
                  var selectedProductId = $(this).data('product-id');
                
                  $.ajax({
                    url: '/saleproduct/details/' + selectedProductId,
                    type: 'GET',
                    success: function(productDetails) {
                      // Handle the success response and update the UI accordingly
                      console.log(productDetails); // Check the response in the console
                
               
                  // Construct the new row HTML using the product details
                  var newRow = '<tr>' +
                                                '<td>' + (tableBody.children().length + 1) + '</td>' +
                                                '<td style="font-size: 16px;">' + productDetails.name + '</td>' +
                                                '<td style="font-size: 16px;"> ' + productDetails.price + '</td>' +
                                                '<td style="font-size: 16px;">' + productDetails.stock + '</td>' +
                                                '<td>' +
                                                '<div class="d-flex align-items-center">' +
                                                '<button type="button" class="btn btn-lg btn-primary increase-quantity" id="increaseqty"><i class="fas fa-plus"></i></button>' +
                                                // '<input type="text" min="1" value="1" max="" name="qty[]" class="form-control quantity-input update-quantity" placeholder="Qty" style="width: 59px; height: 44px;">' +
                                                `<input type="text" min="1" value="1" max="`+productDetails.stock+`" name="qty[]" class="form-control update-quantity quantity-input" placeholder="Qty" style="width: 70px; height: 35px; margin-bottom: 3px">` +
                                            
                                                '<button type="button" class="btn btn-lg btn-primary decrease-quantity" id="decreaseqty"><i class="fas fa-minus"></i></button>' +
                                                '</div>' +
                                                '</td>' +
                                                '<td style="font-size: 16px;">0.00</td>' +
                                                '<td style="font-size: 16px;">0.00</td>' +
                                                '<td id="subtotal" style="font-size: 16px; font-weight:bold">0.00</td>' +
                                                '<td style="font-size: 16px;">' +
                                                '<a href="#" class="action-icon text-danger deleterow" id="deleterow">' +
                                                '<i class="mdi mdi-close-outline"></i>' +
                                                '</a>' +
                                                '</td>' +
                                              '<input type="hidden" name="product_id[]" value="' + productDetails.id + '">' +
                                              '<input type="hidden" name="name[]" value="' + productDetails.name + '">' +
                                              '<input type="hidden" name="price[]" value="' + productDetails.price + '">' +
                                              '</tr>' +
                                              '<tr class="row-separator">' +
                                              '<td colspan="6"></td>' +
                                              '</tr>';

                        
                                            // Append the new row to the table
                                            tableBody.append(newRow);
                                          
                                            // Hide the search results container
                                            searchResults.html('');
                                            searchResults.hide();
                                            updateGrandTotal();
                    },
                    error: function(xhr, status, error) {
                      // Handle the error response
                      console.log(xhr.responseText); // Check the error message in the console
                    }
                  });
                });
                


               
 

                
                tableBody.on('input', '.update-quantity', function() {
                  var row = $(this).closest('tr');
    var quantityInput = row.find('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val());
    quantityInput.val(currentQuantity + 1);
    var maxQuantity = quantityInput.attr('max');
  
if (currentQuantity >= maxQuantity) {
  
    Swal.fire(
  'Alert!',
  'The quantity exceeds the available stock.',

)
    quantityInput.val(maxQuantity); // Reset the input value to the stockValue
  }
  // Update subtotal
                  var price = parseFloat($(this).closest('tr').find('td:eq(2)').text());
                  var subtotal = quantity * price;
                  $(this).closest('tr').find('td#subtotal').text(subtotal.toFixed(2));

                  updateGrandTotal();

                  
                }); 
                tableBody.on('click', '.increase-quantity', function() {
                  var input = $(this).closest('tr').find('.quantity-input');
                  var quantity = parseInt(input.val());
                  input.val(quantity + 1);
              
                  // Update subtotal
                  var price = parseFloat($(this).closest('tr').find('td:eq(2)').text());
                  var subtotal = (quantity + 1) * price;
                  $(this).closest('tr').find('td#subtotal').text(subtotal.toFixed(2));
                  updateGrandTotal();
                  var maxQuantity = input.attr('max');

                  if (quantity >= maxQuantity) {
   // alert('The quantity exceeds the available stock.');
    Swal.fire(
  'Alert!',
  'The quantity exceeds the available stock.',
 
)
    input.val(maxQuantity); // Reset the input value to the stockValue
  }

                });
                
                // Event listener for decreasing quantity
                tableBody.on('click', '.decrease-quantity', function() {
                  var input = $(this).siblings('.quantity-input');
                  var quantity = parseInt(input.val(), 10);
                  if (quantity > 1) {
                    input.val(quantity - 1);
                
                    // Update subtotal
                    var price = parseFloat($(this).closest('tr').find('td:eq(2)').text());
                    var subtotal = (quantity - 1) * price;
                    $(this).closest('tr').find('td#subtotal').text(subtotal.toFixed(2));
                  }
                  updateGrandTotal();
                });
                
                
                tableBody.on('click', '.deleterow', function() {
                  $(this).closest('tr').next('.row-separator').remove();
                  $(this).closest('tr').remove();
                  $('#tax').val('');
  $('#discount').val('');
  $('#shippingcharges').val('');
  $('#taxvalue').text(0);
  $('#discountvalue').text(0);
  $('#shippingvalue').text(0);
                  updateGrandTotal();
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
                
                
                
                function updateGrandTotal() {
  var grandTotal = 0;
  var amountTotal = 0;

  // Iterate over each row
  $('#basic-table tbody tr').each(function() {
    var quantity = parseInt($(this).find('input[name="qty[]"]').val(), 10);
    var price = parseFloat($(this).find('td:eq(2)').text());
    var subtotal = quantity * price;
    if (isNaN(subtotal)) subtotal = 0;

    grandTotal += subtotal;
    amountTotal += subtotal;

    $(this).find('td#subtotal').text(subtotal.toFixed(2));
  });

  $('#total-amount').text(grandTotal.toFixed(3));

  var tax = parseFloat($('#taxvalue').text());
  var discount = parseFloat($('#discountvalue').text());
  var shippingCharges = parseFloat($('#shippingvalue').text());
  if (isNaN(tax)) tax = 0;
  if (isNaN(discount)) discount = 0;
  if (isNaN(shippingCharges)) shippingCharges = 0;

  grandTotal -= tax + discount + shippingCharges;

  $('#grandtotal').text(grandTotal.toFixed(3));

  var totalamount = $('#total-amount').text();
  $('input[name="totalamountv"]').val(totalamount);
}

                
                
                $('#tax, #discount, #shippingcharges').on('input', function() {
                  updateGrandTotal();
                });
      
                        // selected currentdata
              var currentDate = new Date().toISOString().split('T')[0];
              $('#purchaseDate').val(currentDate);
    
                  });


                </script>
                








@endsection