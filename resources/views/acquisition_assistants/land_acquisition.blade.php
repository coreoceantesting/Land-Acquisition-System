<x-admin.layout>
    <x-slot name="title">Record Authorization - In Process</x-slot>
    <x-slot name="heading">Record Authorization - In Process</x-slot>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Record Authorization - In Process</h4>
                    {{-- <a href="{{ route('acquisition_assistant.create') }}" class="btn btn-primary btn-sm float-end">Add New</a> --}}
                </div>
                <div class="card-body" style="overflow-x: auto; white-space: nowrap;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>जिल्हा/District</th>
                                <th>तालुका/Taluka</th>
                                <th>गाव/Village</th>
                                <th>निवाडा क्र./Sr.No</th>
                                <th>भूसंपादनाचे प्रयोजन/Purpose of L.A</th>
                                <th>प्रकल्पाचे नाव/Project Name</th>
                                <th>Actions</th>
                                @can('la_record.change-status')
                                    <th>
                                        status
                                    </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($record->district)->district_name ?? 'No district' }}</td>
                                    <td>{{ optional($record->taluka)->taluka_name ?? 'No taluka' }}</td>
                                    <td>{{ optional($record->village)->village_name ?? 'No village' }}</td>
                                    {{-- <td></td> --}}
                                    <td>{{ $record->sr_no_id ?? 'No sr_nos' }}</td>
                                    <td>{{ optional($record->land_acquisition)->land_acquisitions_name ?? 'No land_acquisitions_name' }}</td>

                                    <td>{{ $record->project_name }}</td>
                                    <td>
                                        <a href="{{ route('acquisition_assistant.show', $record->id) }}?{{ http_build_query(['page_type' => 'record_auth']) }}" class="btn btn-sm btn-success">View</a>
                                    </td>
                                    @can('la_record.change-status')
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success changeStatusModel" data-bs-toggle="modal" data-bs-target="#statusModal" data-id="{{ $record->id }}"
                                                data-acquisition_proposal="{{ $record->acquisition_proposal }}" data-updated_date="{{ $record->updated_date }}">
                                                Change Status
                                            </a>
                                        </td>
                                    @endcan
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true" data-bs-backdrop="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <form id="statusChangeForm" enctype="multipart/form-data" action="{{ route('acquisition_assistant.complete_auth') }}" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="id" id="modelId">
                                    <!-- Acquisition Proposal Field -->
                                    <div class="mb-3">
                                        <label for="acquisitionProposal" class="form-label">भूसंपादन प्रस्ताव /
                                            Land acquisition proposal</label>
                                        <select name="acquisition_proposal" id="acquisition_proposal" class="form-select" required>
                                            <option value="">भूसंपादन प्रस्ताव</option>
                                            <option value="1">पूर्ण</option>
                                            {{-- <option value="2">सुरु</option> --}}
                                        </select>
                                    </div>


                                    <!-- Date Field -->
                                    <div class="mb-3">
                                        <label for="updated_date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="updated_date" name="updated_date" required>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="confirmStatusChange">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    </div>


</x-admin.layout>

<script>
    function updateStatus(id, status, officer) {
        const remark = officer === 'acquisition_officer' ?
            document.getElementById('divisionalOfficerRemark').value :
            document.getElementById('acquisitionOfficerRemark').value;

        fetch(`/acquisition-assistants/${officer}-status/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status,
                    remark
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    location.reload(); // Reload to update status on the page
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
<script>
    // document.getElementById('confirmStatusChange').addEventListener('click', function () {
    //     // Get input values
    //     const acquisitionProposal = document.getElementById('acquisition_proposal').value;
    //     const statusDate = document.getElementById('updated_date').value;
    //     const id = this.getAttribute('data-id');
    //     // Validate fields (optional)
    //     if (!acquisitionProposal || !statusDate) {
    //         alert('Please fill in all fields.');
    //         return;
    //     }

    //     // Example: Log the values or send them via AJAX
    //     console.log('Acquisition Proposal:', acquisition_proposal);
    //     console.log('Date:', updated_date);


    //     const modal = document.querySelector('#statusModal');
    //     const bootstrapModal = bootstrap.Modal.getInstance(modal);
    //     bootstrapModal.hide();

    // });

    $(document).ready(function() {
        $('.changeStatusModel').click(function() {
            let id = $(this).attr('data-id');
            let acquisitionProposal = $(this).attr('data-acquisition_proposal');
            let updatedDate = $(this).attr('data-updated_date');
            // $('#acquisition_proposal').val(acquisitionProposal);
            // $('#updated_date').val(updatedDate);
            $('#modelId').val(id);

            const modal = new bootstrap.Modal(document.getElementById('statusModal'));
            modal.show();
        })
    });
</script>
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
