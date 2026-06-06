@extends('cms.layouts.master')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $object->id ? 'Edit Permission' : 'Create Permission' }}</h4>
                <form class="forms-sample" action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($object->id)
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Select Module</label>
                        <div class="col-sm-12">
                            <select name="module_id" id="module_id" class="form-select select2" required>

                                <option value="">Select Module</option>

                                @foreach ($modules as $id => $name)
                                    <option value="{{ $id }}" {{ $object->module_id == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Permission Name</label>
                        <input type="text" class="form-control name" id="exampleInputUsername1" name="name"
                            placeholder="Enter Permission Name" value="{{ old('name', $object->name) }}">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Description"
                            name="description" value="{{ old('description', $object->description) }}">

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
        });
    </script>
@endsection
