<x-admin.layout>
    <x-slot name="title">Edit Acquisition Assistant</x-slot>
    <x-slot name="heading">Edit Acquisition Assistant</x-slot>

    <form class="theme-form" name="addForm" id="addForm"  method="POST" action="{{ route('acquisition_register.update', $acquisition_register->id) }}" enctype="multipart/form-data" >
        @csrf
@method('PUT')
        <div class="card-header">
            <h4 class="card-title">Land Acquisition Register </h4>
        </div>
        <div class="card-body">
            <div class="mb-3 row">

                <div class="col-md-4">
                    <label class="col-form-label" for="district_name"> जिल्हा/ District <span class="text-danger">*</span></label>
                    <select name="district_id" id="district_name" class="form-select" required>
                        <option value="">जिल्हा निवडा</option>
                        @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ $district->id == $acquisition_register->district_id ? 'selected' : '' }}>{{ $district->district_name }}</option>
                        @endforeach
                        <!-- Dynamic district options will be inserted here -->
                    </select>
                </div>


                <div class="col-md-4">
                    <label class="col-form-label" for="taluka_name">तालुका / Taluka <span class="text-danger">*</span></label>
                    <select name="taluka_id" id="taluka_id" class="form-select" required>
                        <option value="">तालुका निवडा</option>
                        @foreach($talukas as $taluka)
                        <option value="{{ $taluka->id }}" {{ $taluka->id == $acquisition_register->taluka_id ? 'selected' : '' }}>{{ $taluka->taluka_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label" for="village_name">गाव / Village <span class="text-danger">*</span></label>
                    <select name="village_id" id="village_id" class="form-select" required>
                        <option value="">गाव निवडा</option>
                        @foreach($villages as $village)
                        <option value="{{ $village->id }}"  {{ $village->id == $acquisition_register->village_id ? 'selected' : '' }}>{{ $village->village_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label" for="sr_no">Sr.No<span class="text-danger">*</span></label>
                    <input class="form-control" id="sr_no" name="sr_no" type="number" placeholder="Enter sr no" value="{{ old('sr_no', $acquisition_register->sr_no) }}">
                    <span class="text-danger is-invalid applicant_name_err"></span>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label" for="land_acquisitions_name">भूसंपादनाचे प्रयोजन  /
                        Purpose of land acquisition<span class="text-danger">*</span></label>
                    <select name="land_acquisition_id" id="land_acquisition_id" class="form-select" required>
                        <option value="">भूसंपादनाचे प्रयोजन</option>
                        @foreach($land_acquisitions as $land_acquisition)

                        <option value="{{ $land_acquisition->id }}"
                            {{ old('land_acquisition_id', $acquisition_register->land_acquisition_id ?? '') == $land_acquisition->id ? 'selected' : '' }}>{{ $land_acquisition->land_acquisitions_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label" for="bundle">Bundle No<span class="text-danger">*</span></label>
                    <input class="form-control" id="bundle" name="bundle" type="text" placeholder="Enter Bundle" value="{{ old('bundle', $acquisition_register->bundle) }}">
                    <span class="text-danger is-invalid applicant_name_err"></span>
                </div>
                {{-- <div class="col-md-4">
                    <label class="col-form-label" for="project_name">प्रकल्पाचे नाव / Project Name <span class="text-danger">*</span></label>
                    <input class="form-control" id="project_name" name="project_name" type="text" placeholder="Enter Applicant Name">
                    <span class="text-danger is-invalid applicant_name_err"></span>
                </div> --}}

                {{-- <div class="col-md-4">
                    <label class="col-form-label" for="year">भूसंपादनाचे वर्ष / Year <span class="text-danger">*</span></label>
                    <select name="year_id" id="year_id" class="form-select" required>
                        <option value="">भूसंपादनाचे वर्ष निवडा</option>
                        @foreach($years as $year)
                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div> --}}


                <br>
            </div>
<br>
        <div class="">
            <button type="submit" class="btn btn-primary" id="addSubmit" > Update</button>
            <button type="reset" class="btn btn-warning">Reset</button>
        </div>
    </form>
</x-admin.layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(recordId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + recordId).submit();
        }
    });
}
</script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.js"></script>
<script>
    // Handle the form submission with confirmation
    document.getElementById('addSubmit').addEventListener('click', function(e) {
        e.preventDefault();  // Prevent the form from submitting immediately

        // Show a confirmation popup
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update the Acquisition Register?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('addForm').submit();
            }
        });
    });
</script>
<script>
    // Dependent dropdown ajax code
    $(document).ready(function() {
        $('#district_name').on('change', function() {
            var districtId = $(this).val();

            if (districtId) {
                $.ajax({
                    url: '/get-talukas/' + districtId,
                    type: 'GET',
                    success: function(data) {
                        $('#taluka_id').empty();
                        $('#taluka_id').append('<option value="">--तालुका निवडा--</option>');
                        $.each(data, function(key, value) {
                            $('#taluka_id').append('<option value="' + value.id + '">' + value.taluka_name + '</option>');
                        });
                    },
                    error: function() {
                        alert("An error occurred while fetching talukas.");
                    }
                });
            } else {
                $('#taluka_id').empty().append('<option value="">--तालुका निवडा--</option>');
            }
        });

        // When taluka is selected
        $('#taluka_id').change(function() {
            var talukaId = $(this).val();
            if (talukaId) {
                // Make AJAX request to get villages for the selected taluka
                $.ajax({
                    url: '/villages/' + talukaId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var villageDropdown = $('#village_id');
                        villageDropdown.empty(); // Clear existing options
                        villageDropdown.append('<option value="">--गाव --</option>');
                        $.each(data, function(key, village) {
                            villageDropdown.append('<option value="' + village.id + '">' + village.village_name + '</option>');
                        });
                    }
                });
            }
        });

        // When village is selected
        $('#village_id').change(function() {
            var villageId = $(this).val();
            if (villageId) {
                // Make AJAX request to get villages for the selected taluka
                $.ajax({
                    url: '/serial_numbers/' + villageId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var serialDropdown = $('#sr_no_id');
                        serialDropdown.empty();
                        serialDropdown.append('<option value="">--निवाडा क्र. निवडा --</option>');
                        $.each(data, function(key, sr) {
                            serialDropdown.append('<option value="' + sr.id + '">' + sr.sr_no + '</option>');
                        });
                    }
                });
            }
        });

        $('#sr_no_id').change(function() {
            var serialNo = $(this).val();
            if (serialNo) {
                $.ajax({
                    url: '/la_purpose/' + serialNo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);

                        $('#purpose_of_land').val(data.data);
                    }
                });
            }
        });
    });
</script>
