@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<style>
    /* Print Stylesheet */
    @media print {
        /* Hide elements that should not be printed */
        .no-print {
            display: none;
        }

        /* Adjust the layout for printing */
        body {
            font-size: 12px;
        }

        table {
            width: 100%;
        }

        th, td {
            padding: 8px;
        }
    }
</style>

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('employee.attendance.list') }} " class="btn btn-blue btn-lg rounded-pill waves-effect waves-light no-print"><span class="fas fa-arrow-circle-left"></span></a>
                        </ol>
                    </div>
                    <h4 class="page-title"> Employee Attendance Detailed History</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-md-4">
                <label for="monthFilter" class="form-label">Select Month:</label>
                <select id="monthFilter" class="form-select" style="height: 45px">
                    <option value="">All</option>
                    @foreach ($availableMonths as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="yearFilter" class="form-label">Select Year:</label>
                <select id="yearFilter" class="form-select" style="height: 45px">
                    <option value="">All</option>
                    @foreach ($availableYears as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
           
            
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Attend Status</th>
                                    <th>Time In</th>
                                    <th>Attendance History</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $key=> $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <img style="height: 40px; width: 40px" src="{{ (!empty($item['employee']['image'])) ? url('upload/employee/'.$item->employee->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
                                    </td>
                                    <td>{{ $item['employee']['name'] }}</td>
                                    <td>{{ date('Y-m-d',strtotime($item->date)) }}</td>
                                    <td>{{  $item->attend_status }}</td>
                                    <td>{{  $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('attendance.printReport',$item->employee->id) }}" class="btn btn-info btn-sm rounded-pill waves-effect waves-light no-print" target="_blank">
                                            <span class="fas fa-print">  Print</span>
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

@endsection
