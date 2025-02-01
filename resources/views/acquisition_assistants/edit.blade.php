<x-admin.layout>
    <x-slot name="title">Edit Acquisition Assistant</x-slot>
    <x-slot name="heading">Edit Acquisition Assistant</x-slot>

    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
                @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
 @endif
                <form class="theme-form" name="editForm" id="editForm" enctype="multipart/form-data" action="{{ route('acquisition_assistant.update', $acquisitionAssistant->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- This is important for PUT requests -->

                    <div class="card-header">
                        <h4 class="card-title">Land Acquisition Assistance</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="district_name">जिल्हा/ District <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_name" class="form-select" required>
                                    <option value="">जिल्हा निवडा</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $district->id == $acquisitionAssistant->district_id ? 'selected' : '' }}>
                                            {{ $district->district_name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('district_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="taluka_name">तालुका / Taluka <span class="text-danger">*</span></label>
                                <select name="taluka_id" id="taluka_id" class="form-select" required>
                                    <option value="">तालुका निवडा</option>
                                    @foreach($talukas as $taluka)
                                    <option value="{{ $taluka->id }}" {{ $taluka->id == $acquisitionAssistant->taluka_id ? 'selected' : '' }}>{{ $taluka->taluka_name }}</option>
                                    @endforeach

                                </select>
                                @error('taluka_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="village_name">गाव / Village <span class="text-danger">*</span></label>
                                <select name="village_id" id="village_id" class="form-select" required>
                                    <option value="">गाव निवडा</option>
                                    @foreach($villages as $village)
                                    <option value="{{ $village->id }}"  {{ $village->id == $acquisitionAssistant->village_id ? 'selected' : '' }}>{{ $village->village_name }}</option>
                                    @endforeach
                                </select>
                                @error('village_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="sr_no_id">
                                    निवाडा क्र. / Sr.No<span class="text-danger">*</span>
                                </label>
                                <select name="sr_no_id" id="sr_no_id" class="form-select" required>
                                    <option value="">निवाडा क्र. निवडा</option>
                                    @foreach($sr_nos as $sr_no)
                                        <option value="{{ $sr_no->id }}"
                                            {{ old('sr_no_id', $acquisitionAssistant->sr_no_id ?? '') == $sr_no->id ? 'selected' : '' }}>
                                            {{ $sr_no->sr_nos_in }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sr_no_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="land_acquisition_id">
                                    भूसंपादनाचे प्रयोजन / Purpose of land acquisition<span class="text-danger">*</span>
                                </label>
                                <select name="land_acquisition_id" id="land_acquisition_id" class="form-select" required>
                                    <option value="">भूसंपादनाचे प्रयोजन</option>
                                    @foreach($land_acquisitions as $land_acquisition)
                                        <option value="{{ $land_acquisition->id }}"
                                            {{ old('land_acquisition_id', $acquisitionAssistant->land_acquisition_id ?? '') == $land_acquisition->id ? 'selected' : '' }}>
                                            {{ $land_acquisition->land_acquisitions_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('land_acquisition_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="col-md-4">
                                <label class="col-form-label" for="project_name">प्रकल्पाचे नाव / Project Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="project_name" name="project_name" type="text" placeholder="Enter Applicant Name"  value="{{ old('project_name', $acquisitionAssistant->project_name) }}">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                                @error('project_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="year">भूसंपादनाचे वर्ष / Year <span class="text-danger">*</span></label>
                                <select name="year_id" id="year_id" class="form-select" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    @foreach($years as $year)
                                    <option value="{{ $year->id }}"  {{ $year->id == $acquisitionAssistant->year_id ? 'selected' : '' }}>{{ $year->year }}</option>
                                    @endforeach
                                </select>
                                @error('year_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="acquisition_board_name">भूसंपादन मंडळाचे नाव  / Name of Land Acquisition Board<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="acquisition_board_name" id="acquisition_board_name" cols="30" rows="2" placeholder="Enter Applicant Address" required>   {{ old('acquisition_board_name', $acquisitionAssistant->acquisition_board_name ?? '') }}
                                    {{ $abattoirLicense->full_address ?? '' }}</textarea>
                                <span class="text-danger is-invalid full_address_err"></span>
                                @error('acquisition_board_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="description">वर्णन / Description<span class="text-danger">*</span></label>
                                <input class="form-control" id="description" name="description" type="text" placeholder="Enter Applicant Name" value="{{ old('description', $acquisitionAssistant->description) }}">
                                <span class="text-danger is-invalid applicant_name_err"></span>

                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="designation">निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम / Designation <span class="text-danger">*</span></label>
                                <select name="designation" id="designation" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="1" {{ old('designation', $acquisitionAssistant->designation ?? '') == '1' ? 'selected' : '' }}>लिपिक</option>
                                    <option value="2" {{ old('designation', $acquisitionAssistant->designation ?? '') == '2' ? 'selected' : '' }}>सहाय्यक</option>
                                </select>
                                @error('designation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="acquisition_proposal">भूसंपादन प्रस्ताव /
                                    Land acquisition proposal<span class="text-danger">*</span></label>
                                <select name="acquisition_proposal" id="acquisition_proposal" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                    <option value="1" {{ old('acquisition_proposal', $acquisitionAssistant->acquisition_proposal ?? '') == '1' ? 'selected' : '' }}>
                        पूर्ण
                    </option>
                    <option value="2" {{ old('acquisition_proposal', $acquisitionAssistant->acquisition_proposal ?? '') == '2' ? 'selected' : '' }}>
                        सुरु
                    </option>
                                </select>
                                @error('acquisition_proposal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="law">भूसंपादन कोणत्या कायद्यानुसार झाले ? / Land acquisition was done according to which law? <span class="text-danger">*</span></label>
                                <select name="law" id="law" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="1" {{ old('law', $acquisitionAssistant->law ?? '') == '1' ? 'selected' : '' }}>
                                        पूर्ण
                                    </option>
                                    <option value="2" {{ old('law', $acquisitionAssistant->law ?? '') == '2' ? 'selected' : '' }}>
                                        सुरु
                                    </option>
                                </select>
                                @error('law')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                                        @foreach ($acquisitionAssistantSizes as $size)
                                            <tr>
                                                <th>
                                                    <select name="survey_or_group[]" class="form-control" required>
                                                        <option value="1" {{ $size->survey_or_group == 1 ? 'selected' : '' }}>पूर्ण</option>
                                                        <option value="2" {{ $size->survey_or_group == 2 ? 'selected' : '' }}>सुरु</option>
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
                                                    <button type="button" class="btn btn-danger btn-sm deleteButton">Delete</button>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin.layout>
<script>
  document.getElementById('addMoreSegregationButton').addEventListener('click', function () {
    var newRow = document.querySelector('#AcquisitionAssistantBody tr').cloneNode(true);

    // Reset input values (or leave them empty if you don't want to pre-populate)
    newRow.querySelectorAll('input').forEach(function (input) {
        input.value = '';
    });

    // Append the new row to the table body
    document.getElementById('AcquisitionAssistantBody').appendChild(newRow);
});

</script>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle the form submission with confirmation
        document.getElementById('editSubmit').addEventListener('click', function(e) {
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
                    document.getElementById('editForm').submit();  // This now targets the updated form id
                }
            });
        });
    });
</script>
