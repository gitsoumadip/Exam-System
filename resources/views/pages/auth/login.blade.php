@extends('loginMaster.master')
@section('contant')
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                @if ($message = Session::get('error'))
                    <div class=" mt-5 alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="bg-secondary rounded pk-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                        </a>
                        <h3>Sign In</h3>
                    </div>
                    <form action="{{ route('user_login_data') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="username" name="username"
                                placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="userpassword" name="userpassword"
                                placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href=""data-bs-toggle="modal" data-bs-target="#myModal">Forgot Password</a>
                        </div>
                        <button type="submit" name="submit" value="submit" class="btn btn-primary py-3 w-100 mb-4">Sign
                            In</button>
                        <p class="text-center mb-0">Don't have an Account? <a href="registeration">Sign Up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->

    {{-- ****************************************Forgot Password Modal******************************** --}}
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog bg-secondary">
            <div class="modal-content bg-secondary">

                <!-- Modal Header -->
                <div class="modal-header bg-secondary">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('forgetPassword')}}" method="post">
                        @csrf
                        {{-- <input type="hidden" name="email" id="email" value=""> --}}
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="forgot_verify_email" name="forgot_verify_email"
                                placeholder="Enter 6 digit OTP number">
                            <label for="floatingInput">Enter Your Email</label>
                        </div>

                        <button type="submit" nsme="submit" value="submit"
                            class="btn btn-primary py-3 w-100 mb-4">Verifing</button>
                        <div>
                        </div>
                    </form>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0)" id="resend">Resend</a>
                        <p id="return_message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- *********************************************************************************************** --}}
@endsection
