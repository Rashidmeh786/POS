@extends('admin.pos_layout')
@section('admin')

<style>
  .table-responsive {
    height: 420px;
    overflow-y: scroll;
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
        
        <form id="myForm" method="post" action="{{ url('/create-sale-invoice') }}">
          @csrf
            <div class="table-responsive table-sm">
              @if ($errors->has('product_id'))
    <p class="text text-danger">
        {{ $errors->first('product_id') }}
    </p>
@endif

              <table class="table table-borderless table-nowrap table-centered mb-0" id="basic2-table">
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


              <div class="mb-2">
                <div class="d-flex">
                
                    <select name="customerid" class="form-select  @error('customerid') is-invalid @enderror " id="example-select">
                        <option value="">Select Customer</option>
                        @foreach ($customer as $item)
                      
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
    
                    
                    <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#customer-modal">
                        <span class="fas fa-plus-square p-1"></span>
                    </button>
                   
                </div>
                
                @error('customerid')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <input type="hidden" name="totalqty">
            <input type="hidden" name="totalamountv" >
            <input type="hidden" name="totaldiscountv" >
            

              <button type="submit" class="btn btn-primary form-control">Create Invoice</button>
            
          </form>
          
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
            </div>
          {{-- </div>
        </div> --}}
        
      </div> <!-- end col-->

      <div class="col-lg-6 col-xl-6">
        <div class="card">
          <div class="card-body">
            <div class="tab-pane" id="settings">
              <div class="row">

                <div class="col-md-6">
                  <div class="mb-3">
                    <div class="d-flex">
                     

                      <select name="category_id" class="form-select " id="categoryFilter" style="height: 42px;">
                        <option value="">-All Categories-</option>
                        @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                      </select>
                      <button class="btn btn-secondary me-2" type="button">
                        <span class="mdi mdi-refresh"></span>
                      </button>
                      @error('category_select')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

              
                <div class="col-md-6">
                  <div class="mb-3">
                    <div class="d-flex">
                      <select name="brand_id" class="form-select" id="brandFilter" style="height: 42px;">

                      <option value="">-All Brands-</option>
                      @foreach($brand as $br)
                      <option value="{{ $br->id }}">{{ $br->name ?? '' }}</option>
                      @endforeach
                    </select>
                      <button class="btn btn-secondary me-2" type="button">
                        <span class="mdi mdi-refresh"></span>
                      </button>
                      @error('brand_select')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

              </div>
              <div class="datatable-container" style="padding: 20px; background-color: #f8f9fa; overflow-y: auto; max-height:590px; min-height:590px;">
                <table id="basic-datatable1" class="table table-sm dt-responsive nowrap w-100">
                    <input type="text" style="height: 42px;" class="form-control mb-2 " name="search" id="search" placeholder="Enter Product Name to search..">
                    {{-- @error('product_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror --}}
                    <thead>
                        <tr style="background-color: #f8f9fa; color: #212529;">
                            <th>Image</th>
                            <th>Name</th>
                           <th> Price</th>
                            <th hidden>Category</th>
                            <th hidden>Brand</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $key => $item)
                        <tr>
                           
                               <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="name" value="{{ $item->product_name }}">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="price" value="{{ $item->selling_price }}"> 
            
                                <td style="padding: 5px;">
                                    <div class="product-image">
                                      <button style="background: none; border: none; " type="submit" id="product-image-btn" data-product-id="{{ $item->id }}">
                                        <img src="{{ (!empty($item->product_image)) ? url('upload/product/'.$item->product_image) : url('upload/no_image.jpg') }}" alt="{{ $item->product_name }}" class="img img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                    </button>
                                    
                                    </div>
                                </td>
                                <td style="padding: 5px;">
                                    <div class="product-details">
                                        <h5 class="product-name" style="margin: 0; font-size: 16px; font-weight: bold; color: #212529;">{{ $item->product_name }}</h5>
                                    </div>
                                    <div class="product-details">
                                   
                                </td>
                                <td>
                                  <h5 class="product-name" style="margin: 0; font-size: 16px; font-weight: bold; color: #212529;">{{ $item->selling_price }}</h5>
                                </div>
                                </td>
                          
                            <td hidden>{{ $item->category->id ?? "" }}</td>
                            <td hidden>{{ $item->brand->id ?? "" }}</td>
                        </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>
            
            
            </div>
          </div> <!-- end card-body -->
        </div> <!-- end card -->
      </div> <!-- end col -->
    </div> <!-- end row-->
 
  
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
    var quantityInput = existingRow.find('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val());
    quantityInput.val(currentQuantity + 1);
    updateSubtotal(existingRow);
  } else {
    // If no existing row exists, append a new row with the fetched product data
    var newRow = '<tr data-row-id="' + productData.rowId + '">' +
      '<td>' + productData.name + '</td>' +
      '<td>' + productData.price + '</td>' +
      '<td>' +
      '<div class="d-flex align-items-center">' +
      '<button type="button" class="btn btn-sm btn-success p-1 increase-quantity" style="margin-top: -2px;"><i class="fas fa-plus"></i></button>' +
      '<input type="text" min="1" value="1" name="qty[]" class="form-control quantity-input" placeholder="Qty" style="width: 70px; height: 35px; margin-bottom: 3px">' +
      '<button type="button" class="btn btn-sm btn-success p-1 decrease-quantity" style="margin-top: -2px;"><i class="fas fa-minus"></i></button>' +
      '</div>' +
      '</td>' +
      '<td>' +
      '<div class="d-flex align-items-center">' +
        '<input type="text" value="" name="discount[]" class="form-control discount-input" toolti placeholder=" Enter .. " style="width: 80px; height: 34px;" data-row-id="' + productData.rowId + '">' +

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

    tableBody.append(newRow);
  }
  

  tableBody.find('tr').each(function() {
  var row = $(this);
  var quantityInput = row.find('.quantity-input');
  var price = parseFloat(row.find('td:nth-child(2)').text());
  var subtotalElement = row.find('.subtotal');
  var discountInput = row.find('.discount-input');

  quantityInput.on('input', function() {
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


// tableBody.find('.discount-input').off('input').on('input', function() {
//   var row = $(this).closest('tr');
//   updateSubtotal(row);
//   updateValues();
// });
tableBody.find('.quantity-input').off('input').on('input', function() {
  var row = $(this).closest('tr');
  updateSubtotal(row);
  updateValues();
});
  // Bind the increase and decrease button click events to update quantity and subtotal
  tableBody.find('.increase-quantity').off('click').on('click', function() {
    var row = $(this).closest('tr');
    var quantityInput = row.find('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val());
    quantityInput.val(currentQuantity + 1);
    updateSubtotal(row);
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
  $('#ltotal').text((totalAmount + totalDiscount).toFixed(2));
  $('#ldiscount').text(totalDiscount.toFixed(2));
  $('#lgrandtotal').text(grandTotal.toFixed(2));
  $('input[name="totalamountv"]').val((totalAmount + totalDiscount).toFixed(2));
  $('input[name="totalqty"]').val(totalQuantity);
  $('input[name="totaldiscountv"]').val(totalDiscount);
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
                <input id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " type="text" name="name" placeholder="Add New Customer Name">
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
          

            dataTable.column(2).search(selectedcategory).column(3).search(selectbrand).draw();
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



<script>
  
</script>





@endsection
