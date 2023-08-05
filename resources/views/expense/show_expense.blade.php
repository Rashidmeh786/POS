@extends('admin.admin_dashboard')
@section('admin')

<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
<style>
    /* Custom CSS */
    .form-group input[type="date"],
    .form-group input[type="number"],
    .form-group input[type="text"],
    .form-group select,
    .form-group textarea {
        height: 45px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
    }

    /* Increase the height and add border design for inputs and textarea */
    .form-group textarea {
        resize: vertical; /* Allow vertical resizing of textarea */
    }

    /* Adjust button styles */
    .btn {
        height: 45px;
        border-radius: 5px;
    }
</style>

<div class="content">

    <!-- Start Content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                          
                            <a href="{{ route('all.expenses') }}" class="btn btn-outline-primary rounded- pill btn-lg waves-effect waves-light">Back </a>  


                        </ol>
                    </div>
                    <h4 class="page-title">Edit Expense</h4>
                </div>
            </div>
        </div>   
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                     
                        <div class="row">
                     
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="date">Date <span class="text text-danger" >*</span></label>
                                    <input type="date" id="date" name="date" readonly class="form-control" value="{{ $Expense->date }}">
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="expense_title">Expense Title <span class="text text-danger">*</span></label>
                                    <input type="text" id="expense_title" readonly class="form-control @error('title') is-invalid @enderror"  name="title" placeholder="Enter Title .." value="{{ $Expense->title }}">
                                    @error('title')
                                    <span class="text-danger"> {{ $message }} </span>
                                        
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="expense_category">Expense Category <span class="text text-danger">*</span></label>
                                   
                                <select name="category_id" class="form-select" id="example-select" readonly>
                                    <option selected disabled >Select Category </option>
                                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}"  {{ $cat->id == $Expense->category_id ? 'selected' : ''  }}>{{ $cat->name }}</option>
                                     @endforeach
                                </select> 
                                {{-- <button class="btn btn-primary me-2" type="button" data-bs-toggle="modal" data-bs-target="#signup-modal"><span class="fas fa-plus-square"></span></button> --}}

                
                                @error('category_id')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="amount">Amount <span class="text text-danger  @error('amount') is-invalid @enderror"  name="amount" >*</span></label>
                                    <input type="number" id="amount" readonly name="amount" class="form-control" value="{{ $Expense->amount }}">
                                    @error('amount')
                                    <span class="text-danger"> {{ $message }} </span>
                                        
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 mt-2">
                                <label for="description" class="form-label"> Details  <span class="text-danger">*</span></label>
                                <textarea readonly class="ckeditor form-control @error('details') is-invalid @enderror"  cols="3"  name="details" value="{{ old('details') }}"  >{{ $Expense->details }}</textarea>
                                @error('details')
                                <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                          </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-end">
                             
                            </div>
                        </div>
                    
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the current date
    const currentDate = new Date();

    // Get the input element by its ID
    const dateInput = document.getElementById("date");

    // Format the date to YYYY-MM-DD (required by the input type "date")
    const formattedDate = currentDate.toISOString().slice(0, 10);

    // Set the input value to the current date
    dateInput.value = formattedDate;
</script>
  @endsection