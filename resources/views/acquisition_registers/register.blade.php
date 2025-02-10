
<x-admin.layout>
    <x-slot name="title">Land Acquisition Register</x-slot>
    <x-slot name="heading">Land Acquisition Register</x-slot>

    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">

                <form class="theme-form" name="addForm" id="addForm"  method="POST" action="{{ route('acquisition_register.store') }}" enctype="multipart/form-data" >
                    @csrf

                    <div class="card-header">
                        <h4 class="card-title">Land Acquisition Register </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="district_name"> District/जिल्हा <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_name" class="form-select" required>
                                    <option value="" disabled selected>--Select District--</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="taluka_name"> Taluka/ तालुका <span class="text-danger">*</span></label>
                                <select name="taluka_id" id="taluka_id" class="form-select" required>
                                    <option value="" disabled selected>--Select Taluka--</option>
                                    <!-- Dynamic taluka options will be inserted here -->
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="village_name">Village/ गाव  <span class="text-danger">*</span></label>
                                <select name="village_id" id="village_id" class="form-select" required>
                                    <option value="" disabled selected>--Select Village--</option>
                                    <!-- Dynamic village options will be inserted here -->
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="sr_no">SR.No/निवाडा क्र.<span class="text-danger">*</span></label>
                                <input class="form-control" id="sr_no" name="sr_no" type="text" placeholder="Enter sr no">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="land_acquisitions_name">
                                    Purpose of land acquisition/भूसंपादनाचे प्रयोजन<span class="text-danger">*</span></label>
                                <select name="land_acquisition_id" id="land_acquisition_id" class="form-select" required>
                                    <option disabled selected> -- land acquisition -- </option>
                                    @foreach($land_acquisitions as $land_acquisition)

                                    <option value="{{ $land_acquisition->id }}">{{ $land_acquisition->land_acquisitions_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="bundle">Bundle No<span class="text-danger">*</span></label>
                                <input class="form-control" id="bundle" name="bundle" type="text" placeholder="Enter Bundle">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>





                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-admin.layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<script>
    $(document).ready(function() {
    // When district is selected
    $('#district_name').change(function() {
        var districtId = $(this).val();
        if(districtId) {
            // Make AJAX request to get talukas for the selected district
            $.ajax({
                url: '/talukas/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var talukaDropdown = $('#taluka_id');
                    talukaDropdown.empty(); // Clear existing options
                    talukaDropdown.append('<option value="">तालुका निवडा</option>');
                    $.each(data, function(key, taluka) {
                        talukaDropdown.append('<option value="' + taluka.id + '">' + taluka.taluka_name + '</option>');
                    });
                }
            });
        }
    });

    // When taluka is selected
    $('#taluka_id').change(function() {
        var talukaId = $(this).val();
        if(talukaId) {
            // Make AJAX request to get villages for the selected taluka
            $.ajax({
                url: '/villages/' + talukaId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var villageDropdown = $('#village_id');
                    villageDropdown.empty(); // Clear existing options
                    villageDropdown.append('<option value="">--गाव--</option>');
                    $.each(data, function(key, village) {
                        villageDropdown.append('<option value="' + village.id + '">' + village.village_name + '</option>');
                    });
                }
            });
        }
    });
});

$("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('acquisition_register.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('acquisition_register.index') }}';
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

