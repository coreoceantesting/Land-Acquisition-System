
<x-admin.layout>
    <x-slot name="title">Land Acquisition Record - List</x-slot>
    <x-slot name="heading">Land Acquisition Record - List</x-slot>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Land Acquisition Assistance Records</h4>
                    {{-- <a href="{{ route('acquisition_registers.create') }}" class="btn btn-primary btn-sm float-end">Add New</a> --}}
                </div>
                <div class="card-body" style="overflow-x: auto; white-space: nowrap;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>जिल्हा / District</th>
                                <th>तालुका / Taluka</th>
                                <th>गाव / Village</th>
                                 <th>Sr.No</th>
                                  <th>भूसंपादनाचे प्रयोजन / Purpose of land acquisition</th>
                                   <th>Bundle No</th>

                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($record_reg as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($record->district)->district_name ?? 'No district' }}</td>
                                    <td>{{ optional($record->taluka)->taluka_name ?? 'No taluka' }}</td>
                                    <td>{{ optional($record->village)->village_name ?? 'No village' }}</td>
                                    {{-- <td>{{ optional($record->sr_no)->sr_no ?? 'No sr_nos' }}</td> --}}
                                    <td>{{ $record->sr_no ?? 'No sr no' }}</td>

                                    <td>{{ optional($record->land_acquisition)->land_acquisitions_name ?? 'No land_acquisitions_name' }}</td>
                                    <td>{{ $record->bundle ?? 'No bundle' }}</td>

                                    <td>
                                        <a href="{{ route('acquisition_register.show', $record->id) }}" class="btn btn-sm btn-success">View</a>
                                        {{-- <form  id="delete-form-{{ $record->id }}" action="{{ route('acquisition_register.destroy', $record->id) }}" method="POST" class="d-inline" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $record->id }})">Delete</button>
                                        </form>
                                        <a href="{{ route('acquisition_register.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}

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

            </div>
        </div>
    </div>
</x-admin.layout>

<script>
    @if(Session::has('success'))
        swal({
            title: "Successful!",
            text: "{{ Session::get('success') }}",
            icon: "success",
            button: "OK",
        });
    @endif

    @if(Session::has('error'))
        swal({
            title: "Error!",
            text: "{{ Session::get('error') }}",
            icon: "error",
            button: "OK",
        });
    @endif
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
