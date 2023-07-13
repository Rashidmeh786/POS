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
                        <a href="{{ route('add.customer') }}" class="btn btn-danger waves-effect waves-lightt"> <i class="mdi mdi-plus-circle me-1"></i>Add New </a>  
                    </div>
                    <h4 class="page-title">All Customers</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
    <h4 class="header-title">All Customers</h4>

    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>ShopName</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        	@foreach($customer as $key=> $customer)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>   <img style="height: 40px; width: 40px" src="{{ (!empty($customer->image)) ? url('upload/customer/'.$customer->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
                {{-- <td>    <img   src="{{ url('upload/employee/'.$employee->image) }}" class="rounded-circle avatar-lg img-thumbnail"> --}}
         
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->shopname }}</td>
               
             
                <td>
                    {{-- <label class="btn btn-sm btn-{{ $employee->status === 'active' ? 'success' : 'danger' }}  toggle-employee-status" data-employee-id="{{ $employee->id }}">
                        {{ ucfirst($employee->status) }}
                    </label> --}}
                    <span class="badge bg-soft-success text-success">Active</span>
                </td>
                <td>
                    <a href="{{ route('details.customer', $customer->id) }}" class="btn btn-sm btn-info" >
                        <i class="fas fa-eye"></i></a>
                    <a href="{{ route('edit.customer', $customer->id) }}" class="btn btn-sm btn-primary" >
                        <i class="fas fa-edit"></i></a>
                        <a href="{{ route('delete.customer' ,$customer->id) }}" id="delete" class="btn btn-sm btn-danger"  >
                            <i class="fas fa-trash-alt"></i></a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div> <!-- end card body-->
</div> <!-- end card -->
</div><!-- end col-->
</div>
<!-- end row-->




    </div> <!-- container -->

</div> <!-- content -->



<script>

$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  }) 


    });

  });

</script>

  @endsection