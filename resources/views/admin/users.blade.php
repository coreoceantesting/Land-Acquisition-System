<x-admin.layout>
    <x-slot name="title">Users</x-slot>
    <x-slot name="heading">Users</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    <!-- Add Form Start -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm">
                    @csrf
                    <div class="card-header pb-0">
                        <h4>Create User</h4>
                    </div>
                    <div class="card-body pt-0">


                        <div class="mb-3 row">

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="name">User Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="name" name="name" type="text" placeholder="Enter User Name">
                                <span class="text-danger is-invalid name_err"></span>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="email">User Email <span class="text-danger">*</span></label>
                                <input class="form-control" id="email" name="email" type="email" placeholder="Enter User Email">
                                <span class="text-danger is-invalid email_err"></span>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="mobile">User Mobile <span class="text-danger">*</span></label>
                                <input class="form-control" id="mobile" name="mobile" type="number" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    placeholder="Enter User Mobile">
                                <span class="text-danger is-invalid mobile_err"></span>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="role">Select User Type / Role <span class="text-danger">*</span></label>
                                <select class="js-example-basic-single col-sm-12 form-select" id="role" name="role">
                                    <option value="">--Select Role--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" data-role-name="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger is-invalid role_err"></span>
                            </div>

                            <div class="col-md-4 mt-3" id="officerField" style="display: none;">
                                <label class="col-form-label" for="officer_id">Select User Officer <span class="text-danger">*</span></label>
                                <select class="js-example-basic-single col-sm-12 form-select" id="officer_id" name="officer_id">
                                    <option value="">--Select Officer--</option>
                                </select>
                                <span class="text-danger is-invalid officer_id_err"></span>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="district_name"> जिल्हा/ District <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_name" class="form-control" required>
                                    <option value="">जिल्हा निवडा</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="col-md-4">
                                <label class="col-form-label" for="taluka_name">तालुका / Taluka <span class="text-danger">*</span></label>
                                <select name="taluka_id" id="taluka_id" class="form-select" required>
                                    <option value="">तालुका निवडा</option>
                                    <!-- Dynamic taluka options will be inserted here -->
                                </select>
                            </div> --}}


                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="password">Password <span class="text-danger">*</span></label>
                                <input class="form-control" id="password" name="password" type="password" placeholder="********">
                                <span class="text-danger is-invalid password_err"></span>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="********">
                                <span class="text-danger is-invalid confirm_password_err"></span>
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
                <section class="card">
                    <header class="card-header">
                        <h4 class="card-title">Edit User</h4>
                    </header>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">

                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="name">User Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" placeholder="Enter User Name">
                                <span class="text-danger is-invalid name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="email">User Email <span class="text-danger">*</span></label>
                                <input class="form-control" name="email" type="email" placeholder="Enter User Email">
                                <span class="text-danger is-invalid email_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="mobile">User Mobile <span class="text-danger">*</span></label>
                                <input class="form-control" name="mobile" type="number" min="0" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                    placeholder="Enter User Mobile">
                                <span class="text-danger is-invalid mobile_err"></span>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label">Select User Type / Role <span class="text-danger">*</span></label>
                                <select class="js-example-basic-single col-sm-12 form-select" name="role">
                                    <option value="">--Select Role--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger is-invalid role_err"></span>
                            </div>

                            <div class="col-md-4 mt-3 d-none" id="editOfficerField" >
                                <label class="col-form-label" for="officer_id">Select User Officer <span class="text-danger">*</span></label>
                                <select class="js-example-basic-single col-sm-12 form-select" id="officer_id" name="officer_id">
                                    <option value="" selected disabled>--Select Officer--</option>
                                </select>
                                <span class="text-danger is-invalid officer_id_err"></span>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="district_name"> जिल्हा/ District <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_name" class="form-select" required>
                                    <option value="">जिल्हा निवडा</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" id="editSubmit">Update</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </section>
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
                                    <th>Sr No</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    {{-- <th style="min-width: 100px;">Status</th> --}}
                                    <th>Registered On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        {{-- <td>
                                            <div class="media-body text-end icon-state">
                                                <label class="switch">
                                                    <input type="checkbox" class="status" data-id="{{ $user->id }}" {{ $user->active_status == '1' ? 'checked' : '' }}><span class="switch-state"></span>
                                                </label>
                                            </div>
                                        </td> --}}
                                        <td>
                                            {{ \Carbon\Carbon::parse($user->created_at)->format('d M, y h:i:s') }}
                                        </td>
                                        <td>
                                            <button class="edit-element btn text-primary px-2 py-1" title="Edit User" data-id="{{ $user->id }}"><i data-feather="edit"></i></button>
                                            <button class="btn text-primary change-password px-2 py-1" title="Change Password" data-id="{{ $user->id }}"><i data-feather="lock"></i></button>
                                            <button class="btn text-warning assign-role px-2 py-1" title="Assign Role" data-id="{{ $user->id }}"><i data-feather="user-check"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Change Password Form --}}
    <div class="modal fade" id="change-password-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" id="changePasswordForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="user_id" name="user_id" value="">

                        <div class="col-8 mx-auto my-2">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="fas fa-unlock-keyhole"></i></span>
                                    <input class="form-control" type="password" id="new_password" name="new_password">
                                    {{-- <div class="show-hide"><span class="show"></span></div> --}}
                                </div>
                                <span class="text-danger is-invalid password_err"></span>
                            </div>
                        </div>

                        <div class="col-8 mx-auto my-2">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-group"><span class="input-group-text"><i class="fas fa-unlock-keyhole"></i></span>
                                    <input class="form-control" type="password" id="confirmed_password" name="confirmed_password">
                                    {{-- <div class="show-hide"><span class="show"></span></div> --}}
                                </div>
                                <span class="text-danger is-invalid confirmed_password_err"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="changePasswordSubmit" type="submit">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- Assign Role Modal --}}
    <div class="modal fade" id="assign-role-modal" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" id="assignRoleForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Role</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" id="role_user_id" name="role_user_id" value="">

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" for="name">User Name : </label>
                            <div class="col-sm-9">
                                <h6 id="role_user_name" class="pt-2"></h6>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" for="name">Role : </label>
                            <div class="col-sm-9" style="max-height: 60px">
                                <select class="js-example-basic-single" id="edit_role" name="edit_role">
                                    <option value="">--Select Role--</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                </select>
                                <span class="text-danger is-invalid edit_role_err"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="assignRoleSubmit" type="submit">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</x-admin.layout>

<!-- Toggle Status -->
<script>
    $("#buttons-datatables").on("change", ".status", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('users.toggle', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                if (!data.error && !data.error2) {
                    swal("Success!", data.success, "success");
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
    });
</script>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('users.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('users.index') }}';
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


<!-- Open Change Password Modal-->
<script>
    $("#buttons-datatables").on("click", ".change-password", function(e) {
        e.preventDefault();
        var user_id = $(this).attr("data-id");
        $('#user_id').val(user_id);
        $('#change-password-modal').modal('show');
    });
</script>

<!-- Update User Password -->
<script>
    $("#changePasswordForm").submit(function(e) {
        e.preventDefault();
        $("#changePasswordSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        formdata.append('_method', 'PUT');
        var model_id = $('#user_id').val();
        var url = "{{ route('users.change-password', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#changePasswordSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        $("#change-password-modal").modal('hide');
                        $("#changePasswordSubmit").prop('disabled', false);
                    });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#changePasswordSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#changePasswordSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

        function resetErrors() {
            var form = document.getElementById('changePasswordForm');
            var data = new FormData(form);
            for (var [key, value] of data) {
                $('.' + key + '_err').text('');
                $('#' + key).removeClass('is-invalid');
                $('#' + key).addClass('is-valid');
            }
        }

        function printErrMsg(msg) {
            $.each(msg, function(key, value) {
                $('.' + key + '_err').text(value);
                $('#' + key).addClass('is-invalid');
                $('#' + key).removeClass('is-valid');
            });
        }

    });
</script>


<!-- Edit -->
<script>
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        // $(".edit-element").show();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('users.edit', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                console.log(data);


                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.user.id);
                    $("#editForm select[name='role']").html(data.roleHtml);
                    $("#editForm select[name='district_id']").html(data.districtHtml);
                    $("#editForm input[name='name']").val(data.user.name);
                    $("#editForm input[name='email']").val(data.user.email);
                    $("#editForm input[name='mobile']").val(data.user.mobile);
                    $("#editOfficerField").addClass("d-none");
                    if(data.user.officer_id)
                    {
                        $("#editOfficerField").removeClass("d-none");
                        $("#editForm select[name='officer_id']").html(data.userOfficerHtml);
                    }

                } else {
                    swal("Error!", data.error, "error");
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                swal("Error!", "Some thing went wrong", "error");
            },
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
            var url = "{{ route('users.update', ':model_id') }}";
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
                            window.location.href = '{{ route('users.index') }}';
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


<!-- Open Assign Role Modal-->
<script>
    $("#buttons-datatables").on("click", ".assign-role", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('users.get-role', ':model_id') }}";
        $('#role_user_id').val(model_id);

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {

                if (!data.error) {
                    $("#editForm input[name='edit_model_id']").val(data.user.id);
                    $("#edit_role").html(data.roleHtml);
                    $("#role_user_name").text(data.user.name);
                } else {
                    swal("Error!", data.error, "error");
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                swal("Error!", "Some thing went wrong", "error");
            },
        });

        $('#assign-role-modal').modal('show');
    });
</script>

<!-- Update User Role -->
<script>
    $("#assignRoleForm").submit(function(e) {
        e.preventDefault();
        $("#assignRoleSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        formdata.append('_method', 'PUT');
        var model_id = $('#role_user_id').val();
        var url = "{{ route('users.assign-role', ':model_id') }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#assignRoleSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        $("#assign-role-modal").modal('hide');
                    });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#assignRoleSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#assignRoleSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

        function resetErrors() {
            var form = document.getElementById('assignRoleForm');
            var data = new FormData(form);
            for (var [key, value] of data) {
                $('.' + key + '_err').text('');
                $('#' + key).removeClass('is-invalid');
                $('#' + key).addClass('is-valid');
            }
        }

        function printErrMsg(msg) {
            $.each(msg, function(key, value) {
                $('.' + key + '_err').text(value);
                $('#' + key).addClass('is-invalid');
                $('#' + key).removeClass('is-valid');
            });
        }

    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        $('#role').on('change', function () {
            var roleId = $(this).val();
            var mappedRoleId = null;

            if (roleId == 3) {
                mappedRoleId = 2;
            } else if (roleId == 5) {
                mappedRoleId = 4;
            } else {
                mappedRoleId = roleId;
            }

            if (mappedRoleId) {
                $.ajax({
                    url: '/get-officers/' + mappedRoleId,
                    type: 'GET',
                    success: function (data) {
                        $('#officer_id').empty();
                        $('#officer_id').append('<option value="">--Select Officer--</option>');
                        $.each(data, function (key, value) {
                            $('#officer_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function () {
                        alert("An error occurred while fetching officers.");
                    }
                });
            } else {
                $('#officer_id').empty().append('<option value="">--Select Officer--</option>');  // Clear if no role selected or mapped role
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const roleSelect = document.getElementById("role");
        const officerField = document.getElementById("officerField");

        roleSelect.addEventListener("change", function () {
            const selectedRole = roleSelect.options[roleSelect.selectedIndex].getAttribute("data-role-name");

            // Only show officer_id field for these roles
            const allowedRoles = ["3", "5"];

            if (allowedRoles.includes(selectedRole)) {
                officerField.style.display = "block";
            } else {
                officerField.style.display = "none";
            }
        });
    });
</script>

    <script>
    $(document).ready(function() {
        $('#district_id').on('change', function() {
            var districtId = $(this).val();

            if(districtId) {
                $.ajax({
                    url: '/fetch-talukas/' + districtId, // your endpoint to get talukas
                    type: 'GET',
                    success: function(data) {
                        $('#taluka_id').empty(); // Clear existing options
                        $('#taluka_id').append('<option value="" selected disabled>Select Taluka</option>');
                        $.each(data, function(index, taluka) {
                            $('#taluka_id').append('<option value="' + taluka.id + '">' + taluka.name + '</option>');
                        });
                    }
                });
            } else {
                $('#taluka_id').empty();
                $('#taluka_id').append('<option value="" selected disabled>Select Taluka</option>');
            }
        });


        $('#officer_id').on('change', function() {
            var officer_id = $(this).val();

            if(officer_id) {
                $.ajax({
                    url: '/get-districts/' + officer_id, // your endpoint to get talukas
                    type: 'GET',
                    success: function(data) {
                        $('#district_name').empty(); // Clear existing options
                        $('#district_name').attr('readonly');
                        $('#district_name').append('<option value="" selected disabled>Select District</option>');
                        // $.each(data.districts, function(key, value) {
                            $('#district_name').append('<option selected value="' + data.districts.id + '">' + data.districts.district_name + '</option>');
                        // });

                    }
                });
            } else {
                $('#district_id').empty();
                $('#district_id').append('<option value="" selected disabled>Select District</option>');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        // When the district is selected, get talukas for that district
        $('#district_name').on('change', function () {
            var districtId = $(this).val();  // Get selected district ID

            if (districtId) {
                // AJAX request to get talukas based on the selected district
                $.ajax({
                    url: '/get-talukas/' + districtId,  // Adjust with your route
                    type: 'GET',
                    success: function (data) {
                        $('#taluka_id').empty();  // Clear the taluka dropdown
                        $('#taluka_id').append('<option value="">--Select Taluka--</option>');
                        $.each(data, function (key, value) {
                            $('#taluka_id').append('<option value="' + value.id + '">' + value.taluka_name + '</option>');
                        });
                    },
                    error: function () {
                        alert("An error occurred while fetching talukas.");
                    }
                });
            } else {
                // Clear the taluka dropdown if no district is selected
                $('#taluka_id').empty().append('<option value="">--Select Taluka--</option>');
            }
        });
    });
</script>
