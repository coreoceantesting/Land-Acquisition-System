
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
                                <label class="col-form-label" for="district_name"> जिल्हा/ District <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_name" class="form-select" required>
                                    <option value="" disabled selected>--जिल्हा निवडा--</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="taluka_name">तालुका / Taluka <span class="text-danger">*</span></label>
                                <select name="taluka_id" id="taluka_id" class="form-select" required>
                                    <option value="" disabled selected>--तालुका निवडा--</option>
                                    <!-- Dynamic taluka options will be inserted here -->
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="village_name">गाव / Village <span class="text-danger">*</span></label>
                                <select name="village_id" id="village_id" class="form-select" required>
                                    <option value="" disabled selected>--गाव निवडा--</option>
                                    <!-- Dynamic village options will be inserted here -->
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="sr_no">Sr.No<span class="text-danger">*</span></label>
                                <input class="form-control" id="sr_no" name="sr_no" type="number" placeholder="Enter sr no">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="land_acquisitions_name">भूसंपादनाचे प्रयोजन  /
                                    Purpose of land acquisition<span class="text-danger">*</span></label>
                                <select name="land_acquisition_id" id="land_acquisition_id" class="form-select" required>
                                    <option disabled selected> -- भूसंपादनाचे प्रयोजन -- </option>
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

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="successModalLabel">Success</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="successMessage"></p> <!-- This is where the success message will be displayed -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
                // Clear the taluka dropdown if no district is selected
                $('#taluka_id').empty().append('<option value="">--तालुका निवडा--</option>');
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
$(document).ready(function() {
    // Listen for the form submission
    $('#addForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = new FormData(this);

        $.ajax({
            url: '{{ route("acquisition_register.store") }}',  // Route to your save function in Laravel
            type: 'POST',
            data: formData,
            processData: false,  // Prevent jQuery from converting the data
            contentType: false,  // Prevent jQuery from setting content type
            success: function(response) {
                if(response.status === 'success') {
                    // Show success message in a custom modal popup
                    $('#successModal').modal('show'); // Show the modal
                    $('#successMessage').html(response.message); // Set the message in the modal
                    // Optionally reset the form after success
                    $('#addForm')[0].reset();
                }
            },
            error: function(xhr, status, error) {
                // Handle errors here
                alert('Error occurred: ' + error);
            }
        });
    });
});




</script>

