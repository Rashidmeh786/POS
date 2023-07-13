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
            <div class="table-responsive table-sm">
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
                <tbody>
                  @php
                  $allcart = Cart::content();
                  @endphp
                  @foreach($allcart as $cart)
                  <tr>
                    <td>{{ $cart->name }}</td>
                    <td>{{ $cart->price }}</td>
                  
                      <td>
                        <form method="post" action="{{ url('/cart-update/'.$cart->rowId) }}" id="qtyform">
                          @csrf
                          <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-sm btn-success p-1 increase-quantity" style="margin-top: -2px;"><i class="fas fa-plus"></i></button>
                            <input type="text" min="1" value="{{ $cart->qty }}" name="qty" class="form-control quantity-input" placeholder="Qty" style="width: 70px; height: 35px; margin-bottom: 3px">
                            <button id="qtyformsubmit" type="submit" class="btn btn-sm btn-success p-1 decrease-quantity" style="margin-top: -2px;"><i class="fas fa-minus"></i></button>
                          </div>
                        {{-- </form> --}}
                      </td>
                      
                    <td>
                      <div class="d-flex align-items-center">
                        {{-- <button type="submit" class="btn btn-sm btn-success p-1 increase-quantity" style="margin-top: -2px;"><i class="fas fa-plus"></i></button> --}}
                    
                        <input  type="text" value="{{  $cart->discount}}"  name="discount" class="form-control discount-input" toolti placeholder="e.g 5 .. " style="width: 70px; height: 34px;">
                        <button type="submit" title="ENter in Percntage e.g 5" class="btn btsm btn-success btn-sm p-1 mb-0 " style="margin-top: 1px;"><i class="fas fa-check"></i></button>
                      </div>
                    </td>
                  </form>
                    <td>{{ $cart->price * $cart->qty - $cart->discount }}</td>
                    <td>
                      <a href="{{ url('/cart-remove/'.$cart->rowId) }}" class="action-icon text-danger">
                        <i class="mdi mdi-delete"></i>
                      </a>
                    </td>
                
                  </tr>
                  <tr class="row-separator">
                    <td colspan="6"></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div> <!-- end table-responsive -->
          </div>
        </div> <!-- end card -->
        
           <div class=" " style="margin-top: 40px position: fixed;">


            <form id="myForm" method="post" action="{{ url('/create-invoice') }}">
              @csrf
              <div class="mb-2">
                <div class="d-flex">
                
                    <select name="customer" class="form-select  @error('customer') is-invalid @enderror " id="example-select">
                        <option value="">Select Customer</option>
                        @foreach ($customer as $item)
                      
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
    
                    
                    <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#customer-modal">
                        <span class="fas fa-plus-square p-1"></span>
                    </button>
                   
                </div>
                
                @error('customer')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <input type="hidden" value="{{ Cart::count() }}">

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
                    <td>{{ Cart::count() }}</td>
                    <td>Rs : {{ Cart::priceTotal() }}</td>
                    <td>{{ Cart::discount() }}</td>
                    <td>Rs : {{ Cart::subtotal()}}</td>
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
                    <input type="text" style="height: 42px;" class="form-control mb-2" name="search" id="search" placeholder="Enter Product Name to search..">
            
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
                            <form method="post" action="{{ url('/add-cart') }}" id="productform">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="hidden" name="name" value="{{ $item->product_name }}">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="price" value="{{ $item->selling_price }}">
            
                                <td style="padding: 5px;">
                                    <div class="product-image">
                                        <button style="background: none; border: none; " type="submit">
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
                            </form>
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
 
  
    




    
  </div> <!-- container -->
</div> <!-- content -->


<div id="customer-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <form class="px-3" method="post" id="form2" action="" id="customerform">
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
    // Increase quantity
    $('.increase-quantity').click(function() {
      var input = $(this).siblings('.quantity-input');
      var quantity = parseInt(input.val());
      input.val(quantity + 1);
     
    });
  
    // Decrease quantity
    $('.decrease-quantity').click(function() {
      var input = $(this).siblings('.quantity-input');
      var quantity = parseInt(input.val());
      if (quantity > 1) {
        input.val(quantity - 1);
      }
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
 
@endsection
