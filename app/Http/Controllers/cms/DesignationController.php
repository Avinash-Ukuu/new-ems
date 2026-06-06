<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['designations']  =   Designation::all();

        return view("cms.designation.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']     =   new Designation();
        $data['url']        =   route("cms.designation.store");
        $data['method']     =   "POST";

        return view("cms.designation.form", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $designation                   =   new Designation();
        $designation->name             =   $request->name;
        $designation->status           =   isset($request->status) ? 1 : 0;
        $designation->save();
        $data['message']        =   auth()->user()->name . " has created '$designation->name' designation";
        $data['action']         =   "created";
        $data['module']         =   "designation";
        $data['object']         =   $designation;
        saveLogs($data);
        Session::flash("success", "Designation Created");

        return redirect(route("cms.designation.index"));
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
        $data['object']     =   Designation::find($id);
        if (empty($data['object'])) {
            Session::flash("error", "Designation Already Deleted");
            return back();
        }
        $data['url']        =   route("cms.designation.update", ['designation' => $id]);
        $data['method']     =   "PUT";

        return view("cms.designation.form", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $designation                   =   Designation::find($id);
        if (empty($designation)) {
            Session::flash("error", "Designation Already Deleted");
            return redirect(route("cms.designation.index"));
        }
        $designation->name             =   $request->name;
        $designation->status           =   isset($request->status) ? 1 : 0;
        $designation->update();
        $data['message']        =   auth()->user()->name . " has updated '$designation->name' designation";
        $data['action']         =   "updated";
        $data['module']         =   "designation";
        $data['object']         =   $designation;
        saveLogs($data);
        Session::flash("success", "Designation Updated");

        return redirect(route("cms.designation.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
