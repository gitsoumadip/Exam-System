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
                        <h3>OTP</h3>
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
                    <form action="{{ route('otp_verify') }}" method="post">
                        @csrf
                        {{-- {{ $email }} --}}
                        {{-- <input type="hidden" name="name" id="name" value="{{ $name }} "> --}}
                        <input type="hidden" name="email" id="email" value="{{ $email }} ">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="otpVerify" name="otpVerify"
                                placeholder="Enter 6 digit OTP number" required>
                            <label for="floatingInput">Enter OTP</label>
                        </div>

                        <button type="submit" nsme="submit" value="submit"
                            class="btn btn-primary py-3 w-100 mb-4">Verifing</button>
                        <div>
                            @if (session()->has('status'))
                                {{ session()->get('status') }}
                            @endif
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // $(document).ready(function() {
        $("#resend").click(function() {
            let email = '{{ $email }}';
            // let name = $('#name').val;
            // alert("The paragraph was clicked."+ email );
            $.ajax({
                type: "POST",
                url: '{{ route('resend_otp') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: email
                    // name: name
                },
                success: function(data) {
                    // console.log(data);
                    if (data == 1) {
                        $('#return_message').html("cheak your email");
                    } else {
                        $('#return_message').html("worng email id");
                    }
                }
            });
        });
        // });
    </script>
@endsection
