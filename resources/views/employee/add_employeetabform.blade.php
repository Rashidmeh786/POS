@extends('admin.admin_dashboard')

@section('admin')
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<div class="content">
    <!-- Start Content -->
    <div class="container-fluid">
        <!-- Start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Employee</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Employee</h4>
                </div>
            </div>
        </div>
        <!-- End page title -->

        <!-- Tabs navs -->
        <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex3-tab-1" data-bs-toggle="tab" href="#ex3-tabs-1" role="tab" aria-controls="ex3-tabs-1" aria-selected="true">Personal Info</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" disabled id="ex3-tab-2" data-bs-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">Official Info</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" disabled id="ex3-tab-3" data-bs-toggle="tab" href="#ex3-tabs-3" role="tab" aria-controls="ex3-tabs-3" aria-selected="false">Additional Info</a>
            </li>
        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex2-content">
            <div class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
                <form id="personal-info-form">
                    @csrf

                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Employee</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Employee Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Employee Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Employee Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                            <label for="city" class="form-label">Employee City    </label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"   >
                            @error('city')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                            </div>
                            </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Employee Address</label>
                                <textarea name="address" class="form-control" required></textarea>
                                @error('address')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                            </div>
                        </div>
                    </div>

    
                                          

    
                    <div class="mt-4">
                        <button class="btn btn-primary" onclick="nextTab(2, 1); return false;">Save and Next</button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                <form id="official-info-form">
                    @csrf

                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Official Info</h5>

                   


<div class="col-md-6">
    <div class="mb-3">
    <label for="firstname" class="form-label">Employee Experience    </label>
    <select name="experience" class="form-select" id="example-select">
        <option selected="">Select Year </option>
        <option value="1 Year">1 Year</option>
        <option value="2 Year">2 Year</option>
        <option value="3 Year">3 Year</option>
        <option value="4 Year">4 Year</option>
        <option value="5 Year">5 Year</option>
        <option value="5 Year">6 Year</option>
        <option value="5 Year">7 Year</option>
    
    </select>
    
    </div>
    </div>
    
    
    <div class="col-md-6">
    <div class="mb-3">
    <label for="firstname" class="form-label">Employee Salary    </label>
    <input type="text" name="salary" class="form-control @error('salary') is-invalid @enderror"   >
    @error('salary')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
    </div>
    </div>
    
    <div class="col-md-6">
    <div class="mb-3">
    <label for="designation" class="form-label">Employee designation    </label>
    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror"   >
    @error('designation')
    <span class="text-danger"> {{ $message }} </span>
    @enderror
    </div>
    </div>
    

                    <div class="mt-4">
                        <button class="btn btn-primary" onclick="prevTab(1, 2); return false;">Previous</button>
                        <button class="btn btn-primary" onclick="nextTab(3, 2); return false;">Save and Next</button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="ex3-tabs-3" role="tabpanel" aria-labelledby="ex3-tab-3">
                <form id="additional-info-form">
                    @csrf

                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Additional Info</h5>

 
<div class="col-md-12">
    <div class="mb-3">
    <label for="example-fileinput" class="form-label"> </label>
    <img id="showImage" src="{{  url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail"
    alt="profile-image">
    </div>
    </div> <!-- end col -->
    
                    <div class="col-md-12">
                        <div class="mb-3">
                        <label for="example-fileinput" class="form-label">Employee Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        </div>
                               
    
    <div class="col-md-12">
    <div class="mb-3">
    <label for="example-fileinput" class="form-label">additional info </label>
   <textarea name="additionall_info" class="form-control" id="" cols="30" rows="7"></textarea>
    </div>
    

                    <div class="mt-4">
                        <button class="btn btn-primary" onclick="prevTab(2, 3); return false;">Previous</button>
                        <button class="btn btn-primary" onclick="saveForm(); return false;">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Tabs content -->
    </div>
    <!-- End Content -->
</div>

<script>
    function nextTab(nextTabId, currentTabId) {
        // Validate the current tab inputs before moving to the next tab
        if (validateForm(currentTabId)) {
            // Move to the next tab
            $('#ex1 a[href="#ex3-tabs-' + nextTabId + '"]').tab('show');
        }
    }

    function prevTab(prevTabId, currentTabId) {
        // Move to the previous tab
        $('#ex1 a[href="#ex3-tabs-' + prevTabId + '"]').tab('show');
    }

    function saveForm() {
        // Validate the last tab inputs before submitting the form
        if (validateForm(3)) {
            // Get form data
            var formData = new FormData($('#additional-info-form')[0]);

            // Make an AJAX request to submit the form data
            $.ajax({
                url: '{{ route('add.employees') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle success response
                    alert('Form data saved successfully!');
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('Error occurred while saving form data.');
                }
            });
        }
    }

    function validateForm(tabId) {
        var isValid = true;

        if (tabId === 1) {
            // Validate inputs in the first tab
            var name = $('#personal-info-form [name="name"]').val();
            var email = $('#personal-info-form [name="email"]').val();
            var phone = $('#personal-info-form [name="phone"]').val();
            var address = $('#personal-info-form [name="address"]').val();

            if (name.trim() === '') {
                isValid = false;
                alert('Please enter employee name.');
            }

            if (email.trim() === '') {
                isValid = false;
                alert('Please enter employee email.');
            } else if (!validateEmail(email)) {
                isValid = false;
                alert('Please enter a valid email address.');
            }

            if (phone.trim() === '') {
                isValid = false;
                alert('Please enter employee phone.');
            } else if (!validatePhone(phone)) {
                isValid = false;
                alert('Please enter a valid phone number.');
            }

            if (address.trim() === '') {
                isValid = false;
                alert('Please enter employee address.');
            }
        }

        // Add validations for other tabs here if needed

        return isValid;
    }

    function validateEmail(email) {
        // Email validation logic, you can use a regular expression or any other validation method
        // Return true if the email is valid, false otherwise
        return true;
    }

    function validatePhone(phone) {
        // Phone validation logic, you can use a regular expression or any other validation method
        // Return true if the phone number is valid, false otherwise
        return true;
    }
</script>

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
