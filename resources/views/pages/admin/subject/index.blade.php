@extends('master.master');
@section('subject-active', 'active')
@section('title', __('Subject'))
@section('contant')
    <!-- Sale & Revenue Start -->
   
    <div class="row vh-100 bg-secondary rounded p-4 mx-0">

        <div class="col-12 text-center">
            <!-- Button trigger modal -->
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjects">
                Add Subject
            </button>
            <div class="bg-secondary rounded p-4 mt-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Action</th>
                                <th scope="col">Subject</th>                               
                                {{-- <th scope="col">Model Status</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{$subject}} --}}
                            @if (count($subject) > 0)
                                @foreach ($subject as $key => $items)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>
                                            <button class="btn btn-info editButton" data-id="{{ $items->id }}"
                                                 data-bs-toggle="modal"
                                                data-bs-target="#editModal">Edit</button>
                                            {{-- </td>
                                        <td> --}}
                                            <button class="btn btn-danger deleteButton" data-id="{{ $items->id }}"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                        </td>
                                        <td>{{ $items->subject }}</td>                                       
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">Subject are not Found!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Add Brand Modal -->
                <div class="modal" id="addSubjects">
                    <div class="modal-dialog">
                        <form id="addSubject">
                            @csrf
                            <div class="modal-content  bg-secondary">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Subject</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body bg-secondary">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Subject Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter subject Name" class="w-100" id="name">
                                            </div>                                            
                                            {{-- <div class="form-group mb-3">
                                                <label for="" class="form-label">Category
                                                    Status</label>
                                                <select name="status" class="w-100 form-select" id="status">
                                                    <option value="">Select</option>
                                                    <option value="1" selected>active</option>
                                                    <option value="0">inactive</option>
                                                </select>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer  bg-secondary">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Model Modal -->
                {{-- <div class="modal" id="editModal">
                    <div class="modal-dialog">
                        <form id="editModelNo">
                            @csrf
                            <div class="modal-content  bg-secondary">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Brand</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body  bg-secondary">
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="edit_model_id" id="edit_model_id">
                                            <input type="text" name="edit_model_name" placeholder="Enter Model Name"
                                                id="edit_model_name" class="w-100 form-control">
                                            <span class="error brand_name_error"></span>
                                            <br><br>
                                            <input type="text" name="edit_model_slug" placeholder="Enter Model Slug"
                                                id="edit_model_slug" class="w-100 form-control">
                                            <span class="error brand_name_error"></span>
                                            <br><br>
                                            <select name="edit_model_status" class="w-100 form-control"
                                                id="edit_model_status">
                                                <option value="">Select</option>
                                                <option value="active">active</option>
                                                <option value="inactive">inactive</option>
                                            </select>
                                            <span class="error brand_status_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer  bg-secondary">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}

                <!-- Delete Brand Modal -->
                {{-- <div class="modal" id="deleteModal">
                    <div class="modal-dialog">
                        <form id="deleteModels">
                            @csrf
                            <div class="modal-content  bg-secondary">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Model</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body  bg-secondary">
                                    <div class="row">
                                        <div class="col">
                                            <p>Are you sure you want to delete brand?</p>
                                            <input type="hidden" name="delete_model_id" id="delete_model_id">
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer  bg-secondary">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}

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
                     if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data);
                        }
                    }
                });
            });
        });
    </script>
@endpush
{{-- @push('bodyscript')
    <script src="{{asset('/pages/backend/js/subject.js')}}"></script>
@endpush --}}
