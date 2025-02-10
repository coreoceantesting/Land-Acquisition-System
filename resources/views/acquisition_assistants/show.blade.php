<x-admin.layout>
    <x-slot name="title">View Acquisition Record Info</x-slot>
    <x-slot name="heading">View Acquisition Record Info</x-slot>

    <form class="theme-form" name="showForm" id="showForm" enctype="multipart/form-data" action="{{ route('acquisition_assistant.show', $acquisitionAssistant->id) }}" method="POST">
        <div class="card-header mb-3">
            <h4 class="card-title">Land Acquisition Record Info</h4>
        </div>
        <div class="card-body">
            <div class="mb-3 row">
                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="district_name">District /जिल्हा <span class="text-danger">*</span></label>
                    <select name="district_id" id="district_name" disabled readonly class="form-select" required>
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ $district->id == $acquisitionAssistant->district_id ? 'selected' : '' }}>
                                {{ $district->district_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="taluka_name">Taluka/ तालुका <span class="text-danger">*</span></label>
                    <select name="taluka_id" id="taluka_id" disabled readonly class="form-select" required>
                        <option value="">Select Taluka</option>
                        @foreach ($talukas as $taluka)
                            <option value="{{ $taluka->id }}" {{ $taluka->id == $acquisitionAssistant->taluka_id ? 'selected' : '' }}>{{ $taluka->taluka_name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="village_name">Village/ गाव <span class="text-danger">*</span></label>
                    <select name="village_id" disabled readonly id="village_id" class="form-select" required>
                        <option value="">Select Village</option>
                        @foreach ($villages as $village)
                            <option value="{{ $village->id }}" {{ $village->id == $acquisitionAssistant->village_id ? 'selected' : '' }}>{{ $village->village_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="sr_no_id">
                       SR.No/  निवाडा क्र.<span class="text-danger">*</span>
                    </label>
                    <input type="text" readonly class="form-control" value="{{ $acquisitionAssistant->sr_no_id }}">
                </div>

                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="land_acquisition_id">
                        Purpose of land acquisition/ भूसंपादनाचे प्रयोजन<span class="text-danger">*</span>
                    </label>
                    <select name="land_acquisition_id" disabled readonly id="land_acquisition_id" class="form-select" required>
                        <option value="">Select Land Acquisition</option>
                        @foreach ($land_acquisitions as $land_acquisition)
                            <option value="{{ $land_acquisition->id }}" {{ old('land_acquisition_id', $acquisitionAssistant->land_acquisition_id ?? '') == $land_acquisition->id ? 'selected' : '' }}>
                                {{ $land_acquisition->land_acquisitions_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="project_name">Project Name/प्रकल्पाचे नाव <span class="text-danger">*</span></label>
                    <input class="form-control" id="project_name" disabled readonly name="project_name" type="text" placeholder="Enter Project Name" value="{{ old('project_name', $acquisitionAssistant->project_name) }}">
                    <span class="text-danger is-invalid applicant_name_err"></span>
                </div>

                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="year"> Year / भूसंपादनाचे वर्ष<span class="text-danger">*</span></label>
                    <select name="year_id" id="year_id" disabled readonly class="form-select" required>
                        <option value="">Select Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}" {{ $year->id == $acquisitionAssistant->year_id ? 'selected' : '' }}>{{ $year->year }}</option>
                        @endforeach
                    </select>
                    @error('year_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="acquisition_board_name"> Name of Land Acquisition Board /भूसंपादन मंडळाचे नाव<span class="text-danger">*</span></label>
                    <textarea class="form-control" disabled readonly name="acquisition_board_name" id="acquisition_board_name" cols="30" rows="2" placeholder="Enter Land Acquisition" required>{{ $acquisitionAssistant->acquisition_board_name ?? '' }}</textarea>
                    <span class="text-danger is-invalid full_address_err"></span>
                    @error('acquisition_board_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="description">Description/वर्णन <span class="text-danger">*</span></label>
                    <input class="form-control" id="description" disabled readonly name="description" type="text" placeholder="Enter Description" readonly value="{{ $acquisitionAssistant->description ?? '' }}">
                    <span class="text-danger is-invalid applicant_name_err"></span>

                </div>

                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="designation"> Designation/निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम <span class="text-danger">*</span></label>
                    <select name="designation" id="designation" disabled readonly class="form-control" required>
                        <option value="">Select Designation</option>
                        <option value="1" {{ old('designation', $acquisitionAssistant->designation ?? '') == '1' ? 'selected' : '' }}>लिपिक/Clerk</option>
                        <option value="2" {{ old('designation', $acquisitionAssistant->designation ?? '') == '2' ? 'selected' : '' }}>सहाय्यक/Assistant</option>
                    </select>
                    @error('designation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="acquisition_proposal">
                        Land acquisition proposal / भूसंपादन प्रस्ताव <span class="text-danger">*</span>
                    </label>
                    <select name="acquisition_proposal" disabled readonly id="acquisition_proposal" class="form-control" required>
                        <option value="">Select L.A proposal</option>
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


                <div class="col-md-4 mt-3">
                    <label class="col-form-label" for="law"> Land acquisition was done according to which law?/ भूसंपादन कोणत्या कायद्यानुसार झाले ? <span class="text-danger">*</span></label>
                    <select name="law" id="law" disabled readonly class="form-control" required>
                        <option value="">Select L.A Law </option>
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



            <div class="row my-3">

                <div class="col-4">
                    <a href="{{ route('acquisition_assistant.pending') }}" class="btn btn-primary">Cancel</a>
                    @if ($acquisitionAssistant->acquisition_officer_status == 0 || ($acquisitionAssistant->divisional_officer_status = 0))
                        @canany(['la_record.approve', 'la_record.reject'])
                            <button type="button" class="btn btn-success approve-btn" data-id="{{ $acquisitionAssistant->id }}">
                                Approve
                            </button>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                Reject
                            </button>
                        @endcanany
                    @endif

                    @can('la_record.change-status')
                        <a href="#" class="btn btn-success changeStatusModel" data-bs-toggle="modal" data-bs-target="#statusModal" data-id="{{ $acquisitionAssistant->id }}" data-acquisition_proposal="{{ $acquisitionAssistant->acquisition_proposal }}" data-updated_date="{{ $acquisitionAssistant->updated_date }}">
                            Change Status
                        </a>
                    @endcan

                </div>
            </div>
        </div>

    </form>

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


    {{-- Change status modal --}}
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="statusChangeForm" enctype="multipart/form-data" action="{{ route('acquisition_assistant.complete_auth') }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="modelId">
                        <div class="mb-3">
                            <label for="acquisitionProposal" class="form-label"> Land acquisition proposal/भूसंपादन प्रस्ताव</label>
                            <select name="acquisition_proposal" id="acquisition_proposal" class="form-select" required>
                                <option value="">Select L.A proposal</option>
                                <option value="1">पूर्ण</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="updated_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="updated_date" name="updated_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="confirmStatusChange">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $("body").on("click", ".approve-btn", function(e) {
                e.preventDefault();
                $('.approve-btn').attr('disabled', true);
                var model_id = $(this).attr("data-id");
                var url = "{{ route('acquisition_assistant.approve', ':model_id') }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        $('.approve-btn').attr('disabled', false);
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        $('.approve-btn').attr('disabled', false);
                        alert("Some thing went wrong");
                    },
                });
            });
        </script>

        {{-- Change Status JS --}}
        <script>
            $(document).ready(function() {
                $('.changeStatusModel').click(function() {
                    let id = $(this).attr('data-id');
                    let acquisitionProposal = $(this).attr('data-acquisition_proposal');
                    let updatedDate = $(this).attr('data-updated_date');
                    $('#modelId').val(id);
                    $('#statusModal').show();
                })
            });
        </script>
    @endpush

</x-admin.layout>


@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
