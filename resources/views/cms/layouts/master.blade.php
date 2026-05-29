<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EMS Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/mdi/css/materialdesignicons.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/skydash/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/skydash/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/skydash/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/skydash/images/favicon.png') }}" />
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('assets/skydash/toastr/toastr.min.css') }}">
     <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('assets/skydash/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/skydash/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @yield('headerLinks')
</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        @include('cms.layouts.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('cms.layouts.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            2026.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with <i class="ti-heart text-danger ms-1"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/skydash/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/skydash/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/skydash/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/skydash/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/dataTables.select.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/skydash/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/template.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/settings.js') }}"></script>
    <script src="{{ asset('assets/skydash/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/skydash/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/skydash/js/dashboard.js') }}"></script>
    {{-- <script src="{{ asset('assets/skydash/js/Chart.roundedBarCharts.js')}}"></script> --}}
        <!-- Toastr -->
    <script src="{{ asset('assets/skydash/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: "bootstrap4",
                allowClear: true
            });

            $('#summernote').summernote({
                height: 300,
            });

        });

        if ("{{ session()->has('success') }}") {
            let message = "{{ session()->get('success') }}";
            toastr.success(message);
        }

        if ("{{ session()->has('error') }}") {
            let message = "{{ session()->get('error') }}";
            toastr.error(message);
        }

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif

        function confirmBox(submitBtnTarget) {
            let result = confirm("Want to delete?");
            if (result) {
                $(submitBtnTarget).closest("form").submit();
            }

        }

        function deleteItem(path) {
            var sure = confirm('are you sure');
            if (!sure) {
                return false;
            }

            $.ajax({
                url: path,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    toastr.success('Successfully Deleted');
                    location.reload();
                },
                error: function(response) {
                    if (response.status == '404') {
                        alert("Item not found");
                    } else
                        alert(response.statusText);
                }
            });
        }
    </script>
    @yield('footerScripts')
    <!-- End custom js for this page-->
</body>

</html>
