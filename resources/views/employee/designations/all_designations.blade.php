@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>


<div class="content">

    
<div class="container-fluid">

    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a class="btn btn-warning" href="{{ route('dashboard') }}">Back </a></li>

                </ol>
            </div>
            <h4 class="page-title">Manage Designations</h4>
        </div>
    </div>
</div>     
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header bg-info">
               Add New Designation
                </div>
                <div class="card-body">
                 
                 <div class="mb-3">
                    <form action="{{ route('designation.store') }}" method="post" >
                        @csrf
                        <label for="name" class="form-label">Designation </label>
                        <input type="text" placeholder="Enter New Designation Name .." name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger"> {{ $message }} </span>
                        @enderror
        
                 </div>
                 <button type="submit" class="btn btn-primary form-control">Add Designation</button>
                </form>
                </div>
              </div>
        
        </div>
        <div class="col-9">
        
            <div class="card">
                <div class="card-header bg-info">
               List Designations
                </div>
                <div class="card-body">
                    {{-- --datatable --}}
                    <div class="table-responsive">
        <table id="tblData" class="table table-hover  table-striped dataTable dtr-inline">
            <thead> 
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        {{-- <th>Guard Name</th> --}}
                        <th>Action</th>
        
                    </tr>
            </thead>
        
            <tbody class=' '>
        
                @foreach ($designations as $index => $designation)
              <tr >
                <td>{{$index+1}}</td>
        
                <td>{{  $designation->name  }}</td>
        
        
                <td>
                    <a href="{{ url('edit_designation/' . $designation->id) }}" class="btn btn-sm btn-primary" >
                    <i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ url('delete_designation/' . $designation->id) }}" id="delete" class="btn btn-sm btn-danger" >
                        <i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
        </table>
        {{ $designations->links('pagination::bootstrap-5') }}  

        {{-- {{ $designations->links() }} --}}
                    </div>
                 </div>
               
            
                </div>
              </div>
        
        
        </div>
        </div>
          </div>
</div>



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