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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit User</a></li>

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit User</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">


  <div class="col-lg-8 col-xl-12">
<div class="card">
    <div class="card-body">




        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> User Details <span class="text text-danger">*</span></h5>

    <!-- end timeline content-->

    <div class="tab-pane" id="settings">
        <form id="myForm" method="post" action="{{ route('update.user') }}" enctype="multipart/form-data">
        	@csrf

            <input type="hidden" name="id" value="{{ $adminuser->id }}">

            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit User</h5>

            <div class="row">


    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label"> Name<span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $adminuser->name }}"   >
            @error('name')
            <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
    </div>

      <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label"> Email<span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control"  value="{{ $adminuser->email }}"   >
            @error('email')
            <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
    </div>


      <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label"> Phone<span class="text-danger">*</span></label>
            <input type="text" name="phone" class="form-control"  value="{{ $adminuser->phone }}"   >
            @error('phone')
            <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
    </div>



      <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="firstname" class="form-label">Asign Roles </label>
            <select name="roles" class="form-select" id="example-select">
                    <option selected disabled >Select Roles </option>
                    @foreach($roles as $role)
        <option value="{{ $role->id }}" {{ $adminuser->hasRole($role->name) ? 'selected' : '' }} >{{ $role->name }}</option>
                     @endforeach
                </select>

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
