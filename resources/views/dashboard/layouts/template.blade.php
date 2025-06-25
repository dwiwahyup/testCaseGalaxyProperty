<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TestCase</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('assets/admin/img/favicon.png') }}" rel="icon">
    <link href="{{ url('assets/admin/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



    <!-- Template Main CSS File -->
    <link href="{{ url('assets/admin/css/style.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .active-notification {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
        }
        .notification-item:hover {
            background-color: #e9ecef;
        }
        .mark-all-read, .delete-all-read {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>

    @include('dashboard.layouts.navbar')

    @yield('content')

    @include('dashboard.layouts.sidebar')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->

    <script src="{{ url('assets/admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('assets/admin/vendor/php-email-form/validate.js') }}"></script>


    <!-- Template Main JS File -->
    <script src="{{ url('assets/admin/js/main.js') }}"></script>
    <script>
       function markAsRead(notificationId, link) {
            fetch(`/notifications/${notificationId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to mark as read');
                return response.json();
            })
            .then(data => {
                window.location.href = link;
            })
            .catch(error => {
                console.error('Error marking as read:', error);
                window.location.href = link;
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.notification-item').click(function(e) {
                if ($(this).hasClass('active-notification')) {
                    const notificationId = $(this).data('notification-id');
                    markAsRead(notificationId);
                }
            });

            $('.mark-all-read').click(function() {
                if (confirm('Mark all notifications as read?')) {
                    $.ajax({
                        url: '{{ route("notifications.markAllRead") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });

            function markAsRead(notificationId) {
                $.ajax({
                    url: `/notifications/${notificationId}/mark-as-read`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }
        });
    </script>
</body>

</html>
