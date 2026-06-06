@extends('cms.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $user->name }}</h4>
                    <p class="card-description">
                        Assign Roles
                    </p>
                    <form action="{{ route('cms.submitRole') }}" method="POST"
                        onsubmit="document.getElementById('submit').disabled=true;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        @php
                            $assignedRoles = $user->roles->isEmpty()
                                ? []
                                : $user->roles->pluck('name', 'id')->toArray();
                        @endphp
                        <div class="row m-2">
                            @foreach ($roles as $key => $role)
                                <div class="col-md-3 mb-3">
                                    <div class="form-check form-check-primary">
                                        <input class="form-check-input" type="checkbox" name="role_id[]"
                                            value="{{ $key }}" id="role_{{ $key }}"
                                            @if (array_key_exists($key, $assignedRoles)) checked @endif>
                                        <label class="form-check-label" for="role_{{ $key }}">
                                            {{ $role }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <button type="submit" id="submit" class="btn btn-primary me-2">
                                Submit
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-light">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
