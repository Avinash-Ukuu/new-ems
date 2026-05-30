@extends('cms.layouts.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                <h4 class="card-title col-6">Role Table</h4>
                <div class="card-tool col-6 text-end">
                <a href="{{route('cms.role.create')}}" class="btn btn-inverse-primary btn-fw">Add Role</a>
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Assign Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    @if ($role->name != 'Admin')
                                        <td><a href="{{ route('cms.assignPermissions', ['id' => $role->id]) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('cms.role.edit', ['role' => $role->id]) }}"><i
                                                        class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    @else
                                        <td colspan="2">All Access</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
