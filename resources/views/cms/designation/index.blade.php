@extends('cms.layouts.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                <h4 class="card-title col-6">Designation Table</h4>
                <div class="card-tool col-6 text-end">
                    <a href="{{route('cms.designation.create')}}" class="btn btn-inverse-primary btn-fw">Add Designation</a>
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($designations as $designation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $designation->name }}</td>
                                    <td>
                                        @if($designation->status == 1)
                                            <label class="btn btn-outline-success btn-fw">Active</label>
                                        @else
                                            <label class="btn btn-outline-danger btn-fw">In Active</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('cms.designation.edit', ['designation' => $designation->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
