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
                      <a href="{{ route('all.purchase') }}" class="btn btn-outline-primary btn-lg "> Back  </a>  

                    </div>
                    <h2 class="page-title">Create Adjustment</h2>
                </div>
            </div>
        </div> 
    </div>

    <div class="container mt-3 p-5 bg-white"  style="border-radius: 10px">
        
        <form method="POST" action="{{ route('store.adjustment') }}">
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
           
          

          
          
          </div>
      
          <!-- Second Row -->
          <div id="searchContainer">

            <div class="row mb-1">
                <div class="col-md-12">
                    <label for="searchProduct" class="form-label">Search by Product:<span class="text text-danger">*</span></label>
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
            <label for="items" class="form-label"> Items List <span class="text text-danger">*</span></label>

                <div class="table-responsive table-sm">
                    <table class="table table-borderless table-nowrap table-centered mb-0" style="height: 150px" id="basic-table">
                      <thead class="table-light">
                        <tr>
                          <th>#</th>

                          <th>Product</th>
                          <th>Product Code</th>
                          <th>Stock</th>
                          <th>Quantity</th>
                          <th> Adjustment Type </th>
                          
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
                 
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
      
       
          <div class="row mb-3">
            <div class="col-md-12 mt-2">
                <label for="product-description" class="form-label"> Reason  <span class="text-danger">*</span></label>
                <textarea class="ckeditor form-control @error('reason') is-invalid @enderror"  cols="2"  name="reason" style="width: 1175px">{{ old('reason') }}</textarea>
                @error('reason')
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
                                  url: "{{ route('product.search') }}",
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
                                      // updateGrandTotal();
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
                  var existingRow = tableBody.find('input[name="product_id[]"][value="' + selectedProductId + '"]').closest('tr');

                  if (existingRow.length > 0) {
   
    Swal.fire(
   'Alert!',
   'The item is already present in the list.',
       )
       searchResults.html('');
 
} else{
                
                  $.ajax({
                    url: '/product/details/' + selectedProductId,
                    type: 'GET',
                    success: function(productDetails) {
                      // Handle the success response and update the UI accordingly
                      console.log(productDetails); // Check the response in the console
                
               
                  // Construct the new row HTML using the product details
                  var stockBadge = '<span class="badge bg-info">' + productDetails.stock + '</span>';

                  var newRow = '<tr>' +
                                                '<td>' + (tableBody.children().length + 1) + '</td>' +
                                                '<td>' + productDetails.name + '</td>' +
                                                '<td>' + productDetails.product_code + '</td>' +
                                                '<td>' + stockBadge+ '</td>' +
                                                '<td>' +
                                                '<div class="d-flex align-items-center">' +
                                                '<button type="button" class="btn  btn-primary increase-quantity" id="increaseqty"><i class="fas fa-plus"></i></button>' +
                                                '<input type="text" min="1" value="1" name="qty[]" class="form-control quantity-input update-quantity" placeholder="Qty" style="width: 55px; height: 40px;">' +
                                                '<button type="button" class="btn  btn-primary decrease-quantity" id="decreaseqty"><i class="fas fa-minus"></i></button>' +
                                                '</div>' +
                                                '</td>' +
                                                '<td>' +
                                                '<select name="adjustment_type[]" class="form-select target-dropdown @error("adjustment_type") is-invalid @enderror " style="width: 180px;">' +
                                                '<option value="positive">Addition</option>' +
                                                '<option value="negative">Subtraction</option>' +
                                                '</select>' +
                                                '</td>' +
                                                '<td>' +
                                                '<a href="#" class="action-icon text-danger deleterow" id="deleterow">' +
                                                '<i class="mdi mdi-delete" style="font-size: 27px;"></i>' +
                                                '</a>' +
                                                '</td>' +
                                                                                          '<input type="hidden" name="product_id[]" value="' + productDetails.id + '">' +
                                              '<input type="hidden" name="name[]" value="' + productDetails.name + '">' +
                                              '<input type="hidden" name="price[]" value="' + productDetails.price + '">' +
                                              '</tr>' +
                                              '<tr class="row-separator">' +
                                              '<td colspan="6"></td>' +
                                              '</tr>';
                                             
                                            //   var stockValue = productDetails.stock; // Replace with your actual stock value
                                            //  $('.update-quantity').val(stockValue);
                                              
                                            //       console.log(stockValue);
                                            // Append the new row to the table
                                            tableBody.append(newRow);
                                            // var stockValue = productDetails.stock; // Replace with your actual stock value
                                            //  $('.update-quantity').val(stockValue);
                                            //       console.log(stockValue);
                                              
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
                
                
                  tableBody.on('click', '.increase-quantity', function() {
                  var input = $(this).siblings('.quantity-input');
                  var quantity = parseInt(input.val(), 10);
                  input.val(quantity + 1);
                
                });
                
                // Event listener for decreasing quantity
                tableBody.on('click', '.decrease-quantity', function() {
                  var input = $(this).siblings('.quantity-input');
                  var quantity = parseInt(input.val(), 10);
                  if (quantity > 1) {
                    input.val(quantity - 1);
                
                    
                  }
             
                });
                
                
                tableBody.on('click', '.deleterow', function() {
                  $(this).closest('tr').next('.row-separator').remove();
                  $(this).closest('tr').remove();
                  $('#tax').val('');
  
                });
                
                
                        // selected currentdata
              var currentDate = new Date().toISOString().split('T')[0];
              $('#purchaseDate').val(currentDate);
    
                  });


                </script>
                








@endsection