@extends('cms.layouts.master')
@section('content')
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Switch User Form</h4>
                <form class="forms-sample" action="{{ route('cms.switchUser') }}" method="POST"
                    onsubmit="document.getElementById('submit').disabled=true;">
                     @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Select User</label>
                        <div class="col-sm-10">
                            <select name="user_id" id="user_id" class="form-select select2" required>

                                <option value="">Select User</option>

                                @foreach ($users as $id => $name)
                                    <option value="{{ $id }}">
                                        {{ $name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <button type="submit" id="submit" class="btn btn-primary me-2">Submit</button>

                </form>
            </div>
        </div>
    </div>
@endsection
