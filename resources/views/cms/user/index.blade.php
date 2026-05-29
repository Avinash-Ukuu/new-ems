@extends('cms.layouts.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                <h4 class="card-title col-6">Users Table</h4>
                <div class="card-tool col-6 text-end">
                <a href="{{route('cms.user.create')}}" class="btn btn-inverse-primary btn-fw">Add User</a>
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Assign Roles</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="py-1">
                                        @if (!empty($user->image) && file_exists('uploads/users/' . auth()->user()->image))
                                            <img src="{{ asset('uploads/users/' . $user->image) }}"
                                                class="img-circle elevation-2" alt="User Image">
                                        @else
                                            <img src="{{ asset('assets/skydash/images/faces/face28.jpg')}}" alt="image">
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->showRoles() }}</td>
                                    <td><a href="{{ route('cms.assignRoles', ['id' => $user->id]) }}"><i
                                        class="fa fa-edit"></i></a></td>
                                    <td><a href="{{ route('cms.user.show', ['user' => $user->id]) }}"><i
                                        class="fa fa-info-circle"></i></a></td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('cms.user.edit',['user'=>$user->id]) }}"><i class="fa fa-edit"></i></a>

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
