@extends('admin.admin_dashboard')
@section('admin')
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>


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

<div class="row">


<div class="col-lg-8 col-xl-12">
<div class="card">
<div class="card-body">





<!-- end timeline content-->

<div class="tab-pane" id="settings">

    <form method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
        @csrf
    
        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Employee</h5>
    
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="firstname" class="form-label">Employee Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fname" class="form-label">Father Name</label>
                    <input type="text" name="fname" class="form-control @error('name') is-invalid @enderror" value="{{ old('fname') }}">
                    @error('fname')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    {{-- <label for="cnic" class="form-label">CNIC  <span class="text text-warning text-sm"><sup>XXXXX-XXXXXXX-X</sup></span></label> --}}
                    <label for="cnic" class="form-label">CNIC  <span class="text text-warning text-sm">XXXXX-XXXXXXX-X</span></label>
                    <input type="text" name="cnic" class="form-control "value="{{ old('cnic') }}">
                    @error('cnic')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="date" value="{{ old('dob') }}" name="dob" class="form-control @error('dob') is-invalid @enderror" >
                    @error('dob')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="doj" class="form-label">Date Of Joining</label>
                    <input type="date" value="{{ old('dob') }}" name="doj" class="form-control @error('doj') is-invalid @enderror" >
                    @error('doj')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="firstname" class="form-label">Employee Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" >
                    @error('email')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="firstname" class="form-label">Employee Mobile Number</label>
                    <input type="text" value="{{ old('phone') }}" name="phone" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="phone" class="form-label">Emergency  Contact Number</label>
                    <input type="number" value="{{ old('ephone') }}" name="ephone" class="form-control @error('ephone') is-invalid @enderror">
                    @error('ephone')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="firstname" class="form-label">Employee Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror">
                    @error('address')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="gender" class="form-label">Employee Gender</label>
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
                    <label for="experience" class="form-label">Employee Experience</label>
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
            </div>
            

    
        
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="designation" class="form-label">Employee Designation</label>
                    <input type="text" value="{{ old('designation') }}" name="designation" class="form-control @error('designation') is-invalid @enderror">
                    @error('designation')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="salary" class="form-label">Employee Salary</label>
                    <input type="text" name="salary" value="{{ old('salary') }}" class="form-control @error('salary') is-invalid @enderror">
                    @error('salary')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="city" class="form-label">Employee City</label>
                    <input type="text" value="{{ old('city') }}" name="city" class="form-control @error('city') is-invalid @enderror">
                    @error('city')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="example-fileinput" class="form-label"></label>
                    <img id="showImage" style="height: 100px;width: 100px" src="{{ url('upload/no_image.jpg') }}" class="rounded- circle avatar-lg img-thumbnail" alt="profile-image">
                </div>
            </div>

    
          
          
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="additional_info" class="form-label">Additional Info</label>
                    <textarea  name="additionall_info" class="form-control" cols="20" rows="4">{{ old('additionall_info') }}</textarea>
                    @error('additionall_info')
                    <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>
          
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="example-fileinput" class="form-label">Employee Image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                      @error('image')
                  <span class="text-danger"> {{ $message }} </span>
                        @enderror
                </div>
            </div>
    
        </div> <!-- end row -->
    

        <div class="text-end">
            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
        </div>
    </form>
    

</div>
<!-- end settings content-->


                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->



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