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
                    <option value="1" {{ old('designation', $acquisitionAssistant->designation ?? '') == '1' ? 'selected' : '' }}>लिपिक/Clerk</option>
                    <option value="2" {{ old('designation', $acquisitionAssistant->designation ?? '') == '2' ? 'selected' : '' }}>सहाय्यक/Assistant</option>
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
                        THE NATIONAL GREEN TRIBUNAL ACT, 2010/
                        राष्ट्रीय हरित न्यायाधिकरण कायदा, २०१०
                    </option>
                    <option value="2" {{ old('law', $acquisitionAssistant->law ?? '') == '2' ? 'selected' : '' }}>
                        THE MUSSALMAN WAKF ACT, 1923/मुस्लिम वक्फ कायदा, १९२३
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


    </div>




</form>

<div></div>


@if(Auth::user()->hasRole(['Land Acquisition Officer', 'Sub-Divisional Officer'])&& $acquisitionAssistant->acquisition_officer_status == 0 || $acquisitionAssistant->divisional_officer_status= 0 )
   <!-- Approve Button -->
   <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
    Approve
    </button>

        <!-- Approve Modal -->
        <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('acquisition_assistant.approve', $acquisitionAssistant->id) }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="approveModalLabel">Approve with Remark</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="remark" class="form-label">Remark</label>
                                <textarea name="remark" id="remark" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reject Button -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
            Reject
        </button>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('acquisition_assistant.reject', ['id' => $acquisitionAssistant->id]) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalLabel">Reject with Remark</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="remark" class="form-label">Remark</label>
                                <textarea name="remark" id="remark" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @endif


</x-admin.layout>

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
