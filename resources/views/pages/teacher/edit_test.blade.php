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

                <div id="formOverlay" class="overlay hidden">
                    <div class="form-container">
                        <form action="{{ route('teacher.tests.add_question_openai', ['id' => $test->id]) }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" id="question" name="question" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" onclick="hideForm()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Topbar -->
                @include('Partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    {{-- Sub Title --}}
                    <div class="d-sm-flex align-items-center justify-content-between pt-2 mt-4 mb-4">
                        <h1 class="h3 text-gray-800 ">Test: {{ $test->name }}</h1>

                        <div class="">
                            <a class="" href="javascript:void(0);" onclick="showForm()">
                                <button class="btn btn-dark btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Add Question with OpenAI</span>
                                </button>
                            </a>
                            <a class="" href="{{ route('teacher.tests.add_question', ['id' => $test->id]) }}">
                                <button class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Add Question</span>
                                </button>
                            </a>
                            <button id="updateButton" class="btn btn-success btn-icon-split" type="button">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Update</span>
                            </button>


                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="card shadow-custom mb-4" style="width:100%">
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

                                    <form id="updateForm" action="{{ route('teacher.tests.update', ['id' => $test->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        {{-- {{ $this_item->id }} --}}
                                        {{-- <input type="hidden" name="id" value="{{ $this_item->id }}"> --}}
                                        {{-- <input type="hidden" name="question_id" value="{{ $classroom->id }}"> --}}
                                        <div class="row d-flex">

                                            <div class="col-sm-2 form-outline mb-4">
                                                <label class="form-label">Name of Test</label>
                                                <input type="text" name="name" class="form-control" required
                                                    value="{{ $test->name }}">
                                            </div>

                                            <div class="col-sm form-outline mb-4">
                                                <label class="form-label">Classroom</label>
                                                <select type="text" name="classroom_id" class="form-control" autofocus
                                                    required>
                                                    @foreach ($classroom as $item)
                                                        {{-- if --}}
                                                        <option value="{{ $item->id }}"
                                                            @if ($item->id == $test->classroom_id) selected @endif>
                                                            {{ $item->id }} - {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                                    <th>No</th>
                                                    <th>Question ID</th>
                                                    <th>Question</th>
                                                    <th>Code Path</th>
                                                    <th>Key Words</th>
                                                    <th>Created At</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($question as $item)
                                                    <tr class="">
                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $item->id }}
                                                        </td>
                                                        <td>
                                                            {{ $item->question }}
                                                        </td>
                                                        <td>
                                                            {{ $item->code_path }}
                                                        </td>
                                                        <td>
                                                            {{ $item->key_word }}
                                                        </td>
                                                        <td>
                                                            {{ $item->created_at }}
                                                        </td>
                                                        <td>
                                                            <a href=" " class="btn btn-sm btn-warning pr-5 pl-1">
                                                                Edit
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('teacher.question.delete', ['id' => $item->id]) }}"
                                                                method="POST" onclick="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger pr-4 pl-1">Delete</button>
                                                            </form>
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

    <script>
        document.getElementById('updateButton').addEventListener('click', function() {
            document.getElementById('updateForm').submit();
        });
    </script>

    <script>
        function showForm() {
            document.getElementById('formOverlay').classList.remove('hidden');
        }

        function hideForm() {
            document.getElementById('formOverlay').classList.add('hidden');
        }
    </script>
@endsection
