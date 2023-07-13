<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Dashboard |  - ABC</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

        <!-- Plugins css -->
        <link href="{{asset('backend/assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />
        
        <!-- Bootstrap css -->
        <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
        <!-- icons -->
        <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Head js -->
  
      
<link href="{{ asset('backend/assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css')}}" />
<link href="{{ asset('backend/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css')}}" />

<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
 <!-- dataTables -->
 <link href="{{ asset('backend/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('backend/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<!-- dataTables end -->

        <script src="{{asset('backend/assets/js/head.js')}}"></script>
        <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>


    </head>

    <!-- body start -->
    <body data-layout-mode="default" data-theme="light" data-topbar-color="dark" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- Topbar Start -->
          @include('admin.header')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
        
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="pos">
                <div class="container_fluid mt-5">
                    @yield('admin')

                </div>
              @include('sweetalert::alert')  
              {{-- <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script> --}}


                <!-- Footer Start -->
              
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
      
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>

        <!-- Plugins js-->
        <script src="{{asset('backend/assets/libs/flatpickr/flatpickr.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <script src="{{asset('backend/assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>

        <!-- Dashboar 1 init js-->
        <script src="{{asset('backend/assets/js/pages/dashboard-1.init.js')}}"></script>

        <!-- App js-->
        <script src="{{asset('backend/assets/js/app.min.js')}}"></script>
        
{{-- <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script> --}}

 <!-- datatables js -->
 <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
 <script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
 <!-- third party js ends -->


 <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
<!-- Datatables Eend -->
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>



<!-- Dropzone file uploads-->
<script src="{{asset('backend/assets/libs/dropzone/min/dropzone.min.js')}}"></script>

<!-- Quill js -->
<script src="{{asset('backend/assets/libs/quill/quill.min.js')}}"></script>

<!-- Init js-->
<script src="{{asset('backend/assets/js/pages/form-fileuploads.init.js')}}"></script>

<!-- Init js -->
<script src="{{asset('backend/assets/js/pages/add-product.init.js')}}"></script>


    </body>
</html>