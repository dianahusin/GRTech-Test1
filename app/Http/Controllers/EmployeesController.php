<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::all();
        $companies = Companies::all();
        return view('modules.employees.index', compact('employees', 'companies'));
    }

    public function getEmployeeData()
    {
        $employees = Employees::select('employees.*');

        return DataTables::eloquent($employees)
        ->addIndexColumn()
        ->addColumn('action', function ($employee) {
            return '<button class="btn btn-sm btn-primary mb-3" data-toggle="modal"
            data-target="#update-'. $employee->id .'">Update</button>'
            .
            '<form action="'.route('employees.delete', $employee->id).'" method="POST" >
            '.csrf_field().'
            '.method_field("DELETE").'
            <button class="btn btn-sm btn-danger mb-3 btn-submit"  onclick="return confirm(\'Are You Sure?\')">Delete</button>
            </form>';


        })
        ->editColumn('company', function($employee){
            return $employee->companyName->name;
        })
        ->addColumn('fullname', function ($employee) {
            $employee->setFullName($employee->firstname, $employee->lastname);
            return $employee->fullname;
        })
        ->rawColumns(['action', 'fullname', 'company'])
       ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'nullable|email|unique:employees,email',
            'phone'     => 'nullable',
        ]);

        $employee            = new Employees;
        $employee->firstname = $request->input('firstname');
        $employee->lastname  = $request->input('lastname');
        $employee->company   = $request->input('company');
        $employee->email     = $request->input('email');
        $employee->phone     = $request->input('phone');

        $employee->save();

        return redirect()->back()->with('success', 'Information Succesfully Added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employees $employee)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
        ]);

        $employee->firstname    = $request->input('firstname');
        $employee->lastname     = $request->input('lastname');
        $employee->company      = $request->input('company');
        $employee->phone        = $request->input('phone');

        $employee->save();

        return redirect()->back()->with('success', 'Information Succesfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(employees $employee)
    {
        $employee->delete();
        return redirect()->back()->with('success', 'Information Succesfully Delete');
    }

  
}
