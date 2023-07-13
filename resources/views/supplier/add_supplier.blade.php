@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>


            <!-- Begin page -->
         
    
                
             
            
                    <div class="content">
    
                        <!-- Start Content-->
                        <div class="container-fluid">
    
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                              
                                                <li class="breadcrumb-item"><a class="btn btn-danger" href="{{ route('all.supplier') }}">Back</a></li>

                                            </ol>
                                        </div>
                                        <h4 class="page-title">Add Supplier</h4>
                                    </div>
                                </div>
                            </div>     
                            <!-- end page title -->
    
                            

                        
                                <div class="col-lg-12 col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills nav-fill navtab-bg">
                                                {{-- <li class="nav-item">
                                                    <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        About Me
                                                    </a>
                                                </li> --}}
                                                <li class="nav-item">
                                                    <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                        Timeline
                                                    </a>
                                                </li>
                                                {{-- <li class="nav-item">
                                                    <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        Settings
                                                    </a>
                                                </li> --}}
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="aboutme">
        
                                                  
                                                     <form method="post" action="{{ route('supplier.store') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i> Personal Info </span></h5>
                                                   
                                                        
                                                       <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="firstname" class="form-label"> Name <span class="text text-danger">*</span></label>
                                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                                    @error('name')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="shopname" class="form-label">Company Name  <span class="text text-danger">*</span></label>
                                                                    <input type="text" name="shopname" class="form-control @error('shopname') is-invalid @enderror" value="{{ old('shopname') }}">
                                                                    @error('shopname')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                          
                                                        </div> <!-- end row -->
                                                      
        

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="firstname" class="form-label"> Email <span class="text text-danger">*</span></label>
                                                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" >
                                                                    @error('email')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="mb-3">
                                                                {{-- <label for="cnic" class="form-label">CNIC  <span class="text text-warning text-sm"><sup>XXXXX-XXXXXXX-X</sup></span></label> --}}
                                                                <label for="cnic" class="form-label">
                                                                    CNIC
                                                                    <span class="text text-danger text-sm"> * 
                                                                        <sub><small>XXXXX-XXXXXXX-X</small></sub>
                                                                    </span>
                                                                </label>
                                                                
                                                                {{-- <label for="cnic" class="form-label">CNIC  <span class="text text-warning text-sm">XXXXX-XXXXXXX-X</span></label> --}}
                                                                <input type="text" name="cnic" class="form-control "value="{{ old('cnic') }}">
                                                                @error('cnic')
                                                                <span class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- end row -->

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="type" class="form-label">Supplier Type    </label>
                                                                   <select name="type" class="form-select @error('type') is-invalid @enderror" id="example-select">
                                                                            <option selected disabled >Select Type </option>
                                                                            <option value="Distributor">Distributor </option>
                                                                            <option value="Whole Seller">Whole Seller </option> 
                                                                        </select>
                                                                         @error('type')
                                                              <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                        
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                <div class="mb-3">
                                                                    <label for="example-fileinput" class="form-label"></label>
                                                                    <img id="showImage" style="height: 60px;width: 100px" src="{{ url('upload/no_image.jpg') }}" class="rounded- circle avatar-lg img-thumbnail" alt="profile-image">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-5">
                                                                <div class="mb-3">
                                                                    <label for="example-fileinput" class="form-label"> Image <span class="text text-danger">*</span></label>
                                                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                                                      @error('image')
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                                        @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
        
                                                       <!-- end row -->
        
                                                   
                                                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Bank Info </span></h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="bank_name" class="form-label">Bank Name </label>
                                                                    <input type="text" value="{{ old('bank_name') }}" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" >
                                                                    @error('bank_name')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="bank_branch" class="form-label"> Bank Branch </label>
                                                            <input type="text" value="{{ old('bank_branch') }}" name="bank_branch" class="form-control @error('bank_branch') is-invalid @enderror">
                                                            @error('bank_branch')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="salary" class="form-label"> Account Holder </label>
                                                                    <input type="text" name="account_holder" value="{{ old('account_holder') }}" class="form-control @error('account_holder') is-invalid @enderror">
                                                                    @error('account_holder')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="salary" class="form-label"> Account Number </label>
                                                                    <input type="text" name="account_number" value="{{ old('account_number') }}" class="form-control @error('account_number') is-invalid @enderror">
                                                                    @error('account_number')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                           
                                                        </div> <!-- end row -->
        
                                                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Address Details</h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="firstname" class="form-label"> Mobile Number <span class="text text-danger">*</span></label>
                                                                    <input type="text" value="{{ old('phone') }}" name="phone" class="form-control @error('phone') is-invalid @enderror">
                                                                    @error('phone')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="city" class="form-label"> City <span class="text text-danger">*</span></label>
                                                                    <input type="text" value="{{ old('city') }}" name="city" class="form-control @error('city') is-invalid @enderror">
                                                                    @error('city')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                               
                                                        </div> <!-- end row -->
        
                                                        <div class="row">
                                                           
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="address" class="form-label"> Address</label>
                                                                    <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror" cols="10" rows="3">{{ old('address') }}</textarea>
                                                                    @error('address')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                               
                                                            </div>
                                                        </div> <!-- end row -->
                                                       
                                                        </div> 
                                                        
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                                        </div>
                                                    </form>
                                                  
        
                                                </div> <!-- end tab-pane -->
                                                <!-- end about me section content -->
        
                                                <div class="tab-pane  " id="timeline">
        
                                                
                                                
        
                                                </div>
                                                <!-- end timeline content-->
        
                                                <div class="tab-pane" id="settings">
                                                  
                                                </div>
                                                <!-- end settings content-->
        
                                            </div> <!-- end tab-content -->
                                        </div>
                                    </div> <!-- end card-->
    
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
    
                        </div> <!-- container -->
    
                    </div> <!-- content -->
    
                
    
                <!-- ============================================================== -->
                <!-- End Page content -->
                <!-- ============================================================== -->
    
    
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
                    
                    
                    
                    
    


@endsection