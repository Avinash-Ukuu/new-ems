<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['departments']    = Department::orderBy("created_at","desc")->get();

        return view("cms.department.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']     =   new Department();
        $data['url']        =   route("cms.department.store");
        $data['method']     =   "POST";

        return view("cms.department.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $department             =   new Department();
        $department->name       =   $request->name;
        $department->status     =   isset($request->status) ? 1 : 0;
        $department->save();
        $data['message']        =   auth()->user()->name . " has created '$department->name' department";
        $data['action']         =   "created";
        $data['module']         =   "department";
        $data['object']         =   $department;
        saveLogs($data);
        Session::flash("success", "Department Created");

        return redirect(route("cms.department.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['object']     =   Department::find($id);
        if(empty($data['object']))
        {
            Session::flash('error','Data not found');
            return redirect(route('cms.department.index'));
        }
        $data['url']        =   route("cms.department.update",['department'=>$id]);
        $data['method']     =   "PUT";

        return view("cms.department.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $department             =   Department::find($id);
        if(empty($department))
        {
            Session::flash("error", "Department Not Found");
            return redirect(route("cms.department.index"));
        }
        $department->name       =   $request->name;
        $department->status     =   isset($request->status) ? 1 : 0;
        $department->save();
        $data['message']        =   auth()->user()->name . " has updated '$department->name' department";
        $data['action']         =   "updated";
        $data['module']         =   "department";
        $data['object']         =   $department;
        saveLogs($data);
        Session::flash("success", "Department Updated");

        return redirect(route("cms.department.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
