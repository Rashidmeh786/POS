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

<div class="row mb-2">  

 
<div class="col-lg-6">
    <div class="row">
        <div class="col-md-6">
            <label for="dateFilter" class="form-label">From Date :</label>
            <input type="date" class="form-control" id="fromdateFilter" style="height: 45px">
        </div>
        <div class="col-md-6">
            <label for="dateFilter" class="form-label">To Date :</label>
            <input type="date" class="form-control" id="todateFilter" style="height: 45px">
        </div>
            
    </div>
    
</div>


</div>                        
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <table id="basic-datatable1" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                               <td>Reference</td>
                               <td>total products</td> 
                               <td>Created ON</td>
                               <td>Created By</td>
                                {{-- <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</th> --}}
                                <th>Action</th>

                            </tr>
                        </thead>


                        <tbody>
                            @foreach($referenceData as $reference)
                                @php
                                    $item = $alladjustments->where('reference_number', $reference->reference_number)->first();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge bg-warning p-1">{{ $item->reference_number }}</span></td>
                                    <td><span class="badge bg-info p-1">{{ $reference->count }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($item->date_of_adjustment)->format('m/d/Y') }}</td>
                                    <td><span class="badge bg-info p-1">{{ $item->users['name']. '  '. $item->user_id}}</span></td>
                                    <td>
                                        <a href="{{ route('details.adjustment', $item->reference_number) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('print.adjustment', $item->reference_number) }}" id="print" class="btn btn-sm btn-danger">
                                            <i class="fas fa-print"></i>
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







<script>
    $(document).ready(function() {
        var dataTable = $('#basic-datatable1').DataTable();

      
    });
</script>


 



<script>
    $(document).ready(function() {
        $('#fromdateFilter, #todateFilter').on('change', function() {
            var fromDate = $('#fromdateFilter').val();
            var toDate = $('#todateFilter').val();

            // Show all rows when no dates are selected
            $('#basic-datatable1 tbody tr').show();

            // Filter by order date
            if (fromDate !== '' && toDate !== '') {
                $('#basic-datatable1 tbody tr').each(function() {
                    var orderDate = $(this).find('td:nth-child(4)').text().trim();
                    var formattedOrderDate = formatDate(orderDate);

                    if (formattedOrderDate < fromDate || formattedOrderDate > toDate) {
                        $(this).hide();
                    }
                });
            }
        });

        function formatDate(dateString) {
            var dateParts = dateString.split('/');
            var year = dateParts[2];
            var month = dateParts[0];
            var day = dateParts[1];
            return year + '-' + month + '-' + day;
        }
    });
</script> 


@endsection 
