@extends('admin.admin_dashboard')
@section('admin')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>



<div class="content">
    <!-- Start Content-->

   
    <div class="container-fluid">

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

        <section style="background-color: #eee;">
            <div class="container py-5">
             
          
              <div class="row">
                <div class="col-lg-4">
                  <div class="card mb-4">
                    <div class="card-body text-center">
                      <img src="{{ (!empty($adminData->photo)) ? url('upload/admin_image/'.$adminData->photo) : url('upload/no_image.jpg') }}" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                      <h5 class="my-3">{{ $adminData->name }}</h5>
                      <p class="text-muted mb-1">{{ $adminData->email }}</p>
                      <p class="text-muted mb-4">{{ $adminData->phone }}</p>
                      <div class="d-flex justify-content-center mb-2">
                        <button type="button" class="btn btn-primary">Follow</button>
                        <button type="button" class="btn btn-outline-primary ms-1">Message</button>
                        <a href="{{ route('admin.profile') }}" type="button"  class="btn btn-primary ms-1">Edit Details</a>

                      </div>
                   
                    </div>
                  </div>
                
                </div>
                
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- end timeline content-->
                                <div class="tab-pane" id="settings">
                                    <form method="post" action="{{ route('update.password') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="firstname" class="form-label">Old Password <span
                                                            class="text-danger"><sup>*</sup></span></label>
                                                    <input type="password" name="old_password"
                                                        class="form-control @error('old_password') is-invalid @enderror"
                                                        id="current_password">
                                                    @error('old_password')
                                                        <span class="text-danger"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="firstname" class="form-label">New Password <span
                                                            class="text-danger"><sup>*</sup></span></label>
                                                    <input type="password" name="new_password"
                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                        id="new_password">
                                                    @error('new_password')
                                                        <span class="text-danger"> {{ $message }} </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Confirm New Password <span
                                                            class="text-danger"><sup>*</sup></span></label>
                                                    <input type="password" name="new_password_confirmation"
                                                        class="form-control" id="new_password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-success waves-effect waves-light mt-4"><i
                                                    class="mdi mdi-content-save"></i> Save</button>
                                        </div>
                                    </form>
                               
                                <!-- end settings content-->
                            </div>
                        </div>
                        <!-- end card-->
                    </div>
                </div>
              </div>
            </div>
          </section>



       
    </div>
    <!-- container -->
</div>
<!-- content -->
@endsection
