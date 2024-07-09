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
                        <h1 class="h3 text-gray-800 ">Answer List</h1>
                        {{-- <a class="" href="{{ route('teacher.debug.add_question') }}">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add Item</span>
                            </button>
                        </a> --}}
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
                                                    <th>Question ID</th>
                                                    <th>Answer ID</th>
                                                    <th>Test ID</th>
                                                    <th>Question</th>
                                                    <th>status</th>
                                                    <th>Answer</th>
                                                    <th>Analyze</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($question as $item)
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
                                                            {{-- {{ $item->id }} --}
                                                            {{-- answer id --}}
                                                            {{ $answered->where('question_id', $item->id)->pluck('id')->first() }}

                                                        </td>
                                                        <td>
                                                            {{ $item->test_id }}
                                                        </td>
                                                        <td>
                                                            {{ $item->question }}
                                                        </td>
                                                        <td>
                                                            {{-- check if this question already answerred --}}
                                                            @php
                                                                $status = $answered
                                                                    ->where('question_id', $item->id)
                                                                    ->count();
                                                                if ($status > 0) {
                                                                    echo '<span class="badge badge-success">Answered</span>';
                                                                } else {
                                                                    echo '<span class="badge badge-danger">Not Answered</span>';
                                                                }
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('student.fill_question', ['id' => $item->id]) }}"
                                                                class="btn btn-sm btn-warning pr-5 pl-1">
                                                                Answer
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{-- <a href=""
                                                                class="btn btn-sm btn-success pr-5 pl-1">
                                                                Analyze
                                                            </a> --}}
                                                            @if ($status > 0)
                                                                <form action="{{ route('student.evaluation.store') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="question_id"
                                                                        value="{{ $item->id }}">
                                                                    <input type="hidden" name="test_id"
                                                                        value="{{ $item->test_id }}">
                                                                    {{-- answer id from this user for this question id --}}
                                                                    <input type="hidden" name="answer_id"
                                                                        value="{{ $answered->where('question_id', $item->id)->pluck('id')->first() }}">
                                                                    {{-- <button type="submit"
                                                                        class="btn btn-sm btn-primary pr-5 pl-1"> Analyze
                                                                    </button> --}}
                                                                    {{-- check if analyzed show button anaylze again? --}}
                                                                    @php
                                                                        $status = $evaluations
                                                                            ->where('question_id', $item->id)
                                                                            ->count();
                                                                        if ($status > 0) {
                                                                            echo '<button type="submit" class="btn btn-sm btn-primary pr-5 pl-1"> Analyze Again? </button>';
                                                                        } else {
                                                                            echo '<button type="submit" class="btn btn-sm btn-primary pr-5 pl-1"> Analyze </button>';
                                                                        }
                                                                    @endphp
                                                                </form>
                                                            @else
                                                                <a href="" class="btn btn-sm btn-secondary pr-5 pl-1 disabled">
                                                                    Analyze
                                                                </a>
                                                            @endif
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
