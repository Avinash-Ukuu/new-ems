@extends('cms.layouts.master')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $object->id ? 'Edit User' : 'Create User' }}</h4>
                <form class="forms-sample" action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($object->id)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" class="form-control name" id="exampleInputUsername1" name="name"
                            placeholder="Name" value="{{ old('name', $object->name) }}">

                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email"
                            name="email" value="{{ old('email', $object->email) }}">

                    </div>
                    <div class="form-group">
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
                                src="{{ !empty($object->image) && file_exists(public_path('uploads/users/' . $object->image))
                                    ? asset('uploads/users/' . $object->image)
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
        });
    </script>
@endsection
