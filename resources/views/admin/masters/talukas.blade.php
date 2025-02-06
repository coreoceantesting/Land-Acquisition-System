<x-admin.layout>
    <x-slot name="title">talukas</x-slot>
    <x-slot name="heading">talukas</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4 class="card-title">Add taluka</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="district_id">Select District Name / जिल्हा <span class="text-danger">*</span></label>
                                    <select class="form-select" id="district_id" name="district_id" required>
                                        <option value="" selected disabled>Select District</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district?->id }}">{{ $district?->district_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <select id="district" class="form-control">
                                    <option value="">--Select District--</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select> --}}
                                <div class="col-md-4">
                                    <label class="col-form-label" for="taluka_name"> Taluka Name / जिल्हा <span class="text-danger">*</span></label>
                                    <input class="form-control" id="taluka_name" name="taluka_name" type="text" placeholder="Enter taluka initial">
                                    <span class="text-danger is-invalid initial_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="taluka_ini"> Taluka Initial / जिल्हा <span class="text-danger">*</span></label>
                                    <input class="form-control" id="taluka_ini" name="taluka_ini" type="text" placeholder="Enter taluka initial">
                                    <span class="text-danger is-invalid initial_err"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        {{-- Edit Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Taluka</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="district_id">Select District Name / जिल्हा <span class="text-danger">*</span></label>
                                    <select class="form-select" id="district_id" name="district_id" required>
                                        <option value="" selected disabled>Select District</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district?->id }}">{{ $district?->district_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="taluka_name">Taluka Name / जिल्हा <span class="text-danger">*</span></label>
                                    <input class="form-control" id="taluka_name" name="taluka_name" type="text" placeholder="Enter Taluka name">
                                    <span class="text-danger is-invalid initial_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="taluka_ini"> Taluka Initial / जिल्हा <span class="text-danger">*</span></label>
                                    <input class="form-control" id="taluka_ini" name="taluka_ini" type="text" placeholder="Enter taluka initial">
                                    <span class="text-danger is-invalid initial_err"></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="editSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Distrtict Name</th>

                                       <th>Taluka Name</th>
                                        <th>Taluka Initial</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($talukas as $taluka)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{$taluka->district?->district_name}}</td>

                                        <td>{{$taluka->taluka_name}}</td>
                                        <td>{{$taluka->taluka_ini}}</td>



                                        <td>
                                            <button class="edit-element btn text-secondary px-2 py-1" title="Edit Taluka" data-id="{{ $taluka->id }}"><i data-feather="edit"></i></button>
                                            <button class="btn text-danger rem-element px-2 py-1" title="Delete Taluka" data-id="{{ $taluka->id }}"><i data-feather="trash-2"></i></button>

                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</x-admin.layout>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('talukas.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('talukas.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>


<!-- Edit -->
<script>
    // Handle the edit button click
    $(document).on("click", ".edit-element", function (e) {
        e.preventDefault();

        var model_id = $(this).data("id");
        var url = "{{ route('talukas.edit', ':model_id') }}".replace(':model_id', model_id);

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function (data) {
                if (!data.error) {
                    // Populate the edit form with data
                    $("#editForm input[name='district_id']").val(data.taluka.district_id).trigger("change");;
                    $("#editForm input[name='taluka_name']").val(data.taluka.taluka_name);
                    $("#editForm input[name='taluka_ini']").val(data.taluka.taluka_ini);

                    // Show the form
                    $("#editContainer").show();
                } else {
                    swal("Error", data.error, "error");
                }
            },
            error: function () {
                swal("Error", "Something went wrong. Please try again.", "error");
            }
        });
    });

    // Handle form submission
    $(document).ready(function () {
        $("#editForm").submit(function (e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);

            var formData = new FormData(this);
            formData.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('talukas.update', ':model_id') }}".replace(':model_id', model_id);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2) {
                        swal("Successful!", data.success, "success")
                            .then(() => {
                                window.location.href = '{{ route('talukas.index') }}';
                            });
                    } else {
                        swal("Error!", data.error2, "error");
                    }
                },
                statusCode: {
                    422: function (response) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(response.responseJSON.errors);
                    },
                    500: function () {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occurred!", "Something went wrong, please try again.", "error");
                    }
                }
            });
        });
    });
</script>



<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('talukas.update', ":model_id") }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('talukas.index') }}';
                            });
                    else
                        swal("Error!", data.error2, "error");
                },
                statusCode: {
                    422: function(responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occured!", "Something went wrong please try again", "error");
                    }
                }
            });

        });
    });
</script>


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this taluka?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('talukas.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.href = '{{ route('talukas.index') }}';
                                  });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>
