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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Advance Salary</a></li>

                                        </ol>
                                    </div>
                                    <a class="btn btn-info m-2" href="{{ route('all.advance.salary') }}">Back</a>
 
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">


  <div class="col-lg-8 col-xl-12">
<div class="card">
    <div class="card-body">





    <!-- end timeline content-->

    <div class="tab-pane" id="settings">
        <form method="post" action="{{ route('advance.salary.update') }}" >
        	@csrf

            <input type="hidden" name="id" value="{{ $salary->id }}">

            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Advance Salary</h5>

            <div class="row">


 <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Employee Name    </label>
           <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror" id="example-select">
                    <option selected disabled >Select Employee </option>
                    @foreach($employee as $item)
                    <option value="{{  $item->id }}" {{ $item->id == $salary->employee_id ? 'selected' : '' }}>{{  $item->name }}</option>
                    @endforeach
                </select> 
        </div>
    </div>


 <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Salary Month    </label>
           <select name="month" class="form-select @error('month') is-invalid @enderror" id="example-select">
            <option disabled>Select Month</option>

            <?php
            $currentMonth = date('F');
            $months = array(
              'January', 'February', 'March', 'April', 'May', 'June',
              'July', 'August', 'September', 'October', 'November', 'December'
            );
            
            // Find the index of the current month
            $currentMonthIndex = array_search($currentMonth, $months);
            
            // Display the current month minus one
            echo '<option value="' . $months[($currentMonthIndex - 1) % 12] . '">' . $months[($currentMonthIndex - 1) % 12] . '</option>';
            
            // Display the rest of the months
            for ($i = $currentMonthIndex; $i < $currentMonthIndex + 12; $i++) {
              $monthIndex = $i % 12;
              $selected = ($months[$monthIndex] === $salary) ? 'selected' : '';
              echo '<option value="' . $months[$monthIndex] . '"' . $selected . '>' . $months[$monthIndex] . '</option>';
            }
            ?>
            
                </select>
                 @error('month')
      <span class="text-danger"> {{ $message }} </span>
            @enderror

        </div>
    </div>


      <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Salary Year    </label>
           <select name="year" class="form-select @error('year') is-invalid @enderror" id="example-select">
    <option selected disabled >Select Year </option>
    <option value="2022" {{ $salary->year == '2022' ? 'selected' : '' }} >2022</option>
    <option value="2023" {{ $salary->year == '2023' ? 'selected' : '' }}>2023</option>
    <option value="2024" {{ $salary->year == '2024' ? 'selected' : '' }}>2024</option>
    <option value="2025" {{ $salary->year == '2025' ? 'selected' : '' }}>2025</option>
    <option value="2026" {{ $salary->year == '2026' ? 'selected' : '' }}>2026</option>
                </select>
                 @error('year')
      <span class="text-danger"> {{ $message }} </span>
            @enderror

        </div>
    </div>


 <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Advance Salary    </label>
            <input type="text" name="advance_salary" class="form-control @error('advance_salary') is-invalid @enderror" value="{{ $salary->advance_salary }}"   >
             @error('advance_salary')
      <span class="text-danger"> {{ $message }} </span>
            @enderror
        </div>
    </div>



            </div> <!-- end row -->



            <div class="text-end">
                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
    <!-- end settings content-->


                                    </div>
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->




@endsection
 