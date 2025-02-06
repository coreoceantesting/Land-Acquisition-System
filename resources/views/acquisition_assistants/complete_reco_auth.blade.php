<x-admin.layout>
    <x-slot name="title">Land Acquisition Assistance - Record</x-slot>
    <x-slot name="heading">Land Acquisition Assistance - Record</x-slot>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Land Acquisition Assistance Records</h4>
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
                                <th>भूसंपादनाचे प्रयोजन/Purpose of land acquisition</th>
                                <th>प्रकल्पाचे नाव/Project Name</th>
                                {{-- <th>भूसंपादनाचे वर्ष / Year</th>
                             <th>   भूसंपादन मंडळाचे नाव / Name of Land Acquisition Board</th>
                                <th>वर्णन / Description</th>
                   <th>निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम / Designation </th>
                   <th>भूसंपादन प्रस्ताव / Land acquisition proposal</th>
                   <th>भूसंपादन कोणत्या कायद्यानुसार झाले ? / Land acquisition was done according to which law?</th> --}}
                   {{-- <th>status</th> --}}
                   <th>Actions</th>
{{-- <th>status</th> --}}
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
                                    {{-- <td>{{ optional($record->year)->year ?? 'No year' }}</td>
                                    <td>{{ $record->acquisition_board_name }}</td>
                                    <td>{{ $record->description }}</td> --}}
                                  {{-- <td>{{ $record->designation }}</td> --}}
                                  {{-- <td>  @if($record->designation == 1)
                                    लिपिक/Clerk
                                @elseif($record->designation == 2)
                                सहाय्यक/Assistant
                                @endif</td>
                                <td>
                                    @if($record->acquisition_proposal == 1)
                                    पूर्ण
                                @elseif($record->acquisition_proposal == 2)
                                सुरु
                                @endif
                                </td>
                                <td>
                                    @if( $record->law  == 1)
                                    THE NATIONAL GREEN TRIBUNAL ACT, 2010/
                                    राष्ट्रीय हरित न्यायाधिकरण कायदा, २०१०
                                @elseif( $record->law  == 2)
                                THE MUSSALMAN WAKF ACT, 1923/मुस्लिम वक्फ कायदा, १९२३
                                @endif
                                </td> --}}


                                    <td>
                                        <a href="{{ route('acquisition_assistant.show', $record->id) }}" class="btn btn-sm btn-success">View</a>

                                        {{-- <form id="delete-form-{{ $record->id }}" action="{{ route('acquisition_assistant.destroy', $record->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $record->id }})">Delete</button>
                                        </form>
                                        <a href="{{ route('acquisition_assistant.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}

                                    </td>
                                    {{-- <td>
                                        <a href="#" class="btn btn-sm btn-success changeStatusModel"
                                        data-bs-toggle="modal"
                                        data-bs-target="#statusModal"
                                        data-id="{{ $record->id }}"
                                        data-acquisition_proposal="{{ $record->acquisition_proposal }}"
                                        data-updated_date="{{ $record->updated_date }}">
                                         Change Status
                                     </a>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
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
                                    <option value="2">सुरु</option>
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
    </div> --}}

</x-admin.layout>

<script>
    function updateStatus(id, status, officer) {
    const remark = officer === 'acquisition_officer'
        ? document.getElementById('acquisitionOfficerRemark').value
        : document.getElementById('acquisitionOfficerRemark').value;

    fetch(`/acquisition-assistants/${officer}-status/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status, remark })
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

// $(document).ready(function(){
//     $('.changeStatusModel').click(function(){
//         let id = $(this).attr('data-id');
//         let acquisitionProposal = $(this).attr('data-acquisition_proposal');
//         let updatedDate = $(this).attr('data-updated_date');
//         // $('#acquisition_proposal').val(acquisitionProposal);
//         // $('#updated_date').val(updatedDate);
//         $('#modelId').val(id);

//         const modal = new bootstrap.Modal(document.getElementById('statusModal'));
//         modal.show();
//     })
// });



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
