

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
                            <li class="breadcrumb-item"><a href="{{ route('all.permission' )}}" class="btn btn-info"><span class="fas fa-arrow-circle-left"></span></a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Add Permission</h4>
                </div>
            </div>
        </div>    <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <!-- end timeline content-->
                        <div class="tab-pane" id="settings">
                            <form id="myForm" method="post" action="{{ route('permission.store') }}" enctype="multipart/form-data">
                                @csrf
    
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Permission</h5>
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Permission Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                                        </div>
                                        @error('name')
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="firstname" class="form-label">Group Name</label>
                                            <select name="group_name" class="form-select @error('group_name') is-invalid @enderror" id="example-select">
                                                <option selected disabled>Select Group</option>
                                                <option value="pos">Pos</option>
                                                <option value="employee">Employee</option>
                                                <option value="customer">Customer</option>
                                                <option value="supplier">Supplier</option>
                                                <option value="salary">Salary</option>
                                                <option value="attendence">Attendence</option>
                                                <option value="category">Category</option>
                                                <option value="product">Product</option>
                                                <option value="expense">Expense</option>
                                                <option value="orders">Orders</option>
                                                <option value="stock">Stock</option>
                                                <option value="roles">Roles</option>
                                            </select>
                                            @error('group_name')
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
    
    @endsection    