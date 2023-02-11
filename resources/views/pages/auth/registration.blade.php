@extends('loginMaster.master')
@section('contant')
    <!-- Sign Up Start -->

    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                        </a>
                        <h3>Sign Up</h3>
                    </div>
                    @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{Session::get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <form action="{{route('user_register_data')}}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="jhondoe" required>
                            <label for="floatingText">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="useremail" name="useremail"
                                placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="userpassword" name="userpassword"
                                placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        {{-- <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="">Forgot Password</a>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>ReCaptcha:</strong>
                                    <div class="g-recaptcha" data-sitekey="6LefdnoiAAAAAOoU0YzCtwRMEPc_sQBIoyjZZu_u"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}

                        <button type="submit" value="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">SignUp</button>
                        <p class="text-center mb-0">Already have an Account? <a href="/login">Sign In</a></p>
                    </form>
                    <!-- Global site tag (gtag.js) - Google Analytics -->

                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up End -->
@endsection
