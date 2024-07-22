@extends('layouts.core')

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
                                        <p>Guide: {{ $task->desc }}</p>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">

                                    <iframe src="{{ route('pdf.show', $task->id) }}" width="100%"
                                        height="720px"></iframe>

                                </div>
                            </div>

                            {{-- card 3 jawab--}}
                            {{-- <div class="card shadow-custom mb-4" style="width:100%">

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
                                                <a href="{{ route('teacher.topic.task', $topic->id) }}"
                                                    class="btn btn-lg mt-2 px-5 mb-4"
                                                    style="background-color: #F9FAFC; width:100%">Cancel</a>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-lg mt-2 px-5 mb-4 text-light"
                                                    style="background-color: #4FBEAB; width:100%">Answer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
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

                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="json_file">Choose File</label>
                                            <input type="file" class="form-control" id="json_file" name="json_file"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Upload</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- card 1 --}}
                            <div class="card shadow-custom mb-4" style="width:100%">

                                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                    <div class=" align-items-center justify-content-between">
                                        {{-- <h1 class="h4 mb-0 text-gray-800 ">Add Question</h1> --}}
                                        <p>Suggestion</p>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">

                                    {{-- <iframe src="{{ asset('public/topic/' . $task->task_path) }}" width="100%" height="600px"></iframe> --}}
                                    {{-- <iframe src="{{ asset('topic/A1_BASIC_UI/A1X.01 Guide.pdf') }}" width="100%" height="600px"></iframe> --}}
                                    {{-- <iframe src="{{ route('pdf.show', $task->id) }} }}" width="100%" height="600px"></iframe> --}}
                                    {{-- {{ $hasil->report }} --}}
                                    <pre>
@if (isset($summary))
{{ $summary->feedback }}
@else
No feedback yet
@endif
</pre>

                                </div>
                                {{-- <!-- Card Footer -->
                                <div class="card-footer flex-row align-items-center text-center">
                                    <a href="#">Lihat Semua</a>
                                </div> --}}
                            </div>

                            {{-- card 2 Stats --}}
                            <div class="row">
                                <div class="col">
                                    <div class="card-deck">
                                        @php
                                            $cautionNumber = 1;
                                        @endphp
                                        @foreach ($student_evaluations->chunk(2) as $chunk)
                                            @foreach ($chunk as $item)
                                                <div class="col-6 mb-4">
                                                    <!-- Bagian ini menyesuaikan agar setiap baris memiliki dua card -->
                                                    <div class="card widget-card border-light shadow-sm">
                                                        <div class="card-body p-4">
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    <h5 class="card-title widget-card-title mb-3">
                                                                        Caution {{ $cautionNumber++ }}
                                                                    </h5>
                                                                    <h4 class="card-subtitle text-body-secondary m-0">
                                                                        {{-- {{ $item->report }} --}}
                                                                        {{-- 25 kata pertama --}}
                                                                        {{ Str::limit($item->report, 25) }}
                                                                    </h4>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="d-flex justify-content-end">
                                                                        <div class="rounded-circle text-white bg-info p-3 d-flex align-items-center justify-content-center"
                                                                            style="width: 30px; height: 30px;">
                                                                            {{ $item->count }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-12">
                                                                    <div class="d-flex align-items-beetwen">
                                                                        <p class="fs-7 mb-0 text-secondary">
                                                                            {{ $item->status }}
                                                                        </p>
                                                                        <div class="col">

                                                                        </div>
                                                                        <div class="col-end">
                                                                            <button type="button"
                                                                                class="btn btn-primary mt-2"
                                                                                data-toggle="modal"
                                                                                data-target="#modal_{{ $item->id }}">
                                                                                Show
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <button class="btn btn-primary mt-2">Show</button> --}}
                                                            <!-- Tombol Show -->
                                                            {{-- <button type="button" class="btn btn-primary mt-2"
                                                                data-toggle="modal"
                                                                data-target="#modal_{{ $item->id }}">
                                                                Show
                                                            </button> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal untuk menampilkan report dan feedback -->
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal_{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="modal_{{ $item->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modal_{{ $item->id }}Label">Detail</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Konten modal -->
                                                                <p>{{ $item->report }}</p>
                                                                <pre>{{ $item->feedback }}</pre>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal -->
                                            @endforeach
                                        @endforeach
                                    </div>
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
    <script>
        $(document).ready(function() {
            $('.btn-primary').click(function() {
                var modalId = $(this).data('target');
                $(modalId).modal('show');
            });
        });
    </script>

@endsection
