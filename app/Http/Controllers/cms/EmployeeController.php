<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $data['designations']   =   Designation::pluck("name","id")->toArray();
        $data['employees']      =   Employee::with('user')->get();

        return view('cms.employee.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $user                   =   new User();
        $user->name             =   $request->name;
        $user->email            =   $request->email;
        $user->password         =   Hash::make('password');
        $user->is_active        =   1;
        if ($request->has("image")) {
            $imageName  = "user_" . Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads/users/'), $imageName);
            $user->image  =  $imageName;
        }
        $user->save();

        $role_id                =   Role::where('name','employee')->first()->id;
        $user->roles()->sync($role_id);

        $employee                           =   new Employee();
        $employee->user_id                  =   $user->id;
        $employee->designation_id           =   $request->designation_id;
        $employee->reporting_manager_id     =   $request->reporting_manager_id;
        $employee->salary                   =   $request->salary;
        $employee->dob                      =   $request->dob;
        $employee->phone                    =   $request->phone;
        $employee->address                  =   $request->address;
        $employee->gender                   =   $request->gender;
        $employee->employment_type          =   $request->employment_type;
        $employee->joining_date             =   $request->joining_date;
        $employee->emergency_contact_name   =   $request->emergency_contact_name;
        $employee->emergency_contact_number =   $request->emergency_contact_number;
        $employee->save();

        $data['message']        =   auth()->user()->name . " has created '$user->name' account";
        $data['action']         =   "created";
        $data['module']         =   "employee";
        $data['object']         =   $employee;
        saveLogs($data);
        Session::flash("success", "Employee Account Created");

        return redirect(route("cms.employee.index"));
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
        $data['object']         =   Employee::find($id);
        if (empty($data['object'])) {
            Session::flash("error", "Employee Already Deleted");
            return back();
        }
        $data['method']         =   'PUT';
        $data['url']            =   route('cms.employee.update',['employee'=>$id]);
        $data['designations']   =   Designation::pluck("name","id")->toArray();
        $data['employees']      =   Employee::with('user')->get();

        return view('cms.employee.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
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
