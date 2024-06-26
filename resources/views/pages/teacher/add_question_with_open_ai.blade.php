@extends('layouts.core_editor_ai')

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
                    {{-- <div class="d-sm-flex align-items-center justify-content-between pt-2 mt-4 mb-4">
                        <h1 class="h3 mb-0 text-gray-800 ">Add Item</h1>
                    </div> --}}

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col">
                            <div class="card shadow-custom mb-4" style="width:100%">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <div class=" align-items-center justify-content-between">
                                        <h1 class="h4 mb-0 text-gray-800 ">Add Question</h1>
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

                                    <form action="{{ route('teacher.tests.store_question') }}" method="POST">
                                        @csrf
                                        {{-- {{ $this_item->id }} --}}
                                        {{-- <input type="hidden" name="id" value="{{ $this_item->id }}"> --}}

                                        <div class="row d-flex">
                                            <div class="col-sm-1 form-outline mb-4">
                                                <label class="form-label">Test ID<span>
                                                        <p class="text-danger" style="font-size: 12px">*Required</p>
                                                    </span></label>
                                                <select type="text" name="test_id" class="form-control" autofocus
                                                    required>
                                                    @foreach ($test as $item)
                                                        {{-- <option value="{{ $item->id }}">
                                                            {{ $item->id }}
                                                        </option> --}}
                                                        @if ($item->id == $thistest->id)
                                                            <option value="{{ $item->id }}" selected>
                                                                {{ $item->id }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->id }}
                                                            </option>

                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm form-outline mb-4">
                                                <label class="form-label">Question<span>
                                                        <p class="text-danger" style="font-size: 12px">*Required</p>
                                                    </span></label>
                                                <input type="text" name="question" class="form-control" autofocus
                                                    required value="{{ $question }}">
                                            </div>

                                            <div class="col-sm form-outline mb-4">

                                                <style>
                                                    #editor {
                                                        width: 100%;
                                                        height: 400px;
                                                        border: 1px solid #333;
                                                        border-radius: 4px;
                                                    }

                                                    .form-label {
                                                        color: #d4d4d4; /* Label color */
                                                        font-family: Arial, sans-serif; /* Label font family */
                                                        font-size: 14px; /* Label font size */
                                                    }

                                                    .text-grey {
                                                        color: #a0a0a0; /* Grey text color */
                                                    }
                                                </style>
                                                <label class="form-label">Key Answer
                                                    <span>
                                                        <p class="text-grey" style="font-size: 12px">*exact flutter code</p>
                                                    </span>
                                                </label>
                                                <textarea name="key_answer" style="display: none;"></textarea>
                                                <div id="editor"></div>

                                                <label class="form-label pt-3">Key Word<span>
                                                        <p class="text-grey" style="font-size: 12px">*seperate key word with
                                                            comma</p>
                                                    </span></label>
                                                <input type="text" name="key_word" class="form-control" autofocus
                                                    required>

                                            </div>

                                        </div>

                                        <!-- Submit button -->
                                        <div class="row">
                                            <div class="col">
                                                <a href="{{ route('teacher.debug.input_question') }}"
                                                    class="btn btn-lg mt-2 px-5 mb-4"
                                                    style="background-color: #F9FAFC; width:100%">Cancel</a>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-lg mt-2 px-5 mb-4 text-light"
                                                    style="background-color: #4FBEAB; width:100%" type="submit">Create</button>
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
    {{-- @include('Partials.scrolltotop') --}}

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
