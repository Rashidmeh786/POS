@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
 <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Profile</a></li>

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Admin Profile</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">
    <div class="col-lg-4 col-xl-4">
        <div class="card text-center">
            <div class="card-body">  
                <img  style="height: 100px; width: 100px" src="{{ (!empty($adminData->photo)) ? url('upload/admin_image/'.$adminData->photo) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
               
              
                <h4 class="mb-0">{{ $adminData->name }}</h4>
                <p class="text-muted">{{ $adminData->email }}</p>

                <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>

                <div class="text-start mt-3">


                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">{{ $adminData->name }}</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">{{ $adminData->phone }}</span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2">{{ $adminData->email }}</span></p>

                    <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2"> Location </span></p>
                </div>                                    

                <ul class="social-list list-inline mt-4 mb-0">
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





    <!-- end timeline content-->


    
    <div class="tab-pane" id="settings">
        <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
            @csrf
            <h5  class="mb-4 text-uppercase text- end"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="example-fileinput" class="form-label"> </label>
                    <img style="height: 100px; width: 100px" id="showImage" src="{{ (!empty($adminData->photo)) ? url('upload/admin_image/'.$adminData->photo) : url('upload/no_image.jpg') }}" class="rounded -circle avatar-lg img-thumbnail" alt="profile-image">
                </div>
            </div> <!-- end col -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" required name="name" class="form-control" id="firstname" value="{{ $adminData->name }}" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Email</label>
                        <input type="email" required name="email" class="form-control" id="email"  value="{{ $adminData->email }}" >
                    </div>
                </div> <!-- end col -->
    <div class="col-md-6">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Phone</label>
                        <input type="text" required name="phone" class="form-control" id="phone"  value="{{ $adminData->phone }}" >
                    </div>
                </div> <!-- end col -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Admin Profile Image</label>
                        <input type="file" name="photo" id="image" class="form-control">
                    </div>
                </div> <!-- end col -->
                
            
            
            <div class="text-end">
                <button type="submit" class="btn btn-success waves-effect waves-light "><i class="mdi mdi-content-save"></i> Save</button>
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





                                    {{-- -----change password section---- --}}

                                    <div class="content">

                                        <!-- Start Content-->
                                        <div class="container-fluid">
                    
                                            <!-- start page title -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="page-title-box">
                                                        <div class="page-title-right">
                                                            <ol class="breadcrumb m-0">
                                                                <li class="breadcrumb-item "><a href="javascript: void(0);">Change Password</a></li>
                    
                                                            </ol>
                                                        </div>
                                                        <h4 class="page-title">Change Password </h4>
                                                    </div>
                                                </div>
                                            </div>     
                                            <!-- end page title -->
                    
                    <div class="row">
                    
                    
                                                <div class="col-lg-12 col-xl-12">
                                                    <div class="card">
                                                        <div class="card-body">
                    
                    
                    
                    
                    
                        <!-- end timeline content-->
                    
                        <div class="tab-pane" id="settings">
                            <form method="post"  action="{{ route('update.password') }}" >
                                @csrf
                    
                    
                                <div class="row">
                    
                    
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Old Password <span class="text-danger"><sup>*</sup></span></label>
                                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="current_password" >
                                 @error('old_password')
                               <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    
                    
                    
                         <div class="col-md-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">New Password <span class="text-danger"><sup>*</sup></span></label>
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" >
                                 @error('new_password')
                               <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    
                    
                         <div class="col-md-12">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Confirm New Password <span class="text-danger"><sup>*</sup></span></label>
                                <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" >
                    
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
                    



@endsection