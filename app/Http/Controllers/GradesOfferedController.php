<?php

namespace App\Http\Controllers;

use App\GradesOffered;
use Illuminate\Http\Request;
use Validator;

class GradesOfferedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GradesOffered::orderBy('id','DESC')->get();
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'grade_offered' => 'required' ]); 
		if ($validator->fails()) { 

			return response()->json([ 'success' => false, 'errors' => $validator->errors() ]); 
        }
        
        $arr = [ 'grade_offered' => $request->grade_offered ];

        $created = GradesOffered::create($arr);
        if ($created) {
            return response()->json([ 'success' => true, 'data' => $created ],200); 
        } else {
            return response()->json([ 'success' => false, 'data' => '' ],200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GradesOffered  $gradesOffered
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return GradesOffered::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GradesOffered  $gradesOffered
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ 'grade_offered' => 'required' ]); 

		if ($validator->fails()) { 

			return response()->json([ 'success' => false, 'errors' => $validator->errors() ]); 
        }
        $arr = [ 'grade_offered' => $request->grade_offered ];

        $updated = GradesOffered::where('id', $id)->update($arr); 

        if ($updated) {
            $record = GradesOffered::find($id);

            return response()->json([ 'success' => true, 'data' => $record ],200); 

        } else {
            return response()->json([ 'success' => true, 'data' => '' ],200); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GradesOffered  $gradesOffered
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (GradesOffered::find($id)->delete()) 
                ? [ 'response_status' => true, 'message' => 'Record has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'Record cannot delete' ];
    }
}
