@extends('layouts.core_editor3')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('Partials.sidebarteacher')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('Partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    {{-- Sub Title --}}
                    <div class="d-sm-flex align-items-center justify-content-between pt-2 mt-4 mb-4">
                        <h1 class="h3 mb-0 text-gray-800 ">Pengaturan</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-md-5">
                            <div class="card shadow-custom mb-4" style="width:100%">

                                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                    <div class=" align-items-center justify-content-between">
                                        <p>Upload File Evaluasi</p>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    {{-- Form upload json file evaluasi --}}
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <form action="{{ route('upload.json') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="json_file">Choose JSON File</label>
                                            <input type="file" class="form-control" id="json_file" name="json_file"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Upload</button>
                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('Partials.corefooter')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    {{--  @include('Partials.scrolltotop') --}}

    <!-- Logout Modal-->
    @include('Partials.logoutmodal')


    {{-- Custom DataTables --}}
    {{-- <script>
        $('table').dataTable({
            searching: false,
            paging: false,
            info: false
        });
    </script> --}}
@endsection
