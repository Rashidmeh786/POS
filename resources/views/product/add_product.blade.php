@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
{{-- <script src="{{ asset('backend/assets/js/validate.min.js') }}"></script> --}}

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <form id="myForm" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('all.product') }}" type="button" class="btn w-sm btn-danger waves-effect waves-light"><span class="fas fa-arrow-alt-circle-left"></span></a>&nbsp;
                            <button  type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>

                        </ol>
                    </div>
                    <h4 class="page-title">Add / Edit Product</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

  
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                        <div class="mb-3">
                            <label for="product-name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="product-name" name='product_name' value="{{ old('product_name') }}" class="form-control  @error('product_name') is-invalid @enderror" placeholder="e.g : Apple iMac">
                            @error('product_name')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="product_code" class="form-label">Product Code <span class="text-danger">*</span></label>
                            <input type="text" id="product_code" class="form-control @error('product_code') is-invalid @enderror"  name="product_code" placeholder="e.g : p001" value="{{ old('product_code') }}">
                            @error('product_code')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div> --}}




                        <div class="mb-3">
                            <label for="product-category" class="form-label">Product Category <span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <select name="category_id" class="form-select" id="example-select">
                    <option selected disabled >-Select Category- </option>
                    @foreach($category as $cat)
                     <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                     @endforeach
                   </select>
                                <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#categorymodal"><span class="fas fa-plus-square"></span></button>
                              
                            </div>

                        </div>



                        <div class="mb-3">
                            <label for="product-brand" class="form-label">Brand <span class="text-danger">*</span></label>
                            <div class="d-flex">
                            
                                <select name="brand" class="form-select" id="example-selectbrand">
                                    <option selected disabled >-Select Brand- </option>
                                    @foreach($brand as $brand)
                                     <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                     @endforeach
                                   </select>

                                   <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#brand-modal"><span class="fas fa-plus-square"></span></button>

                            
                                @error('brand')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
<div class="row">
   
    <div class="col-md-6">
        <div class="mb-3">
            <label for="product-unit" class="form-label">Purchase Unit <span class="text-danger">*</span></label>
            <div class="d-flex">
                
                <select name="purchase_unit" class="form-select  unit @error('purchase_unit') is-invalid @enderror" id="example-selectunit">
                    <option selected disabled >-Select Unit- </option>
                    @foreach($unit as $purchase_unit)
                     <option value="{{ $purchase_unit->id }}">{{ $purchase_unit->name }}</option>
                     @endforeach
                   </select>


                   <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#unit-modal"><span class="fas fa-plus-square"></span></button>

                @error('purchase_unit')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="product-unit" class="form-label">Sale Unit <span class="text-danger">*</span></label>
            <div class="d-flex">
                
                <select name="sale_unit" class="form-select unit @error('sale_unit') is-invalid @enderror" id="example-selectunit">
                    <option selected disabled >-Select Unit- </option>
                    @foreach($unit as $sale_unit)
                     <option value="{{ $sale_unit->id }}">{{ $sale_unit->name }}</option>
                     @endforeach
                   </select>


                   <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#unit-modal"><span class="fas fa-plus-square"></span></button>

                {{-- <button class="btn btn-primary me-2" type="button"><span class="fas fa-plus-square"></span></button> --}}
                @error('sale_unit')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
        </div>
        
    </div>
</div>
                   
                                

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product-meta-title" class="form-label"> Buying Price<span class="text-danger">*</span></label>
                                    <input type="number"  value="{{ old('buying_price') }}"  class="form-control @error('buying_price') is-invalid @enderror" name="buying_price" id="product-meta-title" placeholder="Enter purchase Price">
                                    @error('buying_price')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product-meta-title" class="form-label"> Selling Price<span class="text-danger">*</span></label>
                                    <input type="number"   value="{{ old('selling_price') }}" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" id="product-meta-title" placeholder="Enter selling Price">
                                    @error('selling_price')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                           </div>
                      
                           <div class="mb-3">
                            <label for="product-description" class="form-label">Product Description <span class="text-danger"></span></label>
                            <textarea class="ckeditor form-control @error('wysiwyg-editor') is-invalid @enderror"   name="wysiwyg-editor"></textarea>
                            @error('wysiwyg-editor')
                            <span class="text-danger"> {{ $message }} </span>
                                
                            @enderror
                        </div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-lg-6">
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Product Images</h5>

                        <div class="mb-3">
                            <label for="example-fileinput" class="form-label"></label>
                           
                            <img id="showImage" name='product_image' style="height: 100px;width: 100px" src="{{ url('upload/no_image.jpg') }}" class="rounded- circle avatar-lg img-thumbnail" alt="profile-image">
                           
                        </div>  

                        <div class="mb-3">
                            <label for="example-fileinput" class="form-label"> Image <span class="text text-danger">*</span></label>
                            <input type="file" name="product_image" id="image" class="form-control @error('product_image') is-invalid @enderror @error('image') is-invalid @enderror">
                              @error('product_image')
                          <span class="text-danger"> {{ $message }} </span>
                                @enderror
                        </div>
                      
                      

                    

                           

                        <!-- Preview -->
                        <div class="dropzone-previews mt-3" id="file-previews"></div>
                    </div>
                </div> <!-- end col-->

                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Meta Data</h5>

                        <div class="mb-3">
                            <label for="product-meta-title" class="form-label"> SKU<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" 
                           value="{{ old('sku') }}" id="product-meta-title" placeholder="Enter title">
                            @error('sku')
                            <span class="text-danger"> {{ $message }} </span>
                                  @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-Supplier" class="form-label">Supplier <span class="text-danger"></span></label>
                            <div class="d-flex">
                                <select name="supplier_id" class="form-select" id="example-select">
                                    <option selected disabled >Select Supplier </option>
                                    @foreach($supplier as $sup)
                               <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                     @endforeach
                                </select>
                                @error('supplier_id')
                                <span class="text-danger"> {{ $message }} </span>
                                      @enderror

                            </div>
                        </div>

                        
                        <div class="mb-3">
                            <label for="product-meta-title" class="form-label"> Buying Date<span class="text-danger"></span></label>
                           
                            <input type="date" class="form-control @error('buying_date') is-invalid @enderror" name="buying_date" id="product-meta-title" placeholder="Enter expiry date ..">
                            @error('buying_date')
                            <span class="text-danger"> {{ $message }} </span>
                                  @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-meta-title" class="form-label"> Expiry Date<span class="text-danger"></span></label>
                           
                            <input type="date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date" id="product-meta-title" placeholder="Enter expiry date ..">
                            @error('expire_date')
                            <span class="text-danger"> {{ $message }} </span>
                                  @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-price">Alert qty <span class="text-danger"></span></label>
                            <input type="number" class="form-control @error('alertqty') is-invalid @enderror" id="alertqty" name="alertqty" placeholder="Enter alert qty ..">
                            @error('alertqty')
                            <span class="text-danger"> {{ $message }} </span>
                                  @enderror
                        </div>
                      
                     

                    </div>
                </div> <!-- end card -->

            </div> <!-- end col-->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="text-end mb-3">
                   
                    
                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                    <a type="submit" href="{{ route('all.product') }}" class="btn w-sm btn-danger waves-effect waves-light">Cancel</a>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

  </form>
      
        
    </div> <!-- container -->

</div> <!-- content -->

                                                        {{-- Modal part --}}
                                {{-- Category modal --}}
                                <div id="categorymodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form class="px-3" method="post" id="categoryform" action="">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <ul class="nav nav-pills nav-fill navtab-bg">
                                                            <li class="nav-item">
                                                                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link bg-info active">
                                                                    Add Category
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <label for="username" class="form-label mt-2">Category Name <span class="text text-danger">*</span></label>
                                                      <input type="hidden" name="productformcategory" value="productformcategory">
                                                        <input id="category-input" value="{{ old('name') }}" class="form-control @error('name') is-invalid  @enderror " type="text" name="name" placeholder="Add Category">
                                                  <div id="validation-errors" class="text-danger"></div>
                                                      
                                                        @error('name')

                                                        <span class="text-danger"> {{ $message }} </span>
                                                              @enderror
                                                    </div>
                                                    <div class="mb-3 text-end">
                                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                                        <button  type="submit" class="btn btn-warning btn-sm" id="cancel-btn" >Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                

                                                {{-- Units model --}}

                                <div id="unit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form class="px-3" method="post" id="unitform" action="">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <ul class="nav nav-pills nav-fill navtab-bg">
                                                            <li class="nav-item">
                                                                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link bg-info active">
                                                                    Add New Unit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <label for="username" class="form-label mt-2">Unit Name <span class="text text-danger">*</span></label>
                                                   
                                                        <input id="unit-input" value="{{ old('name') }}" class="form-control unit @error('name') is-invalid @enderror " type="text" name="name" placeholder="Add New unit">
                                                        <div id="validation-errors-unit" class="text-danger"></div>

                                                    </div>
                                                    <div class="mb-3 text-end">
                                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                                        <button  type="submit" class="btn btn-warning btn-sm" id="cancel-btn-unit" >Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->



   {{-- brand model --}}

   <div id="brand-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="px-3" method="post" id="brandform" action="">
                    @csrf
                    <div class="mb-3">
                        <ul class="nav nav-pills nav-fill navtab-bg">
                            <li class="nav-item">
                                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link bg-info active">
                                    Add New Brand
                                </a>
                            </li>
                        </ul>
                        <label for="username" class="form-label mt-2">Brand Name <span class="text text-danger">*</span></label>
                   
                        <input id="brand-input" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " type="text" name="name" placeholder="Add New Brand">
                        <div id="validation-errorsbrand" class="text-danger"></div>
                       
                        @error('name')
                        <span class="text-danger"> {{ $message }} </span>
                              @enderror
                    </div>
                    <div class="mb-3 text-end">
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        <button  type="submit" class="btn btn-warning btn-sm" id="cancel-btn-brand" >Cancel</button>
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
        $('#categorymodal').modal('hide');
        $('#category-input').val(''); // Reset the input field
        $('.is-invalid').removeClass('is-invalid'); // Remove the 'is-invalid-category' class
        $('.text-danger').text(''); // Clear the validation error message
    });

    $('#cancel-btn-unit').click(function(e) {
        e.preventDefault(); // Prevent the form from submitting
        $('#unit-modal').modal('hide');
        $('#unit-input').val(''); // Reset the input field
        $('.is-invalid').removeClass('is-invalid'); // Remove the 'is-invalid-unit' class
        $('.text-danger').text(''); // Clear the validation error message
    });

    $('#cancel-btn-brand').click(function(e) {
        e.preventDefault(); // Prevent the form from submitting
        $('#brand-modal').modal('hide');
        $('#brand-input').val(''); // Reset the input field
        $('.is-invalid').removeClass('is-invalid'); // Remove the 'is-invalid-brand' class
        $('.text-danger').text(''); // Clear the validation error message
    });
});
</script>
                                
                    

{{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> --}}
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>


<script type="text/javascript">

    $(document).ready(function(){
    $('#image').change(function(e){
    var reader = new FileReader();
    reader.onload =  function(e){
    $('#showImage').attr('src',e.target.result);
    }
    reader.readAsDataURL(e.target.files['0']);
    });
    });
    </script>



<script>
    $('#categoryform').submit(function(e) {
  e.preventDefault();

  // Serialize the form data
  var formData = $(this).serialize();

  // Send the AJAX request to the Laravel controller
  $.ajax({
    url: '{{ url('ajaxcategory/store') }}',
    type: 'POST',
    data: formData,
    success: function(response) {
      // Handle the success response
      console.log(response);
      $('#categorymodal').modal('hide');
      $('#categoryform')[0].reset();
      // Clear the existing options in the select element
      $('#example-select').empty();

      // Append the new options from the response
      $.each(response.categories, function(index, category) {
        $('#example-select').append('<option value="' + category.id + '">' + category.name + '</option>');
      });

      // Set the selected option to the newly added category
      $('#example-select').val(response.selectedCategoryId);
    },
    error: function(xhr) {
    // Handle the error response
    var errors = xhr.responseJSON.errors;
    var errorMessage = '';

    $.each(errors, function(key, value) {
      errorMessage += value + '<br>';
    });

    $('#validation-errors').html(errorMessage);
  }
  });
});

</script>





<script>
    $('#brandform').submit(function(e) {
  e.preventDefault();

  // Serialize the form data
  var formData = $(this).serialize();

  // Send the AJAX request to the Laravel controller
  $.ajax({
    url: '{{ url('ajaxbrand/store') }}',
    type: 'POST',
    data: formData,
    success: function(response) {
      // Handle the success response
      console.log(response);
      $('#brand-modal').modal('hide');
      $('#brandform')[0].reset();
      // Clear the existing options in the select element
      $('#example-selectbrand').empty();

      // Append the new options from the response
      $.each(response.brands, function(index, brand) {
        $('#example-selectbrand').append('<option value="' + brand.id + '">' + brand.name + '</option>');
      });

      // Set the selected option to the newly added category
      $('#example-selectbrand').val(response.selectedBrandId);
    },
    error: function(xhr) {
    // Handle the error response
    var errors = xhr.responseJSON.errors;
    var errorMessage = '';

    $.each(errors, function(key, value) {
      errorMessage += value + '<br>';
    });

    $('#validation-errorsbrand').html(errorMessage);
  }
  });
});

</script>



<script>
    $('#unitform').submit(function(e) {
  e.preventDefault();

  // Serialize the form data
  var formData = $(this).serialize();

  // Send the AJAX request to the Laravel controller
  $.ajax({
    url: '{{ url('ajaxunit/store') }}',
    type: 'POST',
    data: formData,
    success: function(response) {
      // Handle the success response
      console.log(response);
      $('#unit-modal').modal('hide');
      $('#unitform')[0].reset();
      // Clear the existing options in the select element
      $('.unit').empty();

      // Append the new options from the response
      $.each(response.units, function(index, unit) {
        $('.unit').append('<option value="' + unit.id + '">' + unit.name + '</option>');
      });

      // Set the selected option to the newly added category
      $('.unit').val(response.selectedUnitId);
    },
    error: function(xhr) {
    // Handle the error response
    var errors = xhr.responseJSON.errors;
    var errorMessage = '';

    $.each(errors, function(key, value) {
      errorMessage += value + '<br>';
    });

    $('#validation-errors-unit').html(errorMessage);
  }
  });
});

</script>



@endsection