@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/assets/js/validate.min.js') }}"></script>

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <form id="myForm" method="post" action="{{ route('product.update')}}" enctype="multipart/form-data">
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
                        <div class="row">

                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="product_code" class="form-label"> Code <span class="text-danger">*</span></label>
                                    <input type="text" disabled id="product_code" value="{{ $product->product_code }}" class="form-control @error('product_code') is-invalid @enderror"  name="product_code" placeholder="e.g : p001">
                                    @error('product_code')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                        <div class="mb-3">
                            <label for="product-name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="product-name" name='product_name' value="{{ $product->product_name }}" class="form-control  @error('product_name') is-invalid @enderror" placeholder="e.g : Apple iMac">
                            @error('product_name')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                            </div>
                    </div>



                        <div class="mb-3">
                            <label for="product-category" class="form-label">Product Category <span class="text-danger">*</span></label>
                            <div class="d-flex">
                              

                                <select name="category_id" class="form-select" id="example-select">
                                    <option selected disabled >Select Category </option>
                                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}"  {{ $cat->id == $product->category_id ? 'selected' : ''  }}>{{ $cat->name }}</option>
                                     @endforeach
                                </select> 

                
                                <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#signup-modal"><span class="fas fa-plus-square"></span></button>
                                @error('category_id')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>







                        <div class="mb-3">
                            <label for="product-category" class="form-label">Brand <span class="text-danger">*</span></label>
                            <div class="d-flex">
                              
                                    <select name="brand" class="form-select  @error('brand') is-invalid @enderror" id="example-select">
                                        <option selected disabled >Select Brand </option>
                                        @foreach($brand as $brand)
                            <option value="{{ $brand->id }}"  {{ $brand->id == $product->brand_id ? 'selected' : ''  }}>{{ $brand->name }}</option>
                                         @endforeach
                                    </select> 
                                <button class="btn btn-primary me-2" type="button"><span class="fas fa-plus-square"></span></button>
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
             
                <select name="purchase_unit" class="form-select @error('purchase_unit') is-invalid @enderror" id="example-select">
                    <option selected disabled >Select Unit </option>
                    @foreach($unit as $purchase_unit)
        <option value="{{ $purchase_unit->id }}"  {{ $purchase_unit->id == $product->purchase_unit_id ? 'selected' : ''  }}>{{ $purchase_unit->name }}</option>
                     @endforeach
                </select> 

                <button class="btn btn-primary me-2" type="button"><span class="fas fa-plus-square"></span></button>
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
             
                <select name="sale_unit" class="form-select @error('sale_unit') is-invalid @enderror" id="example-select">
                    <option selected disabled >Select Unit </option>
                    @foreach($unit as $sale_unit)
        <option value="{{ $sale_unit->id }}"  {{ $sale_unit->id == $product->sale_unit_id ? 'selected' : ''  }}>{{ $sale_unit->name }}</option>
                     @endforeach
                </select> 

                <button class="btn btn-primary me-2" type="button"><span class="fas fa-plus-square"></span></button>
                @error('purchase_unit')
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
                                    <input type="number" class="form-control @error('buying_price') is-invalid @enderror" name="buying_price" id="product-meta-title" value="{{ $product->buying_price }}" placeholder="Enter purchase Price">
                                    @error('buying_price')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="product-meta-title" class="form-label"> Selling Price<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" value="{{ $product->selling_price }}" id="product-meta-title" placeholder="Enter selling Price">
                                    @error('selling_price')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                           </div>
                      
                           <div class="mb-3">
                            <label for="product-description" class="form-label">Product Description <span class="text-danger"></span></label>
                            <textarea class="ckeditor form-control @error('wysiwyg-editor') is-invalid @enderror"  name=" description"> {{ $product->description }} </textarea>
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
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="example-fileinput" class="form-label"></label>
            <img name='product_image' style="height: 100px; width: 100px" src="{{ (!empty($product->product_image)) ? url('upload/product/'.$product->product_image) : url('upload/no_image.jpg') }}" class=" avatar-lg img-thumbnail">
        </div>  
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <div class="mb-3">
            <label for="example-fileinput" class="form-label"></label>
            <img id="showImage" name='product_image' style="height: 100px;width: 100px" src="{{ url('upload/no_image.jpg') }}" class="rounded -circle avatar-lg img-thumbnail" alt="profile-image">
        </div>  
    </div>
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
                           value="{{ $product->sku}}" id="product-meta-title" placeholder="Enter title">
                            @error('sku')
                            <span class="text-danger"> {{ $message }} </span>
                                  @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-category" class="form-label">Supplier <span class="text-danger"></span></label>
                            <div class="">
                                <select name="supplier_id" class="form-select" id="example-select">
                                    <option selected disabled >Select Supplier </option>
                                    @foreach($supplier as $sup)
                        <option value="{{ $sup->id }}"  {{ $sup->id == $product->supplier_id ? 'selected' : ''  }}>{{ $sup->name }}</option>
                                     @endforeach
                                </select> 
                                @error('supplier_id')
                                <span class="text-danger"> {{ $message }} </span>
                                      @enderror

                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="mb-3">
                            <label for="product-meta-title" class="form-label"> Buying Date<span class="text-danger"></span></label>
                           
                            <input type="date" class="form-control @error('buying_date') is-invalid @enderror" value="{{ $product->buying_date }}" name="buying_date" id="product-meta-title" placeholder="Enter buy date ..">
                            @error('buying_date')
                            <span class="text-danger"> {{ $message }} </span>
                                  @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-meta-title" class="form-label"> Expiry Date<span class="text-danger"></span></label>
                           
                            <input type="date" class="form-control @error('expire_date') is-invalid @enderror" value="{{ $product->expire_date }}" name="expire_date" id="product-meta-title" placeholder="Enter expiry date ..">
                            @error('expire_date')
                            <span class="text-danger"> {{ $message }} </span>
                                  @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product-price">Alert qty <span class="text-danger"></span></label>
                            <input type="number" class="form-control @error('alertqty') is-invalid @enderror" id="alertqty" value="{{ $product->alertqty }}" name="alertqty" placeholder="Enter alert qty ..">
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


                                {{-- modal --}}
                                <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form class="px-3" method="post" id="form2" action="{{ route('category.store') }}">
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
                                                        <input id="category-input" value="{{ old('name') }}" class="form-control @error('name') is-invalid-c @enderror " type="text" name="name" placeholder="Add Category">
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
                                
                                {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
                                <script>
                                   
                                   
      $(document).ready(function() {
    if ($(".is-invalid-c").length) {
        // If there are, open the modal again
        $('#signup-modal').modal('show');
    }

    $('#cancel-btn').click(function(e) {
        e.preventDefault(); // Prevent the form from submitting
        $('#signup-modal').modal('hide');
        $('#category-input').val(''); // Reset the input field
        $('.is-invalid').removeClass('is-invalid'); // Remove the 'is-invalid' class
        $('.text-danger').text(''); // Clear the validation error message
    });
});

                                </script>
                                
                                {{-- end modal --}}

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




@endsection