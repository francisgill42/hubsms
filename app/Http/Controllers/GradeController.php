<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;
use Validator;

class GradeController extends Controller
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
        return Grade::orderBy('id','DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'grade' => 'required' ]); 
		if ($validator->fails()) { 

			return response()->json([ 'success' => false, 'errors' => $validator->errors() ]); 
        }
        
        $arr = [ 'grade' => $request->grade ];

        $created = Grade::create($arr);
        if ($created) {
            return response()->json([ 'success' => true, 'data' => $created ],200); 
        } else {
            return response()->json([ 'success' => false, 'data' => '' ],200); 
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ 'grade' => 'required' ]); 

		if ($validator->fails()) { 

			return response()->json([ 'success' => false, 'errors' => $validator->errors() ]); 
        }
        $arr = [ 'grade' => $request->grade ];

        $updated = Grade::where('id', $id)->update($arr); 

        if ($updated) {
            $record = Grade::find($id);

            return response()->json([ 'success' => true, 'data' => $record ],200); 

        } else {
            return response()->json([ 'success' => true, 'data' => '' ],200); 
        }
    }

    public function show($id)
    {
        return Grade::find($id);
    }
    public function destroy($id)
    {
        return (Grade::find($id)->delete()) 
                ? [ 'response_status' => true, 'message' => 'Record has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'Record cannot delete' ];
    }
}
