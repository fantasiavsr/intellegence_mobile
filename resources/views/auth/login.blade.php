@extends('layouts.app2')

@section('content')
    <div class="bg-light d-flex"
        style="min-height: 100vh; background-size: cover;">
        <div class="container py-5 m-auto">
            <div class="row">
                <div class="col">

                    <div class="container" style="">
                        <div class="row">

                            <div class="col-sm-0 col-md-6 col-xl-5 pt-5 pb-5 px-3 align-self-center">
                                <div class="card py-4 px-2">
                                    <div class="card-body">
                                        <div class="pb-3 text-center">
                                            <h1 class="h3 font-weight-bold text-dark">Sign In</h1>
                                            <p>We're so excited to see you again!</p>
                                        </div>

                                        <form action="{{ route('login') }}" method="post">
                                            @csrf

                                            <div class="form-outline mb-4">
                                                <label class="form-label">Username</label>
                                                <input type="username" name="username" id="username"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    autocomplete="on" autofocus required>
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-outline mb-4">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" id="password" autocomplete="off"
                                                    class="form-control @error('password') is-invalid @enderror" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            {{-- <input type="hidden" id="role" name="role" value="0"> --}}
                                            <!-- Submit button -->
                                            <button type="submit"
                                                class="btn btn-block btn-success mt-4 px-5 mb-4 text-light shadow-custom-green">Login</button>

                                            {{-- forgot password --}}
                                            <div class="text-center mb-0">
                                                <p class="mb-1">Forgot password? <a href="{{ route('password.request') }}"
                                                        class="text-success">Reset</a>
                                                </p>
                                            </div>
                                            <!-- Register buttons -->
                                            <div class="text-center">
                                                <p>Not a member? <a href="{{ route('register') }}"
                                                        class="text-success">Register</a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col text-center align-self-center">
                                <img src="{{ asset('img/login.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
