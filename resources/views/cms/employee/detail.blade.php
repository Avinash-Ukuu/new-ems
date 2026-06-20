@extends('cms.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">
                                <img src="{{ asset('uploads/users/'.$employee->user->image) }}" alt="profile"
                                    class="img-lg rounded-circle mb-3">
                                <div class="mb-3">
                                    <h3>{{ ucfirst($employee->user->name) }}</h3>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="mb-0 me-2 text-muted">{{ $employee->designation->name }}</h5>
                                    </div>
                                </div>
                                {{-- <p class="w-75 mx-auto mb-3">Bureau Oberhaeuser is a design bureau focused on Information-
                                    and
                                    Interface Design. </p>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success me-1">Hire Me</button>
                                    <button class="btn btn-success">Follow</button>
                                </div> --}}
                            </div>
                            <div class="border-bottom py-4">
                                <p>Skills</p>
                                <div>
                                    <label class="badge badge-outline-dark my-1">Chalk</label>
                                    <label class="badge badge-outline-dark my-1">Hand lettering</label>
                                    <label class="badge badge-outline-dark my-1">Information Design</label>
                                    <label class="badge badge-outline-dark my-1">Graphic Design</label>
                                    <label class="badge badge-outline-dark my-1">Web Design</label>
                                </div>
                            </div>

                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Status
                                    </span>
                                    <span class="float-right text-muted">
                                        @if($employee->user->is_active == 1)
                                            Active
                                        @else
                                            In Active
                                        @endif
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Gender
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ ucfirst($employee->gender)}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        DOB
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $employee->dob ? \Carbon\Carbon::parse($employee->dob)->format('d-m-Y') : '' }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $employee->phone}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Mail
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $employee->user->email}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Address
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $employee->address}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Emergency Contact Name
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $employee->emergency_contact_name}}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Emergency Contact Number
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $employee->emergency_contact_number}}
                                    </span>
                                </p>

                            </div>
                            <a href="{{ route('cms.employee.index') }}" class="btn btn-outline-primary">
                                Back
                            </a>
                        </div>
                        <div class="col-lg-8">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
