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
                        <h1 class="h3 text-gray-800 ">Classroom {{ $classroom->name }}</h1>

                        <div class="">
                            <a class="" href="{{ route('teacher.classroom.add_student', ['id' => $classroom->id]) }}">
                                <button class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Add Student</span>
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

                                    <form id="updateForm" action="{{ route('teacher.classroom.update', ['id' => $classroom->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        {{-- {{ $this_item->id }} --}}
                                        {{-- <input type="hidden" name="id" value="{{ $this_item->id }}"> --}}
                                        {{-- <input type="hidden" name="question_id" value="{{ $classroom->id }}"> --}}
                                        <div class="row d-flex">

                                            <div class="col-sm-2 form-outline mb-4">
                                                <label class="form-label">Name of Classroom</label>
                                                <input type="text" name="name" class="form-control" required
                                                    value="{{ $classroom->name }}">
                                            </div>

                                            <div class="col-sm form-outline mb-4">
                                                <label class="form-label">Description</label>
                                                <input type="text" name="description" class="form-control" required
                                                    value="{{ $classroom->description }}">
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
                                                    <th>Student ID</th>
                                                    <th>Name</th>
                                                    <th>Created At</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($student as $item)
                                                    <tr class="">
                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $item->id }}
                                                        </td>
                                                        <td>
                                                            {{ $item->name }}
                                                        </td>
                                                        <td>
                                                            {{ $item->created_at }}
                                                        </td>
                                                        {{-- <td>
                                                            <a href=" "
                                                                class="btn btn-sm btn-warning pr-5 pl-1">
                                                                Edit
                                                            </a>
                                                        </td> --}}
                                                        <td>
                                                            <form action="{{ route('teacher.classroom.delete_student', ['id' => $item->id]) }}" method="POST"
                                                                onclick="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                {{-- classroom id hidden --}}
                                                                <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
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
@endsection
