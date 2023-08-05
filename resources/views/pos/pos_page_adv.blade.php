@extends('admin.pos_layout')
@section('admin')

<style>
  .table-responsive {
    height: 460px;
    overflow-y: scroll;
  }
#search,#categoryFilter,#brandFilter{
  font-size: 20px;font-weight: bold;
        font-family:'Times New Roman', Times, serif
}

tbody{
  font-size: 19px;font-weight: bold;
        font-family:'Times New Roman', Times, serif
}
  .table {
    margin-bottom: 0;
  }

  .row-separator td {
    border-top: 1px solid #dee2e6;
  }

  .row-separator td[colspan="6"] {
    padding: 0;
  }
  .product-image img:hover {
    transform: scale(1.2);
}
.line-below {
    border-bottom: 1px solid #ccc;
    padding-bottom: 5px;
    margin-bottom: 5px;}

                .pcard {
                  transition: transform 0.2s, box-shadow 0.2s;
                  background-color: #faf6f6;
                  border: 1px solid #eff0f1;
                  border-radius: 8px;
                }
              
                .pcard:hover {
                  transform: scale(1.05);
                  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
              
                .plabel-bg {
                  /* background-color: rgba(0, 0, 0, 0.7); */
                  /* padding: 8px; */
                  padding: 3px 8px 3px 8px;
                  border-radius: 8px;
                }
              
                .plabel-bg p {
                  margin: 0;
                  font-size: 12px;
                  color: #ffffff;
                }
              
                .product-title {
                /* background-color: rgba(255, 255, 255, 0.7); */
                  padding: 5px;
                  border-bottom-left-radius: 8px;
                  border-bottom-right-radius: 8px;
                  text-align: center;
                 
                }
              
                .product-title h6 {
                  margin: 0;
                   font-size: 16px;font-weight: bold;
                   font-family:'Times New Roman', Times, serif;
                  color: #ffffff;
                  text-align: center;
                }
              

                /* modal design */

                /* Add this custom CSS to your existing styles */

/* Center the modal vertically and horizontally */
.modal-dialog.modal-dialog-centered {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Add some padding and border-radius to the modal content */
.modal-content {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

/* Style the modal header */
.modal-header {
    background-color: #f1f1f1;
    border-bottom: 1px solid #ccc;
}

/* Style the modal title */
.modal-title {
    color: #333;
}

/* Style the modal body */
.modal-body {
    color: #555;
}

/* Style the buttons */
.btn {
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

/* Add a hover effect on buttons */
.btn:hover {
    background-color: #007bff;
    color: #fff;
}

/* Style the primary button */
.btn-primary {
    background-color: #007bff;
    color: #fff;
}

/* Style the info button */
.btn-info {
    background-color: #17a2b8;
    color: #fff;
}

/* Style the close button */
.btn-close {
    color: #888;
    font-size: 20px;
}


</style>

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

 <div class="content">
  
  <!-- Start Content-->
  <div class="container-fluid " style="margin-top: 80px;">
   
    <div class="row ">
      <div class="col-lg-6 col-xl-6">
        <div class="card text-center">
          <div class="card-body">
         
          
          
             @error('cart')
            <span class="alert alert-danger">{{ $message }}</span>
        @enderror 
        
        <form id="myForm" method="post" action="{{ url('/final-invoice-new') }}">
          @csrf
            <div class="table-responsive table-sm">
              @if ($errors->has('product_id'))
    <p class="text text-danger">
        {{ $errors->first('product_id') }}
    </p>
@endif

              <table class="table table-borderless table-hover table-nowrap table-centered mb-0" id="basic2-table">
                <thead class="table-dark">
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th> Discount </th>

                    <th>Total</th>
                    <th style="width: 50px;"></th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div> <!-- end table-responsive -->
          </div>
        </div> <!-- end card -->
        
           <div class=" " style="margin-top: 40px position: fixed;">


              <div class="" >
                <p class="" style="margin-bottom: -1px;">Customer <span class="text text-danger"> *</span></p>

                <div class="d-flex ">
                 
                    <select name="customerid" class="form-select  @error('customerid') is-invalid @enderror " id="example-select">
                        <option value="{{ $visitor->id }}">{{ $visitor->name }}</option>
                        @foreach ($customers as $item)
                      
                            <option id="customer" value="{{ $item->id }}">{{ $item->name }}</option>
                            <input type="hidden" value="{{ $item->id }}" id="customerid">

                        @endforeach
                    </select>
    
                    
                    <button class="btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#customer-modal">
                        <span class="fas fa-plus-square p-1"></span>
                    </button>
                   
                </div>
                
                @error('customerid')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <input type="hidden" name="totalqty">
            <input type="hidden" name="totalamountv" >
            <input type="hidden" name="grandtotalamountv" >
            <input type="hidden" name="totaldiscountv" >
            <input type="hidden" name="payamountv" >
            <input type="hidden" name="dueamountv" >
             

            
            
       
          
              <table class="table table-light" id="basic1-table">
                <thead class="thead text-bold text-dark">
                  <tr>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Discount </th>
                    <th>Grand Total</th>
                  </tr>
                </thead>
                <tbody class="text-bold text-dark">
                  <tr>
                    <td id="lqty">0</td>
                    <td id="ltotal">0</td>

                    <td id="ldiscount">0</td>
                    <td id="lgrandtotal">0</td>
                  </tr>
                   
                  
                </tbody>
              </table>
                 <div class="row">
   
    <div class="col">
      <button type="button" class="btn btn-primary form-control"><span class="fas fa-dollar-sign fa-lg p-1">&nbsp;Pay Multiple </span></button>
    </div>
  </form>
    <div class="col">
     
      <button type="button" class="btn btn-info form-control" name="hold" id="HoldOrder"> <span class="fas fa-hand-holding-usd fa-lg p-1">&nbsp;&nbsp;HOLD</span></button>
      
    </div>
    <div class="col">
   
      <button type="button" class="btn btn-secondary text-capitalize form-control" data-bs-toggle="modal"
      data-bs-target="#pay-modal" style="background-color:#60bdf3 ; "><span class="fas fa-dollar-sign fa-lg p-1">&nbsp;Pay All </span></button>
    </div>
  </div>
            </div>
          {{-- </div>
        </div> --}}
     
      </div> <!-- end col-->
  





      
  






      <div class="col-lg-6 col-xl-6 " >
        <div class="card">
          <div class="card-body">
            <div class="tab-pane" id="settings">
              <div class="row">
   
                <div class="col-md-6 mt-2">
                  <div class="mb-3">
                    <div class="d-flex">
                     
                    
                      <select name="category_id" class="form-select " id="categoryFilter"  style="height: 47px; font-size: 15px; border-radius: 8px; border: 1px solid #ced4da; padding: 5px;">
                        <option value="" id="">  &nbsp; &nbsp;All Categories</option>
                        @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                      </select>
                      
                      @error('category_select')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

              
                <div class="col-md-6  mt-2">
                  <div class="mb-3">
                    <div class="d-flex">
                      <select name="brand_id" class="form-select" id="brandFilter"  style="height: 47px; font-size: 15px; border-radius: 8px; border: 1px solid #ced4da; padding: 5px;">

                      <option value=""> &nbsp; &nbsp;All Brands</option>
                      @foreach($brand as $br)
                      <option value="{{ $br->id }}">{{ $br->name ?? '' }}</option>
                      @endforeach
                    </select>
                      {{-- <button class="btn btn-secondary me-2" type="button">
                        <span class="mdi mdi-refresh"></span>
                      </button> --}}
                      @error('brand_select')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

              </div>
             
              <div class="Search" style="margin-bottom: 10px;">
                <input type="text" style="height: 47px; font-size: 18px; border-radius: 8px; border: 1px solid #ced4da; padding: 5px;" class="form-control mb-2" name="search" id="search" placeholder="  Search Product here ..." autocomplete="off">
              </div>
              
              
              <div class="datatable-container" style="padding: 20px; background- color: #f8f9fa; overflow-y: auto; max-height: 530px; min-height: 550px;">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="productContainer">
                  <!-- Product Cards will be rendered here -->
                </div>
              </div>
              
              
        
            
            </div>
          </div> <!-- end card-body -->
        </div> <!-- end card -->
      </div> <!-- end col -->
    </div> <!-- end row-->
 


    <script>
      $(document).ready(function() {
        // Function to display the products based on the search query
        function displayProducts(data) {
          var productContainer = $("#productContainer");
          productContainer.empty();
    
          $.each(data, function(index, item) {
            // Construct the full image URL using the base URL of your application
            var imageUrl = "{{ url('upload/product') }}/" + item.product_image;
    
            var card = $('<div class="col mb-4">' +
              '<div class="pcard h-100 position-relative border-0" id="product-image-btn" data-product-id="' + item.id + '">' +
              '<img src="' + imageUrl + '" alt="' + item.product_name + '" class="card-img-top" style="object-fit: cover; height: 150px; border-radius: 10px; padding:25px 20px 25px 20px;">' +
              '<div class="position-absolute top-0 start-0 plabel-bg" style="border-top-left-radius: 8px;">' +
              '<p class="m-0 badge bg-primary">' + item.stock + '</p>' +
              '</div>' +
              '<div class="position-absolute top-0 end-0 plabel-bg" style="border-top-right-radius: 8px;">' +
              '<p class="m-0 badge bg-pink"> RS ' + item.selling_price + '</p>' +
              '</div>' +
              '<div class="card-img-overlay d-flex flex-column justify-content-end product-title">' +
              '<h6 class="card-title mb-0 badge bg-info ">' + item.product_name + '</h6>' +
              '</div>' +
              '</div>' +
              '</div>');
    
            productContainer.append(card);
          });
        }
    
        // Function to fetch products based on the search query
        function fetchProducts(searchQuery, categoryFilter, brandFilter) {
      $.ajax({
        url: '/get/products', // Update this with your API endpoint for fetching products
        method: 'GET',
        data: { 
          search: searchQuery,
          category_id: categoryFilter,
          brand_id: brandFilter
        },
        success: function(data) {
          displayProducts(data);
        },
        error: function(xhr, textStatus, errorThrown) {
          console.error(errorThrown);
        }
      });
    }
    
        // Event listener for the input field keyup event
        $("#search").on('keyup', function() {
      var searchQuery = $(this).val();
      var categoryFilter = $("#categoryFilter").val();
      var brandFilter = $("#brandFilter").val();

      fetchProducts(searchQuery, categoryFilter, brandFilter);
    });
    
    $("#categoryFilter, #brandFilter").on('change', function() {
      var searchQuery = $("#search").val();
      var categoryFilter = $("#categoryFilter").val();
      var brandFilter = $("#brandFilter").val();

      fetchProducts(searchQuery, categoryFilter, brandFilter);
    });

    // Initially fetch all products on page load with no filters applied
    fetchProducts('', '', '');
      });
    </script>
    






  
    <script>
      $(document).ready(function() {
  // Update values on page load
  updateValues();
      // Handle click event on the product image button
      $(document).on('click', '#product-image-btn', function() {
          var productId = $(this).data('product-id');
          
          // Make an AJAX request to fetch the data for the clicked product
          $.ajax({
              url: '/product-details/' + productId, // Replace with the actual URL for fetching product details
              type: 'GET',
              dataType: 'json',
              success: function(response) {
                console.log(response);
                  // Update the second table with the fetched data
                  updateProductTable(response);
                  updateValues();

              },
              error: function(xhr, status, error) {
                  console.log(error);
              }
          });
      });
  


function updateProductTable(productData) {
  var tableBody = $('#basic2-table tbody');
  
  // Check if the table body already contains a row for the product
  var existingRow = tableBody.find('tr[data-row-id="' + productData.rowId + '"]');
  
  if (existingRow.length > 0) {
    // If an existing row exists, increment the quantity
    // var quantityInput = existingRow.find('.quantity-input');
    // var currentQuantity = parseInt(quantityInput.val());
    // quantityInput.val(currentQuantity + 1);
    // updateSubtotal(existingRow);
    Swal.fire(
   'Alert!',
   'The item is already present in the Cart list.',
       )
  } else {
    // If no existing row exists, append a new row with the fetched product data
    var newRow = '<tr data-row-id="' + productData.rowId + '">' +
      '<td>' + productData.name + '</td>' +
      '<td>' + productData.price + '</td>' +
      '<td>' +
      '<div class="d-flex align-items-center">' +
      '<button type="button" class="btn btn-sm btn-primary p-1 increase-quantity" style="margin-top: -2px; height:40px; width:32px;"><i class="fas fa-plus"></i></button>' +
      `<input type="text" min="1" value="1" max="`+productData.stock+`" name="qty[]" class="form-control quantity-input" placeholder="Qty" style="width: 70px; height: 40px; margin-bottom: 3px">` +
      '<button type="button" class="btn btn-sm btn-primary p-1 decrease-quantity" style="margin-top: -2px;height:40px; width:32px;"><i class="fas fa-minus"></i></button>' +
      '</div>' +
      '</td>' +
      '<td>' +
      '<div class="d-flex align-items-center">' +
        '<input type="text" value="" name="discount[]" class="form-control discount-input" toolti placeholder=" 0 " style="width: 80px; height: 34px;" data-row-id="' + productData.rowId + '">' +

       '</div>' +
      '</td>' +
      '<td class="subtotal">0.00</td>' +
      '<td>' +
      '<a href="#" class="action-icon text-danger delete-row">' +
      '<i class="mdi mdi-delete"></i>' +
      '</a>' +
      '</td>' +
      '<input type="hidden" name="product_id[]" value="' + productData.rowId + '">' +
                                              '<input type="hidden" name="name[]" value="' + productData.name + '">' +
                                              '<input type="hidden" name="price[]" value="' + productData.price + '">' +
      '</tr>' +
      '<tr class="row-separator">' +
      '<td colspan="6"></td>' +
      '</tr>';
  
// var stockValue = productData.stock; 
//   var quantityInput = $('.quantity-input');
//   quantityInput.attr('max', stockValue);


    tableBody.append(newRow);
    
  }
  



 // Bind the increase and decrease button click events to update quantity and subtotal
 tableBody.find('.increase-quantity').off('click').on('click', function() {
    var row = $(this).closest('tr');
  //  console.log(row);
    var quantityInput = row.find('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val());
    quantityInput.val(currentQuantity + 1);
    var maxQuantity = quantityInput.attr('max');
    // var maxQuantity = parseInt($('.quantity-input').attr('max'));
//console.log(maxQuantity); // Output the value of the max attribute
if (currentQuantity >= maxQuantity) {
   // alert('The quantity exceeds the available stock.');
    Swal.fire(
  'Alert!',
  'The quantity exceeds the available stock.',

)
    quantityInput.val(maxQuantity); // Reset the input value to the stockValue
  }
    updateSubtotal(row);
    updateValues();
  });
  
  tableBody.find('tr').each(function() {
  var row = $(this);
  var quantityInput = row.find('.quantity-input');
  var price = parseFloat(row.find('td:nth-child(2)').text());
  var subtotalElement = row.find('.subtotal');
  var discountInput = row.find('.discount-input');

//   quantityInput.off('input').on('input', function() {
//     var row = $(this).closest('tr');
//     var quantityInput = row.find('.quantity-input');
//     var currentQuantity = parseInt(quantityInput.val());
//     quantityInput.val(currentQuantity + 1);
//     var maxQuantity = quantityInput.attr('max');
  
// if (currentQuantity >= maxQuantity) {
  
//     Swal.fire(
//   'Alert!',
//   'The quantity exceeds the available stock.',

// )
//     quantityInput.val(maxQuantity); // Reset the input value to the stockValue
//   }
//     updateSubtotal(row);
//     updateValues();
//   });


tableBody.find('.quantity-input').off('input').on('input', function() {
  var row = $(this).closest('tr');
  var quantityInput = row.find('.quantity-input');
  var currentQuantity = parseInt(quantityInput.val());

  var maxQuantity = quantityInput.attr('max');
//console.log(maxQuantity); // Output the value of the max attribute
if (currentQuantity >= maxQuantity) {
   // alert('The quantity exceeds the available stock.');
    Swal.fire(
  'Warning!',
  'The quantity exceeds the available stock.',
  'Warning'
)
quantityInput.val(maxQuantity); // Reset the input value to the stockValue
  }
  updateSubtotal(row);
  updateValues();
});



  discountInput.on('input', function() {
    var quantity = parseInt(quantityInput.val());
    var discount = parseFloat(discountInput.val() || 0);
    var subtotal = quantity * price;
    var discountedSubtotal = subtotal - discount;

    subtotalElement.text(discountedSubtotal.toFixed(2));
    updateValues();
  });
});


  tableBody.find('tr').each(function() {
  var row = $(this);
  var quantity = parseInt(row.find('.quantity-input').val());
  var price = parseFloat(row.find('td:nth-child(2)').text());
  var discount = parseFloat(row.find('.discount-input').val() || 0); // Retrieve the discount value for the row
  var subtotal = quantity * price;
  var discountedSubtotal = subtotal - discount; // Subtract the discount from the subtotal
  row.find('.subtotal').text(discountedSubtotal.toFixed(2));
});

 
  tableBody.find('.decrease-quantity').off('click').on('click', function() {
    var row = $(this).closest('tr');
    var quantityInput = row.find('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val());
  
    if (currentQuantity > 1) {
      quantityInput.val(currentQuantity - 1);
      updateSubtotal(row);
      updateValues();
    }
  });
  
  // Bind the delete button click event to remove the row
  tableBody.find('.delete-row').off('click').on('click', function(e) {
    e.preventDefault();
    $(this).closest('tr').remove();
    updateValues();
  });
}

function updateSubtotal(row) {
  var quantityInput = row.find('.quantity-input');
  var quantity = parseInt(quantityInput.val());
  var price = parseFloat(row.find('td:eq(1)').text());
  var subtotal = (quantity * price).toFixed(2);
  row.find('.subtotal').text(subtotal);
  updateValues();
}

function updateValues() {
  var totalQuantity = 0;
  var totalAmount = 0;
  var totalDiscount = 0;
  var grandTotal = 0;

  $('.quantity-input').each(function() {
    var quantity = parseInt($(this).val());
    totalQuantity += quantity;
  });
// new commint cdsdsd  dfdfd
  $('.subtotal').each(function() {
    var subtotal = parseFloat($(this).text());
    totalAmount += subtotal;
  });
// this is change
  $('.discount-input').each(function() {
    var discount = parseFloat($(this).val() || 0);
    totalDiscount += discount;
  });

  // grandTotal = totalAmount - totalDiscount;

  grandTotal =(totalAmount + totalDiscount)-totalDiscount;

  $('#lqty').text(totalQuantity);
  $('#ltotal').text((totalAmount + totalDiscount));
  $('#ldiscount').text(totalDiscount);
  $('#lgrandtotal').text(grandTotal);
  $('input[name="totalamountv"]').val((totalAmount + totalDiscount));
  $('input[name="grandtotalamountv"]').val((totalAmount));
  $('input[name="totalqty"]').val(totalQuantity);
  $('input[name="totaldiscountv"]').val(totalDiscount);
  
  $('#subtotal-label').text((totalAmount + totalDiscount));
  $('#discount-label').text(totalDiscount);
  $('#total-label').text(grandTotal);
  $('#paid-label').text(grandTotal);
  $('#payamount').val(grandTotal);

  $('input[name="payamountv"]').val($('#payamount').val());
  $('input[name="dueamountv"]').val($('#due').val());
}

})
</script>
  




    
  </div> <!-- container -->
</div> <!-- content -->


<div id="customer-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <form class="px-3" method="post" id="form2" action="" >
          @csrf
          <div class="mb-3">
            <ul class="nav nav-pills nav-fill navtab-bg">
              <li class="nav-item">
                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link bg-info active">
                  Add New Customer
                </a>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="username" class="form-label mt-2">Customer Name <span class="text text-danger">*</span></label>
                <input id="name" value="" class="form-control @error('name') is-invalid @enderror " type="text" name="name" placeholder="Add New Customer Name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email">
                @error('email')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input id="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" placeholder="Phone">
                @error('phone')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="account_holder" class="form-label">Account Holder</label>
                <input id="account_holder" value="{{ old('account_holder') }}" class="form-control @error('account_holder') is-invalid @enderror" type="text" name="account_holder" placeholder="Account Holder">
                @error('account_holder')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
              
            </div>
            <div class="col-md-6 mt-2">
              <div class="mb-3">
                <label for="shopname" class="form-label">Shop Name</label>
                <input id="shopname" value="{{ old('shopname') }}" class="form-control @error('shopname') is-invalid @enderror" type="text" name="shopname" placeholder="Shop Name">
                @error('shopname')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="cnic" class="form-label">CNIC</label>
                <input id="cnic" value="{{ old('cnic') }}" class="form-control @error('cnic') is-invalid @enderror" type="text" name="cnic" placeholder="CNIC">
                @error('cnic')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
              
              <div class="mb-3">
                <label for="account_number" class="form-label">Account Number</label>
                <input id="account_number" value="{{ old('account_number') }}" class="form-control @error('account_number') is-invalid @enderror" type="text" name="account_number" placeholder="Account Number">
                @error('account_number')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input id="bank_name" value="{{ old('bank_name') }}" class="form-control @error('bank_name') is-invalid @enderror" type="text" name="bank_name" placeholder="Bank Name">
                @error('bank_name')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
            
              <div class="mb-3">
                <label for="bank_branch" class="form-label">Bank Branch</label>
                <input id="bank_branch" value="{{ old('bank_branch') }}" class="form-control @error('bank_branch') is-invalid @enderror" type="text" name="bank_branch" placeholder="Bank Branch">
                @error('bank_branch')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input id="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" type="text" name="city" placeholder="City">
                @error('city')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
              </div>
              
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address"></textarea>
              @error('address')
              <span class="text-danger"> {{ $message }} </span>
              @enderror
            </div>
          </div>
          <div class="mb-3 text-end">
            <button class="btn btn-primary btn-sm" type="submit" id="submitmyform">Save</button>
            <button type="button" class="btn btn-warning btn-sm" id="cancel-btn">Cancel</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>

$(document).ready(function() {
  

  $('#cancel-btn').click(function(e) {
      e.preventDefault(); // Prevent the form from submitting
      $('#customer-modal').modal('hide');
      $('.input').val(''); // Reset the input field
      // $('.is-invalid').removeClass('is-invalid'); // Remove the 'is-invalid' class
      $('.text-danger').text(''); // Clear the validation error message
  });
});
</script>




<script>
  $(document).ready(function() {
      var dataTable = $('#basic-datatable1').DataTable();

      $('#search').keyup(function() {
          dataTable.column(1).search($(this).val()).draw();
      });
  });
</script>


  <script>
    $(document).ready(function() {
        var dataTable = $('#basic-datatable1').DataTable();

        $('#categoryFilter,#brandFilter').change(function() {
            var selectedcategory = $('#categoryFilter').val();
            var selectbrand = $('#brandFilter').val();
          

            dataTable.column(3).search(selectedcategory).column(4).search(selectbrand).draw();
        });
    });
</script>



        {{-- add new customer  --}}
<script>
  $(document).ready(function() {
  // Get the CSRF token value from the meta tag
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $('#submitmyform').click(function(e) {
    e.preventDefault();
    $('#submitmyform').val("Creating..");
    var formData = $('#form2').serialize(); // Serialize the form data

    $.ajax({
      url: '{{ route('newcustomer.store') }}',
      type: 'POST',
      data: formData,
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function(response) {
        // Close the modal on success
        $('#customer-modal').modal('hide');

        // Update the customer select options
        var customerSelect = $('#example-select');
        customerSelect.append($('<option>', {
          value: response.customers.id,
          text: response.customers.name
        }));

        // Reset the select value to the newly added customer
        customerSelect.val(response.customers.id);

//         Swal.fire(
//   'Good job!',
//   'Customer Added Succesfully',
//   'success'
// )
       
      },
      error: function(xhr) {
        // Handle the error response
        if (xhr.status === 422) {
          var errors = xhr.responseJSON.errors;
          $.each(errors, function(field) {
            // Display the validation error messages for each field
            var $field = $('#' + field);
            $field.addClass('is-invalid');
        
          });
        } else {
          console.log(xhr.responseText);
        }
      }
    });
  });
});

</script>


      {{-- -hold order- --}}

      <script>
        $(document).on('click', '#HoldOrder', function() {
           // Function to send the data to the controller
         
           $('#HoldOrder').prop('disabled', true);

             var rows = []; // Array to store data from each row
             var customer_id = $('#customerid').val();
             console.log(customer_id);
          //   Loop through each row in the table
             $('table tbody tr').each(function() {
               var row = {};
               // Get the data from each input element in the row
               row.product_id = $(this).find('input[name="product_id[]"]').val();
               row.name = $(this).find('input[name="name[]"]').val();
               row.price = $(this).find('input[name="price[]"]').val();
               row.qty = $(this).find('input[name="qty[]"]').val();
               row.discount = $(this).find('.discount-input').val();
              
       
               // Add the row data to the array
               rows.push(row);
             });
             console.log(rows);
       
             // Get the CSRF token from the meta tag
             var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
             // Send the data to the controller using AJAX
             $.ajax({
               //  url: '/hold-order', 
               url: '{{ route('holdorder.hold') }}',
               method: 'POST',
               data: { rows: rows, customer_id: customer_id },
              // data: { customer_id: customer_id }, // Sending the array of rows as data
                // Sending the array of rows as data
               headers: {
                 'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
               },
               success: function(response) {
                 // Handle the response from the server if needed
               
            Swal.fire(
       'Success',
       'Order Has been Holded using Refrence Number : '+response[0]
       )
       $('#basic2-table tbody').empty();
       $('#ltotal').text(0);
       $('#lqty').text(0);
       $('#ldiscount').text(0);
       $('#lgrandtotal').text(0);
     
       fetchHoldOrders();
 $('#HoldOrder').prop('disabled', false);
    

               },
    
               error: function(xhr, status, error) {
                 // Handle errors if any
                 console.error('Error submitting order:', error);
               }
               
             });
            
           });
       </script>


      {{-- pay modal --}}
       
    

<div id="pay-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Create Invoice</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
            <div class="row">
              <div class="col-md-8">
              

                  <div class="mb-3">
                    <label for="payment" class="form-label">Payment</label>
                    <select name="payment_status" class="form-select" id="example-select">
                        <option selected value="HandCash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        {{-- <option value="Due">Due</option> --}}
                    </select>
                </div>
  
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="username" class="form-label">Pay Now</label>
                            <input id="payamount" class="form-control" type="text" value="0" name="pay" placeholder="Enter Amount to Pay..">
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
                            <input id="due" class="form-control" disabled type="text" value="0" name="due" placeholder="Due amount..">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="username" class="form-label">Due All</label>
                            <button id="dueall" class="form-control btn btn-info" type="button" name="payall">Full Due</button>
                        </div>
                    </div>
                </div>
  
                <div class="mb-3 text-center">
                    <button class="btn btn-primary form-control" type="submit" id="complete_order">Complete Order</button>
                </div>
  
                </div>
               

                <div class="col-md-4 p-2 d-flex flex-column">
                  <div class="mt-3 line-below d-flex justify-content-between align-items-end">
                    <label for="subtotal" class="form-label">Sub Total</label>
                    <span id="subtotal-label">1000</span>
                  </div>
                  <div class="mt-1 line-below d-flex justify-content-between align-items-end">
                    <label for="discount" class="form-label">Discount </label>
                    <span id="discount-label">0.00</span>
                  </div>
                  <div class="mt-1 line-below d-flex justify-content-between align-items-end">
                    <label for="tax" class="form-label">Tax</label>
                    <span id="tax-label">0</span>
                  </div>
                  <div class="mt-2 line-below d-flex justify-content-between align-items-end">
                    <label for="total-amount" class="form-label">Total</label>
                    <span id="total-label">0</span>
                  </div>
                  <div class="mt-1 line-below d-flex justify-content-between align-items-end">
                    <label for="paid-amount" class="form-label">Paid Amount </label>
                    <span id="paid-label">0</span>
                  </div>
                  <div class="mt-1 line-below d-flex justify-content-between align-items-end">
                    <label for="due-label" class="form-label">Due Amount</label>
                    <span id="due-label">0</span>
                  </div>
                </div>



              </div>

              </div>
      </div>
  </div>
</div>






<script>


  $(document).ready(function() {
    $("#complete_order").click(function(event) {
      // console.log('completeorder');
      event.preventDefault();
      $('input[name="payamountv"]').val($('#payamount').val());
  $('input[name="dueamountv"]').val($('#due').val());
      $("#myForm").submit();
      window.open('{{ route('printInvoice') }}', '_blank');
     
    });
  });

 $(document).ready(function () {
  $("#payall").click(function() {
    // console.log('clicked');
    var totalAmount = $("#total-label").text();
    $("#payamount").val(totalAmount);
    $("#due").val(0);
    $('#paid-label').text(totalAmount);
    $('#due-label').text(0)
    $('input[name="payamountv"]').val(totalAmount);
  $('input[name="dueamountv"]').val(0);
  });

  // Copy total amount to due amount
  $("#dueall").click(function() {
    var totalAmount = $("#total-label").text();
    $("#due").val(totalAmount);
    $("#payamount").val(0);
    $('#due-label').text(totalAmount);
    $('#paid-label').text(0);
    $('input[name="payamountv"]').val(0);
  $('input[name="dueamountv"]').val(totalAmount);
  });
  // Update due amount based on pay amount
  $("#payamount").on("input", function() {
    var totalAmount = parseInt($("#total-label").text());
    var payAmount = parseInt($(this).val());
    $('#paid-label').text(payAmount)? $('#paid-label').text(payAmount): $('#paid-label').text(0);
    var dueAmount = totalAmount - payAmount;
    $('input[name="payamountv"]').val(payAmount);
  $('input[name="dueamountv"]').val(dueAmount);
    if (!isNaN(dueAmount)) {
      $("#due").val(dueAmount);
      $('#due-label').text(dueAmount);
    }
    if (isNaN(payAmount) || payAmount < 0) {
        // If the value is NaN or less than 0, set it to 0
        payAmount = 0;
        $(this).val(payAmount);
        $('#due-label').text(0);
        $('#paid-label').text(0);
        $('#due').val(0);
    }
    if(payAmount>totalAmount)
    {
      Swal.fire(
   'Alert!',
   'The Paying amount cannot be greater then the total amount.',
       );
       $(this).val(totalAmount);
       $("#due").val(0);
       $("#due-label").text(0);
       $("#paid-label").text(totalAmount);
    }
  });

  $('#payamount').on('blur', function() {
  
            var inputValue = $(this).val();
            // Check if the value is empty or less than 0
            if (inputValue === '' || parseFloat(inputValue) < 0) {
                // Set the value to 0
                $(this).val(0);
                $('#paid-label').text(0);
            }
        });

 });
</script>



{{-- hold order section--}}
<script>

function fetchHoldOrders() {
        // Make an AJAX request
        $.ajax({
            url: '{{ route("get.hold.orders") }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                //  console.log(data);
                // console.log(data.count);
                $('#count').text(data.count);
                const tableBody = $('#hold-orders-body');
                tableBody.empty(); // Clear existing data in the table body

                // Populate the table with fetched data
                $.each(data.holdOrders, function(index, order) {
                    tableBody.append(`
                        <tr>
                            <td>${order.hold_no}</td>
                            <td>${order.hold_date}</td>
                            <td>
                                <a class="button btn-sm text-primary edit-btn" data-order-id="${order.id}"><span class="fas fa-edit edit-btns"></span></a>&nbsp;&nbsp;
                                <a class="button btn-sm text-danger delete-btn" data-order-id="${order.id}"><span class="fas fa-trash edit-btns"></span></a>
                            </td>
                          
                        </tr>
                    `);
                   
                });
            },
            error: function(error) {
                console.error('Error fetching hold orders:', error);
            }
        });
    }

    // Call the function to fetch and display hold orders when the page loads
    $(document).ready(function() {
        fetchHoldOrders();




        
    $(document).on('click', '.delete-btn', function(event) {
      //  Get the order ID from the 'data-order-id' attribute of the clicked element
        var orderId = $(this).data('order-id');
        // console.log(orderId);
        // // Call the deleteOrder function with the order ID
        deleteHoldOrder(orderId);

       
    });
    });



    function deleteHoldOrder(orderId) {
        $.ajax({
            url: '{{ route("delete.holdorder") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Add the CSRF token for Laravel
                id: orderId
            },
            dataType: 'json',
            success: function(response) {
                // Handle the success response, maybe update the table again after deletion
                // console.log(response);
                Swal.fire({
                                        title: 'Are you sure?',
                                        text: "Delete This Data?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, delete it!'
                                      }).then((result) => {
                                        if (result.isConfirmed) {
                                        
                                          Swal.fire(
                                            'Deleted!',
                                            'Hold Order Has been deleted.',
                                            'success'
                                          )
                                        }
                                      }) 
                fetchHoldOrders(); // Update the table with the latest data after deletion
            },
            error: function(error) {
                console.error('Error deleting order:', error);
            }
        });
    }


    $(document).on('click', '.edit-btn', function(event) {
      //  Get the order ID from the 'data-order-id' attribute of the clicked element
        var orderId = $(this).data('order-id');
        // console.log(orderId);
        // // Call the deleteOrder function with the order ID
        editHoldOrder(orderId);
        
       
    });




    
    // Function to edit order
    function editHoldOrder(orderId) {
        
        $.ajax({
            url: '/get/holdorder/' + orderId,
            type: 'GET',
            success: function (holdproductDetails) {
                // console.log(holdproductDetails);

                // Assuming your tableBody is defined somewhere in your HTML
                var tableBody = $('#basic2-table tbody');
                tableBody.empty(); // Clear existing data in the table body

                // Populate the table with the received data
                $.each(holdproductDetails, function(index, product) {
                    var newRow = '<tr data-row-id="' + product.product.product_id + '">' +
      '<td>' + product.product.product_name + '</td>' +
      '<td>' + product.product.selling_price + '</td>' +
      '<td>' +
      '<div class="d-flex align-items-center">' +
      '<button type="button" class="btn btn-sm btn-primary p-1 increase-quantity" style="margin-top: -2px; height:40px; width:32px;"><i class="fas fa-plus"></i></button>' +
      `<input type="text" min="1" value="`+product.quantity+`" max="`+product.product.stock+`" name="qty[]" class="form-control quantity-input" placeholder="Qty" style="width: 70px; height: 40px; margin-bottom: 3px">` +
      '<button type="button" class="btn btn-sm btn-primary p-1 decrease-quantity" style="margin-top: -2px;height:40px; width:32px;"><i class="fas fa-minus"></i></button>' +
      '</div>' +
      '</td>' +
      '<td>' +
      '<div class="d-flex align-items-center">' +
        '<input type="text" value="" name="discount[]" class="form-control discount-input" toolti placeholder=" 0 " style="width: 80px; height: 34px;" data-row-id="' + product.product.product_id + '">' +

       '</div>' +
      '</td>' +
      '<td class="subtotal">0.00</td>' +
      '<td>' +
      '<a href="#" class="action-icon text-danger delete-row">' +
      '<i class="mdi mdi-delete"></i>' +
      '</a>' +
      '</td>' +
      '<input type="hidden" name="product_id[]" value="' + product.product.product_id + '">' +
                                              '<input type="hidden" name="name[]" value="' + product.product.product_name + '">' +
                                              '<input type="hidden" name="price[]" value="' + product.product.selling_price + '">' +
      '</tr>' +
      '<tr class="row-separator">' +
      '<td colspan="6"></td>' +
      '</tr>';

      tableBody.append(newRow);
     
                });


                tableBody.find('.increase-quantity').off('click').on('click', function() {
    var row = $(this).closest('tr');
  //  console.log(row);
    var quantityInput = row.find('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val());
    quantityInput.val(currentQuantity + 1);
    var maxQuantity = quantityInput.attr('max');
    // var maxQuantity = parseInt($('.quantity-input').attr('max'));
//console.log(maxQuantity); // Output the value of the max attribute
if (currentQuantity >= maxQuantity) {
   // alert('The quantity exceeds the available stock.');
    Swal.fire(
  'Alert!',
  'The quantity exceeds the available stock.',

)
    quantityInput.val(maxQuantity); // Reset the input value to the stockValue
  }
    updateSubtotal(row);
    updateValues();
  });


  
  tableBody.find('tr').each(function() {
  var row = $(this);
  var quantityInput = row.find('.quantity-input');
  var price = parseFloat(row.find('td:nth-child(2)').text());
  var subtotalElement = row.find('.subtotal');
  var discountInput = row.find('.discount-input');



tableBody.find('.quantity-input').off('input').on('input', function() {
  var row = $(this).closest('tr');
  var quantityInput = row.find('.quantity-input');
  var currentQuantity = parseInt(quantityInput.val());

  var maxQuantity = quantityInput.attr('max');
//console.log(maxQuantity); // Output the value of the max attribute
if (currentQuantity >= maxQuantity) {
   // alert('The quantity exceeds the available stock.');
    Swal.fire(
  'Warning!',
  'The quantity exceeds the available stock.',
  'Warning'
)
quantityInput.val(maxQuantity); // Reset the input value to the stockValue
  }
  updateSubtotal(row);
  updateValues();
});



  discountInput.on('input', function() {
    var quantity = parseInt(quantityInput.val());
    var discount = parseFloat(discountInput.val() || 0);
    var subtotal = quantity * price;
    var discountedSubtotal = subtotal - discount;

    subtotalElement.text(discountedSubtotal.toFixed(2));
    updateValues();
  });
});


tableBody.find('tr').each(function() {
  var row = $(this);
  var quantity = parseInt(row.find('.quantity-input').val());
  var price = parseFloat(row.find('td:nth-child(2)').text());
  var discount = parseFloat(row.find('.discount-input').val() || 0); // Retrieve the discount value for the row
  var subtotal = quantity * price;
  var discountedSubtotal = subtotal - discount; // Subtract the discount from the subtotal
  row.find('.subtotal').text(discountedSubtotal.toFixed(2));
  updateValues();
});

 
  tableBody.find('.decrease-quantity').off('click').on('click', function() {
    var row = $(this).closest('tr');
    var quantityInput = row.find('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val());
  
    if (currentQuantity > 1) {
      quantityInput.val(currentQuantity - 1);
      updateSubtotal(row);
      updateValues();
    }
  });
  
  // Bind the delete button click event to remove the row
  tableBody.find('.delete-row').off('click').on('click', function(e) {
    e.preventDefault();
    $(this).closest('tr').remove();
    updateValues();
  });
  function updateSubtotal(row) {
  var quantityInput = row.find('.quantity-input');
  var quantity = parseInt(quantityInput.val());
  var price = parseFloat(row.find('td:eq(1)').text());
  var subtotal = (quantity * price).toFixed(2);
  row.find('.subtotal').text(subtotal);
  updateValues();
}

function updateValues() {
  var totalQuantity = 0;
  var totalAmount = 0;
  var totalDiscount = 0;
  var grandTotal = 0;

  $('.quantity-input').each(function() {
    var quantity = parseInt($(this).val());
    totalQuantity += quantity;
  });
// new commint cdsdsd  dfdfd
  $('.subtotal').each(function() {
    var subtotal = parseFloat($(this).text());
    totalAmount += subtotal;
  });
// this is change
  $('.discount-input').each(function() {
    var discount = parseFloat($(this).val() || 0);
    totalDiscount += discount;
  });

  // grandTotal = totalAmount - totalDiscount;

  grandTotal =(totalAmount + totalDiscount)-totalDiscount;

  $('#lqty').text(totalQuantity);
  $('#ltotal').text((totalAmount + totalDiscount).toFixed(2));
  $('#ldiscount').text(totalDiscount.toFixed(2));
  $('#lgrandtotal').text(grandTotal.toFixed(2));
  $('input[name="totalamountv"]').val((totalAmount + totalDiscount).toFixed(2));
  $('input[name="totalqty"]').val(totalQuantity);
  $('input[name="totaldiscountv"]').val(totalDiscount);
}


            },
           
        });


    }




</script>

@endsection
