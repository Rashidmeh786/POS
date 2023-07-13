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
                        <a href="{{ route('add.product') }}" class="btn btn-primary waves-effect waves-lightt"> <i class="mdi mdi-plus-circle me-1"></i>Add New </a>  
                    </div>
                    <h4 class="page-title">All products</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
    <h4 class="header-title">All products</h4>

    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Image</th>
                <th>Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Brand</th>
               
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Stock</th>
                
                {{-- <th>Expiry Status</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($product as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                   
                    <img style="height: 40px; width: 40px" src="{{ (!empty($item->product_image)) ? url('upload/product/'.$item->product_image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">
                </td>
                <td>{{ $item->product_code }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->category->name ??"NA" }}</td>
                <td>{{ $item->brand->name ?? 'NA'}}</td>
                {{-- <td>{{ $item->supplier->name }}</td> --}}

               
                <td>{{ $item->buying_price }}</td>
                <td>{{ $item->selling_price }}</td>
                <td>{{ $item->stock ?? "0"}}</td>
                {{-- <td> 

                @if($item->expire_date>=Carbon\Carbon::now()->format('Y','m','d'))
                <span class="badge bg-soft-success text-success">Available</span>
                @else
                <span class="badge bg-soft-success text-success">Expired</span>
                @endif
            </td> --}}
                <td>
                    <a href="#" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('edit.product', $item->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('delete.product', $item->id) }}" id="delete" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <a href="{{ route('barcode.product', $item->id) }}" id="barcode" class="btn btn-sm btn-info">
                        <i class="fas fa-barcode"></i>
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