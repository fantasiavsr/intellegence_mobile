@extends('layouts.core')

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

                        <div class="">
                            <h1 class="text-gray-800" style="font-weight:700; font-size:32px;">
                                <a href="{{ url()->previous() }}" class="btn rounded-circle mr-1"
                                    style="background-color: #EDEFF5">
                                    <i class="fa fa-angle-left" style="width: 9px; height:9px"></i>
                                </a>
                                Evaluation
                                <span class="badge text-light"
                                    style="font-weight:500; font-size:15px; background-color:#4FBEAB">
                                    {{ $user->name }}
                                </span>
                            </h1>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col">
                            <div class="card shadow-custom mb-4" style="width:100%">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Test ID</th>
                                                    <th>Question ID</th>
                                                    <th>Answer ID</th>
                                                    <th>Error Count</th>
                                                    <th>Error Penalty</th>
                                                    <th>Diff Penalty</th>
                                                    <th>Missing Keyword</th>
                                                    <th>Word Penalty</th>
                                                    <th>Total Penalty</th>
                                                    <th>Score</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($evaluations as $item)
                                                    <tr class="">
                                                        {{-- <td>
                                                            <img class="avatar rounded-circle me-2"
                                                                @if ($image->where('produk_green_id', $item->id)->pluck('image')->first() != null) src="{{ asset('img/produk/' .$image->where('produk_green_id', $item->id)->pluck('image')->first()) }}"
                                                            @else
                                                                src="{{ asset('img/produk/default.png') }}" @endif
                                                                alt="" style="width:42px; height:42px">
                                                        </td> --}}
                                                        <td>
                                                            {{ $item->id }}
                                                        </td>
                                                        <td>
                                                            {{ $item->test_id }}
                                                        </td>
                                                        <td>
                                                            {{ $item->question_id }}
                                                        </td>
                                                        <td>
                                                            {{ $item->answer_id }}
                                                        </td>
                                                        <td>
                                                            {{ $item->analyze_error_count }}
                                                        </td>
                                                        <td>
                                                            {{ $item->analyze_penalty }}
                                                        </td>
                                                        <td>
                                                            {{ $item->differences_penalty }}
                                                        </td>
                                                        <td>
                                                            {{ $item->missing_keywords }}
                                                        </td>
                                                        <td>
                                                            {{ $item->keyword_penalty }}
                                                        </td>
                                                        <td>
                                                            {{ $item->total_penalty }}
                                                        </td>
                                                        <td>
                                                            {{ $item->score }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('student.evaluation.detail', $item->id) }}"
                                                                class="btn btn-sm btn-primary pr-5 pl-1">
                                                                Detail
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

@endsection
