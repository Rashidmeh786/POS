@extends('admin.admin_dashboard')

@section('admin')
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('all.users') }}" class="btn btn-outline-primary rounded-pill waves-effect waves-light">Back</a>
                        </ol>
                    </div>
                    <h4 class="page-title">Add User</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> User Details <span class="text-danger">*</span></h5>

                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Admin</h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Phone<span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Assign Roles</label>
                                            <select name="roles" class="form-select" id="example-select">
                                                <option selected disabled>Select Roles</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
