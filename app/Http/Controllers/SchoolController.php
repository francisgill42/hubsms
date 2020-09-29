<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use Validator;

class SchoolController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return School::orderBy('id','DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'isApproved' => 'required',
            'grade_offered'=> 'required',
            'school_name'=> 'required',
            'school_logo' => 'required',
            'school_branch'=> 'required',
            'education_type'=> 'required',
            'phone'=> 'required',
            'address'=> 'required',
            'country'=> 'required',
        ]); 
		if ($validator->fails()) { 

			return response()->json([ 'success' => false, 'errors' => $validator->errors() ]); 
        }
        
        $arr = [ 
            'isApproved' => $request->isApproved,
            'grades_offered' => $request->grade_offered,
            'school_name' => $request->school_name,
            'school_logo' => 'test',
            'school_branch' => $request->school_branch,
            'education_type' => $request->education_type,
            'center_number' => $request->center_number,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'area' => $request->area,
            'town' => $request->town,
            'province' => $request->province,
            'country' => $request->country,
            'user_id' => $request->user_id
        ];

        $created = School::create($arr);
        if ($created) {
            return response()->json([ 'success' => true, 'data' => $created ],200); 
        } else {
            return response()->json([ 'success' => false, 'data' => '' ],200); 
        }
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return School::find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [ 
            'isApproved' => 'required',
            'grade_offered'=> 'required',
            'school_name'=> 'required',
            'school_logo' => 'required',
            'school_branch'=> 'required',
            'education_type'=> 'required',
            'phone'=> 'required',
            'address'=> 'required',
            'country'=> 'required',
            ]); 

		if ($validator->fails()) { 

			return response()->json([ 'success' => false, 'errors' => $validator->errors() ]); 
        }
        $arr = [ 
            'isApproved' => $request->isApproved,
            'grades_offered' => $request->grade_offered,
            'school_name' => $request->school_name,
            'school_logo' => 'test',
            'school_branch' => $request->school_branch,
            'education_type' => $request->education_type,
            'center_number' => $request->center_number,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'area' => $request->area,
            'town' => $request->town,
            'province' => $request->province,
            'country' => $request->country,
            'user_id' => $request->user_id
        ];

        $updated = School::where('id', $id)->update($arr); 

        if ($updated) {
            $record = School::find($id);

            return response()->json([ 'success' => true, 'data' => $record ],200); 

        } else {
            return response()->json([ 'success' => true, 'data' => '' ],200); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (School::find($id)->delete()) 
                ? [ 'response_status' => true, 'message' => 'Record has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'Record cannot delete' ];
    }
}
