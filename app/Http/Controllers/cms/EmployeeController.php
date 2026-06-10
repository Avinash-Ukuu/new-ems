<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(!empty(auth()->user()->super_admin))
        {
            $data['users']          =   User::with('employee')->where('id','<>',auth()->user()->id)->orderBy("created_at","desc")->get();
        }
        else
        {
            $data['users']          =   User::with('employee')->where('id','<>',auth()->user()->id)->where(function($query){
                                            $query->whereNull('super_admin')->orWhere('super_admin','0');
                                        })->orderBy("created_at","desc")->get();
        }

        return view('cms.employee.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['object']         =   new Employee();
        $data['method']         =   'POST';
        $data['url']            =   route('cms.employee.store');

        return view('cms.employee.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
