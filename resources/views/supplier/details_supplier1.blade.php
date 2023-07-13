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
                                            <li class="breadcrumb-item"><a class="btn btn-info" href="{{ route('all.supplier') }}">Back</a></li>

                                        </ol>
                                    </div>
                                    <h4 class="page-title">Details Supplier</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

<div class="row">


  <div class="col-lg-8 col-xl-12">
<div class="card">
    <div class="card-body">



        <ul class="nav nav-pills nav-fill navtab-bg">
            {{-- <li class="nav-item">
                <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                    About Me
                </a>
            </li> --}}
            <li class="nav-item">
                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                    Profile
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                    Settings
                </a>
            </li> --}}
        </ul>

    <!-- end timeline content-->

    <div class="tab-pane" id="settings">
        <form method="post" action="{{ route('supplier.update') }}" enctype="multipart/form-data">
        	@csrf

           <input type="hidden" name="id" value="{{ $supplier->id }}"> 

            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Details Supplier</h5>

            <div class="row">


    <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Supplier Name</label>
            <p class="text-danger">{{ $supplier->name }}</p>
        </div>
    </div>


              <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Supplier Email</label>
               <p class="text-danger">{{ $supplier->email }}</p>

        </div>
    </div>




              <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Supplier Phone    </label>
             <p class="text-danger">{{ $supplier->phone }}</p>
        </div>
    </div>


      <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Supplier Address    </label>
             <p class="text-danger">{{ $supplier->address }}</p>
        </div>
    </div>



      <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Supplier Shop Name    </label>
             <p class="text-danger">{{ $supplier->shopname }}</p>
        </div>
    </div>


      <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Supplier Type   </label>
             <p class="text-danger">{{ $supplier->type }}</p>
        </div>
    </div>





 <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Account Holder    </label>


             <p class="text-danger">{{ $supplier->account_holder }}</p>
        </div>
    </div>

     <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Account Number    </label>

              <p class="text-danger">{{ $supplier->account_number }}</p>
        </div>
    </div>

      <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Bank Name    </label>

              <p class="text-danger">{{ $supplier->bank_name }}</p>
        </div>
    </div>


      <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Bank Branch    </label>

             <p class="text-danger">{{ $supplier->bank_branch }}</p>
        </div>
    </div>


     <div class="col-md-6">
        <div class="mb-3">
            <label for="firstname" class="form-label">Supplier City    </label>
            <p class="text-danger">{{ $supplier->city }}</p>
        </div>
    </div>



   <div class="col-md-12">
<div class="mb-3">
        <label for="example-fileinput" class="form-label"> </label>
        <img  style="height: 100px; width: 100px" src="{{ (!empty($supplier->image)) ? url('upload/supplier/'.$supplier->image) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg mt-2 img-thumbnail">

    </div>
 </div> <!-- end col -->



            </div> <!-- end row -->


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



<script type="text/javascript">
	
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload =  function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>







@endsection
  