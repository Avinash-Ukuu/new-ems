@extends('cms.layouts.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <h4 class="card-title col-6">Department Table</h4>
                    <div class="card-tool col-6 text-end">
                        <a href="{{route('cms.department.create')}}" class="btn btn-inverse-primary btn-fw">Add Department</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>
                                        @if($department->status == 1)
                                            <label class="btn btn-outline-success btn-fw">Active</label>
                                        @else
                                            <label class="btn btn-outline-danger btn-fw">In Active</label>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <a href="{{ route('cms.department.edit',['department'=>$department->id]) }}"><i class="fa fa-edit"></i></a>

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
@section('footerScripts')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
@endsection
