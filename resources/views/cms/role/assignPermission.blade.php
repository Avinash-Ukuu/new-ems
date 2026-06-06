@extends('cms.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $role->name }}</h4>
                    <form action="{{ route('cms.submitPermission') }}" method="POST"
                        onsubmit="document.getElementById('submit').disabled=true;">
                        @csrf
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        @foreach ($modulePermissions as $name => $permissions)
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">
                                    <strong>{{ ucfirst($name) }}</strong>
                                </h5>
                                <div class="row m-3">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-3 col-sm-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permission_id[]"
                                                    id="permission{{ $permission->id }}" value="{{ $permission->id }}"
                                                    {{ array_key_exists($permission->id, $assignedPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
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
