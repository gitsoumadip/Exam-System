@extends('loginMaster.master')
@section('contant')
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="index.html" class="">
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                        </a>
                        <h3>Email</h3>
                    </div>
                    <div class="">
                        {{-- <h4> {{ $name }} </h4>
                        <h4>{{ $email }}</h4> --}}

                    </div>
                    @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{Session::get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <form action="" method="post">
                        @csrf
                        {{-- {{ $email }} --}}
                        {{-- <input type="hidden" name="name" id="name" value="{{ $name }} "> --}}
                        {{-- <input type="hidden" name="email" id="email" value=""> --}}
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="forgot_verify_email" name="forgot_verify_email"
                                placeholder="Enter 6 digit OTP number" required>
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
    <!-- Sign In End -->

@endsection
