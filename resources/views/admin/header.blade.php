<style>.calculator-container {
    position: absolute;
    width: 200px;
    top: 50px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    text-align: center;
  }
  .calculator-buttons {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 5px;
}

  .calculator-screen {
    width: 100%;
    height: 40px;
    font-size: 24px;
    text-align: right;
    margin-bottom: 10px;
    border: none;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
  }
  
  .calculator-buttons {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 5px;
  }
  
  .calculator-button {
    width: 100%;
    height: 50px;
    font-size: 20px;
    border: none;
    background-color: #ffffff;
    color: #0f0f0f;
    cursor: pointer;
    border-radius: 5px;
  }
  
  .calculator-button:hover {
    background-color: #45a049;
  }


  .edit-btns {
 
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  transform-origin: center;
}


.edit-btns:hover {
 
  transform: scale(1.1); /* You can adjust the scale value as per your preference */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
  
  </style>

@php
     $id = Auth::user()->id;
        $adminData = App\Models\User::find($id);
@endphp

<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

       
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light  " data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>








            {{-- holdlist notification --}}
            @if(Route::currentRouteName() === 'pos')
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light text-primary" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fas fa-hand-holding fa-lg"></i>
                   
                    <span class="badge bg-danger rounded-circle noti-icon-badge" id="count">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                               
                            </span>Hold List
                        </h5>
                    </div>

                    <div class="noti-scroll" data-simplebar>    
                      
                        <div class="container">
                            <div class="table-container" style=" max-height: 250px; /* Set the maximum height for the container */
                            overflow-y: auto;">
                                <table class="table hold-table table-hover table-sm ">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Refno</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hold-orders-body">
                                        <tr class="data-row">
                                            <td colspan="3">Loading hold orders...</td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        
                        

                    <!-- All-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        View all
                        <i class="fe-arrow-right"></i>
                    </a> --}}

                </div>
            </li>
            @endif
           


            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light text-info " id="calculator" data-toggle="calculator" href="#">
                  <i class="fas fa-calculator fa-lg "></i>
                </a>
                <div class="calculator-container d-none">
                    <input type="text" class="calculator-screen" disabled />
                    <div class="calculator-buttons">
                      <button class="calculator-button">1</button>
                      <button class="calculator-button">2</button>
                      <button class="calculator-button">3</button>
                      <button class="calculator-button">+</button>
                      <button class="calculator-button">4</button>
                      <button class="calculator-button">5</button>
                      <button class="calculator-button">6</button>
                      <button class="calculator-button">-</button>
                      <button class="calculator-button">7</button>
                      <button class="calculator-button">8</button>
                      <button class="calculator-button">9</button>
                      <button class="calculator-button">*</button>
                      <button class="calculator-button">0</button>
                      <button class="calculator-button">.</button>
                      <button class="calculator-button">/</button>
                      <button class="calculator-button">C</button>
    
                      <button class="calculator-button" style="grid-column: span 4;">=</button>
                      {{-- <button class="calculator-button">C</button> --}}
    
                    </div>
                  </div>
              </li>
              
             
              
              
          
          

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light text-primary" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-bell noti-icon"></i>
                    <span class="badge bg-danger rounded-circle noti-icon-badge" id="count">9</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="m-0">
                            <span class="float-end">
                                <a href="" class="text-dark">
                                    <small>Clear All</small>
                                </a>
                            </span>Notification
                        </h5>
                    </div>

                    <div class="noti-scroll" data-simplebar>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon">
                                {{-- <img src="{{ asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle" alt="" /> </div> --}}
                            <p class="notify-details">Cristina Pride</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Hi, How are you? What about our next meeting</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admin
                                <small class="text-muted">1 min ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                {{-- <img src="{{ asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle" alt="" /> </div> --}}
                            <p class="notify-details">Karen Robinson</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Wow ! this admin looks good and awesome design</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning">
                                <i class="mdi mdi-account-plus"></i>
                            </div>
                            <p class="notify-details">New user registered.
                                <small class="text-muted">5 hours ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admin
                                <small class="text-muted">4 days ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-secondary">
                                <i class="mdi mdi-heart"></i>
                            </div>
                            <p class="notify-details">Carlos Crouch liked
                                <b>Admin</b>
                                <small class="text-muted">13 days ago</small>
                            </p>
                        </a>
                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        View all
                        <i class="fe-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img id="Image" src="{{ (!empty($adminData->photo)) ? url('upload/admin_image/'.$adminData->photo) : url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                   
                    <span class="pro-user-name ms-1">
                        {{ $adminData->name }} <i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('admin.profile') }}" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('changePassword') }}" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Change Password</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="#" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="20">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>

            <a href="{{ route('dashboard') }}"  class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="20">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>   

            <li class="  ">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="" href="{{ route('pos') }}" role="button" aria-haspopup="false" aria-expanded="false">
                   <span class="badge bg-pink p-2"> POS</span>
                   
                </a>
              

               
            </li>



            <li class="dropdown d-none d-xl-block">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                   <span class=" text-white  badge bg-primary p-2"><i class="fas fa-plus-square"></i></span>
                    {{-- <i class="mdi mdi-chevron-down"></i>  --}}
                </a>
                <div class="dropdown-menu">
                    <!-- item-->
                    <a href="{{ route('add.sale') }}" class="dropdown-item">
                        <i class="fe-briefcase me-1"></i>
                        <span> Create Sale</span>

                    </a>
                    <a href="{{ route('add.purchase') }}" class="dropdown-item">
                        <i class="fe-briefcase me-1"></i>
                        <span> Create Purchase</span>

                    </a>
                    <a href="{{ route('add.expense') }}" class="dropdown-item">
                        <i class="fe-briefcase me-1"></i>
                        <span> Create Expense</span>

                    </a>
                    <a href="{{ route('add.supplier') }}" class="dropdown-item">
                        <i class="fe-user me-1"></i>
                        <span> Add New Supplier</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('add.product') }}" class="dropdown-item">
                        <i class="fe-user me-1"></i>
                        <span> Add New Product</span>
                    </a>

                    <!-- item-->
                    

                    <!-- item-->
                    <a href="{{ route('create.adjustment') }}" class="dropdown-item">
                        <i class="fe-settings me-1"></i>
                        <span>Adjustment</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="fe-headphones me-1"></i>
                        <span>Help & Support</span>
                    </a>

                </div>
            </li>




            <li class="dropdown d-none d-xl-block">
                <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class=" text-white  badge bg-info p-2"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </a>
                <div class="dropdown-menu">
                    <!-- item-->
                    <a href="{{ route('all.sales') }}" class="dropdown-item">
                        <i class="fe-briefcase me-1"></i>
                        <span> All Sales</span>

                    </a>
                    <a href="{{ route('all.purchase') }}" class="dropdown-item">
                        <i class="fe-briefcase me-1"></i>
                        <span> All Purchases</span>

                    </a>
                    <a href="{{ route('all.expenses') }}" class="dropdown-item">
                        <i class="fe-briefcase me-1"></i>
                        <span> List Expenses</span>

                    </a>
                    <a href="{{ route('all.supplier') }}" class="dropdown-item">
                        <i class="fe-user me-1"></i>
                        <span> All Supplier</span>
                    </a>
                    <!-- item-->
                    <a href="{{ route('all.product') }}" class="dropdown-item">
                        <i class="fe-user me-1"></i>
                        <span> All Products</span>
                    </a>

                    <!-- item-->
                    

                    <!-- item-->
                    <a href="{{ route('all.adjustment') }}" class="dropdown-item">
                        <i class="fe-settings me-1"></i>
                        <span>Adjustment details</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <i class="fe-headphones me-1"></i>
                        <span>Help & Support</span>
                    </a>

                </div>
            </li>





           
        </ul>
        <div class="clearfix"></div>
    </div>
</div>


              <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script>
  $(document).ready(function() {
    $("#calculator").on("click", function() {
      $(".calculator-container").toggleClass("d-none");
    });

    $(".calculator-button").on("click", function() {
      var screen = $(".calculator-screen");
      var buttonText = $(this).text();

      if (buttonText === "=") {
        try {
          screen.val(eval(screen.val()));
        } catch (e) {
          screen.val("Error");
        }
      } else if (buttonText === "C") {
        screen.val("");
      } else {
        screen.val(screen.val() + buttonText);
      }
    });
  });
</script>


<!-- Add the following script to your Blade template or view file -->
<script>
    // Function to fetch hold orders and update the table
    // function fetchHoldOrders() {
    //     // Make an AJAX request
    //     $.ajax({
    //         url: '{{ route("get.hold.orders") }}',
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(data) {
    //             //  console.log(data);
    //             // console.log(data.count);
    //             $('#count').text(data.count);
    //             const tableBody = $('#hold-orders-body');
    //             tableBody.empty(); // Clear existing data in the table body

    //             // Populate the table with fetched data
    //             $.each(data.holdOrders, function(index, order) {
    //                 tableBody.append(`
    //                     <tr>
    //                         <td>${order.hold_no}</td>
    //                         <td>${order.hold_date}</td>
    //                         <td>
    //                             <a class="button btn-sm text-primary edit-btn" data-order-id="${order.id}"><span class="fas fa-edit edit-btns"></span></a>&nbsp;&nbsp;
    //                             <a class="button btn-sm text-danger delete-btn" data-order-id="${order.id}"><span class="fas fa-trash edit-btns"></span></a>
    //                         </td>
                          
    //                     </tr>
    //                 `);
                   
    //             });
    //         },
    //         error: function(error) {
    //             console.error('Error fetching hold orders:', error);
    //         }
    //     });
    // }

    // // Call the function to fetch and display hold orders when the page loads
    // $(document).ready(function() {
    //     fetchHoldOrders();
    // });



    // $(document).on('click', '.delete-btn', function(event) {
    //   //  Get the order ID from the 'data-order-id' attribute of the clicked element
    //     var orderId = $(this).data('order-id');
    //     // console.log(orderId);
    //     // // Call the deleteOrder function with the order ID
    //     deleteHoldOrder(orderId);

       
    // });



    // function deleteHoldOrder(orderId) {
    //     $.ajax({
    //         url: '{{ route("delete.holdorder") }}',
    //         type: 'POST',
    //         data: {
    //             _token: '{{ csrf_token() }}', // Add the CSRF token for Laravel
    //             id: orderId
    //         },
    //         dataType: 'json',
    //         success: function(response) {
    //             // Handle the success response, maybe update the table again after deletion
    //             // console.log(response);
    //             Swal.fire({
    //                                     title: 'Are you sure?',
    //                                     text: "Delete This Data?",
    //                                     icon: 'warning',
    //                                     showCancelButton: true,
    //                                     confirmButtonColor: '#3085d6',
    //                                     cancelButtonColor: '#d33',
    //                                     confirmButtonText: 'Yes, delete it!'
    //                                   }).then((result) => {
    //                                     if (result.isConfirmed) {
                                        
    //                                       Swal.fire(
    //                                         'Deleted!',
    //                                         'Hold Order Has been deleted.',
    //                                         'success'
    //                                       )
    //                                     }
    //                                   }) 
    //             fetchHoldOrders(); // Update the table with the latest data after deletion
    //         },
    //         error: function(error) {
    //             console.error('Error deleting order:', error);
    //         }
    //     });
    // }

    // Call the function to fetch and display hold orders when the page loads
   

//     $(document).on('click', '.edit-btn', function(event) {
//       //  Get the order ID from the 'data-order-id' attribute of the clicked element
//         var orderId = $(this).data('order-id');
//         // console.log(orderId);
//         // // Call the deleteOrder function with the order ID
//         editHoldOrder(orderId);
        
       
//     });




    
//     // Function to edit order
//     function editHoldOrder(orderId) {
        
//         $.ajax({
//             url: '/get/holdorder/' + orderId,
//             type: 'GET',
//             success: function (holdproductDetails) {
//                 // console.log(holdproductDetails);

//                 // Assuming your tableBody is defined somewhere in your HTML
//                 var tableBody = $('#basic2-table tbody');
//                 tableBody.empty(); // Clear existing data in the table body

//                 // Populate the table with the received data
//                 $.each(holdproductDetails, function(index, product) {
//                     var newRow = '<tr data-row-id="' + product.product.product_id + '">' +
//       '<td>' + product.product.product_name + '</td>' +
//       '<td>' + product.product.selling_price + '</td>' +
//       '<td>' +
//       '<div class="d-flex align-items-center">' +
//       '<button type="button" class="btn btn-sm btn-primary p-1 increase-quantity" style="margin-top: -2px; height:40px; width:32px;"><i class="fas fa-plus"></i></button>' +
//       `<input type="text" min="1" value="`+product.quantity+`" max="`+product.product.stock+`" name="qty[]" class="form-control quantity-input" placeholder="Qty" style="width: 70px; height: 40px; margin-bottom: 3px">` +
//       '<button type="button" class="btn btn-sm btn-primary p-1 decrease-quantity" style="margin-top: -2px;height:40px; width:32px;"><i class="fas fa-minus"></i></button>' +
//       '</div>' +
//       '</td>' +
//       '<td>' +
//       '<div class="d-flex align-items-center">' +
//         '<input type="text" value="" name="discount[]" class="form-control discount-input" toolti placeholder=" 0 " style="width: 80px; height: 34px;" data-row-id="' + product.product.product_id + '">' +

//        '</div>' +
//       '</td>' +
//       '<td class="subtotal">0.00</td>' +
//       '<td>' +
//       '<a href="#" class="action-icon text-danger delete-row">' +
//       '<i class="mdi mdi-delete"></i>' +
//       '</a>' +
//       '</td>' +
//       '<input type="hidden" name="product_id[]" value="' + product.product.product_id + '">' +
//                                               '<input type="hidden" name="name[]" value="' + product.product.product_name + '">' +
//                                               '<input type="hidden" name="price[]" value="' + product.product.selling_price + '">' +
//       '</tr>' +
//       '<tr class="row-separator">' +
//       '<td colspan="6"></td>' +
//       '</tr>';

//       tableBody.append(newRow);
     
//                 });


//                 tableBody.find('.increase-quantity').off('click').on('click', function() {
//     var row = $(this).closest('tr');
//   //  console.log(row);
//     var quantityInput = row.find('.quantity-input');
//     var currentQuantity = parseInt(quantityInput.val());
//     quantityInput.val(currentQuantity + 1);
//     var maxQuantity = quantityInput.attr('max');
//     // var maxQuantity = parseInt($('.quantity-input').attr('max'));
// //console.log(maxQuantity); // Output the value of the max attribute
// if (currentQuantity >= maxQuantity) {
//    // alert('The quantity exceeds the available stock.');
//     Swal.fire(
//   'Alert!',
//   'The quantity exceeds the available stock.',

// )
//     quantityInput.val(maxQuantity); // Reset the input value to the stockValue
//   }
//     updateSubtotal(row);
//     updateValues();
//   });


  
//   tableBody.find('tr').each(function() {
//   var row = $(this);
//   var quantityInput = row.find('.quantity-input');
//   var price = parseFloat(row.find('td:nth-child(2)').text());
//   var subtotalElement = row.find('.subtotal');
//   var discountInput = row.find('.discount-input');



// tableBody.find('.quantity-input').off('input').on('input', function() {
//   var row = $(this).closest('tr');
//   var quantityInput = row.find('.quantity-input');
//   var currentQuantity = parseInt(quantityInput.val());

//   var maxQuantity = quantityInput.attr('max');
// //console.log(maxQuantity); // Output the value of the max attribute
// if (currentQuantity >= maxQuantity) {
//    // alert('The quantity exceeds the available stock.');
//     Swal.fire(
//   'Warning!',
//   'The quantity exceeds the available stock.',
//   'Warning'
// )
// quantityInput.val(maxQuantity); // Reset the input value to the stockValue
//   }
//   updateSubtotal(row);
//   updateValues();
// });



//   discountInput.on('input', function() {
//     var quantity = parseInt(quantityInput.val());
//     var discount = parseFloat(discountInput.val() || 0);
//     var subtotal = quantity * price;
//     var discountedSubtotal = subtotal - discount;

//     subtotalElement.text(discountedSubtotal.toFixed(2));
//     updateValues();
//   });
// });


// tableBody.find('tr').each(function() {
//   var row = $(this);
//   var quantity = parseInt(row.find('.quantity-input').val());
//   var price = parseFloat(row.find('td:nth-child(2)').text());
//   var discount = parseFloat(row.find('.discount-input').val() || 0); // Retrieve the discount value for the row
//   var subtotal = quantity * price;
//   var discountedSubtotal = subtotal - discount; // Subtract the discount from the subtotal
//   row.find('.subtotal').text(discountedSubtotal.toFixed(2));
//   updateValues();
// });

 
//   tableBody.find('.decrease-quantity').off('click').on('click', function() {
//     var row = $(this).closest('tr');
//     var quantityInput = row.find('.quantity-input');
//     var currentQuantity = parseInt(quantityInput.val());
  
//     if (currentQuantity > 1) {
//       quantityInput.val(currentQuantity - 1);
//       updateSubtotal(row);
//       updateValues();
//     }
//   });
  
//   // Bind the delete button click event to remove the row
//   tableBody.find('.delete-row').off('click').on('click', function(e) {
//     e.preventDefault();
//     $(this).closest('tr').remove();
//     updateValues();
//   });
//   function updateSubtotal(row) {
//   var quantityInput = row.find('.quantity-input');
//   var quantity = parseInt(quantityInput.val());
//   var price = parseFloat(row.find('td:eq(1)').text());
//   var subtotal = (quantity * price).toFixed(2);
//   row.find('.subtotal').text(subtotal);
//   updateValues();
// }

// function updateValues() {
//   var totalQuantity = 0;
//   var totalAmount = 0;
//   var totalDiscount = 0;
//   var grandTotal = 0;

//   $('.quantity-input').each(function() {
//     var quantity = parseInt($(this).val());
//     totalQuantity += quantity;
//   });
// // new commint cdsdsd  dfdfd
//   $('.subtotal').each(function() {
//     var subtotal = parseFloat($(this).text());
//     totalAmount += subtotal;
//   });
// // this is change
//   $('.discount-input').each(function() {
//     var discount = parseFloat($(this).val() || 0);
//     totalDiscount += discount;
//   });

//   // grandTotal = totalAmount - totalDiscount;

//   grandTotal =(totalAmount + totalDiscount)-totalDiscount;

//   $('#lqty').text(totalQuantity);
//   $('#ltotal').text((totalAmount + totalDiscount).toFixed(2));
//   $('#ldiscount').text(totalDiscount.toFixed(2));
//   $('#lgrandtotal').text(grandTotal.toFixed(2));
//   $('input[name="totalamountv"]').val((totalAmount + totalDiscount).toFixed(2));
//   $('input[name="totalqty"]').val(totalQuantity);
//   $('input[name="totaldiscountv"]').val(totalDiscount);
// }


//             },
           
//         });


//     }



</script>
