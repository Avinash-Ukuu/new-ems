
@extends('cms.layouts.master')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $object->id ? 'Edit Employee' : 'Create Employee' }}</h4>
                <form class="forms-sample" action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($object->id)
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control name" id="exampleInputUsername1" name="name"
                                placeholder="Name" value="{{ old('name', $object->user->name ?? '') }}">

                        </div>
                        <div class="form-group col-4">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Email"
                                name="email" value="{{ old('email', $object->user->email ?? '') }}">
                        </div>
                        <div class="form-group col-4">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control phone" id="phone" placeholder="Phone"
                                name="phone" value="{{ old('phone', $object->phone) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="dob">DOB</label>
                            <input type="date" class="form-control" id="dob" placeholder="Date Of Birth"
                                name="dob" max="{{ date('Y-m-d') }}" value="{{ old('dob', $object->dob) }}">
                            <small id="dob_error" class="text-danger"></small>
                        </div>

                        <div class="form-group col-4">
                            <label for="gender">Gender</label>
                            <select class="form-control select2" id="gender" name="gender">
                                <option value="">-- Select Gender --</option>
                                <option value="male" {{ old('gender', $object->gender ?? '') == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>
                                <option value="female" {{ old('gender', $object->gender ?? '') == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>
                                <option value="other" {{ old('gender', $object->gender ?? '') == 'other' ? 'selected' : '' }}>
                                    Other
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Address"
                                name="address" value="{{ old('address', $object->address) }}">
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="joining_date">Joining Date</label>
                            <input type="date" class="form-control" id="joining_date" placeholder="Joining Date"
                                name="joining_date" value="{{ old('joining_date', $object->joining_date) }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="employment_type">Employment Type</label>
                            <select class="form-control select2" id="employment_type" name="employment_type">
                                <option value="">-- Select Employment Type --</option>
                                <option value="full-time" {{ old('employment_type', $object->employment_type ?? '') == 'full-time' ? 'selected' : '' }}>
                                    Full Time
                                </option>
                                <option value="part-time" {{ old('employment_type', $object->employment_type ?? '') == 'part-time' ? 'selected' : '' }}>
                                    Part Time
                                </option>
                                <option value="contract" {{ old('employment_type', $object->employment_type ?? '') == 'contract' ? 'selected' : '' }}>
                                    Contract
                                </option>
                                <option value="intern" {{ old('employment_type', $object->employment_type ?? '') == 'intern' ? 'selected' : '' }}>
                                    Intern
                                </option>
                                <option value="temporary" {{ old('employment_type', $object->employment_type ?? '') == 'temporary' ? 'selected' : '' }}>
                                    Temporary
                                </option>
                                <option value="freelance" {{ old('employment_type', $object->employment_type ?? '') == 'freelance' ? 'selected' : '' }}>
                                    Freelance
                                </option>
                            </select>
                        </div>



                        <div class="form-group col-md-4">
                            <label for="exampleInputUsername2">Select Designation</label>
                            <div class="col-sm-12">
                                <select name="designation_id" id="designation_id" class="form-select select2" required>

                                    <option value="">Select Designation</option>

                                    @foreach ($designations as $id => $name)
                                        <option value="{{ $id }}" {{ $object->designation_id == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-4">
                            <label for="salary">Salary</label>
                            <input type="number" class="form-control" id="salary" name="salary" min="0" step="1"
                                placeholder="Salary" value="{{ old('salary', $object->salary) }}">
                        </div>

                        <div class="form-group col-4">
                            <label for="emergency_contact_name">Emergency Contact Name</label>
                            <input type="text" class="form-control name" id="emergency_contact_name" name="emergency_contact_name"
                                placeholder="Emergency Contact Name" value="{{ old('emergency_contact_name', $object->emergency_contact_name) }}">

                        </div>

                        <div class="form-group col-4">
                            <label for="emergency_contact_number">Emergency Contact Number</label>
                            <input type="text" class="form-control phone" id="emergency_contact_number" placeholder="Emergency Contact Number"
                                name="emergency_contact_number" value="{{ old('emergency_contact_number', $object->emergency_contact_number) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-8">
                            <label>Profile Image</label>

                            {{-- Hidden File Input --}}
                            <input type="file" name="image" id="imageInput" class="file-upload-default"
                                accept=".jpg,.jpeg,.png">

                            {{-- Custom Upload UI --}}
                            <div class="input-group col-xs-12 d-flex align-items-center">

                                <input type="text" class="form-control file-upload-info @error('image') is-invalid @enderror"
                                    disabled placeholder="Upload Image" id="fileName">

                                <span class="input-group-append ms-2">
                                    <button class="file-upload-browse btn btn-primary"  type="button">
                                        Upload
                                    </button>
                                </span>

                            </div>

                            {{-- Image Note --}}
                            <small class="text-muted">
                                Only JPG, JPEG, PNG allowed. Max size: 2MB
                            </small>

                            {{-- Preview --}}
                            <div class="mt-3">

                                <img id="previewImage"
                                    src="{{ !empty($object->user->image) && file_exists(public_path('uploads/users/' . $object->user->image))
                                        ? asset('uploads/users/' . $object->user->image)
                                        : asset('images/no-image.jpg') }}"
                                    alt="Preview"
                                    style="
                                        width:120px;
                                        height:120px;
                                        object-fit:cover;
                                        border-radius:10px;
                                        border:1px solid #ddd;
                                    ">

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="exampleInputUsername2">Select Reporting Manager</label>
                            <div class="col-sm-12">
                                <select name="reporting_manager_id" id="reporting_manager_id" class="form-select select2" required>

                                    <option value="">Select Reporting Manager</option>

                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $object->reporting_manager_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->user->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" id="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footerScripts')
    <script>
        // Open File Manager
        document.querySelector('.file-upload-browse').addEventListener('click', function() {
            document.getElementById('imageInput').click();
        });

        // Preview + Validation
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) {
                return;
            }
            // Allowed Types
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            // Max Size = 2MB
            const maxSize = 2 * 1024 * 1024;
            // Type Validation
            if (!allowedTypes.includes(file.type)) {
                alert('Only JPG, JPEG and PNG files are allowed.');
                e.target.value = '';
                document.getElementById('fileName').value = '';
                return;
            }

            // Size Validation
            if (file.size > maxSize) {
                alert('Image size must be less than 2MB.');
                e.target.value = '';
                document.getElementById('fileName').value = '';
                return;
            }

            // Show File Name
            document.getElementById('fileName').value = file.name;
            // Image Preview
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImage').style = event.target.result;
                document.getElementById('previewImage').style = "height:100px";
                document.getElementById('previewImage').src = event.target.result;
            };

            reader.readAsDataURL(file);

        });

        $(document).ready(function() {
            var name = $(".name").val();
            if (name == "") {
                $('#submit').prop('disabled', true);
            }
            $('.name').on('input', function() {
                var inputValue = $(this).val();
                var numeric = /^\d/;
                var specialCharacter = "!@#\\$%\^&*()_\\-+=\\[\\]{};':\",./<>?\\|`~";
                var emojiRegex = /[\uD800-\uDBFF][\uDC00-\uDFFF]|[\u2600-\u27FF]/;
                var hasSpecialCharacter = false;
                var hasnumeric = false;

                for (var i = 0; i < specialCharacter.length; i++) {
                    if (inputValue.includes(specialCharacter[i])) {
                        hasSpecialCharacter = true;
                        break;
                    }
                }

                if (/\d/.test(inputValue)) {
                    hasnumeric = true;
                }

                if (hasSpecialCharacter || emojiRegex.test(inputValue) || hasnumeric) {
                    $('#submit').prop('disabled', true);
                } else {
                    $('#submit').prop('disabled', false);
                }
            });


            $('#email').on('input', function() {
                const email = $('#email').val().trim();
                const gmailRegex = /@gmail\.com$/i;

                if (email === '' || gmailRegex.test(email)) {
                    $('#submit').prop('disabled', false);
                } else {
                    $('#submit').prop('disabled', true);
                }
            });

            $('.phone').on('input', function(){
                var inputValue = $(this).val();
                inputValue = inputValue.replace(/\D/g, '');
                inputValue = inputValue.substring(0, 10);
                $(this).val(inputValue);
            });

            $("#dob").on("change", function () {

                let dob = new Date($(this).val());
                let today = new Date();
                today.setHours(0, 0, 0, 0);
                if (dob > today) {
                    $("#dob_error").text("Date of birth cannot be a future date.");
                    $(this).val('');
                    return;
                }

                let age = today.getFullYear() - dob.getFullYear();
                let monthDiff = today.getMonth() - dob.getMonth();

                if (
                    monthDiff < 0 ||
                    (monthDiff === 0 && today.getDate() < dob.getDate())
                ) {
                    age--;
                }
                if (age < 18) {
                    $("#dob_error").text("Age must be at least 18 years.");
                    $(this).val('');
                    return;
                }

                $("#dob_error").text("");
            });

            $("#salary").on("input", function () {
                this.value = this.value.replace(/[^0-9.]/g, '');
                this.value = this.value.replace(/(\..*)\./g, '$1');
            });
        });
    </script>
@endsection
