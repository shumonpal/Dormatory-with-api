<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Company\Company as CompanyResource;
use App\Http\Resources\Company\CompanyCollection;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompanyCollection::collection(Company::CompanyByUser()->paginate(5));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $validate = Validator::make($request->all(), $this->rules($id = null));
        if ($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors()
            ]);
        }
        $data = $validate->validated();
        $data['user_id'] = auth()->user()->id;
        $company = Company::create($data);
        return new CompanyResource($company);
    }

    public function rules($id)
    {
        return [
            'name' => 'required|max:50',
            'regi_no' => 'required|max:30',
            'address' => 'required|max:60',
            'email' => ['required', 'email', 'max:50', "unique:companies,email,$id"],
            // 'email' => ['required', 'email', 'max:50', Rule::unique('companies')->ignore('id', $request->id)],
            'phone' => 'required|max:40',
            'others' => 'nullable',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validate = Validator::make($request->all(), $this->rules($company->id));
        if ($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors()
            ]);
        }
        $data = $validate->validated();

        $company->update($data);
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json([
            "message" => "Data has been deleted"
        ]);
    }
}
