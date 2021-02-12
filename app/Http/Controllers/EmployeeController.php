<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
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
    public function index(Request $request)
    {
        $employees = Employees::all();
        $companies = Companies::all();



        return view('modules.employees.index', compact(
            'employees',
            'companies'
        ));
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

        // ->filter(function ($query) {
        //     if (request()->has('firstname')) {
        //         $query->where('firstname', 'like', "%" . request('firstname') . "%");
        //     }
        //     if (request()->has('lastname')) {
        //         $query->where('lastname', 'like', "%" . request('lastname') . "%");
        //     }
        //     if (request()->has('company')) {
        //         $query->where('company', 'like', "%" . request('company') . "%");
        //     }

        //     if (request()->has('startdate')) {
        //         $query->where('created_at', 'like', "%" . request('startdate') . "%");
        //     }
        //     if (request()->has('enddate')) {
        //         $query->where('created_at', 'like', "%" . request('enddate') . "%");
        //     }

        //     if (request()->has('email')) {
        //         $query->where('email', 'like', "%" . request('email') . "%");
        //     }
        // }, true)
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

    public function getCustomFilterData(Request $request)
    {
        $users = Employees::select(['id', 'firstname','lastname', 'email','company', 'created_at', 'updated_at'])->get();

        return Datatables::of($users)
            ->filter(function ($instance) use ($request) {
                if ($request->has('firstname')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['firstname'], $request->get('fisrtname')) ? true : false;
                    });
                }
                if ($request->has('lastname')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['lastname'], $request->get('lastname')) ? true : false;
                    });
                }

                if ($request->has('company')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['company'], $request->get('company')) ? true : false;
                    });
                }

                if ($request->has('email')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['email'], $request->get('email')) ? true : false;
                    });
                }
            })
            ->make(true);
    }





}
