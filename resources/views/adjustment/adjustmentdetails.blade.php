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
                                        <a href="{{ route('all.adjustment') }}" class="btn btn-outline-primary rounded- pill btn-lg waves-effect waves-light">back </a>  
                                    </div>
                                    <h4 class="page-title">All Adjustments</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                       
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <table id="basic-datatable1" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                               <td>Reference</td>
                               <td>Product </td> 
                               <td>Productcode </td> 
                               <td>Quantity</td>
                               <td>Adjustment Type</td>
                               <td>Created ON</td>
                               <td>Created By</td>
                                {{-- <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</th> --}}
                                <th>Show Reason</th>

                            </tr>
                        </thead>


        <tbody>
        	@foreach($adjustments as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td><span class="badge bg-primary p-1 ">{{ $item->reference_number }}</span></td>
                <td><span class=" ">{{ $item->products['product_name'] }}</td>
                    <td><span class=" ">{{ $item->products['product_code'] }}</td>
                        <td><span class="badge bg-info p-1 ">{{ $item->quantity }}</td>
                            <td> <span class="badge bg-pink p-1">{{ $item->adjustment_type }}</span></td>
                <td>{{ \Carbon\Carbon::parse($item->date_of_adjustment)->format('m/d/Y') }}</td>
                <td><span class="badge bg-info p-1 ">{{  $item->users['name'] }}</td>

                
                        <td>
                            {{-- <a href="{{ route('details.adjustment', $item->reference_number) }}" class="btn btn-sm btn-warning" >
                                <i class="fas fa-eye"></i></a>
                             --}}
                                <a href=""data-bs-toggle="modal" data-bs-target="#details-modal" id="{{ $item->reference_number }}" onclick="showreason(this.id)" class=" btn-sm btn btn-warning">
                                    <i class="fas fa-eye"></i></a>
                                   
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



            </div> <!-- content -->


            <!--  modal content -->
            <div id="details-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reason For Adjustment</h5>
                
                    </div>
                       <div class="modal-body"> 
                           <div class="text-center mt-2 mb-4 ">
                                   <div class="auth-logo">
                
                                       <h3> reason </h3>
                                   </div>
                           </div>
                
                           
                        <label for="username" class="form-label">Remarks by user</label>
                                <textarea name="textarea" class="form-control" id="textarea" cols="30" rows="10"></textarea>
                     </div>
                
                
                               <div class="mb-3 text-center">
                                
             

                <button type="button" class="close btn btn-primary" data-dismiss="#details-modal" id="cancel-btn" aria-label="Close">
                    <span aria-hidden="true">OK</span>
                  </button>
                               </div>
                
                           </form>
                
                       </div>
                   </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                
                <script type="text/javascript">
                   
                   function showreason(id) {
                       $.ajax({
                           type: 'GET',
                           url: '/adjustment/reason/'+id,
                           dataType: 'json',
                           success:function(data){
                               console.log(data)
                              $('#textarea').val(data[0].reason);
                              
                           }
                       })
                   }
                
                
                   $('#cancel-btn').click(function(e) {
                        e.preventDefault(); // Prevent the form from submitting
                        $('#details-modal').modal('hide');
                        // $("#paydue-form")[0].reset();
                    });
                </script> 
                

<script>
    $(document).ready(function() {
        var dataTable = $('#basic-datatable1').DataTable();

      
    });
</script>


 





@endsection 
