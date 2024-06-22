<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/gv-logo-box.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('demo/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('demo/css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- <link href="demo/css/sb-admin-2.min.css" rel="stylesheet"> --}}

    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
    {{-- <link href="css/style.css" rel="stylesheet"> --}}

    <!-- Custom styles for DataTable-->
    <link href="{{ asset('demo/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    {{-- <link href="demo/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}

    {{--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}

    {{-- @include('css.css1') --}}

    {{-- @include('css.sb-admin-2') --}}

    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>


    <style>
        .bg-gradient-animation {
            background: linear-gradient(270deg, #4fbeab, #30445c);
            background-size: 400% 400%;
            -webkit-animation: BG 35s ease infinite;
            -moz-animation: BG 35s ease infinite;
            -o-animation: BG 35s ease infinite;
            animation: BG 35s ease infinite;
        }

        @-webkit-keyframes BG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @-moz-keyframes BG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @-o-keyframes BG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes BG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body id="page-top">

    @yield('content')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('demo/vendor/jquery/jquery.min.js') }}"></script>
    {{-- <script src="demo/vendor/jquery/jquery.min.js"></script> --}}

    <script src="{{ asset('demo/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('demo/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="demo/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(".filter").on("keyup", function() {
            var input = $(this).val().toUpperCase();

            $(".card").each(function() {
                if ($(this).data("string").toUpperCase().indexOf(input) < 0) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            })
        });
    </script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('demo/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    {{-- <script src="demo/vendor/jquery-easing/jquery.easing.min.js"></script> --}}

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('demo/js/sb-admin-2.min.js') }}"></script>
    {{-- <script src="demo/js/sb-admin-2.min.js"></script> --}}

    <!-- Page level plugins -->
    <script src="{{ asset('demo/vendor/chart.js/Chart.min.js') }}"></script>
    {{-- <script src="demo/vendor/chart.js/Chart.min.js"></script> --}}

    <!-- DataTables scripts -->
    <script src="{{ asset('demo/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="demo/vendor/datatables/jquery.dataTables.min.js"></script> --}}

    <script src="{{ asset('demo/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="demo/vendor/datatables/dataTables.bootstrap4.min.js"></script> --}}

    <script src="{{ asset('demo/js/demo/datatables-demo.js') }}"></script>
    {{-- <script src="demo/js/demo/datatables-demo.js"></script> --}}


    {{-- Custom DataTables --}}
    <script>
        $('table').dataTable({
            searching: true,
            paging: true,
            info: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ]
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            var cards = $(".card-deck");
            var cardContainer = $("#cardContainer");
            var pagination = $("#pagination ul");

            var itemsPerPage = 8; // Jumlah kartu per halaman
            var currentPage = 1;

            showPage(currentPage);

            function showPage(page) {
                cards.hide();
                cards.slice((page - 1) * itemsPerPage, page * itemsPerPage).show();
            }

            var totalPages = Math.ceil(cards.length / itemsPerPage);

            for (var i = 1; i <= totalPages; i++) {
                pagination.append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
            }

            pagination.find("li:first").addClass("active");

            pagination.find("a").on("click", function() {
                var newPage = $(this).text();
                pagination.find("li").removeClass("active");
                $(this).parent().addClass("active");
                showPage(newPage);
                currentPage = newPage;
            });
        });
    </script> --}}

    {{-- <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>

    <script>
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script> --}}

    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        $('#datepicker').datetimepicker({
            footer: true,
            modal: true,
        });
        $('#datepicker2').datetimepicker({
            footer: true,
            modal: true
        });
    </script>
</body>

</html>
