@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<link rel="stylesheet" href="{{asset('backend/assets/css/attend.css')}}">
<style>
   .switch-toggle{
   width: auto;
   }
   .switch-toggle label:not(.disabled){
   cursor: pointer;
   }
   .switch-candy a{
   border: 1px solid #333;
   border-radius: 3px;
   background-color: white;
   background-image: -webkit-linear-gradient(top,rgba(255, 255, 255, 0.2), transparent);
   background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), transparent);
   }
   .switch-toggle.switch-candy, .switch-light.switch-candy > span{
   background-color: #5a6268;
   border-radius: 3px;
   box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.2);
   }
</style>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
<div class="content">
   <!-- Start Content-->
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <h4>

                        <a href="{{ route('employee.attendance.list') }} " class="btn btn-blue btn-lg rounded- pill waves-effect waves-light "><span class="fas fa-arrow-circle-left"></span></a>

                         {{-- <input type="hidden" name="employee_id[]" value="{{$item->employee_id}}" class="employee_id"> --}}
                         {{-- <a href="{{ route('employee.attend.list') }}" class="btn btn-primary float-sm-right"> <i class="fas fa-list"></i>Employee Attendance List</a> --}}
                     </h4>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title --> 
      <div class="row">
         <div class="col-12">
            <div class="card">




               <div class="card-body">
                  <form action="{{ route('employee.attend.store') }}" method="post" id="myForm">
                     @csrf



                     <div class="row">
                        <div class="form-group col-lg-4">
                           <label for="date" class="control-label">Attendance Date</label>
                           <input type="datetime-local" name="attendance_datetime" value="{{ $editData['0']['date'] }}" id="date" class="checkdate form-control form-control mb-2 singledatepicker" placeholder="Attendance Date" autocomplete="off">
                        </div>






                        <div class="form-group col-lg-4 offset-lg-4">
                           <label for="employeeName" class="control-label">Search Employee Name</label>
                           <input type="text" name="employeeName" id="employeeName" class="form-control" placeholder="Enter employee name">
                        </div>
                     </div>


                    
                     <table class="table sm table-bordered table-striped dt-responsive" style="width: 100%">
                        <thead>
                           <tr>
                              <th rowspan="2" class="text-center text-white bg-secondary" style="vertical-align: middle">#</th>
                              <th rowspan="2" class="text-center text-white bg-secondary" style="vertical-align: middle">Employee Name</th>
                              <th colspan="3" class="text-center text-white bg-secondary" style="vertical-align: middle">Attendance Status</th>
                           </tr>
                           <tr>
                              <th class="text-center btn present_all text-white bg-secondary" style="display: table-cell;background-color:#114190">Present</th>
                              <th class="text-center btn leave_all text-white bg-secondary" style="display: table-cell;background-color:#114190">Leave</th>
                              <th class="text-center btn absent_all text-white bg-secondary" style="display: table-cell;background-color:#114190">Absent</th>
                           </tr>
                        </thead>
    <tbody>
       @foreach ($editData as $key => $item)
       <tr class="text-center">
        <input type="hidden" name="employee_id[]" value="{{$item->employee_id}}" class="employee_id">
          <td>{{$key+1}}</td>
          <td>{{$item['employee']['name']}}</td>
          <td colspan="3">
             <div class="switch-toggle switch-3 switch-candy">
                <input class="present" id="present{{$key}}" name="attend_status{{$key}}" value="present" type="radio" {{ $item->attend_status == 'present' ? 'checked' : '' }}  > 
                <label for="present{{$key}}">Present</label>

                <input class="leave" id="leave{{$key}}" name="attend_status{{$key}}" value="Leave" type="radio" {{ $item->attend_status == 'Leave' ? 'checked' : '' }}> 
                <label for="leave{{$key}}">Leave</label>

                <input class="absent" id="absent{{$key}}" name="attend_status{{$key}}" value="Absent" type="radio" {{ $item->attend_status == 'Absent' ? 'checked' : '' }}> 
                <label for="absent{{$key}}">Absent</label>
                <a></a>
             </div>
          </td>
       </tr>
       @endforeach
    </tbody>
 </table>
 <button type="submit" class="btn btn-success btn-sm"> Update Attendance  </button>
</form>
</div>
               <!-- end card body-->

            </div>
            <!-- end card -->
         </div>
         <!-- end col-->
      </div>
      <!-- end row-->
   </div>
   <!-- container -->
</div>
<!-- content -->

<script type="text/javascript">
      $(document).on('click','.present',function(){
      $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
      });
      $(document).on('click','.leave',function(){
      $(this).parents('tr').find('.datetime').css('pointer-events','').css('background-color','white').css('color','#495057');
      });
      $(document).on('click','.absent',function(){
      $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
      });
</script>
<script type="text/javascript">
      $(document).on('click','.present_all',function(){
      $("input[value=Present]").prop('checked',true);
      $('.datetime').css('ponter-events','none').css('background-color','#dee2e6').css('color','#495057');
      });
      $(document).on('click','.leave_all',function(){
      $("input[value=Leave]").prop('checked',true);
      $('.datetime').css('ponter-events','').css('background-color','white').css('color','#495057');
      });
      $(document).on('click','.absent_all',function(){
      $("input[value=Absent]").prop('checked',true);
      $('.datetime').css('ponter-events','none').css('background-color','#dee2e6').css('color','#dee2e6');
      });
</script>


<script>
   $(document).ready(function () {
      $('#employeeName').on('keyup', function () {
         var searchText = $(this).val().toLowerCase();
         $('tbody tr').each(function () {
            var employeeName = $(this).find('td:eq(1)').text().toLowerCase();
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
