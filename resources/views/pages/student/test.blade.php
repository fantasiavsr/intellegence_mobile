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
                        <h1 class="h3 text-gray-800 ">Test List</h1>
                       {{--  <a class="" href="{{ route('teacher.tests.add') }}">
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
                                                    <th>No</th>
                                                    <th>Test ID</th>
                                                    <th>Name</th>
                                                    <th>Classroom Name</th>
                                                    <th>Created at</th>
                                                    <th>Start</th>
                                                    <th>Evaluation</th>
                                                    {{-- <th>Edit</th> --}}
                                                    {{-- <th>Delete</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($test as $item)
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
                                                            {{-- search classroom->name where this test->classroom_id --}}
                                                            @foreach ($classroom as $class)
                                                                @if ($class->id == $item->classroom_id)
                                                                    {{ $class->name }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{ $item->created_at }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('student.tests.question', ['id' => $item->id]) }}"
                                                                class="btn btn-sm btn-success pr-5 pl-1">
                                                                Start
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('student.tests.evaluation', ['id' => $item->id]) }}"
                                                                class="btn btn-sm btn-primary pr-5 pl-1">
                                                                Evaluation
                                                            </a>
                                                        </td>
                                                        {{-- <td>
                                                            <a href="{{ route('teacher.tests.edit', ['id' => $item->id]) }}"
                                                                class="btn btn-sm btn-warning pr-5 pl-1">
                                                                Edit
                                                            </a>
                                                        </td> --}}
                                                        {{-- <td>
                                                            <form
                                                                action="{{ route('teacher.tests.delete', ['id' => $item->id]) }}"
                                                                method="POST" onclick="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger pr-4 pl-1">Delete</button>
                                                            </form>
                                                        </td> --}}
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
