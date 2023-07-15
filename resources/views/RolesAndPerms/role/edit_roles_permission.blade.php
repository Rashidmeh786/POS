@extends('admin.admin_dashboard')
@section('admin')


<style type="text/css">
    
    .form-check-label{
        text-transform: capitalize;
    }
</style>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<div class="container mt-4">
    
    <form id="myForm" method="post" action="{{ route('role.permission.store') }}" enctype="multipart/form-data">
        @csrf
    <div class="row">
        
        <div class="col-md-6 d-flex align-items-center">
            <a class="btn btn-outline-primary " href="{{ route('all.roles.permission') }}">Back</a> &nbsp; &nbsp; &nbsp; 

          <select class="form-select" style="margin-right: 1rem; height: 40px;" id="roles"  name="role_id">
            <option selected disabled>{{ $role->name }}</option>
           
          </select>
          <button class="btn btn-success px-3 text-bold"> <span class="fas fa-save">&nbsp;Update</span></button>
          
        </div> 
      
        <div class="col-md-6 d-flex align-items-end justify-content-end">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="allPermissions">
            <label class="form-check-label" for="allPermissions">Provide All Permissions</label>
          </div>
        </div>
      </div>
      
      <div class="row mt-4">
        @foreach($permission_groups as $group)
          <div class="col-md-3">
            <div class="card">
              <div class="card-body p-3">
                <label class="form-check-label text-bold" for="all"> <span class=" "> {{ $group->group_name }}</span></label>
                @php
                $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                @endphp            
            
                    @foreach($permissions as $permission)
                <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}"  {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="customckeck{{ $permission->id }}" >
                   
                    <label class="form-check-label" for="customckeck{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <form>
    </div>



    <script type="text/javascript">
        $('#allPermissions').click(function(){
            if ($(this).is(':checked')) {
                $('input[type = checkbox]').prop('checked',true);
            }else{
                $('input[type = checkbox]').prop('checked',false);
            } 
        });
   </script>
    @endsection
 