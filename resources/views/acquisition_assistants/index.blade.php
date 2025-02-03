<x-admin.layout>
    <x-slot name="title">Land Acquisition Assistance - List</x-slot>
    <x-slot name="heading">Land Acquisition Assistance - List</x-slot>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Land Acquisition Assistance Records</h4>
                    <a href="{{ route('acquisition_assistant.create') }}" class="btn btn-primary btn-sm float-end">Add New</a>
                </div>
                <div class="card-body" style="overflow-x: auto; white-space: nowrap;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>जिल्हा / District</th>
                                <th>तालुका / Taluka</th>
                                <th>गाव / Village</th>
                                <th>निवाडा क्र. / Sr.No</th>
                                <th>भूसंपादनाचे प्रयोजन / Purpose of land acquisition</th>
                                <th>प्रकल्पाचे नाव / Project Name</th>
                                <th>भूसंपादनाचे वर्ष / Year</th>
                             <th>   भूसंपादन मंडळाचे नाव / Name of Land Acquisition Board</th>
                                <th>वर्णन / Description</th>
                   <th>निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम / Designation </th>
                   <th>भूसंपादन प्रस्ताव / Land acquisition proposal</th>
                   <th>भूसंपादन कोणत्या कायद्यानुसार झाले ? / Land acquisition was done according to which law?</th>
                   <th>status</th>
                   <th>Actions</th>

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
                                    <td>{{ optional($record->sr_no)->sr_nos_in ?? 'No sr_nos' }}</td>
                                    <td>{{ optional($record->land_acquisition)->land_acquisitions_name ?? 'No land_acquisitions_name' }}</td>

                                    <td>{{ $record->project_name }}</td>
                                    <td>{{ optional($record->year)->year ?? 'No year' }}</td>
                                    <td>{{ $record->acquisition_board_name }}</td>
                                    <td>{{ $record->description }}</td>
                                  {{-- <td>{{ $record->  }}</td> --}}
                                  <td>  @if($record->designation == 1)
                                    पूर्ण
                                @elseif($record->designation == 2)
                                सुरु
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
    पूर्ण
@elseif( $record->law  == 2)
सुरु
@endif
</td>
<td></td>

                                    <td>
                                        <a href="{{ route('acquisition_assistant.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('acquisition_assistant.destroy', $record->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        <a href="{{ route('acquisition_assistant.show', $record->id) }}" class="btn btn-sm btn-warning">View</a>
                                    </td>



                                    </td>
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



</x-admin.layout>

<script>
    function updateStatus(id, status, officer) {
    const remark = officer === 'acquisition_officer'
        ? document.getElementById('divisionalOfficerRemark').value
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
