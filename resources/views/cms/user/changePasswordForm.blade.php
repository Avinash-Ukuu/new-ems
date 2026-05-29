@extends('cms.layouts.master')
@section('content')
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Change Password Form</h4>
                <form method="POST" action="{{ route('cms.updatePassword') }}"
                    onsubmit="document.getElementById('submit').disabled=true;">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Update Password</h4>

                                    <div class="row">
                                        <div class="form-group col-6 mb-3">
                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" value="{{ old('password') }}"
                                                placeholder="Enter New Password">

                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6 mb-3">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation" name="password_confirmation"
                                                value="{{ old('password_confirmation') }}" placeholder="Confirm Password">

                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" id="submit" class="btn btn-primary me-2">
                                        Submit
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
