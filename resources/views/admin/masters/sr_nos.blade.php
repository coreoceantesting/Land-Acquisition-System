<x-admin.layout>
    <x-slot name="title">Sr No</x-slot>
    <x-slot name="heading">Sr No</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4 class="card-title">Add Sr No</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="sr_nos_in">Enter Sr No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="sr_nos_in" name="sr_nos_in" type="text" placeholder="Enter Sr.No">
                                    <span class="text-danger is-invalid name_err"></span>
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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Srno</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="sr_nos_in">Enter Sr No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="sr_nos_in" name="sr_nos_in" type="text" placeholder="Enter Sr No">
                                    <span class="text-danger is-invalid sr_nos_in_err"></span>
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
                                        <th>sr.no</th>
                                        <th>Srno Name</th>

                                       {{-- <th>District Initial</th> --}}

                                      {{--    <th>Office</th>

                                        <th>Age</th>

                                        <th>Start date</th>

                                        <th>Salary</th> --}}

                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($sr_nos as $sr_no)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$sr_no->sr_nos_in}}</td>

                                        {{-- <td>{{$district->district_initial}}</td> --}}



                                        <td>

                                            <button class="edit-element btn text-secondary px-2 py-1" title="Edit Srno" data-id="{{ $sr_no->id }}"><i data-feather="edit"></i></button>

                                            <button class="btn text-danger rem-element px-2 py-1" title="Delete Srno" data-id="{{ $sr_no->id }}"><i data-feather="trash-2"></i> </button>

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
            url: '{{ route('sr_nos.store') }}',
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
                            window.location.href = '{{ route('sr_nos.index') }}';
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
    // Handle edit button click
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('sr_nos.edit', ':model_id') }}".replace(':model_id', model_id);

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data) {
                if (!data.error) {
                    // Show the edit form container
                    $("#editContainer").show();
                    // Set form values with the fetched data
                    $("#editForm input[name='edit_model_id']").val(data.district.id);
                    $("#editForm input[name='sr_nos_in']").val(data.district.initial); // Set the Sr No
                } else {
                    alert(data.error);
                }
            },
            error: function() {
                alert("Something went wrong");
            }
        });
    });

    // Handle form submission
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();

            var url = "{{ route('sr_nos.update', ':model_id') }}".replace(':model_id', model_id);

            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error) {
                        swal("Successful!", data.success, "success").then(() => {
                            window.location.href = '{{ route('sr_nos.index') }}';
                        });
                    } else {
                        swal("Error!", data.error, "error");
                    }
                },
                statusCode: {
                    422: function(response) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(response.responseJSON.errors);
                    },
                    500: function() {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error!", "Something went wrong. Please try again.", "error");
                    }
                }
            });
        });
    });

    // Reset error messages
    function resetErrors() {
        $(".is-invalid").text('');
    }

    // Print validation error messages
    function printErrMsg(errors) {
        $.each(errors, function(key, value) {
            $("#" + key).siblings(".is-invalid").text(value[0]);
        });
    }
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
            var url = "{{ route('sr_nos.update', ":model_id") }}";
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
                                window.location.href = '{{ route('sr_nos.index') }}';
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
            title: "Are you sure to delete this Sr Nos?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('sr_nos.destroy', ":model_id") }}";

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
                                    window.location.reload();
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
