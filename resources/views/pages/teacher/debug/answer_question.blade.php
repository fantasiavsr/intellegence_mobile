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
                        <h1 class="h3 text-gray-800 ">List Item</h1>
                        <a class="" href="{{ route('teacher.debug.add_question') }}">
                            <button class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add Item</span>
                            </button>
                        </a>
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
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list_item as $item)
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
                                                            {{ $item->question }}
                                                        </td>
                                                        {{-- <td>
                                                            <a href="{{ route('admin.edit.item', ['id' => $item->id]) }}"
                                                                class="btn btn-sm btn-warning pr-5 pl-1">
                                                                Edit
                                                            </a>
                                                        </td> --}}
                                                        <td>
                                                            <a href="{{ route('teacher.debug.fill_question', ['id' => $item->id]) }}"
                                                                class="btn btn-sm btn-warning pr-5 pl-1">
                                                                Answer
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
