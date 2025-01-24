<x-admin.layout>
    <x-slot name="title">Show Acquisition Assistant</x-slot>
    <x-slot name="heading">Show Acquisition Assistant</x-slot>

<form  class="theme-form" name="showForm" id="showForm" enctype="multipart/form-data" action="{{ route('acquisition_assistant.show', $acquisitionAssistant->id) }}" method="POST">
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
                <input class="form-control" id="project_name" name="project_name" type="text" placeholder="Enter Applicant Name" value="{{ old('project_name', $acquisitionAssistant->project_name) }}">
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
                <textarea class="form-control" name="acquisition_board_name" id="acquisition_board_name" cols="30" rows="2" placeholder="Enter Applicant Address" required >
                    {{ old('acquisition_board_name', $acquisitionAssistant->acquisition_board_name ?? '') }}
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
                    <option value="1" {{ old('designation', $acquisitionAssistant->designation ?? '') == '1' ? 'selected' : '' }}>पूर्ण</option>
                    <option value="2" {{ old('designation', $acquisitionAssistant->designation ?? '') == '2' ? 'selected' : '' }}>सुरु</option>
                </select>
                @error('designation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="col-form-label" for="acquisition_proposal">
                    भूसंपादन प्रस्ताव / Land acquisition proposal <span class="text-danger">*</span>
                </label>
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
                <h4>Acquisition Assistant Details</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>सर्वे / गट क्र. निवडा</th>
                            <th>क्रमांक</th>
                            <th>क्षेत्र (हेक्टर)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($acquisitionAssistantSizes as $size)
                            <tr>
                                <td>{{ $size->survey_or_group == 1 ? 'पूर्ण' : 'सुरु' }}</td>
                                <td>{{ $size->number }}</td>
                                <td>{{ $size->area }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h2> Status Details</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Remark</th>
                </tr>
            </thead>
            {{-- <tbody>
                <tr>
                    <td>1</td>
                    <td>Clerk</td>
                    <td>
                        @if($nocData->clerk_status == 0)
                            <b>Pending by clerk</b>
                        @elseif($nocData->clerk_status == 1)
                            <b>Approved by clerk</b>
                        @elseif($nocData->clerk_status == 2)
                            <b>Rejected by clerk</b>
                        @else
                            Status not available
                        @endif
                    </td>
                    <td>{{ $nocData->clerk_remark ?? 'No remarks available' }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Junior Engineer</td>
                    <td>
                        @if($noc Data->jr_eng_status == 0)
                            <b>Pending by Junior Engineer</b>
                        @elseif($nocData->jr_eng_status == 1)
                            <b>Approved by Junior Engineer</b>
                        @elseif($nocData->jr_eng_status == 2)
                            <b>Rejected by Junior Engineer</b>
                        @else
                            Status not available
                        @endif
                    </td>
                    <td>{{ $nocData->jr_eng_remark ?? 'No remarks available' }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Senior Engineer</td>
                    <td>
                        @if($nocData->sr_eng_status == 0)
                            <b>Pending by Senior Engineer</b>
                        @elseif($nocData->sr_eng_status == 1)
                            <b>Approved by Senior Engineer</b>
                        @elseif($nocData->sr_eng_status == 2)
                            <b>Rejected by Senior Engineer</b>
                        @else
                            Status not available
                        @endif
                    </td>
                    <td>{{ $nocData->sr_eng_remark ?? 'No remarks available' }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>HOD</td>
                    <td>
                        @if($nocData->hod_status == 0)
                            <b>Pending by HOD</b>
                        @elseif($nocData->hod_status == 1)
                            <b>Approved by HOD</b>
                        @elseif($nocData->hod_status == 2)
                            <b>Rejected by HOD</b>
                        @else
                            Status not available
                        @endif
                    </td>
                    <td>{{ $nocData->hod_remark ?? 'No remarks available' }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>City Engineer</td>
                    <td>
                        @if($nocData->city_eng_status == 0)
                            <b>Pending by City Engineer</b>
                        @elseif($nocData->city_eng_status == 1)
                            <b>Approved by City Engineer</b>
                        @elseif($nocData->city_eng_status == 2)
                            <b>Rejected by City Engineer</b>
                        @else
                            Status not available
                        @endif
                    </td>
                    <td>{{ $nocData->city_eng_remark ?? 'No remarks available' }}</td>
                </tr>
            </tbody> --}}
        </table>
        <!-- Display other details of the Acquisition Assistant -->
        {{-- <div class="row">
            <div class="col-md-6">
                <label for="project_name">Project Name:</label>
                <input type="text" class="form-control" value="{{ $acquisitionAssistant->project_name }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="created_by">Created By:</label>
                <input type="text" class="form-control" value="{{ $acquisitionAssistant->created_by }}" readonly>
            </div>
        </div> --}}

        <!-- Add more fields as necessary, based on the data you want to display -->


            {{-- <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="editSubmit">Update</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div> --}}
        </div>
    </div>
</form>

</x-admin.layout>

