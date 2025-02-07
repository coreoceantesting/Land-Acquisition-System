<x-admin.layout>
    <x-slot name="title">Villages</x-slot>
    <x-slot name="heading">Villages</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                        <div class="card-header">
                            <h4 class="card-title">Add Villages</h4>
                        </div>
                        <div class="card-body">

                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="district_id">Select District Name / जिल्हा <span class="text-danger">*</span></label>
                                    <select class="form-select" id="district_id" name="district_id" required>
                                        <option value="" selected disabled>Select District</option>
                                        @foreach($districts as $district)
                                               <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="taluka_id">Select Taluka Name / तालुका निवडा <span class="text-danger">*</span></label>
                                    <select class="form-select" id="taluka_id" name="taluka_id" required>
                                        <option value="" selected disabled>Select Taluka</option>
                                        @foreach($talukas as $taluka)
                                            <option value="{{ $taluka->id }}">{{ $taluka->taluka_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="village_name"> Village Name / जिल्हा <span class="text-danger">*</span></label>
                                    <input class="form-control" id="village_name" name="village_name" type="text" placeholder="Enter Village initial">
                                    <span class="text-danger is-invalid initial_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="village_init"> Village Initial <span class="text-danger">*</span></label>
                                    <input class="form-control" id="village_init" name="village_init" type="text" placeholder="Enter Village initial">
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Taluka</h4>
                    </div>
                    <div class="card-body py-2">
                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="taluka_id">Select Taluka Name / जिल्हा <span class="text-danger">*</span></label>
                                <select class="form-select" id="taluka_id" name="taluka_id" required>
                                    <option value="" selected disabled>Select Taluka</option>
                                    @foreach ($talukas as $taluka)
                                        <option value="{{ $taluka->id }}">{{ $taluka->taluka_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="village_name"> Village Name / जिल्हा <span class="text-danger">*</span></label>
                                <input class="form-control" id="village_name" name="village_name" type="text" placeholder="Enter village name">
                                <span class="text-danger is-invalid initial_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="village_init"> Village Initial <span class="text-danger">*</span></label>
                                <input class="form-control" id="village_init" name="village_init" type="text" placeholder="Enter Village initial">
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

                                    <th>taluka Name</th>
                                    <th>Village Name</th>
                                    <th>Village Initial</th>
                                    {{--    <th>Office</th>

                                        <th>Age</th>

                                        <th>Start date</th>

                                        <th>Salary</th> --}}

                                    <th>Action</th>

                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($villages as $village)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $village->taluka?->taluka_name }}</td>

                                        <td>{{ $village->village_name }}</td>
                                        <td>{{ $village->village_init }}</td>

                                        <td>
                                            <button class="edit-element btn text-secondary px-2 py-1" title="Edit village" data-id="{{ $village->id }}"><i data-feather="edit"></i></button>
                                            <button class="btn text-danger rem-element px-2 py-1" title="Delete village" data-id="{{ $village->id }}"><i data-feather="trash-2"></i></button>

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
            url: '{{ route('villages.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('villages.index') }}';
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
        var url = "{{ route('villages.edit', ':model_id') }}".replace(':model_id', model_id);

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                if (!data.error) {
                    $("#editContainer").show();
                    $("#editForm input[name='edit_model_id']").val(data.village.id);
                    $("#editForm select[name='taluka_id']").val(data.village.taluka_id); // Dropdown value
                    $("#editForm input[name='village_name']").val(data.village.village_name);
                    $("#editForm input[name='village_init']").val(data.village.village_init);
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

            var url = "{{ route('villages.update', ':model_id') }}".replace(':model_id', model_id);

            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2) {
                        swal("Successful!", data.success, "success").then(() => {
                            window.location.href = '{{ route('villages.index') }}';
                        });
                    } else {
                        swal("Error!", data.error2, "error");
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

    function resetErrors() {
        $(".is-invalid").text('');
    }

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

            var url = "{{ route('villages.update', ':model_id') }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('villages.index') }}';
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
                title: "Are you sure to delete this village?",
                // text: "Make sure if you have filled Vendor details before proceeding further",
                icon: "info",
                buttons: ["Cancel", "Confirm"]
            })
            .then((justTransfer) => {
                if (justTransfer) {
                    var model_id = $(this).attr("data-id");
                    var url = "{{ route('villages.destroy', ':model_id') }}";

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#district_id').on('change', function () {
            var districtId = $(this).val();

            if (districtId) {

                $.ajax({
                    url: '/get-talukas/' + districtId,
                    type: 'GET',
                    success: function (data) {
                        $('#taluka_id').empty();
                        $('#taluka_id').append('<option value="">--तालुका निवडा--</option>');
                        $.each(data, function (key, value) {
                            $('#taluka_id').append('<option value="' + value.id + '">' + value.taluka_name + '</option>');
                        });
                    },
                    error: function () {
                        alert("An error occurred while fetching talukas.");
                    }
                });
            } else {
                $('#taluka_id').empty().append('<option value="">--तालुका निवडा--</option>');
            }
        });
    });

</script>
