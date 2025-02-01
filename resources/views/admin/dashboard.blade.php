<x-admin.layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="heading">Dashboard</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate" >
                <div class="card-body" style="background-color:#e2c636 !important ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home icon-bg text-white"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>

                    <div class="d-flex align-items-center" >
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-white text-truncate mb-0" style="color: white"> Total Land Acquisition</p>
                        </div>

                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value text-white" data-target="{{ $acquisition_assistants }}">0</span>
                            </h4>
                        </div>
                        {{-- <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-dollar-circle text-primary"></i>
                            </span>
                        </div> --}}
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">

                <div class="card-body" style="background-color: #1b4c43 !important" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book icon-bg text-white"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                         <p class="text-uppercase fw-medium text-white text-truncate mb-0" >Total Pending</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value text-white" data-target="{{ $pending_count }}">0</span>
                            </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate" >
                <div class="card-body" style="background-color:blue !important ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book icon-bg text-white"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-white text-truncate mb-0">Total Approved</p>
                        </div>

                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value text-white" data-target="{{ $approved_count }}">0</span>
                            </h4>
                        </div>

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body" style="background-color: red !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book icon-bg text-white"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-white text-truncate mb-0"> Total Reject</p>
                        </div>

                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value text-white" data-target="{{ $reject_count }}">0</span>
                            </h4>
                        </div>

                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>

<br>
    <div>

        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> <b>Taluka Name</b></p>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate" >
                    <div class="card-body" >
                        <div class="d-flex align-items-center" style="color: blue">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Land Acquisition Record <br>Total count</p>
                            </div>

                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $acquisition_assistants }}">0</span>
                                </h4>
                            </div>
                            {{-- <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                    <i class="bx bx-dollar-circle text-primary"></i>
                                </span>
                            </div> --}}
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                             <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Land Acquisition Record <br> Pending count</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $pending_count }}">0</span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Land Acquisition Record <br> Approved count</p>
                            </div>

                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $approved_count }}">0</span>
                                </h4>
                            </div>

                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Land Acquisition Record <br> Reject count</p>
                            </div>

                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $reject_count }}">0</span>
                                </h4>
                            </div>

                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <!-- card -->
                <div class="card card-animate" >
                    <div class="card-body" >
                        <div class="d-flex align-items-center" style="color: blue">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total village</p>
                            </div>

                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $village }}">0</span>
                                </h4>
                            </div>
                            {{-- <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                    <i class="bx bx-dollar-circle text-primary"></i>
                                </span>
                            </div> --}}
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-4 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                             <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Land acquisition village count</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $pending_count }}">0</span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-4 col-md-6">
                <!-- card -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">No of Land acquisition village count</p>
                            </div>

                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="{{ $approved_count }}">0</span>
                                </h4>
                            </div>

                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6">
            <!-- card -->
            <div class="card card-animate" >
                <div class="card-body" >
                    <div class="d-flex align-items-center" style="color: blue">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Land acquisition Complete Count</p>
                        </div>

                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="{{ $acquisition_assistants }}">0</span>
                            </h4>
                        </div>
                        {{-- <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-dollar-circle text-primary"></i>
                            </span>
                        </div> --}}
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-6 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                         <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Land acquisition Inprocess count</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="{{ $pending_count }}">0</span>
                            </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

<!-- end col -->

        </div>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.counter-value').forEach(function (counter) {
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
    @push('scripts')
    @endpush

</x-admin.layout>

