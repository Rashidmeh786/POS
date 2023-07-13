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
                        <a href="{{ route('add.product') }}" class="btn btn-primary waves-effect waves-lightt"> <i class="mdi mdi-plus-circle me-1"></i>Add New </a>  
                    </div>
                    <h4 class="page-title">Expenses</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
    </div>
</div>
  @endsection