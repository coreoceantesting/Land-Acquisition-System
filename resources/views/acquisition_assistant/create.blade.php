<x-admin.layout>
    <x-slot name="title">Form</x-slot>
    <x-slot name="heading">Form</x-slot>

    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header">
                        <h4 class="card-title">Land Acquisition Assistance </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="name"> जिल्हा <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">जिल्हा निवडा</option>
                                    <option value="district1">District 1</option>
                                    <option value="district2">District 2</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="date">तालुका <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">तालुका निवडा</option>
                                    <option value="district1">District 1</option>
                                    <option value="district2">District 2</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="date">गाव <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">गाव निवडा</option>
                                    <option value="district1">District 1</option>
                                    <option value="district2">District 2</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="date">निवाडा क्र. <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">निवाडा क्र. निवडा    </option>
                                    <option value="district1">District 1</option>
                                    <option value="district2">District 2</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="date">भूसंपादनाचे प्रयोजन <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">भूसंपादनाचे प्रयोजन</option>
                                    <option value="district1">District 1</option>
                                    <option value="district2">District 2</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="name">प्रकल्पाचे नाव <span class="text-danger">*</span></label>
                                <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="date">भूसंपादनाचे वर्ष <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="district1">District 1</option>
                                    <option value="district2">District 2</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="full_address">भूसंपादन मंडळाचे नाव <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="full_address" id="full_address" cols="30" rows="2" placeholder="Enter Applicant Address" required>{{ $abattoirLicense->full_address ?? '' }}</textarea>
                                <span class="text-danger is-invalid full_address_err"></span>
                            </div>


                            <div class="col-md-4">
                                <label class="col-form-label" for="name">तपशिल <span class="text-danger">*</span></label>
                                <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name">
                                <span class="text-danger is-invalid applicant_name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="date">निवाडा घोषित करणारे तत्कालन भूसंपादन अधिकाऱ्याचे पदनाम <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="district1">District 1</option>
                                    <option value="district2">District 2</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="date">भूसंपादन प्रस्ताव <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="1">पूर्ण</option>
                                    <option value="2">सुरु</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="date">भूसंपादन कोणत्या कायद्यानुसार झाले ? <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                    <option value="district1">District 1</option>
                                    <option value="district2">District 2</option>
                                </select>
                            </div>




                            {{-- <input type="hidden" name="document_id" value="{{ $documentId }}"> --}}
                        </div>

                        <div class="form-group" style="border: 2px solid #959ba0; padding: 20px; border-radius: 5px;">


                            <div class="form-group">
                                <div id="dynamic-fields">
                                    <div class="dynamic-row">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="col-form-label" for="date">भूसंपादन प्रस्ताव <span class="text-danger">*</span></label>
                                                <select name="district" id="district" class="form-control" required>
                                                    <option value="">भूसंपादनाचे वर्ष निवडा</option>
                                                    <option value="0">सर्वे क्र.</option>
                                                    <option value="1">गट क्र.</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- Label for 'क्रमांक' above input field -->
                                                <label for="number">क्रमांक (Number) <span class="text-danger">*</span></label>
                                                <input type="number" name="numbers[]" class="form-control" placeholder="क्रमांक" required>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- Label for 'क्षेत्र (हेक्टर)' above input field -->
                                                <label for="area">क्षेत्र (हेक्टर) <span class="text-danger">*</span></label>
                                                <input type="number" name="areas[]" class="form-control" placeholder="क्षेत्र (हेक्टर)" required>
                                            </div>

                                            <div class="col-md-2">
                                                <!-- Additional space, can be used for buttons or more controls -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button to add more rows -->
                                <br>
                                <button type="button" id="add-row" class="btn btn-success">+ Add More</button>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin.layout>
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('acquisition_assistant.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('acquisition_assistant.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>

{{-- mobile and adhar validation --}}
<script>
     $(document).ready(function () {
        $('#phone_no').on('input', function () {
            const phoneValue = $(this).val();
            $(this).val(phoneValue.replace(/[^0-9]/g, '').substring(0, 10));
        });

        // Validate Aadhaar Number (12 digits only)
        $('#addhar_no').on('input', function () {
            const aadhaarValue = $(this).val();
            $(this).val(aadhaarValue.replace(/[^0-9]/g, '').substring(0, 12));
        });
     });

     document.getElementById("nocForm").addEventListener("submit", async function (e) {
        e.preventDefault();

        const form = new FormData(this);
        try {
            const response = await fetch("/noc/store", {
                method: "POST",
                body: form,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            const result = await response.json();
            if (response.ok) {
                alert(result.success);
            } else {
                console.error(result.message || "An error occurred");
                alert("Failed to create NOC");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("An unexpected error occurred");
        }
    });
</script>
