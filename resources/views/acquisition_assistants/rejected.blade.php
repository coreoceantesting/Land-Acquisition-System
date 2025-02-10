<x-admin.layout>
    <x-slot name="title">Land Acquisition Recorrection Records- List</x-slot>
    <x-slot name="heading">Land Acquisition Recorrection Records - List</x-slot>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Land Acquisition Recorrection Records</h4>
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
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($record->district)->district_name ?? 'No district' }}</td>
                                    <td>{{ optional($record->taluka)->taluka_name ?? 'No taluka' }}</td>
                                    <td>{{ optional($record->village)->village_name ?? 'No village' }}</td>
                                    <td>{{ $record->sr_no_id ?? 'No sr_nos' }}</td>
                                    <td>{{ optional($record->land_acquisition)->land_acquisitions_name ?? 'No land_acquisitions_name' }}</td>

                                    <td>{{ $record->project_name }}</td>
                                    <td>
                                        <a href="{{ route('acquisition_assistant.show', $record->id) }}" class="btn btn-sm btn-warning">View</a>
                                        @if ($record->acquisition_officer_status == 2)
                                            @can('la_record.edit')
                                                <a href="{{ route('acquisition_assistant.edit', $record->id) }}" class="btn btn-sm btn-danger">Edit</a>
                                            @endcan
                                        @endif
                                    </td>
                                    <td style="color: red">{{ $record->acquisition_officer_remark }} </td>
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
