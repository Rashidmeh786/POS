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
             <a href="{{ route('all.roles') }}"class="btn btn-primary rounded- pill waves-effect waves-light"> <span class="fas fa-plus-square"> </span> Add New</a>  
                                      
                                   </ol>
                                    </div>
                                    <h4 class="page-title">All Roles</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                      

    <div class="row">
<div class="col-4">


        <div class="card ribbon-box">
            <div class="card-body">
                <div class="ribbon ribbon-info float-start"><i class="mdi mdi-access-point me-1 "></i> Update</div>
                <h5 class="text-info float-end mt-0">Update Role</h5>
                <div class="ribbon-content">
                    <form action="{{ route('roles.update') }}" method="post" >
                @csrf
                <input type="hidden" name="id" value="{{ $role->id }}">
                <label for="firstname" class="form-label">Role Name <span class="text text-danger">*</span></label>
                <input type="text" name="name" value="{{ $role->name }}" placeholder="Enter New Role Name.." class="form-control mb-2 @error('name') is-invalid @enderror">
            
            @error('name')
            <span class="text-danger"> {{ $message }} </span>
            @enderror
            <button type="submit" class="btn btn-info mt-2 p-1 form-control"> Update Role</button>
        </form>
                </div>
            </div>
        </div>


      </div>


        <div class="col-8">
            <div class="card">
                <div class="card-body">


                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role Name </th>
                              
                                <th>Action</th>
                            </tr>
                        </thead>


        <tbody>
        	@foreach($roles as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td> 
                <td>{{ $item->name }}</td>
              
                <td>
<a href="{{ route('edit.role',$item->id) }}" class="btn btn-blue rounded- pill waves-effect waves-light btn-sm"><span class="fas fa-edit"></span></a>
<a href="{{ route('delete.role',$item->id) }}" class="btn btn-danger rounded- pill waves-effect waves-light btn-sm" id="delete"><span><i class="fas fa-trash" aria-hidden="true"></i></span></a>

                </td>
            </tr>
            @endforeach
        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
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
