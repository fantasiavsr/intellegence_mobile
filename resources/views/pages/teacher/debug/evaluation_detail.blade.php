@extends('layouts.core3')

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

                    {{-- Sub Title - Nama Produk --}}
                    <div class="d-sm-flex align-items-center justify-content-between pt-2 mt-1 mb-4">
                        <div class="">
                            <h1 class="text-gray-800" style="font-weight:700; font-size:32px;">
                                <a href="{{ url()->previous() }}" class="btn rounded-circle mr-1"
                                    style="background-color: #EDEFF5">
                                    <i class="fa fa-angle-left" style="width: 9px; height:9px"></i>
                                </a>
                                Evaluation ID:{{ $evaluation->id }}
                                <span class="badge text-light"
                                    style="font-weight:500; font-size:15px; background-color:#4FBEAB">
                                    {{ $user->name }}
                                </span>
                            </h1>
                        </div>
                        <div class="pb-2">
                            {{-- <a href="" class="btn btn-lg shadow-custom-alt mt-2 text-light"
                                style="background-color: #30445C">
                                Update</a> --}}
                            <a href="" class="btn btn-lg shadow-custom-green mt-2 text-light"
                                style="background-color: #30445C">
                                Evaluate</a>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="card shadow-custom mb-4" style="width:100%; background-color: #30445C">
                                <!-- Card Body -->
                                <div class="card-body text-light" style="">
                                    <div class="row">
                                        <div class="col d-flex">
                                            <label class="form-label text-light" style="">Evaluation Ready
                                                <i class="fas fa-fw fa-bookmark"></i>
                                                <span>
                                                    <p class="text-light" style="font-size: 12px; margin-bottom: 0;">Open AI
                                                    </p>
                                                </span>
                                            </label>

                                        </div>
                                        <div class="col text-right">
                                            <button id="toggleButton" class="btn btn-primary"
                                                onclick="toggleEvaluation()">Show
                                                Evaluation</button>
                                        </div>
                                    </div>
                                    <p id="evaluationText" class="pt-3" style="margin-top: 0; display: none;">
                                        Evaluasi kode yang diberikan:

                                        Terdapat kesalahan dan beberapa saran untuk meningkatkan kinerja kode. Kesalahan
                                        utama adalah fungsi MyAp yang tidak terdefinisi seharusnya MyApp. Selain itu,
                                        beberapa saran diberikan untuk memperbaiki kinerja: menambahkan parameter key pada
                                        konstruktor publik, dan menggunakan kata kunci const untuk meningkatkan performa.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="card shadow-custom mb-4" style="width:100%">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <label class="form-label" style="">Question
                                        <span>
                                            <p class="text-grey" style="font-size: 12px; margin-bottom: 0;">question id:
                                                {{ $evaluation->question_id }}</p>
                                        </span>
                                    </label>
                                    <p class="pt-0" style="margin-top: 0;">
                                        {{ $question->question }}
                                    </p>
                                </div>
                                {{-- <!-- Card Footer -->
                                <div class="card-footer flex-row align-items-center text-center">
                                    <a href="#">Lihat Semua</a>
                                </div> --}}
                            </div>
                        </div>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col">
                            <div class="card shadow-custom mb-4" style="width:100%">
                                <!-- Card Body -->
                                <div class="card-body">
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
                                    <label class="form-label">Answer
                                        <span>
                                            <p class="text-grey" style="font-size: 12px">*exact flutter code</p>
                                        </span>
                                    </label>
                                    <textarea name="answer" style="display: none;"></textarea>
                                    <div id="editor"></div>
                                </div>
                                {{-- <!-- Card Footer -->
                                <div class="card-footer flex-row align-items-center text-center">
                                    <a href="#">Lihat Semua</a>
                                </div> --}}
                            </div>
                        </div>

                    </div>

                    <!-- Content Row -->
                    <div class="row">


                        <div class="col d-flex">
                            <div class="card shadow-custom-green mb-4" style="width:100%; background-color: #4FBEAB">
                                <!-- Card Body -->
                                <div class="card-body text-light" style="">

                                    <div class="row d-flex px-3">
                                        <div class="col">
                                            <div class="table-responsive" style="">
                                                <table class="table table-borderless text-light">
                                                    <thead>
                                                        <thead>
                                                            <tr>
                                                                <th>Error Count</th>
                                                                <th>Error Penalty</th>
                                                                <th>Diff Penalty</th>
                                                                <th>Missing Keyword</th>
                                                                <th>Word Penalty</th>
                                                                <th>Score</th>
                                                                {{-- <th></th> --}}
                                                            </tr>
                                                        </thead>
                                                    </thead>
                                                    <tbody">
                                                        <tr>
                                                            <td>{{ $evaluation->analyze_error_count }}</td>
                                                            <td>{{ $evaluation->analyze_penalty }}</td>
                                                            <td>{{ $evaluation->differences_penalty }}</td>
                                                            <td>{{ $evaluation->missing_keywords }}</td>
                                                            <td>{{ $evaluation->keyword_penalty }}</td>
                                                            <td>{{ $evaluation->score }}</td>
                                                        </tr>
                                                        </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- <div class="col-xl-2 pt-2">
                                            <a href=""
                                                class="btn btn-light mt-2" style="width:100%">Bandingkan</a>
                                            <div class="text-center pt-3">
                                                <a href="#" class="text-light">
                                                    <i class="fas fa-fw fa-question"></i>
                                                    <span>Bantuan</span>
                                                </a>
                                            </div>

                                        </div> --}}
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Content Row - Asset -->
                    <div class="row mt-2">

                        <div class="col">
                            {{-- <h4 class=" text-gray-800 ">Manajer Investasi</h4> --}}
                            <div class="card mb-4" style="width:100%">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row d-flex px-3">
                                        <div class="col">
                                            <label class="form-label">Console
                                                {{-- <span>
                                                    <p class="text-grey" style="font-size: 12px">*exact flutter code</p>
                                                </span> --}}
                                            </label>
                                            <textarea class="form-control" rows="5" style="background-color: black; color: white;" disabled>http://localhost:8000/> {{ $evaluation->analyze_stdout }}
                                            </textarea>
                                        </div>
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
    @include('Partials.scrolltotop')

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
        function toggleEvaluation() {
            var evaluationText = document.getElementById("evaluationText");
            var toggleButton = document.getElementById("toggleButton");

            if (evaluationText.style.display === "none") {
                evaluationText.style.display = "block";
                toggleButton.textContent = "Hide Evaluation";
            } else {
                evaluationText.style.display = "none";
                toggleButton.textContent = "Show Evaluation";
            }
        }
    </script>
@endsection
