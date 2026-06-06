@extends('cms.layouts.master')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $object->id ? 'Edit Role' : 'Create Role' }}</h4>
                <form class="forms-sample" action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($object->id)
                        @method('PUT')
                    @endif
                    <div class="form-group">
                        <label for="exampleInputUsername1">Role Name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="name"
                            placeholder="Name" value="{{ old('name', $object->name) }}">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Description"
                            name="description" value="{{ old('description', $object->description) }}">

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
