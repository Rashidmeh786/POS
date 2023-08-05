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
                       
                        <a href="{{ route('add.expense') }}" class="btn btn-outline-primary rounded- pill btn-lg waves-effect waves-light">Create New </a>  
                       
                        {{-- <a href="{{ route('add.expense') }}" class="btn btn-outline-primary waves-effect waves-light p-1 text-lg"> <i class="mdi mdi-plus-circle me-1"></i>Add New </a>   --}}
                    </div>
                    <h4 class="page-title">All Expenses</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
    <h4 class="header-title">All Expenses</h4>

    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Expense Title</th>
                <th>Expense Category</th>
                <th>Expense Amount</th>
                <th>Recorded By</th>
                {{-- <th>Expiry Status</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($Expenses as $key => $item)
            <tr>
               
              
                <td>{{ $item->ref_no }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category->name ??"NA" }}</td>
               
                <td>{{ $item->amount }}</td>
                <td>{{ $item->user->name}}</td>
               
               
                <td>
                    <a href="{{ route('show.expense', $item->id)}}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('edit.expense', $item->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('delete.expense', $item->id) }}" id="delete" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                   
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