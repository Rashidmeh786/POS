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
                            <li class="breadcrumb-item">
                                <a href="{{ route('month.salary') }}" class="btn btn-outline-warning waves-effect waves-light">Back</a>
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Employee History Salary</h4>
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
                                    <th>Paid</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salaryHistory as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img style="height: 40px; width: 40px" src="{{ (!empty($item['employee']['image'])) ? url('upload/employee/'.$item->employee->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
                                    </td>
                                    <td>{{ $item['employee']['name'] }}</td>
                                    <td>{{ $item->salary_month }}</td>
                                    <td>{{ $item['employee']['salary'] }}</td>
                                    <td>{{ $item->advance_salary ?? 0 }}</td>
                                    <td>{{ $item->due_salary}}</td>
                                    <td><span class="badge bg-success">{{ $item->salary_status }}</span></td>
                                    <td>
                                       <a target="_blank" href="{{ url('print/salary/report/'.$item->employee_id)}}" class="btn btn-blue rounded-pill waves-effect waves-light">Print</a>
                                        {{-- <a href="{{ route('salary.printEmpReport',$item->employee_id)}}" class="btn btn-blue rounded-pill waves-effect waves-light">Print</a>  --}}
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
