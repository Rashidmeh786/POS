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
      <a href="{{ route('add.advance.salary') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Advance Salary </a>  
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Advance Salary</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Month</th>
                                <th>Salary</th>
                                <th>Advance</th>
                                <th>Action</th>
                            </tr>
                        </thead>


        <tbody>
        	@foreach($salary as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                {{-- <td> <img src="{{ asset($item->employee->image) }}" style="width:50px; height: 40px;"> </td> --}}
               <td>
                <img style="height: 40px; width: 40px" src="{{ (!empty($item['employee']['image'])) ? url('upload/employee/'.$item->employee->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
            </td>
                <td>{{ $item['employee']['name'] }}</td>
                <td>{{ $item->month }}</td>
                <td>{{ $item['employee']['salary'] }}</td>
                <td>{{ $item->advance_salary }}</td>
 <td>
        <a href="#" class="btn btn-sm btn-info">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ route('edit.advance.salary', $item->id) }}" class="btn btn-sm btn-primary">
        <i class="fas fa-edit"></i>
    </a>
    <a href="{{ route('delete.advanceSalary', $item->id) }}" id="delete" class="btn btn-sm btn-danger">
        <i class="fas fa-trash-alt"></i>
    </a>
    
</td>



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