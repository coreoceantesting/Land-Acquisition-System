<x-admin.layout>
    <x-slot name="title">Form</x-slot>
    <x-slot name="heading">Form</x-slot>

    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header">
                        <h4 class="card-title">Land Acquisition Assistance </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="district_name"> जिल्हा/ District <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_name" class="form-select" required>
                                    <option value="">जिल्हा निवडा</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                    @endforeach
                                    <!-- Dynamic district options will be inserted here -->
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="taluka_name">तालुका / Taluka <span class="text-danger">*</span></label>
                                <select name="taluka_id" id="taluka_id" class="form-select" required>
                                    <option value="">तालुका निवडा</option>
                                    @foreach($talukas as $taluka)
                                    <option value="{{ $taluka->id }}">{{ $taluka->taluka_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="village_name">गाव / Village <span class="text-danger">*</span></label>
                                <select name="village_id" id="village_id" class="form-select" required>
                                    <option value="">गाव निवडा</option>
                                    @foreach($villages as $village)
                                    <option value="{{ $village->id }}">{{ $village->village_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="sr_nos_in">निवाडा क्र. / Sr.No<span class="text-danger">*</span></label>
                                <select name="sr_no_id" id="sr_no_id" class="form-select" required>
                                    <option value="">निवाडा क्र. निवडा    </option>
                                    @foreach($sr_nos as $sr_no)
                                    <option value="{{ $sr_no->id }}">{{ $sr_no->sr_nos_in }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="land_acquisitions_name">भूसंपादनाचे प्रयोजन  /
                                    Purpose of land acquisition<span class="text-danger">*</span></label>
                                <select name="land_acquisition_id" id="land_acquisition_id" class="form-select" required>
                                    <option value="">भूसंपादनाचे प्रयोजन</option>
                                    @foreach($land_acquisitions as $land_acquisition)

                                    <option value="{{ $land_acquisition->id }}">{{ $land_acquisition->land_acquisitions_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="project_name">प्रकल्पाचे नाव / Project Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="project_name" name="project_name" type="text" placeholder="Enter Applicant Name">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="year">भूसंपादनाचे वर्ष / Year <span class="text-danger">*</span></label>
                                <select name="year" id="year_id" class="form-select" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    @foreach($years as $year)
                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="acquisition_board_name">भूसंपादन मंडळाचे नाव  / Name of Land Acquisition Board<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="acquisition_board_name" id="acquisition_board_name" cols="30" rows="2" placeholder="Enter Applicant Address" required>{{ $abattoirLicense->full_address ?? '' }}</textarea>
                                <span class="text-danger is-invalid full_address_err"></span>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="description">वर्णन / Description<span class="text-danger">*</span></label>
                                <input class="form-control" id="description" name="description" type="text" placeholder="Enter Applicant Name">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="designation">निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम / Designation <span class="text-danger">*</span></label>
                                <select name="designation" id="designation" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="1">पूर्ण</option>
                                    <option value="2">सुरु</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="acquisition_proposal">भूसंपादन प्रस्ताव /
                                    Land acquisition proposal<span class="text-danger">*</span></label>
                                <select name="acquisition_proposal" id="acquisition_proposal" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="1">पूर्ण</option>
                                    <option value="2">सुरु</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="law">भूसंपादन कोणत्या कायद्यानुसार झाले ? / Land acquisition was done according to which law? <span class="text-danger">*</span></label>
                                <select name="law" id="law" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="1">पूर्ण</option>
                                    <option value="2">सुरु</option>
                                </select>
                            </div>




                            {{-- <input type="hidden" name="document_id" value="{{ $documentId }}"> --}}
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
                                                <select name="survey_or_group[]" class="form-control" required>
                                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                                    <option value="1">पूर्ण</option>
                                                    <option value="2">सुरु</option>
                                                </select>
                                            </th>
                                            <th>
                                                <input class="form-control" name="number[]" type="number" placeholder="Enter ">
                                            </th>
                                            <th>
                                                <input class="form-control" name="area[]" type="number" placeholder="Enter ">
                                            </th>
                                            <th>
                                                <button type="button" class="btn btn-danger btn-sm deleteButton">Delete</button>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
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
</x-admin.layout>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Fetch district data from the Laravel route
    fetch('/districts')
        .then(response => response.json())
        .then(data => {
            const districtSelect = document.getElementById('district');

            // Clear existing options
            districtSelect.innerHTML = '<option value="">जिल्हा निवडा</option>';

            // Populate the dropdown with district options
            data.forEach(function(district) {
                const option = document.createElement('option');
                option.value = district.id;  // Use the 'id' from the database
                option.textContent = district.name;  // Use the 'name' from the database
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
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('acquisition_assistant.index') }}';
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
<script>
     $(document).ready(function () {
        $('#phone_no').on('input', function () {
            const phoneValue = $(this).val();
            $(this).val(phoneValue.replace(/[^0-9]/g, '').substring(0, 10));
        });

        // Validate Aadhaar Number (12 digits only)
        $('#addhar_no').on('input', function () {
            const aadhaarValue = $(this).val();
            $(this).val(aadhaarValue.replace(/[^0-9]/g, '').substring(0, 12));
        });
     });

     document.getElementById("nocForm").addEventListener("submit", async function (e) {
        e.preventDefault();

        const form = new FormData(this);
        try {
            const response = await fetch("/noc/store", {
                method: "POST",
                body: form,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            const result = await response.json();
            if (response.ok) {
                alert(result.success);
            } else {
                console.error(result.message || "An error occurred");
                alert("Failed to create NOC");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("An unexpected error occurred");
        }
    });
</script>

{{-- <script>
    $(document).ready(function () {
        let SegregationRowCount = 1; // Counter for unique row IDs

        // Automatically show the first row when the page loads
        let html = `<tr id="SegregationRow${SegregationRowCount}">
                        <td>
                             <select name="waste_type[]" class="form-select AddFormSelectzone" required/>
                                    <option value="">Select waste type</option>
                                  @foreach($PrefixDetails as $Prefix)
                                     <option value="{{ $Prefix->Main_Prefix }}">{{ $Prefix->value}}</option>
                                  @endforeach
                                </select>
                        </td>
                        <td>
                            <input type="text" name="waste_sub_type1[]" class="form-control" placeholder="Enter waste sub type1" required>
                        </td>
                        <td>
                            <input type="text" name="waste_sub_type2[]" class="form-control" placeholder="Enter waste sub type2" required>
                        </td>
                        <td>
                            <input type="number" name="volume[]" class="form-control volumeInput" placeholder="Enter volume" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm removeSegregationRow" data-id="${SegregationRowCount}">Remove</button>
                        </td>
                    </tr>`;
        $('#SegregationTableBody').append(html); // Append the first row to the table body
        SegregationRowCount++; // Increment the row counter for unique IDs

        // Add More Button Functionality (now only for adding extra rows after initial load)
        $('#addMoreSegregationButton').on('click', function () {
            let html = `<tr id="SegregationRow${SegregationRowCount}">
                            <td>
                                  <select name="waste_type[]" class="form-select AddFormSelectzone" required/>
                                    <option value="">Select waste type</option>
                                  @foreach($PrefixDetails as $Prefix)
                                     <option value="{{ $Prefix->Main_Prefix }}">{{ $Prefix->value}}</option>
                                  @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="waste_sub_type1[]" class="form-control" placeholder="Enter waste sub type1" required>
                            </td>
                            <td>
                                <input type="text" name="waste_sub_type2[]" class="form-control" placeholder="Enter waste sub type2" required>
                            </td>
                            <td>
                                <input type="number" name="volume[]" class="form-control volumeInput" placeholder="Enter volume" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm removeSegregationRow" data-id="${SegregationRowCount}">Remove</button>
                            </td>
                        </tr>`;

            $('#SegregationTableBody').append(html); // Append the new row to the table body
            SegregationRowCount++; // Increment the row counter for unique IDs
        });

        // Remove Row Functionality
        $('body').on('click', '.removeSegregationRow', function () {
            const rowId = $(this).data('id'); // Get the row ID from the button's data-id attribute
            $(`#SegregationRow${rowId}`).remove(); // Remove the corresponding row
            calculateTotalVolume(); // Recalculate total volume after removal
        });

        // Event listener to calculate total volume when the volume input field is updated
        $('body').on('input', '.volumeInput', function () {
            calculateTotalVolume(); // Recalculate total volume whenever a volume input changes
        });

        // Function to calculate and update the total volume
        function calculateTotalVolume() {
            let totalVolume = 0;
            // Iterate through each volume field and sum up the values
            $('input[name="volume[]"]').each(function () {
                let volume = parseFloat($(this).val());
                if (!isNaN(volume)) {
                    totalVolume += volume;
                }
            });
            // Update the total volume field
            $('#totalVolumeField').val(totalVolume.toFixed(2)); // Display total volume with 2 decimal places
        }
    });
</script> --}}
<script>
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
                    <select name="survey_or_group[]" class="form-control" required>
                        <option value="">भूसंपादनाचे वर्ष निवडा</option>
                        <option value="1">पूर्ण</option>
                        <option value="2">सुरु</option>
                    </select>
                </th>
                <th>
                    <input class="form-control" name="number[]" type="number" placeholder="Enter Applicant Name">
                </th>
                <th>
                    <input class="form-control" name="area[]" type="number" placeholder="Enter Applicant Name">
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
</script>


