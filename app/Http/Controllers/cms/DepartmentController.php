<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
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
        Session::flash("success", "Module Created");

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
