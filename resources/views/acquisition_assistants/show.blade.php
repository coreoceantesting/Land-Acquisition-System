<x-admin.layout>
    <x-slot name="title">Land Acquisition Assistance</x-slot>
    <x-slot name="heading">Land Acquisition Assistance Details</x-slot>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Land Acquisition Assistance Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <!-- District -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="district_name">जिल्हा/ District</label>
                            <p>{{ $acquisition_assistant->district_id->district_name }}</p>
                        </div>

                        <!-- Taluka -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="taluka_name">तालुका / Taluka</label>
                            <p>{{ $acquisition_assistant->taluka_id->taluka_name }}</p>
                        </div>

                        <!-- Village -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="village_name">गाव / Village</label>
                            <p>{{ $acquisition_assistant->village_id->village_name }}</p>
                        </div>

                        <!-- Sr No -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="sr_nos_in">निवाडा क्र. / Sr.No sr_no_id</label>
                            <p> {{ $acquisition_assistant->sr_no_id->sr_no_id }}
                            </p>
                        </div>

                        <!-- Purpose of land acquisition -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="land_acquisitions_name">भूसंपादनाचे प्रयोजन / Purpose of land acquisition</label>
                            <p>{{ $acquisition_assistant->land_acquisition_id->land_acquisitions_name }}</p>
                        </div>

                        <!-- Project Name -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="project_name">प्रकल्पाचे नाव / Project Name</label>
                            <p>{{ $acquisition_assistant->project_name }}</p>
                        </div>

                        <!-- Year -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="year">भूसंपादनाचे वर्ष / Year</label>
                            <p>{{ $acquisition_assistant->year_id->year }}</p>
                        </div>

                        <!-- Acquisition Board Name -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="acquisition_board_name">भूसंपादन मंडळाचे नाव / Name of Land Acquisition Board</label>
                            <p>{{ $acquisition_assistant->acquisition_board_name }}</p>
                        </div>

                        <!-- Description -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="description">वर्णन / Description</label>
                            <p>{{ $acquisition_assistant->description }}</p>
                        </div>

                        <!-- Designation -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="designation">निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम / Designation</label>
                            <p>{{ $acquisition_assistant->designation == 1 ? 'पूर्ण' : 'सुरु' }}</p>
                        </div>

                        <!-- Acquisition Proposal -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="acquisition_proposal">भूसंपादन प्रस्ताव / Land acquisition proposal</label>
                            <p>{{ $acquisition_assistant->acquisition_proposal == 1 ? 'पूर्ण' : 'सुरु' }}</p>
                        </div>

                        <!-- Law -->
                        <div class="col-md-4">
                            <label class="col-form-label" for="law">भूसंपादन कोणत्या कायद्यानुसार झाले ? / Land acquisition was done according to which law?</label>
                            <p>{{ $acquisition_assistant->law == 1 ? 'पूर्ण' : 'सुरु' }}</p>
                        </div>
                    </div>

                    <!-- Survey/Group Table -->
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>सर्वे / गट क्र. निवडा</th>
                                        <th>क्रमांक</th>
                                        <th>क्षेत्र (हेक्टर)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($acquisition_assistant->segregations as $segregation)
                                        <tr>
                                            <td>{{ $segregation->survey_or_group }}</td>
                                            <td>{{ $segregation->number }}</td>
                                            <td>{{ $segregation->area }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- <div class="card-footer">
                    <a href="{{ route('acquisition_assistant.edit', $acquisition_assistant->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('acquisition_assistant.index') }}" class="btn btn-secondary">Back</a>
                </div> --}}
            </div>
        </div>
    </div>
</x-admin.layout>
