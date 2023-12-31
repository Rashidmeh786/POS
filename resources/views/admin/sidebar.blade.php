<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>
              {{-- @if(Auth::user()->can('pos.menu')) --}}
                <li>
                    <a href="{{ route('pos') }}">
                        <span class="badge bg-pink float-end">NEW</span>
                    <i class="mdi mdi-cart-plus "></i>
                        <span> POS </span>
                    </a>
                </li>
                {{-- @endif --}}
                <li>
                    <a href="{{ url('dashboard') }}">
                     <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end">4</span>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li class="menu-title mt-2">Organization</li>

               

                <li>
                    <a href="#" data-bs-toggle="collapse">
                     <i class="mdi mdi-account-arrow-left"></i>

                        <span>  Students </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="#">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.designation') }}"> Students</a>
                            </li>
                          
                            {{-- <li>
                                <a href="{{ route('add.employee') }}">Add Employee</a>
                            </li> --}}
                            <li>
                                <a href="{{ route('all.employee') }}">Manage Students</a>
                            </li>
                           
                        </ul>
                        
                    </div>
                </li>


                {{-- <li class="menu-title mt-2">Employees</li> --}}

               

                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                     <i class="mdi mdi-account-arrow-left"></i>
                        <span> Employees </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.employee') }}">Employees</a>
                            </li>
                            <li>
                                <a href="{{ route('all.designation') }}"> Designations</a>
                            </li>
                          
                            <li>
                                <a href="{{ route('all.department') }}"> Department</a>
                            </li>
                           
                           
                        </ul>
                        
                    </div>
                </li>

                <li>
                    <a href="#salary" data-bs-toggle="collapse">
                     <i class="mdi mdi-cash"></i>
                        <span> Employee Salary </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="salary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('pay.salary') }}">Pay Salary</a>
                            </li>
                            <li>
                                <li>
                                    <a href="{{ route('month.salary') }}">  Salary History</a>
                                </li>
                                {{-- <li>
                                <a href="{{ route('add.advance.salary') }}"> Advance Salary</a>
                            </li> --}}
                            <li>
                                <a href="{{ route('all.advance.salary') }}">Advance Salary </a>
                            </li>
        
                        </ul>
                    </div>
                </li>
            
                <li>
                    <a href="#attendence" data-bs-toggle="collapse">
                     <i class="mdi mdi-account-check"></i>
                        <span> Employee Attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="attendence">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employee.attendance.list') }}">Employee Attendence </a>
                            </li>
        
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                     <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Customers </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.customer') }}">All Customer</a>
                            </li>
                            <li>
                                <a href="{{ route('add.customer') }}">Add New Customer</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>


    

                <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                     <i class="mdi mdi-account-cash"></i>
                        <span> Manage Supplier  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.supplier') }}">All Supplier</a>
                            </li>
                            <li>
                                <a href="{{ route('add.supplier') }}">Add New </a>
                            </li>
                        </ul>
                    </div>
                </li>

              

                <li class="menu-title mt-2">Inventory</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                     <i class="mdi mdi-account-circle-outline"></i>
                        <span> Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            
                            <li>
                                <a href="{{route('all.category')}}">Product Categories</a>
                            </li>
                            <li>
                                <a href="{{route('all.brand')}}">Product Brands</a>
                            </li>
                            <li>
                                <a href="{{route('all.unit')}}">Product Unit</a>
                            </li>
                            <li>
                                <a href="{{route('all.product')}}">All Products</a>
                            </li>
                           
                            
                            
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#stock" data-bs-toggle="collapse">
                     <i class="mdi mdi-sticker-plus"></i>
                        <span> Manage Stock    </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('stock.manage') }}"> Current Stock </a>
                            </li>
                            <li>
                                <a href="{{ route('all.adjustment') }}"> Adjustment Details </a>
                            </li>
                
                
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#orders" data-bs-toggle="collapse">
                     <i class="mdi mdi-cart-outline"></i>

                        <span>  Sale  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="orders">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.sale') }}">Add Sale </a>
                            </li>
                            <li>
                                <a href="{{ route('pending.order') }}">Pending Orders </a>
                            </li>
                
                             <li>
                                <a href="{{ route('complete.order') }}">Complete Orders </a>
                            </li>
                            <li>
                                <a href="{{ route('pending.due') }}">Pending Dues </a>
                            </li>
                            <li>
                                <a href="{{ route('all.sales') }}">All Sales </a>
                            </li>
                
                
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#purchase" data-bs-toggle="collapse">
                     <i class="mdi mdi-cart-outline"></i>

                        <span> Purchase  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="purchase">
                        <ul class="nav-second-level">
                           
                            {{-- <li>
                                <a href="{{ route('all.purchase') }}">All Purchase </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('add.purchase') }}">Add Purchase </a>
                            </li>
                            <li>
                                <a href="{{ route('all.purchase') }}">All Purchases </a>
                            </li>
                            <li>
                                <a href="{{ route('pending.purchaseorder') }}">Pending Purchases </a>
                            </li>
                            <li>
                                <a href="{{ route('complete.purchaseorder') }}">Complete Purchase Orders </a>
                            </li>
                        </ul>
                    </div>
                </li>



                {{-- <li class="menu-title mt-2">Custom</li> --}}

                <li>
                    <a href="#expense" data-bs-toggle="collapse">
                     <i class="mdi mdi-account-circle-outline"></i>
                        <span> Expenses </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="expense">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.category') }}">Expense Categories</a>
                            </li>
                            
                            <li>
                                <a href="{{ route('all.expenses') }}">Expense</a>
                            </li>
                        
                           
                            
                        </ul>
                    </div>
                </li>
                <li class="menu-title mt-2">User Managment</li>
                <li>
                    <a href="#admin" data-bs-toggle="collapse">
                     <i class="mdi mdi-account-cog"></i>
                        <span> User Managment   </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="admin">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.users') }}">All Users </a>
                            </li>
                
                            <li>
                                <a href="{{ route('add.user') }}">Add User </a>
                            </li> 
                
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#permission" data-bs-toggle="collapse">
                     <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Roles And Permission    </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="permission">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.permission') }}">All Permission </a>
                            </li>
                            <li>
                                <a href="{{ route('all.roles') }}">All Roles </a>
                            </li>
                            <li>
                                <a href="{{ route('add.roles.permission') }}">Assign Permission to Roles </a>
                            </li>
                            <li>
                                <a href="{{ route('all.roles.permission') }}"> Roles Permissions </a>
                            </li>
                
                
                        </ul>
                    </div>
                </li>

              
           
              
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>