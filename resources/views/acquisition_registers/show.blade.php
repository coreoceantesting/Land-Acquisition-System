<x-admin.layout>
    <x-slot name="title">View Acquisition Registered</x-slot>
    <x-slot name="heading">View Acquisition Registered</x-slot>


<form  class="theme-form" name="showForm" id="showForm" enctype="multipart/form-data" action="{{ route('acquisition_register.show', $acquisition_register->id) }}" method="POST">
    <div class="card-header">
        <h4 class="card-title">View Acquisition Registered</h4>
    </div>
    <div class="card-body">
        <div class="mb-3 row">
            <div class="col-md-4">
                <label class="col-form-label" for="district_name">District/जिल्हा<span class="text-danger">*</span></label>
                <select name="district_id" id="district_name" class="form-select" required disabled readonly>
                    <option value="">Select District</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ $district->id == $acquisition_register->district_id ? 'selected' : '' }} >
                            {{ $district->district_name }}
                        </option>
                    @endforeach

                </select>
                @error('district_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="col-md-4">
                <label class="col-form-label" for="taluka_name">Taluka/तालुका <span class="text-danger">*</span></label>
                <select name="taluka_id" id="taluka_id" class="form-select" required disabled readonly>
                    <option value="" >Select Taluka</option>
                    @foreach($talukas as $taluka)
                    <option value="{{ $taluka->id }}" {{ $taluka->id == $acquisition_register->taluka_id ? 'selected' : '' }} >{{ $taluka->taluka_name }}</option>
                    @endforeach

                </select>
                @error('taluka_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>


            <div class="col-md-4">
                <label class="col-form-label" for="village_name">Village/ गाव<span class="text-danger">*</span></label>
                <select name="village_id" id="village_id" class="form-select" required disabled readonly>
                    <option value="" >Select Village</option>
                    @foreach($villages as $village)
                    <option value="{{ $village->id }}"  {{ $village->id == $acquisition_register->village_id ? 'selected' : '' }} >{{ $village->village_name }}</option>
                    @endforeach
                </select>
                @error('village_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
{{--
            <div class="col-md-4">
                <label class="col-form-label" for="sr_no_id">
                    निवाडा क्र. / Sr.No<span class="text-danger">*</span>
                </label>
                <select name="sr_no_id" id="sr_no_id" class="form-select" required>
                    <option value="">निवाडा क्र. निवडा</option>
                    @foreach($sr_nos as $sr_no)
                        <option value="{{ $sr_no->id }}"
                            {{ old('sr_no_id', $acquisition_register->sr_no_id ?? '') == $sr_no->id ? 'selected' : '' }}>
                            {{ $sr_no->sr_nos_in }}
                        </option>
                    @endforeach
                </select>
                @error('sr_no_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

            <div class="col-md-4">
                <label class="col-form-label" for="sr_no">SR. No/निवाडा क्र.<span class="text-danger">*</span></label>
                <input class="form-control" id="sr_no" name="sr_no" type="text" placeholder="Enter SR. No" value="{{ old('sr_no', $acquisition_register->sr_no) }}" disabled readonly>
                <span class="text-danger is-invalid applicant_name_err"></span>

            </div>

            <div class="col-md-4">
                <label class="col-form-label" for="land_acquisition_id">
                    Purpose of land acquisition/ भूसंपादनाचे प्रयोजन<span class="text-danger">*</span>
                </label>
                <select name="land_acquisition_id" id="land_acquisition_id" class="form-select" required disabled readonly>
                    <option value="" disabled>Select land acquisition</option>
                    @foreach($land_acquisitions as $land_acquisition)
                        <option value="{{ $land_acquisition->id }}"
                            {{ old('land_acquisition_id', $acquisition_register->land_acquisition_id ?? '') == $land_acquisition->id ? 'selected' : '' }} disabled>
                            {{ $land_acquisition->land_acquisitions_name }}
                        </option>
                    @endforeach
                </select>
                @error('land_acquisition_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="col-form-label" for="bundle">Bundle No/बंडल क्रमांक<span class="text-danger">*</span></label>
                <input class="form-control" id="bundle" name="bundle" type="text" placeholder="Enter Bundle" value="{{ old('bundle', $acquisition_register->bundle) }}" disabled readonly>
                <span class="text-danger is-invalid applicant_name_err"></span>

            </div>

        </div>
<br>
<a href="{{ route('acquisition_register.index') }}" class="btn btn-primary btn-danger">Cancel</a>


</div>


        {{-- <h2> Status Details</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Remark</th>
                </tr>
            </thead>

        </table> --}}

        </div>
    </div>
</form>


</x-admin.layout>
