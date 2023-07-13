@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
<style>
    .disabled-button {
        opacity: 0.5;
        pointer-events: none;
        cursor: not-allowed;
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
                            <a href="{{ route('month.salary') }}" class="btn btn-primary rounded -pill waves-effect waves-light">Show Salary History</a>
                           
                           &nbsp; &nbsp; <a href="{{ route('add.advance.salary') }}" class="btn btn-primary rounded -pill waves-effect waves-light">Add Advance Salary</a>
                        </ol>
                        
                    </div>

                    <h4 class="page-title"> Pay Salary</h4>
                    <h4 class="header-title">Current Month : {{ date("F Y") }}</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="header-title">{{ date("F Y") }}</h4> --}}

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Salary</th>
                                    <th>Advance</th>
                                    <th>To Pay</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee as $key=> $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <img style="height: 40px; width: 40px" src="{{ (!empty($item['image'])) ? url('upload/employee/'.$item->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td><span class="badge bg-info">{{ date("F", strtotime('-1 month')) }}</span></td>
                                    <td><span class="badge bg-info">{{ date("Y") }}</span></td>
                                    <td>{{  $item->salary }}</td>
                                    <td>
                                        @if(!$item->advance || $item->advance->advance_salary === null)
                                        <p>No Advance</p>
                                        @else
                                        {{ $item->advance->advance_salary }}
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                        $amount = $item->salary - ($item->advance ? $item->advance->first()->advance_salary : 0);
                                        @endphp
                                        <strong style="color: #ce2121;">{{ round($amount) }}</strong>
                                    </td>
                                    {{-- <td id="sal_status">
                                        @php
                                            $paysalary = $item->paysalary()->where('salary_month', $previousMonth)->first();
                                        @endphp
                            
                                        @if ($paysalary)
                                            <span class="badge bg-info">{{ $paysalary->salary_status }}</span>
                                        @else
                                            <span class="badge bg-primary">Unpaid</span>
                                        @endif
                                    </td> --}}
                                    

                                    <td id="sal_status">
                                        @php
                                        $paysalary = $item->paysalary()->where('salary_month', $previousMonth)->first();
                                        @endphp
                                      
                                        @if ($paysalary)
                                        <span class="badge bg-info" data-status="{{ $paysalary->salary_status }}">{{ $paysalary->salary_status }}</span>
                                        @else
                                        <span class="badge bg-primary" data-status="unpaid">Unpaid</span>
                                        @endif
                                      </td>
                                      
                                    <td>
                                        <a href="{{ route('pay.now.salary',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light pay-now-btn disabled-button">Pay Now</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div><!-- end row-->
    </div> <!-- container -->
</div> <!-- content -->

{{-- <script>
    $(document).ready(function() {
        $('.pay-now-btn').each(function() {
            var statusText = $(this).closest('tr').find('#sal_status span').text().trim();
            if (statusText === 'Unpaid') {
                $(this).removeClass('disabled-button');
            }
        });
    });
</script> --}}

<script>
    $(document).ready(function() {
  $('.pay-now-btn').each(function() {
    var statusValue = $(this).closest('tr').find('#sal_status span').data('status'); // Assuming the status value is stored in a data attribute, e.g., data-status="paid"

    if (statusValue === 'unpaid') {
      $(this).removeClass('disabled-button');
    }
  });
});

</script>
@endsection
