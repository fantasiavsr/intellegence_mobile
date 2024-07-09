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
                        <h1 class="h3 mb-0 text-gray-800 ">Task ID: {{ $task->id }}</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col">
                            <div class="card shadow-custom mb-4" style="width:100%">

                                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                    <div class=" align-items-center justify-content-between">
                                        {{-- <h1 class="h4 mb-0 text-gray-800 ">Add Question</h1> --}}
                                        <p>{{ $task->desc }}</p>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">

                                    {{-- <iframe src="{{ asset('public/topic/' . $task->task_path) }}" width="100%" height="600px"></iframe> --}}
                                    {{-- <iframe src="{{ asset('topic/A1_BASIC_UI/A1X.01 Guide.pdf') }}" width="100%" height="600px"></iframe> --}}
                                    <iframe src="{{ route('pdf.show', $task->id) }} }}" width="100%" height="600px"></iframe>

                                </div>
                                {{-- <!-- Card Footer -->
                                <div class="card-footer flex-row align-items-center text-center">
                                    <a href="#">Lihat Semua</a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="card shadow-custom mb-4" style="width:100%">

                                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                    <div class=" align-items-center justify-content-between">
                                        {{-- <h1 class="h4 mb-0 text-gray-800 ">Add Question</h1> --}}
                                        <p>Guidance</p>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">

                                    {{-- <iframe src="{{ asset('public/topic/' . $task->task_path) }}" width="100%" height="600px"></iframe> --}}
                                    {{-- <iframe src="{{ asset('topic/A1_BASIC_UI/A1X.01 Guide.pdf') }}" width="100%" height="600px"></iframe> --}}
                                    {{-- <iframe src="{{ route('pdf.show', $task->id) }} }}" width="100%" height="600px"></iframe> --}}
                                    {{-- {{ $hasil->report }} --}}
                                    <pre>{{ $hasil->feedback }}</pre>

                                </div>
                                {{-- <!-- Card Footer -->
                                <div class="card-footer flex-row align-items-center text-center">
                                    <a href="#">Lihat Semua</a>
                                </div> --}}
                            </div>

                            <div class="card shadow-custom mb-4" style="width:100%">

                                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                    <p>Jawab</p>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="" method="POST">
                                        @csrf
                                        {{-- {{ $this_item->id }} --}}
                                        {{-- <input type="hidden" name="id" value="{{ $this_item->id }}"> --}}
                                        <input type="hidden" name="question_id" value="{{ $task->id }}">
                                        <div class="row d-flex">

                                            <div class="col-sm form-outline mb-4">

                                                <style>
                                                    #editor {
                                                        width: 100%;
                                                        height: 400px;
                                                        border: 1px solid #333;
                                                        border-radius: 4px;
                                                    }

                                                    .form-label {
                                                        color: #d4d4d4;
                                                        /* Label color */
                                                        font-family: Arial, sans-serif;
                                                        /* Label font family */
                                                        font-size: 14px;
                                                        /* Label font size */
                                                    }

                                                    .text-grey {
                                                        color: #a0a0a0;
                                                        /* Grey text color */
                                                    }
                                                </style>
                                                <textarea name="answer" style="display: none;"></textarea>
                                                <div id="editor"></div>

                                            </div>


                                        </div>

                                        <!-- Submit button -->
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('teacher.topic.task', $topic->id) }}" class="btn btn-lg mt-2 px-5 mb-4"
                                                    style="background-color: #F9FAFC; width:100%">Cancel</a>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-lg mt-2 px-5 mb-4 text-light"
                                                    style="background-color: #4FBEAB; width:100%">Answer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{-- <!-- Card Footer -->
                                <div class="card-footer flex-row align-items-center text-center">
                                    <a href="#">Lihat Semua</a>
                                </div> --}}
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
