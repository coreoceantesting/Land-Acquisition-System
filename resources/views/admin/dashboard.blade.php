<x-admin.layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="heading">Dashboard</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

    @push('styles')
        <style>
            .br-right{
                border-right: 1px solid #eee !important;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-12 px-0">

            {{-- first section --}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body d-flex gap-3 align-items-center">
                            <div class="avatar-sm">
                                <div class="avatar-title border bg-success-subtle border-success border-opacity-25 rounded-2 fs-17">
                                    <i data-feather="box" class="icon-dual-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-15">{{ $districtCount }}</h5>
                                <p class="mb-0 text-muted">Total Districts</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body d-flex gap-3 align-items-center">
                            <div class="avatar-sm">
                                <div class="avatar-title border bg-info-subtle border-info border-opacity-25 rounded-2 fs-17">
                                    <i data-feather="package" class="icon-dual-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-15">{{ $talukaCount }}</h5>
                                <p class="mb-0 text-muted">Total Talukas</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body d-flex gap-3 align-items-center">
                            <div class="avatar-sm">
                                <div class="avatar-title border bg-warning-subtle border-warning border-opacity-25 rounded-2 fs-17">
                                    <i data-feather="home" class="icon-dual-warning"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-15">{{ $villageCount }}</h5>
                                <p class="mb-0 text-muted">Total Villages</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            {{-- second section --}}
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card p-3">
                        <h3>Land Acquisition Records</h3>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Records</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-3">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-2"><span class="counter-value" data-target="{{ $allRecords }}">{{ $allRecords }}</span></h4>
                                                <a href="" class="">&nbsp;</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                    <i class="bx bx-map-pin text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending Records</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-3">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-2"><span class="counter-value" data-target="{{ $pendingRecords }}">{{ $pendingRecords }}</span></h4>
                                                <a href="{{ route('acquisition_assistant.pending') }}" class="text-decoration-underline">View List</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-info-subtle rounded fs-3">
                                                    <i class="bx bx-map-pin text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Approved Records</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-3">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-2"><span class="counter-value" data-target="{{ $approvedRecords }}">{{ $approvedRecords }}</span></h4>
                                                <a href="{{ route('acquisition_assistant.approved') }}" class="text-decoration-underline">View List</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-success-subtle rounded fs-3">
                                                    <i class="bx bx-map-pin text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Recorrection Records</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-3">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-2"><span class="counter-value" data-target="{{ $recorrectionRecords }}">{{ $recorrectionRecords }}</span></h4>
                                                <a href="{{ route('acquisition_assistant.rejected') }}" class="text-decoration-underline">View List</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-danger-subtle rounded fs-3">
                                                    <i class="bx bx-map-pin text-danger"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            {{-- third section --}}
            {{-- <div class="row mt-3">
                <div class="col-12">
                    <div class="card p-3">

                    </div>
                </div>
            </div> --}}



            {{-- fourth section --}}
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card p-3">
                        <h3 class="">Taluka Wise :</h3>
                        <div class="row">
                            @foreach ($talukasData as $talukaData)
                                <div class="col-md-4 col-lg-4 col-xl-4 box-col-4">
                                    <div class="card custom-card rounded">
                                        <h5 class="card-header rounded bg-primary py-2 px-3 text-center text-light">({{ ucwords($talukaData[0]->taluka?->taluka_name) }}) - Total: {{ $talukaData->count() }}</h5>
                                        <div class="card-body px-3">
                                            <div class="row">
                                                <div class="col-4 br-right text-center">
                                                    <h6 class="mb-0">Pending</h6>
                                                    <strong style="font-size:22px">{{ $talukaData->where('acquisition_officer_status', 0)->count() }} </strong> <br>
                                                </div>
                                                <div class="col-4 br-right text-center">
                                                    <h6 class="mb-0">Approved</h6>
                                                    <strong style="font-size:22px; display:inline-block;">{{ $talukaData->where('acquisition_officer_status', 1)->count() }}</strong> <br>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <h6 class="mb-0">Recorrection</h6>
                                                    <strong style="font-size:22px; display:inline-block;">{{ $talukaData->where('acquisition_officer_status', 2)->count() }}</strong> <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-6 br-right text-center">
                                                    <h6 class="mb-0">In Process</h6>
                                                    <strong style="font-size:22px">{{ $talukaData->where('acquisition_proposal', 1)->count() }}</strong> <br>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <h6 class="mb-0">Completed</h6>
                                                    <strong style="font-size:22px; display:inline-block;">{{ $talukaData->where('acquisition_proposal', 2)->count() }}{{-- <span style="font-size:14px; display:inline-block;">(61%)</span> --}}
                                                    </strong> <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.counter-value').forEach(function(counter) {
                    let target = parseInt(counter.getAttribute('data-target'));
                    let count = 0;
                    let speed = 50;
                    let increment = target / speed;

                    function updateCount() {
                        count += increment;
                        if (count < target) {
                            counter.innerText = Math.floor(count);
                            setTimeout(updateCount, 10);
                        } else {
                            counter.innerText = target;
                        }
                    }
                    updateCount();
                });
            });
        </script>
    @endpush

</x-admin.layout>
