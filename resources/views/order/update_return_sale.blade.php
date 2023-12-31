@extends('admin.admin_dashboard')
@section('admin')
<style>

.maintbody
{
  font-weight: ;
  
        font-family:'Times New Roman', Times, serif;
     
        color: black;

}
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
        color: black;
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
                    <h2 class="page-title">Update Sale Return</h2>
                </div>
            </div>
        </div> 
    </div>

    <div class="container mt-3 p-5 bg-white"  style="border-radius: 10px">
        
        <form method="POST" action="{{ route('store.updatedsalereturn') }}">
          @csrf
          <!-- First Row -->
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="purchaseDate" class="form-label  @error('date') is-invalid @enderror">Ordered Date: <span class="text text-danger">*</span></label>
              <input type="date" class="form-control" id="purchaseDate" name="date" value="{{ \Carbon\Carbon::parse($OrderReturn->order_date)->format('Y-m-d') }}">
              @error('date')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
           
            <div class="col-md-4">
              <label for="customer" class="form-label">Customer:<span class="text text-danger">*</span></label>
              <select class="form-select   @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
              
               
                <option value="{{ $OrderReturn->customer->id }}" selected>{{ $OrderReturn->customer->name }}</option>
            
              </select> 
              
           
              @error('customer_id')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>

            <div class="col-md-4">
              <label for="" class="form-label">  Invoice No :<span class="text text-danger">*</span></label>
              <select class="form-select bg-light @error('invoice_id') is-invalid @enderror" id="invoice_id" name="invoice_id">
                <option value="{{ $OrderReturn->invoice_no }}" selected>{{ $OrderReturn->invoice_no }}</option>

                 
              </select>
              @error('invoice_id')
                  <span class="text-danger">{{ $message }}</span>
              @enderror

              <input type="hidden" id="order_id" name="order_id" value="{{ $order->id}}">
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
            <label for="items" class="form-label">Returned Items <span class="text text-danger">*</span></label>

                <div class="table-responsive table-sm">
                    <table class="table table-borderless table-nowrap table-centered mb-0" style="height: 150px" id="basic-table">
                      <thead class="table-light">
                        <tr>
                          <th>#</th>

                          <th>Product</th>
                          <th>Price</th>
                          <th>Sale qty</th>
                          <th> return Qty</th>
                          <th> Discount </th>
                          <th> Tax </th>
      
                          <th>Sub Total</th>
                          <th style="width: 50px;"></th>
                        </tr>
                      </thead>
                      <tbody class="maintbody">   
                     
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
                    <input type="hidden" name="gtotal" >

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

$(document).ready(function () {
    var order_id = $('#order_id').val();

    $.ajax({
        url: '/get/saleproduct/return/' + order_id,
        type: 'GET',
        success: function (productDetails) {
            console.log(productDetails);

            // Assuming the data structure is correct as mentioned before
            var tableBody = $('#basic-table tbody');
            tableBody.empty(); // Clear the existing rows

            $.each(productDetails.productDetails, function (index, product) {
                var qty = productDetails.qty[index];
                var returnedqty = productDetails.returnedqty[index];

                // Calculate subtotal
                var price = parseFloat(product.price);
                var subtotal = parseFloat(returnedqty == '' ? 0 : returnedqty) * price;

                var newRow = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td style="font-size: 16px;">' + product.name + '</td>' +
                    '<td style="font-size: 16px;">' + product.price + '</td>' +
                    '<td style="font-size: 16px;">' + qty + '</td>' +
                    '<td>' +
                    '<div class="d-flex align-items-center">' +
                    '<button type="button" class="btn btn-lg btn-primary increase-quantity" id="increaseqty"><i class="fas fa-plus"></i></button>' +
                    '<input type="text" min="1" value="' + (returnedqty == '' ? 0 : returnedqty) + '" max="' + qty + '" name="qty[]" class="form-control update-quantity quantity-input" placeholder="Qty" style="width: 70px; height: 43px; margin-bottom: 1px">' +
                    '<button type="button" class="btn btn-lg btn-primary decrease-quantity" id="decreaseqty"><i class="fas fa-minus"></i></button>' +
                    '</div>' +
                    '</td>' +
                    '<td style="font-size: 16px;">0.00</td>' +
                    '<td style="font-size: 16px;">0.00</td>' +
                    '<td id="subtotal" style="font-size: 16px; font-weight:bold">' + subtotal.toFixed(2) + '</td>' +
                    '<td style="font-size: 16px;">' +
                    '<a href="#" class="action-icon text-danger deleterow" id="deleterow">' +
                    '<i class="mdi mdi-close-outline"></i>' +
                    '</a>' +
                    '</td>' +
                    '<input type="hidden" name="product_id[]" value="' + product.id + '">' +
                    '<input type="hidden" name="name[]" value="' + product.name + '">' +
                    '<input type="hidden" name="price[]" value="' + product.price + '">' +
                    '<input type="hidden" name="totalqty[]" value="' + qty + '">' +
                    '</tr>' +
                    '<tr class="row-separator">' +
                    '<td colspan="6"></td>' +
                    '</tr>';

                tableBody.append(newRow);
                 // Manually trigger the input event for quantity input fields
        $('.quantity-input').trigger('input');
            });

            updateGrandTotal();
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });

  
});



</script>


              

                <script>
                  $(document).ready(function() {
                      var searchResults = $('#searchResults');
                        var tableBody = $('#basic-table tbody');

                        var invoice_id=$('#invoice_id').val();
                        var order_id=$('#order_id').val();
                
                      $('#searchProduct').on('input', function() {
                          var searchTerm = $(this).val();
                
                          if (searchTerm !== '') {
                              $.ajax({
                                  url: "{{ url('UpdateReturnSaleProduct') }}",
                                  type: "GET",
                                  data: {
                                      term: searchTerm,
                                      'invoice_id':invoice_id,
                                      'order_id':order_id
                                  },
                                  success: function(response) {
                                   console.log(response);
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
                //  console.log(selectedProductId);
                  // var invoice_number=$('#invoice_id').val();
                  var order_id=$('#order_id').val();
                 // var selectedProductId = $(this).data('product-id');

// Check if the product is already present in the table
var existingRow = tableBody.find('input[name="product_id[]"][value="' + selectedProductId + '"]').closest('tr');

if (existingRow.length > 0) {
    // Product already exists in the table, increase the quantity
    Swal.fire(
  'Alert!',
  'The Item is already in the List.',

      )
      searchResults.html('');
      searchResults.hide(); // Hide the results container
} else {
                
                  $.ajax({
                    url: '/update/saleproduct/return/' + selectedProductId + '/' +order_id,
                    type: 'GET',
                    
                    success: function(productDetails) {
               
                  // Construct the new row HTML using the product details
                  var newRow = '<tr>' +
                                                '<td>' + (tableBody.children().length + 1) + '</td>' +
                                                '<td style="font-size: 16px;">' + productDetails.productDetails.name + '</td>' +
                                                '<td style="font-size: 16px;"> ' + productDetails.productDetails.price + '</td>' +
                                                '<td style="font-size: 16px;">' + productDetails.qty[0] + '</td>' +
                                                '<td>' +
                                                '<div class="d-flex align-items-center">' +
                                                '<button type="button" class="btn btn-lg btn-primary increase-quantity" id="increaseqty"><i class="fas fa-plus"></i></button>' +
                                                // '<input type="text" min="1" value="1" max="" name="qty[]" class="form-control quantity-input update-quantity" placeholder="Qty" style="width: 59px; height: 44px;">' +
                                                `<input type="text" min="1" value="`+(productDetails.returnedqty == '' ? 0 :productDetails.returnedqty )+`" max="`+productDetails.qty+`" name="qty[]" class="form-control update-quantity quantity-input" placeholder="Qty" style="width: 70px; height: 43px; margin-bottom: 1px">` +
                                            
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
                                              '<input type="hidden" name="product_id[]" value="' + productDetails.productDetails.id + '">' +
                                              '<input type="hidden" name="name[]" value="' + productDetails.productDetails.name + '">' +
                                              '<input type="hidden" name="price[]" value="' + productDetails.productDetails.price + '">' +
                                              '<input type="hidden" name="totalqty[]" value="' + productDetails.qty[0] + '">' +

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
                }
                });
                


               
 

                
                tableBody.on('input', '.update-quantity', function() {
                  var row = $(this).closest('tr');
    var quantityInput = row.find('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val());
    // quantityInput.val(currentQuantity + 1);
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
                  var subtotal = currentQuantity * price;
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
 $('input[name="gtotal"]').val(grandTotal);
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