<!DOCTYPE html>
<html lang="en">

    @php
        $site_setting = DB::table('site_settings')->first();
    @endphp

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if (@$site_setting->icon == '' || @$site_setting->icon == null)
        <link rel="icon" href="{{ asset('upload/no_image.jpg') }}">
    @else
        <link rel="icon" href="{{ URL::to('storage/icon', @$site_setting->icon) }}">
    @endif

    <title>{{ @$site_setting->company_name }}</title>
    
    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/custom_style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/dashboard_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/product_edit_multi_img_add.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2_search.css') }}">

    {{-- Select-2 Search css --}}
    <link rel="stylesheet" href="{{ asset('backend/css/select2_search/select2_search.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/product_add_page/product_add.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/scss/custom_scss/datepicker_scss.scss') }}">

    {{-- Date-Picker Show Section CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/javascript-datepicker-lightpick/css/lightpick.css') }}">
    
    {{-- Top Bar Message Show Section CSS --}} 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    @stack('css')


</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">

        @include('admin.body.header')

        <!-- Left side column. contains the logo and sidebar -->

        @include('admin.body.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-white">

            @yield('admin')

        </div>
        <!-- /.content-wrapper -->
        @include('admin.body.footer')

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->

    <!-- Vendor JS -->
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    {{-- Datatables Section JS --}} 
    <script src="{{ asset('../assets/vendor_components/datatable/datatables.min.js') }}"></script>
	<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>
    <!-- Sunny Admin App -->
    <script src="{{ asset('backend/js/template.js') }}"></script>
    <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>
    {{-- Delete Section JS --}}
    <script src="{{ asset('assets/delete_custom_js/delete_custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Order Controll Section JS --}}
    <script src="{{ asset('assets/order_controll_js/order_controll.js') }}"></script>
    {{-- Tags Input Section Js --}}
    <script src="{{ asset('../assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
    {{-- CK Editors Section Js --}}
    
    {{-- <script src="{{ asset('../assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
	<script src="{{ asset('backend/js/pages/editor.js') }}"></script> --}}

    {{-- Toastr Message Js Link --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- Image validation message --}}
    <script src="{{ asset('assets/img_validation_custom_js/common.js') }}"></script>
    <script src="{{ asset('assets/img_validation_custom_js/multi_img.js') }}"></script>
    {{-- Order Return Approve & Cancel Sweet-alert --}}
    <script src="{{ asset('assets/return_order_approve_cancel_js/return_order_approve_cancel.js') }}"></script>
    {{-- Date-Picker Show Section CSS --}}
    <script src="{{ asset('assets/javascript-datepicker-lightpick/js/lightpick.js') }}"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://unpkg.com/lightpick@latest/lightpick.js"></script>

    {{-- Inspect Off Js --}}
    {{-- <script src="{{ asset('assets/inspect_off_js/inspect_off.js') }}"></script> --}}
    

    {{-- Top Bar Message Show Section JS --}} 
    @if(Session::has('message'))
      <script>
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
      </script>
    @endif


    @stack('js')


</body>

</html>
