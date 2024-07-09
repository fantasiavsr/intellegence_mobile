<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/gv-logo-box.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('demo/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('demo/css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}

    <!-- Custom styles for DataTable-->
    <link href="{{ asset('demo/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Monaco Editor -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.31.1/min/vs/editor/editor.main.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.31.1/min/vs/loader.min.js"></script> --}}

    <style>
        .hidden {
            display: none !important;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .form-container {
            background-color: #f8f9fc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
            width: 300px;
        }

        .form-container .form-group {
            margin-bottom: 15px;
        }

        .form-container label {
            margin-bottom: 5px;
            display: block;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-container button {
            width: 48%;
        }
    </style>
</head>

<body id="page-top">

    @yield('content')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('demo/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('demo/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('demo/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('demo/js/sb-admin-2.min.js') }}"></script>

    <!-- DataTables scripts -->
    <script src="{{ asset('demo/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('demo/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('demo/js/demo/datatables-demo.js') }}""></script>

    {{-- Custom DataTables --}}
    <script>
        $('table').dataTable({
            searching: true,
            paging: true,
            info: true,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ]
        });
    </script>

    <!-- Monaco Editor -->
    {{-- <script>
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.31.1/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            var editor = monaco.editor.create(document.getElementById('editor'), {
                value: [
                    "// This is a simple Dart program.",
                    "// Delete all to empty key answer",
                    "import 'package:flutter/material.dart';",
                    "",
                    "void main() {",
                    "  runApp(MyApp());",
                    "}",
                    "",
                    "class MyApp extends StatelessWidget {",
                    "  @override",
                    "  Widget build(BuildContext context) {",
                    "    return MaterialApp(",
                    "      home: Scaffold(",
                    "        appBar: AppBar(",
                    "          title: Text('Flutter App'),",
                    "        ),",
                    "        body: Center(",
                    "          child: Text('Hello, World!'),",
                    "        ),",
                    "      ),",
                    "    );",
                    "  }",
                    "}"
                ].join("\n"),
                language: 'dart',
                theme: 'vs-dark'
            });

            // Menangkap nilai dari editor saat form disubmit
            document.querySelector('form').addEventListener('submit', function() {
                var value = editor.getValue();
                // Set nilai editor sebagai nilai dari textarea dengan name 'key_answer'
                document.querySelector('textarea[name="key_answer"]').value = value;
            });
        });
    </script> --}}

</body>

</html>
