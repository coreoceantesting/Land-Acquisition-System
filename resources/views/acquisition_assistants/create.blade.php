<x-admin.layout>
    <x-slot name="title">Land Acquisition Fill Record</x-slot>
    <x-slot name="heading">Land Acquisition Fill Record</x-slot>
    @if (!Auth::user()->hasRole(['Land Acquisition Officer', 'Sub-Divisional']))
        <div class="row" id="addContainer">
            <div class="col-sm-12">
                <div class="card">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    @endif

                    <div class="row" id="addContainer">
                        <div class="col-sm-12">
                            <div class="card">
                                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                                    @csrf

                                    <div class="card-header">
                                        <h4 class="card-title">Land Acquisition Fill Record</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 row">

                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="district_name"> District/ जिल्हा <span class="text-danger">*</span></label>
                                                <select name="district_id" id="district_name" class="form-select" required>
                                                    <option value=""disabled selected>--Select District--</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="taluka_name"> Taluka /तालुका  <span class="text-danger">*</span></label>
                                                <select name="taluka_id" id="taluka_id" class="form-select" required>
                                                    <option value="" disabled selected>--Select Taluka--</option>
                                                    <!-- Dynamic taluka options will be inserted here -->
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="village_name">Village / गाव <span class="text-danger">*</span></label>
                                                <select name="village_id" id="village_id" class="form-select" required>
                                                    <option value="" disabled selected>--Select Village--</option>
                                                    <!-- Dynamic village options will be inserted here -->
                                                </select>
                                            </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="col-form-label" for="sr_nos_in"> SR.No / निवाडा क्र.<span class="text-danger">*</span></label>
                                            <select name="sr_no_id" id="sr_no_id" class="form-select" required>
                                                <option value="" disabled selected>--Select sr.no--</option>
                                            </select>
                                        </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="land_acquisitions_name">Purpose of land acquisition/ भूसंपादनाचे प्रयोजन<span class="text-danger">*</span></label>
                                                <input type="text" name="purpose_of_land" readonly id="purpose_of_land" class="form-control" value="" placeholder="Enter Land Acquisition">
                                            </div>


                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="project_name"> Project Name /प्रकल्पाचे नाव <span class="text-danger">*</span></label>
                                                <input class="form-control" id="project_name" name="project_name" type="text" placeholder="Enter Project Name">
                                                <span class="text-danger is-invalid applicant_name_err"></span>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="year">Year / भूसंपादनाचे वर्ष  <span class="text-danger">*</span></label>
                                                <select name="year_id" id="year_id" class="form-select" required>
                                                    <option value="" disabled selected>--Select Year--</option>
                                                    @foreach ($years as $year)
                                                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="acquisition_board_name">भूसंपादन मंडळाचे नाव /Name of Land Acquisition Board<span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="acquisition_board_name" id="acquisition_board_name" cols="30" rows="2" placeholder="Enter Land Acquisition Name" required></textarea>
                                                <span class="text-danger is-invalid full_address_err"></span>
                                            </div>


                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="description">वर्णन / Description</label>
                                                <input class="form-control" id="description" name="description" type="text" placeholder="Enter Description">
                                                <span class="text-danger is-invalid description_err"></span>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="designation">निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम / Designation <span class="text-danger">*</span></label>
                                                <select name="designation" id="designation" class="form-select" required>
                                                    <option value="" disabled selected> -- Select Designation -- </option>
                                                    @foreach ($designations as $designation)
                                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="acquisition_proposal">भूसंपादन प्रस्ताव /
                                                    Land acquisition proposal<span class="text-danger">*</span></label>
                                                <select name="acquisition_proposal" id="acquisition_proposal" class="form-select" required>
                                                    <option value=""disabled selected> -- Select Land Acquisition Proposal -- </option>
                                                    <option value="1">पूर्ण</option>
                                                    <option value="2">सुरु</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="col-form-label" for="law">भूसंपादन कोणत्या कायद्यानुसार झाले ? / Land acquisition was done according to which law? <span class="text-danger">*</span></label>
                                                <select name="law" id="law" class="form-select" required>
                                                    <option value="" disabled selected> -- Select L.A Law -- </option>
                                                    <option value="1">THE NATIONAL GREEN TRIBUNAL ACT, 2010/राष्ट्रीय हरित न्यायाधिकरण कायदा, २०१०</option>
                                                    <option value="2">THE MUSSALMAN WAKF ACT, 1923/मुस्लिम वक्फ कायदा, १९२३</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>सर्वे / गट क्र. निवडा</th>
                                                            <th>क्रमांक</th>
                                                            <th>क्षेत्र (हेक्टर)</th>
                                                            <th>
                                                                <button class="btn btn-primary btn-sm" type="button" id="addMoreSegregationButton">Add More</button>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="AcquisitionAssistantBody">
                                                        <!-- Initial row (this can be used as a template) -->
                                                        <tr>
                                                            <th>
                                                                <select name="survey_or_group[]" class="form-select" required>
                                                                    <option value="" disabled selected>--सर्वे / गट क्र. निवडा--</option>
                                                                    <option value="1">सर्वे क्र.</option>
                                                                    <option value="2">गट क्र.</option>
                                                                </select>
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="number[]" type="number" placeholder="सर्वे / गट क्र. ">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="area[]" type="number" placeholder="सर्वे / गट क्र. ">
                                                            </th>
                                                            <th>
                                                                {{-- <button type="button" class="btn btn-danger btn-sm deleteButton">Delete</button> --}}
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- JavaScript to handle Add and Delete functionality -->
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const addMoreButton = document.getElementById('addMoreSegregationButton');
                                                const acquisitionAssistantBody = document.getElementById('AcquisitionAssistantBody');

                                                // Add new row when "Add More" button is clicked
                                                addMoreButton.addEventListener('click', function() {
                                                    const newRow = document.createElement('tr');
                                                    newRow.innerHTML = `
                                                            <th>
                                                                <select name="survey_or_group[]" class="form-select" required>
                                                                    <option value="">सर्वे / गट क्र. निवडा</option>
                                                                    <option value="1">सर्वे क्र.</option>
                                                                    <option value="2">गट क्र.</option>
                                                                </select>
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="number[]" type="number" placeholder="सर्वे / गट क्र. ">
                                                            </th>
                                                            <th>
                                                                <input class="form-control" name="area[]" type="number" placeholder="सर्वे / गट क्र. ">
                                                            </th>
                                                            <th>
                                                                <button type="button" class="btn btn-danger btn-sm deleteButton">Delete</button>
                                                            </th>
                                                        `;
                                                    acquisitionAssistantBody.appendChild(newRow);
                                                });

                                                // Remove row when the delete button is clicked
                                                acquisitionAssistantBody.addEventListener('click', function(event) {
                                                    if (event.target && event.target.classList.contains('deleteButton')) {
                                                        const row = event.target.closest('tr');
                                                        row.remove();
                                                    }
                                                });
                                            });
                                        </script>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>

</x-admin.layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/admin/districts')
            .then(response => response.json())
            .then(data => {
                const districtSelect = document.getElementById('district');
                districtSelect.innerHTML = '<option value="">जिल्हा निवडा</option>';

                data.forEach(function(district) {
                    const option = document.createElement('option');
                    option.value = district.id;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching districts:', error));
    });

    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('acquisition_assistant.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                    .then((action) => {
                        window.location.href = '{{ route('acquisition_assistant.pending') }}';
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

{{-- mobile and adhar validation --}}



{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the Add More button and the table body
        const addMoreButton = document.getElementById("addMoreSegregationButton");
        const tableBody = document.getElementById("AcquisitionAssistantBody");

        // Add event listener to Add More button
        addMoreButton.addEventListener("click", function() {
            // Create a new row element
            const newRow = document.createElement("tr");

            // Set the inner HTML of the new row, similar to the initial row
            newRow.innerHTML = `
                <th>
                    <select name="survey_or_group[]" class="form-select" required>
                        <option value="">भूसंपादनाचे वर्ष निवडा</option>
                        <option value="1">पूर्ण</option>
                        <option value="2">सुरु</option>
                    </select>
                </th>
                <th>
                    <input class="form-select" name="number[]" type="number" placeholder="Enter Applicant Name">
                </th>
                <th>
                    <input class="form-select" name="area[]" type="number" placeholder="Enter Applicant Name">
                </th>
                <th>
                    <!-- Add a Delete button to the new row -->
                    <button type="button" class="btn btn-danger btn-sm deleteButton">Delete</button>
                </th>
            `;

            // Append the new row to the table body
            tableBody.appendChild(newRow);

            // Add event listener to the delete button of the new row
            const deleteButton = newRow.querySelector(".deleteButton");
            deleteButton.addEventListener("click", function() {
                // Remove the row when the delete button is clicked
                newRow.remove();
            });
        });

        // You can also add an event listener for the initial delete button in case of page reload or first entry
        const initialDeleteButton = document.querySelector(".deleteButton");
        if (initialDeleteButton) {
            initialDeleteButton.addEventListener("click", function() {
                // Remove the initial row
                initialDeleteButton.closest('tr').remove();
            });
        }
    });
</script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#district_name').on('change', function() {
            var districtId = $(this).val();

            if (districtId) {
                $.ajax({
                    url: '/get-talukas/' + districtId,
                    type: 'GET',
                    success: function(data) {
                        $('#taluka_id').empty();
                        $('#taluka_id').append('<option value="">--Select Taluka--</option>');
                        $.each(data, function(key, value) {
                            $('#taluka_id').append('<option value="' + value.id + '">' + value.taluka_name + '</option>');
                        });
                    },
                    error: function() {
                        alert("An error occurred while fetching talukas.");
                    }
                });
            } else {
                $('#taluka_id').empty().append('<option value="">--Select Taluka--</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // When district is selected
        // $('#district_name').change(function() {
        //     var districtId = $(this).val();
        //     if (districtId) {
        //         // Make AJAX request to get talukas for the selected district
        //         $.ajax({
        //             url: '/talukas/' + districtId,
        //             type: 'GET',
        //             dataType: 'json',
        //             success: function(data) {
        //                 var talukaDropdown = $('#taluka_id');
        //                 talukaDropdown.empty(); // Clear existing options
        //                 talukaDropdown.append('<option value="">तालुका निवडा</option>');
        //                 $.each(data, function(key, taluka) {
        //                     talukaDropdown.append('<option value="' + taluka.id + '">' + taluka.taluka_name + '</option>');
        //                 });
        //             }
        //         });
        //     }
        // });

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
                        villageDropdown.append('<option value="">--Village--</option>');
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
                        serialDropdown.append('<option value="">--SR.No--</option>');
                        $.each(data, function(key, sr) {
                            serialDropdown.append('<option value="' + sr.id + '">' + sr.sr_no + '</option>');
                        });
                    }
                });
            }
        });

        // when serial number change
        // $('#sr_no_id').change(function() {
        //     var serialNo = $(this).attr();
        //     if (villageId) {
        //         // Make AJAX request to get villages for the selected taluka
        //         $.ajax({
        //             url: '/serial_numbers/' + villageId,
        //             type: 'GET',
        //             dataType: 'json',
        //             success: function(data) {
        //                 var serialDropdown = $('#sr_no_id');
        //                 serialDropdown.empty();
        //                 serialDropdown.append('<option value="">--निवाडा क्र. निवडा--</option>');
        //                 $.each(data, function(key, sr) {
        //                     serialDropdown.append('<option value="' + sr.id + '">' + sr.sr_no + '</option>');
        //                 });

        //             }
        //         });
        //     }
        // });
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
