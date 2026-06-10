@extends('cms.layouts.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <h4 class="card-title col-6">Employees Table</h4>
                    <div class="card-tool col-6 text-end">
                        <a href="{{route('cms.employee.create')}}" class="btn btn-inverse-primary btn-fw">Add Employee</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Designation</th>
                                {{-- <th>About</th>
                                <th>Action</th> --}}
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
                                    <td>{{ $user->employee->phone ?? 'N/A' }}</td>
                                    <td>
                                        @if($user->is_active == 1)
                                            <label class="btn btn-inverse-success btn-fw">Active</label>
                                        @else
                                            <label class="btn btn-inverse-danger btn-fw">In Active</label>
                                        @endif
                                    </td>
                                    <td><label class="btn btn-inverse-primary btn-fw">{{ $user->employee->designation ?? "N/A" }}</label></td>
                                    {{-- <td><a href="{{ route('cms.employee.show', ['employee' => $user->employee->id]) }}"><i
                                        class="fa fa-info-circle"></i></a></td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('cms.employee.edit',['employee'=>$user->employee->id]) }}"><i class="fa fa-edit"></i></a>

                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerScripts')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
@endsection
