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
      <a href="{{ route('add.employee.attend') }}" class="btn btn-primary rounded- pill waves-effect waves-light"><span class="fas fa-plus-square"></span>  Attendance  </a>  
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Employee Attendance</h4>
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
                                <th>#</th> 
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>


        <tbody>
        	@foreach($allData as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td> 
                <td>{{ date('Y-m-d', strtotime($item->date))  }}</td>
                <td>
                    <a href="{{ route('employee.attend.edit',$item->date) }} " class="btn btn-blue btn-sm rounded- pill waves-effect waves-light"><span class="fas fa-edit"></span></a>
                    <a href="{{ route('employee.attend.view',$item->date) }}" class="btn btn-info btn-sm rounded- pill waves-effect waves-light" ><span class="fas fa-eye"></span></a>

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


@endsection 
