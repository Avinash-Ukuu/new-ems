@extends('cms.layouts.master')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                <h4 class="card-title col-6">Module Table</h4>
                <div class="card-tool col-6 text-end">
                    @can('superAdmin', new App\Models\User())
                        <a href="{{route('cms.module.create')}}" class="btn btn-inverse-primary btn-fw">Add Module</a>
                    @endcan
                </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                @can('superAdmin', new App\Models\User())
                                    <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $module->name }}</td>
                                    @can('superAdmin', new App\Models\User())
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('cms.module.edit', ['module' => $module->id]) }}"><i
                                                        class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
