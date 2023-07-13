@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>


            <!-- Begin page -->
         
            @php
            use App\Models\Designation; // Replace 'Designation' with the name of your model
            $designation = Designation::all();
        @endphp
            
               
            @php
            use App\Models\Department; // Replace 'Designation' with the name of your model
            $department = Department::all();
        @endphp
            
                
             
            
                    <div class="content">
    
                        <!-- Start Content-->
                        <div class="container-fluid">
    
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                              
                                                <li class="breadcrumb-item"><a class="btn btn-warning" href="{{ route('all.employee') }}">Back</a></li>

                                            </ol>
                                        </div>
                                        <h4 class="page-title">Add Employee</h4>
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
        
                                                  
                                                     <form method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                                                        @csrf
                                                      
                                                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                                                        <div class="row">
                                                            
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="mb-3">
                                                                            <label for="code" class="form-label"> Code <span class="text text-danger">*</span></label>
                                                                            <input type="text" name="code" value="" disabled class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
                                                                            @error('code')
                                                                            <span class="text-danger"> {{ $message }} </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div class="mb-3">
                                                                            <label for="firstname" class="form-label"> Name <span class="text text-danger">*</span></label>
                                                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                                            @error('name')
                                                                            <span class="text-danger"> {{ $message }} </span>
                                                                            @enderror
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                             
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="fname" class="form-label">Father Name <span class="text text-danger">*</span></label>
                                                                    <input type="text" name="fname" class="form-control @error('name') is-invalid @enderror" value="{{ old('fname') }}">
                                                                    @error('fname')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="gender" class="form-label"> Gender <span class="text text-danger">*</span></label>
                                                                    <select name="gender" class="form-select" id="example-select">
                                                                        <option selected disabled>Select Gender</option>
                                                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                                    </select>
                                                                    @error('gender')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="dob" class="form-label">Date Of Birth <span class="text text-danger">*</span></label>
                                                                    <input type="date" value="{{ old('dob') }}" name="dob" class="form-control @error('dob') is-invalid @enderror" >
                                                                    @error('dob')
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
                                                                    <label for="department" class="form-label">Department <span class="text text-danger">*</span></label>
                                                                    <select class="form-select text-info" id="" name="department">
                                                                        @php
                                                                            $selectedDept = old('department');
                                                                        @endphp
                                                                        <option value="" >--Select--</option>
                                                                        @foreach ($department as $department)
                                                                            <option value="{{ $department->id }}" {{  $department->id == $selectedDept ? 'selected' : '' }}>
                                                                                {{ $department->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('department')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                                                <div class="mb-3">
                                                                    <label for="example-fileinput" class="form-label"></label>
                                                                    <img id="showImage" style="height: 100px;width: 100px" src="{{ url('upload/no_image.jpg') }}" class="rounded- circle avatar-lg img-thumbnail" alt="profile-image">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-10">
                                                                <div class="mb-3">
                                                                    <label for="example-fileinput" class="form-label"> Image <span class="text text-danger">*</span></label>
                                                                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                                                                      @error('image')
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                                        @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
        
                                                       <!-- end row -->
        
                                                   
                                                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Company Info <span class="text text-danger">*</span></h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="doj" class="form-label">Date Of Joining <span class="text text-danger">*</span></label>
                                                                    <input type="date" value="{{ old('doj') }}" name="doj" class="form-control @error('doj') is-invalid @enderror" >
                                                                    @error('doj')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="designation" class="form-label">Designation <span class="text text-danger">*</span></label>
                                                                    <select class="form-select text-info" id="designation" name="designation">
                                                                        @php
                                                                            $selectedDesignation = old('designation');
                                                                        @endphp
                                                                        <option value="" >--Select--</option>
                                                                        @foreach ($designation as $designation)
                                                                            <option value="{{ $designation->id }}" {{  $designation->id == $selectedDesignation ? 'selected' : '' }}>
                                                                                {{ $designation->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('designation')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="salary" class="form-label"> Salary <span class="text text-danger">*</span></label>
                                                                    <input type="text" name="salary" value="{{ old('salary') }}" class="form-control @error('salary') is-invalid @enderror">
                                                                    @error('salary')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                <label for="experience" class="form-label"> Experience <span class="text text-danger">*</span></label>
                                                                <select name="experience" class="form-select" id="example-select">
                                                                    <option selected disabled>Select experience</option>
                                                                    <option value="1 Year" {{ old('experience') == '1 Year' ? 'selected' : '' }}>1 Year</option>
                                                                    <option value="2 Year" {{ old('experience') == '2 Year' ? 'selected' : '' }}>2 Year</option>
                                                                    <option value="3 Year" {{ old('experience') == '3 Year' ? 'selected' : '' }}>3 Year</option>
                                                                    <option value="4 Year" {{ old('experience') == '4 Year' ? 'selected' : '' }}>4 Year</option>
                                                                    <option value="5 Year" {{ old('experience') == '5 Year' ? 'selected' : '' }}>5 Year</option>
                                                                </select>
                                                                @error('experience')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            </div> <!-- end col -->
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
                                                                        <label for="phone" class="form-label">Emergency  Contact Number <span class="text text-danger">*</span></label>
                                                                        <input type="number" value="{{ old('ephone') }}" name="ephone" class="form-control @error('ephone') is-invalid @enderror">
                                                                        @error('ephone')
                                                                        <span class="text-danger"> {{ $message }} </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                        </div> <!-- end row -->
        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="city" class="form-label"> City <span class="text text-danger">*</span></label>
                                                                    <input type="text" value="{{ old('city') }}" name="city" class="form-control @error('city') is-invalid @enderror">
                                                                    @error('city')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="firstname" class="form-label"> Address</label>
                                                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror">
                                                                    @error('address')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="mb-3">
                    <label for="additional_info" class="form-label">Additional Info</label>
                    <textarea  name="additionall_info" class="form-control" cols="20" rows="4">{{ old('additionall_info') }}</textarea>
                    @error('additionall_info')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                                                        </div>
                                                      
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