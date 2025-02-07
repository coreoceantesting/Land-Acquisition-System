<x-admin.layout>
    <x-slot name="title">Edit Acquisition Assistant</x-slot>
    <x-slot name="heading">Edit Acquisition Assistant</x-slot>

    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">

                <form class="theme-form" name="editForm" id="editForm" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-header">
                        <h4 class="card-title">Land Acquisition Assistance</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="district_name">जिल्हा/ District <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_name" class="form-select" required>
                                    <option value="" disabled selected>जिल्हा निवडा</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" {{ $district->id == $acquisitionAssistant->district_id ? 'selected' : '' }}>
                                            {{ $district->district_name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('district_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4  mt-3">
                                <label class="col-form-label" for="taluka_name">तालुका / Taluka <span class="text-danger">*</span></label>
                                <select name="taluka_id" id="taluka_id" class="form-select" required>
                                    <option value="" disabled selected>तालुका निवडा</option>
                                    @foreach ($talukas as $taluka)
                                        <option value="{{ $taluka->id }}" {{ $taluka->id == $acquisitionAssistant->taluka_id ? 'selected' : '' }}>{{ $taluka->taluka_name }}</option>
                                    @endforeach

                                </select>
                                @error('taluka_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="village_name">गाव / Village <span class="text-danger">*</span></label>
                                <select name="village_id" id="village_id" class="form-select" required>
                                    <option value="" disabled selected>गाव निवडा</option>
                                    @foreach ($villages as $village)
                                        <option value="{{ $village->id }}" {{ $village->id == $acquisitionAssistant->village_id ? 'selected' : '' }}>{{ $village->village_name }}</option>
                                    @endforeach
                                </select>
                                @error('village_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="sr_no_id">
                                    निवाडा क्र. / Sr.No<span class="text-danger">*</span>
                                </label>
                                <select name="sr_no_id" id="sr_no_id" class="form-select" required>
                                    <option value="" disabled>निवाडा क्र. निवडा</option>
                                    @foreach ($sr_nos as $sr_no)
                                        <option value="{{ $sr_no->id }}" {{ $sr_no->sr_no == $acquisitionAssistant->sr_no ? 'selected' : '' }}>{{ $sr_no->sr_no }}</option>
                                    @endforeach
                                </select>
                                @error('sr_no_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="land_acquisition_id">
                                    भूसंपादनाचे प्रयोजन / Purpose of land acquisition<span class="text-danger">*</span>
                                </label>
                                <select name="land_acquisition_id" id="land_acquisition_id" class="form-select" required>
                                    <option value="" disabled selected>भूसंपादनाचे प्रयोजन</option>
                                    @foreach ($land_acquisitions as $land_acquisition)
                                        <option value="{{ $land_acquisition->id }}" {{ $land_acquisition->id == $acquisitionAssistant->land_acquisition_id ? 'selected' : '' }}>{{ $land_acquisition->land_acquisitions_name }}</option>
                                    @endforeach
                                </select>
                                @error('land_acquisition_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="project_name">प्रकल्पाचे नाव / Project Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="project_name" name="project_name" type="text" placeholder="Enter Applicant Name" value="{{ old('project_name', $acquisitionAssistant->project_name) }}">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                                @error('project_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="year">भूसंपादनाचे वर्ष / Year <span class="text-danger">*</span></label>
                                <select name="year_id" id="year_id" class="form-select" required>
                                    <option value="" disabled selected>भूसंपादनाचे वर्ष निवडा</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}" {{ $year->id == $acquisitionAssistant->year_id ? 'selected' : '' }}>{{ $year->year }}</option>
                                    @endforeach
                                </select>
                                @error('year_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="acquisition_board_name">भूसंपादन मंडळाचे नाव / Name of Land Acquisition Board<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="acquisition_board_name" id="acquisition_board_name" cols="30" rows="2" placeholder="Enter Applicant Address" required>{{ old('acquisition_board_name', $acquisitionAssistant->acquisition_board_name ?? '') }}</textarea>
                                <span class="text-danger is-invalid full_address_err"></span>
                                @error('acquisition_board_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="description">वर्णन / Description<span class="text-danger">*</span></label>
                                <input class="form-control" id="description" name="description" type="text" placeholder="Enter Applicant Name" value="{{ old('description', $acquisitionAssistant->description) }}">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="designation">निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम / Designation<span class="text-danger">*</span></label>
                                <select name="designation" id="designation" class="form-select" required>
                                    <option value="" disabled selected> -- भूसंपादनाचे अधिकाऱ्याचे पदनाम निवडा -- </option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}" {{ $designation->id == $acquisitionAssistant->designation ? 'selected' : '' }}>{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="acquisition_proposal">भूसंपादन प्रस्ताव / Land acquisition proposal<span class="text-danger">*</span></label>
                                <select name="acquisition_proposal" id="acquisition_proposal" class="form-control" required>
                                    <option value="" disabled selected> -- भूसंपादनाचे प्रस्ताव निवडा -- </option>
                                    <option value="1" {{ $acquisitionAssistant->acquisition_proposal == '1' ? 'selected' : '' }}>पूर्ण</option>
                                    <option value="2" {{ $acquisitionAssistant->acquisition_proposal == '2' ? 'selected' : '' }}>सुरु</option>
                                </select>
                                @error('acquisition_proposal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="col-form-label" for="law">भूसंपादन कोणत्या कायद्यानुसार झाले ? / Land acquisition was done according to which law? <span class="text-danger">*</span></label>
                                <select name="law" id="law" class="form-control" required>
                                    <option value="" disabled selected> -- भूसंपादनाचे कायद्यानुसार निवडा -- </option>
                                    <option value="1" {{ $acquisitionAssistant->law == '1' ? 'selected' : '' }}>THE NATIONAL GREEN TRIBUNAL ACT, 2010/राष्ट्रीय हरित न्यायाधिकरण कायदा, २०१०</option>
                                    <option value="2" {{ $acquisitionAssistant->law == '2' ? 'selected' : '' }}>THE MUSSALMAN WAKF ACT, 1923/मुस्लिम वक्फ कायदा, १९२३</option>
                                </select>
                                @error('law')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                        <div class="row mt-4">
                            <div class="col-12 mt-4">
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
                                        @foreach ($acquisitionAssistantSizes as $size)
                                            <tr>
                                                <th>
                                                    <select name="survey_or_group[]" class="form-select" required>
                                                        <option value="1" {{ $size->survey_or_group == 1 ? 'selected' : '' }}>सर्वे क्र.</option>
                                                        <option value="2" {{ $size->survey_or_group == 2 ? 'selected' : '' }}>गट क्र.</option>
                                                    </select>
                                                    @error('survey_or_group[]')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </th>
                                                <th>
                                                    <input class="form-control" name="number[]" type="number" value="{{ old('number', $size->number) }}" placeholder="Enter ">
                                                    @error('number[]')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </th>
                                                <th>
                                                    <input class="form-control" name="area[]" type="number" value="{{ old('area', $size->area) }}" placeholder="Enter ">
                                                    @error('area[]')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </th>
                                                <th>
                                                    {{-- <button type="button" class="btn btn-danger btn-sm deleteButton">Delete</button> --}}
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="editSubmit">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-admin.layout>

<script>
    document.getElementById('addMoreSegregationButton').addEventListener('click', function() {
        var newRow = document.querySelector('#AcquisitionAssistantBody tr').cloneNode(true);

        newRow.querySelectorAll('input').forEach(function(input) {
            input.value = '';
        });
        var lastTh = newRow.querySelector('th:last-child');

        lastTh.innerHTML = '<button type="button" class="btn btn-danger btn-sm deleteButton">Delete</button>';
        document.getElementById('AcquisitionAssistantBody').appendChild(newRow);
    });

    document.getElementById('AcquisitionAssistantBody').addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('deleteButton')) {
            const row = event.target.closest('tr');
            row.remove();
        }
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

<!-- Update Form Submit-->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();

            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = {{ $acquisitionAssistant->id }};
            var url = "{{ route('acquisition_assistant.update', ':model_id') }}";

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
                            window.location.reload();
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

            function resetErrors() {
                var form = document.getElementById('editForm');
                var data = new FormData(form);
                for (var [key, value] of data) {
                    var field = key.replace('[]', '');
                    $('.' + field + '_err').text('');
                    $('#' + field).removeClass('is-invalid');
                    $('#' + field).addClass('is-valid');
                }
            }

            function printErrMsg(msg) {
                $.each(msg, function(key, value) {
                    var field = key.replace('[]', '');
                    $('.' + field + '_err').text(value);
                    $('#' + field).addClass('is-invalid');
                });
            }

        });
    });
</script>
