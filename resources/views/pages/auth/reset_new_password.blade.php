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
                            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Reset Password</h3>
                        </a>
                        {{-- <h3>Reset Password</h3> --}}
                    </div>
                    @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{Session::get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <form action="{{ route('resetPassword') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="hidden" name="email" id="email" value="{{ $email }} ">
                            <input type="password" class="form-control" id="newpassword" name="newpassword"
                                placeholder="New Password" required>
                            <label for="floatingInput">New Password</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="confarmPassword" name="confarmPassword"
                                placeholder="Confarm Password" required>
                            <label for="floatingPassword">Confarm Password</label>
                        </div>
                        <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                        <br>
                        <button type="submit" name="submit" value="submit" id="submit"
                            class="btn btn-primary py-3 w-100 mb-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
@endsection
@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submit').hide();
            $("#confarmPassword").on('keyup', function() {
                let newpassword = $('#newpassword').val();
                let confirmpassword = $('#confarmPassword').val();
                // alert(newpassword + '=' + confirmpassword);
                if (newpassword != confirmpassword) {
                    $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
                } else {
                    $("#CheckPasswordMatch").html("Password match !").css("color", "green");
                    $('#submit').show();
                }
            });
        });
    </script>
@endpush
