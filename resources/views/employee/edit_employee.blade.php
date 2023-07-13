@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>


            <!-- Begin page -->
         
    

            @php
            use App\Models\Designation; // Replace 'Designation' with the name of your model
            $designation = Designation::all();
        @endphp                

@php
use App\Models\Department; // Replace 'department' with the name of your model
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
                                              
                                                <li class="breadcrumb-item"><a class="btn btn-warning " href="{{ route('all.employee') }}"><span class="fas fa-arrow-left"></span></a></li>
                                                <form method="post" action="{{ route('employee.update') }}" enctype="multipart/form-data">
                                               
                                                    &nbsp;    <button type="submit" class="btn btn-success waves-effect waves-light "><i class="mdi mdi-content-save"></i> Save</button>

                                            </ol>
                                        </div>
                                        <h4 class="page-title">Add Employee</h4>
                                    </div>
                                </div>
                            </div>     
                            <!-- end page title -->
    
                            

                            <div class="row">
                                <div class="col-lg-4 col-xl-4">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <ul class="nav nav-pills nav-fill navtab-bg">
                                                {{-- <li class="nav-item">
                                                    <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        About Me
                                                    </a>
                                                </li> --}}
                                                <li class="nav-item">
                                                    <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                        Profile
                                                    </a>
                                                </li>
                                                {{-- <li class="nav-item">
                                                    <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        Settings
                                                    </a>
                                                </li> --}}
                                            </ul>
                                            <img  style="height: 100px; width: 100px" src="{{ (!empty($employee->image)) ? url('upload/employee/'.$employee->image) : url('upload/no_image.jpg') }}" class="rounded-circle mt-2 avatar-lg img-thumbnail">

                                            <h4 class="mb-0">{{$employee->code}}</h4>
    
                                            <h4 class="mb-0">{{$employee->name}}</h4>
                                            <p class="text-muted">{{$employee->email}}</p>
    
                                            <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                                            <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>
    
                                            <div class="text-start mt-3">
                                                <h4 class="font-13 text-uppercase">About Me :</h4>
                                                <p class="text-muted font-13 mb-3">
                                                    {{$employee->additionall_info}}
                                                  </p>
                                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{$employee->name}}</span></p>
                                            
                                                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">{{$employee->phone}}</span></p>
                                            
                                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2">{{$employee->email}}</span></p>
                                            
                                                <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2">{{$employee->city}}</span></p>
                                            </div>                                    
    
                                            <ul class="social-list list-inline mt-3 mb-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                                </li>
                                            </ul>   
                                        </div>                                 
                                    </div> <!-- end card -->
    
                                  
    
                                </div> <!-- end col-->



                                <div class="col-lg-8 col-xl-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-pills nav-fill navtab-bg">
                                                <li class="nav-item">
                                                    <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        About Me
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                        Timeline
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                        Settings
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="aboutme">
        
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $employee->id }}">
                                                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="firstname" class="form-label">Employee Code</label>
                                                                            <input type="text" disabled name="code" class="form-control @error('code') is-invalid @enderror" value="{{ $employee->code }}"  >
                                                                            @error('code')
                                                                            <span class="text-danger"> {{ $message }} </span>
                                                                            @enderror
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="col-md-8">

                                                                <div class="mb-3">
                                                                    <label for="firstname" class="form-label">Employee Name</label>
                                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $employee->name }}"  >
                                                                    @error('name')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="fname" class="form-label">Father Name</label>
                                                                    <input type="text" name="fname" class="form-control @error('name') is-invalid @enderror" value="{{ $employee->fname }}">
                                                                    @error('fname')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="gender" class="form-label">Employee Gender    </label>
                                                                    <select name="gender" class="form-select @error('gender') is-invalid @enderror" id="example-select">
                                                                    <option selected disabled >Select Gender </option>
                                                                    <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }} >MALE</option>
                                                                    <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }} >FEMALE</option>
                                                                   
                                                                    </select>
                                                                     @error('experience')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                    
                                                                    </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="dob" class="form-label">Date Of Birth</label>
                                                                    <input type="date" value="{{$employee-> dob }}" name="dob" class="form-control @error('dob') is-invalid @enderror" >
                                                                    @error('dob')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
        

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Employee Email</label>
                                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"   value="{{ $employee->email }}"  >
                                                                    @error('email')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                    </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="cnic" class="form-label">CNIC <span class="text text-info">XXXXX-XXXXXXX-X</span></label>
                                                                    <input type="text" name="cnic" class="form-control @error('cnic') is-invalid @enderror" value="{{ $employee->cnic }}">
                                                                    @error('cnic')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                </div>
                                                            </div> <!-- end col -->
                                                         
                                                        </div> <!-- end row -->

                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                            <label for="designation">  Department</label>
                                                           
                                    
                                                            <select class="form-select " id="designation" name="department">
                                                                <option value="">--Select--</option>
                                                            
                                                                @foreach ($department as $department)
                                                                  
                                                                <option value="{{ $department->id }}" {{ $department->id == $employee->department_id ? 'selected' : '' }}>
                                                                    {{ $department->name }}
                                                                </option>
                                                                {{-- <option value="{{ $designation->id }}" {{ $employee->designation == $name->name ? 'selected' : '' }}>{{ $name->name }}</option> --}}
                                                                @endforeach
                                                            </select>
                                                            @error('department')
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="row">
                                                            <div class="col-md-3 d-flex align-items-center justify-content-center">
                                                                <div class="mb-3">
                                                                    <label for="example-fileinput" class="form-label"></label>
                                                                    <img id="showImage" src="{{ asset("upload/employee/".$employee->image) }}" class="rounded -circle avatar-lg img-thumbnail" alt="profile-image">
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-9">
                                                                <div class="mb-3">
                                                                    <label for="example-fileinput" class="form-label">Employee Image</label>
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
        
                                                   
                                                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Company Info</h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="doj" class="form-label">Date Of Joining</label>
                                                                <input type="date" value="{{$employee-> joiningdate }}" name="doj" class="form-control @error('doj') is-invalid @enderror" >
                                                                @error('doj')
                                                                <span class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                            </div>
                                                            </div>
                                                            
                                                                <div class="col-md-6">
                                                                <div class="mb-3">
                                                            <label for="designation">  designation</label>
                                                           
                                    
                                                            <select class="form-select " id="designation" name="designation">
                                                                <option value="">--Select--</option>
                                                            
                                                                @foreach ($designation as $designation)
                                                                  
                                                                <option value="{{ $designation->id }}" {{ $designation->id == $employee->designation_id ? 'selected' : '' }}>
                                                                    {{ $designation->name }}
                                                                </option>
                                                                {{-- <option value="{{ $designation->id }}" {{ $employee->designation == $name->name ? 'selected' : '' }}>{{ $name->name }}</option> --}}
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
                                                                <label for="firstname" class="form-label">Employee Salary    </label>
                                                                <input type="text" name="salary" class="form-control @error('salary') is-invalid @enderror"   value="{{ $employee->salary }}"  >
                                                                @error('salary')
                                                                <span class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="gender" class="form-label">Previous Experience    </label>
                                                                    <select name="experience" class="form-select @error('experience') is-invalid @enderror" id="example-select">
                                                                    <option selected disabled >Select Year </option>
                                                                    <option value="1 Year" {{ $employee->experience == '1 Year' ? 'selected' : '' }} >1 Year</option>
                                                                    <option value="2 Year"  {{ $employee->experience == '2 Year' ? 'selected' : '' }}>2 Year</option>
                                                                    <option value="3 Year" {{ $employee->experience == '3 Year' ? 'selected' : '' }}>3 Year</option>
                                                                    <option value="4 Year" {{ $employee->experience == '4 Year' ? 'selected' : '' }}>4 Year</option>
                                                                    <option value="5 Year" {{ $employee->experience == '5 Year' ? 'selected' : '' }}>5 Year</option>
                                                                    </select>
                                                                     @error('experience')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                    
                                                                    </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
        
                                                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Address Details</h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="firstname" class="form-label">Employee Mobile Number    </label>
                                                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"  value="{{ $employee->phone }}"   >
                                                                @error('phone')
                                                                <span class="text-danger"> {{ $message }} </span>
                                                                @enderror
                                                                </div></div>
                                                                <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="firstname" class="form-label">Emergency Phone no    </label>
                                                                    <input type="number" name="ephone" class="form-control @error('ephone') is-invalid @enderror"  value="{{ $employee->ephone }}"   >
                                                                    @error('ephone')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                    </div></div> <!-- end col -->
                                                        </div> <!-- end row -->
        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="firstname" class="form-label">Employee City    </label>
                                                                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"  value="{{ $employee->city }}"   >
                                                                    @error('city')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                    </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="firstname" class="form-label">Employee Address    </label>
                                                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"  value="{{ $employee->address }}"   >
                                                                    @error('address')
                                                                    <span class="text-danger"> {{ $message }} </span>
                                                                    @enderror
                                                                    </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                                        <div class="row">
                                                            <div class="mb-3">
                                                    <label for="additional_info" class="form-label">BIO</label>
                                                    <textarea name="additionall_info" class="form-control" cols="20" rows="4">{{ $employee->additionall_info }}</textarea>
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