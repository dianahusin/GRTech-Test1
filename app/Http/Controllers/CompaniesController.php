<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompaniesController extends Controller
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
        $companies = Companies::all();
        return view('modules.companies.index',compact('companies'));
    }

    public function getCompanyData()
    {
        $companies = Companies::select('companies.*');

        return DataTables::eloquent($companies)
        ->addIndexColumn()
        ->addColumn('index', function($company){
            return $company->count();
        })
        ->addColumn('action', function($company){
          return '<button class="btn btn-sm btn-primary mb-3" data-toggle="modal"
            data-target="#update-'. $company->id .'">Update</button> &nbsp;'
            .
            '<form action="'.route('companies.delete', $company->id).'" method="POST" >
            '.csrf_field().'
            '.method_field("DELETE").'
            <button class="btn btn-sm btn-danger mb-3 btn-submit" onclick="return confirm(\'Are You Sure?\')">Delete</button>
            </form>';
        })
        ->editColumn('logo', function($company){

            $url= asset('storage/'.$company->logo);
            return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->editColumn('website', function($company){

            return '<a href="'.$company->website.'" target="_blank">'.$company->website.'</a>';
        })
        ->rawColumns(['action','logo','website'])
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
            'name' => 'required',
            'email' => 'nullable|email|unique:companies,email',
            'website' => 'nullable',
        ]);

        $company = new Companies;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');

        if ($request->file('logo')) {
            $logoFileName = $request->file('logo')->getClientOriginalName() ;
            $path = $request->file('logo')->storeAs('public', $logoFileName);

            $company->logo = $logoFileName;
        }
        $company->save();

        return redirect()->back()->with('success', 'Information Succesfully Added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $company)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $company->name = $request->input('name');
        $company->website = $request->input('website');

        if ($request->file('logo')) {
            $logoFileName = $request->file('logo')->getClientOriginalName() ;
            $path = $request->file('logo')->storeAs('public', $logoFileName);

            $company->logo = $logoFileName;
        }
        $company->save();

        return redirect()->back()->with('success', 'Information Succesfully Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $company)
    {
        $company->delete();
        return redirect()->back()->with('success', 'Information Succesfully Delete');
    }


}
