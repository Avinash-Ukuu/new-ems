@extends('cms.layouts.master')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $object->id ? 'Edit Designation' : 'Create Designation' }}</h4>
                <form class="forms-sample" action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($object->id)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="exampleInputUsername1">Designation Name</label>
                        <input type="text" class="form-control name" id="exampleInputUsername1" name="name"
                            placeholder="Name" value="{{ old('name', $object->name) }}">
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2 m-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status"
                                id="status" value="1"
                                {{ $object->status == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">
                                Status
                            </label>
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
