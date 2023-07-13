@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<style>
    .table-no-border td {
        border: none;
        border-bottom: 1px solid #dee2e6;
    }
    
    .table-no-border th {
        border: none;
        border-bottom: 1px solid #dee2e6;
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
                            <li class="breadcrumb-item"><a href="{{ route('pay.salary') }}" class="btn btn-light"> Back </a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Paid Salary</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <tr>
                            {{-- <th>Employee Image</th> --}}
                            <td>
                              <img style="height: 100px; width: 100px" src="{{ (!empty($paysalary->image)) ? url('upload/employee/'.$paysalary->image) : url('upload/no_image.jpg') }}" class="rounded- circle avatar-lg img-thumbnail">

                            </td>
                        </tr>
                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('employe.salary.store') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $paysalary->id }}">
                                {{-- <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Paid Salary</h5> --}}

                                <div class="table-responsive mt-4">
                                    <table class="table table-bordered table-no-border">
                                        <tbody>
                                          
                                       
                                            <tr>
                                                <th>Employee Name</th>
                                                <td>
                                                    <strong style="color: #dd1929;">{{ $paysalary->name }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Salary Month</th>
                                                <td>
                                                    <strong style="color: #ce1919;">{{ date("F", strtotime('-1 month')) }}</strong>
                                                    <input type="hidden" name="month" value="{{ date("F", strtotime('-1 month')) }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>
                                                    <strong style="color: #ce1919;">{{ date("Y") }}</strong>
                                                    <input type="hidden" name="year" value="{{ date("Y") }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <strong style="color: #ce1919;">
                                                        @if ($paysalary->paysalary && $paysalary->paysalary->salary_status)
                                                            {{ $paysalary->paysalary->salary_status }}
                                                        @else
                                                            <span>Unpaid</span>
                                                        @endif
                                                    </strong>
                                                    <input type="hidden" name="salary_status" value="paid">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Employee Salary</th>
                                                <td>
                                                    <strong style="color: #bb0808;">{{ $paysalary->salary }}</strong>
                                                    <input type="hidden" name="paid_amount" value="{{ $paysalary->salary }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Advance Salary</th>
                                                <td>
                                                    @if ($paysalary['advance'] && $paysalary['advance']['advance_salary'])
                                                        <strong style="color: #b10e0e;">{{ $paysalary['advance']['advance_salary'] }}</strong>
                                                        <input type="hidden" name="advance_salary" value="{{ $paysalary['advance']['advance_salary'] }}">
                                                    @else
                                                        <p style="color: #b10e0e">No Advance</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $amount = $paysalary->salary - ($paysalary['advance'] ? $paysalary['advance']['advance_salary'] : 0);
                                            @endphp
                                            <tr>
                                                <th>Due Salary</th>
                                                <td>
                                                    <strong style="color: #7c0c0c;">
                                                        @if ($paysalary['advance'] && $paysalary['advance']['advance_salary'] !== null)
                                                            {{ round($amount) }}
                                                        @else
                                                            <span>No Salary</span>
                                                        @endif
                                                    </strong>
                                                    <input type="hidden" name="due_salary" value="{{ round($amount) }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-content-save"></i> Pay Salary</button>
                                </div>
                            </form>
                        </div>
                        <!-- end settings content-->
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container -->
</div> <!-- content -->

@endsection

