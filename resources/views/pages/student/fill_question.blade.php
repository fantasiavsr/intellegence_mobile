@extends('layouts.core_editor2')

@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('Partials.sidebarstudent')
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
                        <h1 class="h3 mb-0 text-gray-800 ">Question ID: {{ $question->id }}</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col">
                            <div class="card shadow-custom mb-4" style="width:100%">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <div class=" align-items-center justify-content-between">
                                        {{-- <h1 class="h4 mb-0 text-gray-800 ">Add Question</h1> --}}
                                        <p>{{ $question->question }}</p>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">

                                    {{-- {{ $this_item->user->nama_lengkap }}
                                    {{ $this_item->produk_green->nama }}
                                    {{ $this_item->total_bayar }}
                                    {{ $this_item->jenis_transaksi }}
                                    {{ $this_item->tanggal }}
                                    {{ $this_item->status }} --}}

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('student.add_answer.store') }}" method="POST">
                                        @csrf
                                        {{-- {{ $this_item->id }} --}}
                                        {{-- <input type="hidden" name="id" value="{{ $this_item->id }}"> --}}
                                        <input type="hidden" name="question_id" value="{{ $question->id }}">
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
                                                <label class="form-label">Key Answer
                                                    <span>
                                                        <p class="text-grey" style="font-size: 12px">*exact flutter code</p>
                                                    </span>
                                                </label>
                                                <textarea name="answer" style="display: none;"></textarea>
                                                <div id="editor"></div>

                                            </div>


                                        </div>

                                        <!-- Submit button -->
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('student.tests.question', ['id' => $test->id]) }}"
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
