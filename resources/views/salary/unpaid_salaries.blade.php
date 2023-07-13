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
                            <a href="{{ route('pay.salary') }}" class="btn btn-outline-warning waves-effect waves-light">Back</a>
                        </ol>
                    </div>
                    <h4 class="page-title">Previous Unpaid Month Salary</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="mb-3">
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
                    <div class="col-md-4">
                        <label for="yearFilter" class="form-label">Search Employee:</label>
                        
                        <input type="text" name="employeeName" id="employeeName" class="form-control" placeholder="Search employee name" style="height: 45px" >
                        
                    </div>
                   
                    
                </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <table id="basic-datatable1" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paidsalary as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <img style="height: 40px; width: 40px" src="{{ (!empty($item['employee']['image'])) ? url('upload/employee/'.$item->employee->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
                                    </td>

                                    <td>{{ $item['employee']['name'] }}</td>
                                    <td><span class="badge bg-info">{{ $item->salary_month }}</span></td>
                                    <td><span class="badge bg-info">{{ $item->salary_year }}</span></td>
                                    <td>{{ $item['employee']['salary'] }}</td>
                                    <td><span class="badge bg-success">{{ $item->salary_status }}</span></td>

                                    <td>
                                        <form method="post" action="{{ route('salary.pay_unpaid_salary') }}">
                                            <input name="employee_id" type="hidden" value="{{ $item->employee_id }}">
                                            <input name="salary_month" type="hidden" value="{{ $item->salary_month }}">
                                            <input name="salary_year" type="hidden" value="{{ $item->salary_year }}">
                                            <input name="salary_status" type="hidden" value="{{ $item->salary_status }}">

                                            @csrf
                                            <button type="submit" class="btn btn-blue rounded-pill waves-effect waves-light">PayNow</button>
                                          </form>
                                          
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
    $(document).ready(function() {
        var dataTable = $('#basic-datatable1').DataTable();

        $('#monthFilter, #yearFilter').change(function() {
            var selectedMonth = $('#monthFilter').val();
            var selectedYear = $('#yearFilter').val();

            dataTable.column(3).search(selectedMonth).column(4).search(selectedYear).draw();
        });
    });
</script>

<script>
    $(document).ready(function () {
       $('#employeeName').on('keyup', function () {
          var searchText = $(this).val().toLowerCase();
          $('tbody tr').each(function () {
             var employeeName = $(this).find('td:eq(2)').text().toLowerCase();
             if (employeeName.includes(searchText)) {
                $(this).show();
             } else {
                $(this).hide();
             }
          });
       });
    });
 </script>

@endsection
