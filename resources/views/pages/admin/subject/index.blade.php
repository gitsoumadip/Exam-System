@extends('master.master');
@section('subject-active', 'active')
@section('title', __('Subject'))
@section('contant')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <div class="ms-3">
                        <button type="button" class="btn btn-outline-primary m-2"data-bs-toggle="modal"
                            data-bs-target="#moduleFormModal">
                            Add Subject
                        </button>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal" id="moduleFormModal">
                <div class="modal-dialog">
                    <form id="addSubject">
                        @csrf
                        <div class="modal-content bg-secondary">
                            {{-- Model header --}}
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Subject</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            {{-- modal Body  --}}
                            <div class="modal-body bg-secondary">
                                <div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder=" Enter subject Name:">
                                    </div>
                                </div>
                            </div>

                            {{-- Modal footer  --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="button" value="submit" class="btn btn-primary">Submit</button> --}}
                                <input type="submit" name="submit" value="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

@endsection
@push('bodyscript')
    <script>
        $(document).ready(function() {
            $("#addSubject").submit(function(e) {
                e.preventDefault();
                var formdata = $(this).serialize();
                alert(formdata);
                $.ajax({
                    url:"{{ route('admin.addSuject') }}",
                    type:"POST",
                    data:formdata,
                    success:function(data){
                     console.log(data);   
                    }
                });
            });
        });
    </script>
@endpush
{{-- @push('bodyscript')
    <script src="{{asset('public\pages\backend\js\subject.js')}}"></script>
@endpush --}}
