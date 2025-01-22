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
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>जिल्हा / District</th>
                                <th>तालुका / Taluka</th>
                                <th>गाव / Village</th>
                                <th>प्रकल्पाचे नाव / Project Name</th>
                                <th>भूसंपादनाचे वर्ष / Year</th>
                                <th>वर्णन / Description</th>
                                <th>भूसंपादनाचे प्रयोजन / Purpose</th>
                                {{-- <th>>निवाडा क्र. / Sr.No</th> --}}
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
                                    {{-- <td>{{ optional($record->sr_no)->sr_no ?? 'No sr_nos' }}</td> --}}
                                    <td>{{ $record->project_name }}</td>
                                    <td>{{ optional($record->year)->year ?? 'No year' }}</td>

                                    <td>{{ $record->description }}</td>
                                    <td>{{ optional($record->land_acquisition)->land_acquisitions_name ?? 'No land_acquisitions_name' }}</td>


                                    <td>
                                        <a href="{{ route('acquisition_assistant.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('acquisition_assistant.destroy', $record->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                        </form>
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
