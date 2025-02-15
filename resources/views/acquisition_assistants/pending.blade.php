<x-admin.layout>
    <x-slot name="title">Land Acquisition Pending Records - List</x-slot>
    <x-slot name="heading">Land Acquisition Pending Records - List</x-slot>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Land Acquisition Pending Records</h4>
                    {{-- @if (!Auth::user()->hasRole(['Super Admin']))
                    <a href="{{ route('acquisition_assistant.create') }}" class="btn btn-primary btn-sm float-end">Add New</a>
                     @endif --}}
                </div>

                <div class="card-body" style="overflow-x: auto; white-space: nowrap;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>District/जिल्हा/</th>
                                <th>Taluka/तालुका</th>
                                <th>Village/गाव</th>
                                <th>Sr.No/निवाडा क्र.</th>
                                <th>Purpose of L.A/भूसंपादनाचे प्रयोजन</th>
                                <th>Project Name/प्रकल्पाचे नाव</th>
                                {{-- <th>भूसंपादनाचे वर्ष / Year</th>
                             <th>   भूसंपादन मंडळाचे नाव / Name of Land Acquisition Board</th>
                                <th>वर्णन / Description</th>
                             <th>निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम / Designation </th>
                           <th>भूसंपादन प्रस्ताव / Land acquisition proposal</th>
                           <th>भूसंपादन कोणत्या कायद्यानुसार झाले ? / Land acquisition was done according to which law?</th> --}}
                                {{-- <th>status</th> --}}
                                <th class="sticky-column">Actions</th>

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
                                    {{-- <td>  @if ($record->designation == 1)
                                    लिपिक/Clerk
                                @elseif($record->designation == 2)
                                सहाय्यक/Assistant
                                @endif</td>
                                <td>
                                    @if ($record->acquisition_proposal == 1)
                                    पूर्ण
                                @elseif($record->acquisition_proposal == 2)
                                सुरु
                                @endif
                                </td>
                                    <td>
                                        @if ($record->law == 1)
                                        THE NATIONAL GREEN TRIBUNAL ACT, 2010/
                                        राष्ट्रीय हरित न्यायाधिकरण कायदा, २०१०
                                    @elseif( $record->law  == 2)
                                    THE MUSSALMAN WAKF ACT, 1923/मुस्लिम वक्फ कायदा, १९२३
                                    @endif
                                    </td> --}}


                                    <td>
                                        @can('la_record.detail')
                                            <a href="{{ route('acquisition_assistant.show', $record->id) }}" class="btn btn-sm btn-success">View</a>
                                        @endcan

                                        @if ($record->acquisition_officer_status == 0)
                                            @can('la_record.edit')
                                                <a href="{{ route('acquisition_assistant.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @endcan
                                            @can('la_record.delete')
                                                <form id="delete-form-{{ $record->id }}" action="{{ route('acquisition_assistant.destroy', $record->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $record->id }})">Delete</button>
                                                </form>
                                            @endcan
                                        @endif
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
    <style>

    </style>


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
