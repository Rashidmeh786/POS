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

   <a href="" class="btn btn-info rounded-pill waves-effect waves-light">Import </a>  
   &nbsp;&nbsp;&nbsp;
   <a href="" class="btn btn-danger rounded-pill waves-effect waves-light">Export </a>  
   &nbsp;&nbsp;&nbsp;

      <a href="{{ route('add.product') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Product </a>  
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Product</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>Code</th>
                                <th>Stock</th> 
                                <td>Details</td>
                               
                            </tr>
                        </thead>


        <tbody>
        	@foreach($product as $key=> $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                <img style="height: 40px; width: 40px" src="{{ (!empty($item->product_image)) ? url('upload/product/'.$item->product_image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail">

                </td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item['category']['name'] }}</td>
                <td>{{ $item['supllier']['name'] ?? "NA"}}</td>
                <td>{{ $item->product_code }}</td>
                <td> <span class="badge bg-warning p-1 ">{{ $item->stock ?? '0'}}</span>
                
                </td>  
                <td>
                    {{-- <a href="{{ route('purchaseorder.details',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light"> <span class="fas fa-eye"></span> </a>  --}}
                    <a href="#" class="btn btn-info  btn-sm"> <span class="fas fa-eye"></span> </a> 
                  
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


@endsection 
  