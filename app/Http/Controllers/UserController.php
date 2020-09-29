<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
	}
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        foreach($users as $user){
            $user->role =  $user->role;
        }     
        
        return response()->json([ 'success' => true,'data' => $users] ,200);
    }

  
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
           
            'abc' => 'required',
            
            'role_id' => 'required',
            'first_name' => 'required', 
            'last_name' => 'required', 
			'email' => 'required|email|unique:users',
			
			'mobile_no' => 'required|unique:users',
		]); 
		if ($validator->fails()) { 
			return response()->json(['success' => false, 'errors' => $validator->errors() ]); 
        }
        
        $arr = [
            'role_id' => $request->role_id, 
            'master' => 0, 
            'email' => $request->email, 
            'password' => bcrypt($request->pwd), 
            'first_name' => $request->first_name, 
            'middle_name' => $request->middle_name, 
            'last_name' => $request->last_name,   
            'mobile_no' => $request->mobile_no, 
            'isActive' => $request->isActive, 
            'photo' => $request->photo
        ];

        $created = User::create($arr);
       
        if($created){
            
            $created->user = $created->user;
            $created->role = $created->role;
            return response()->json(['success' => true, 'data' => $created]);
        }
        else{
            return response()->json(['success' => false,'data' => '']);
        }
        
    }


    public function update(Request $request, $id)
    {
        $arr = [
            'role_id' => $request->role_id, 
            'master' => 0, 
            'email' => $request->email, 
            'first_name' => $request->first_name, 
            'middle_name' => $request->middle_name, 
            'last_name' => $request->last_name,   
            'mobile_no' => $request->mobile_no, 
            'isActive' => $request->isActive,
            'photo' => $request->photo
        ];

        $updated = User::where('id',$id)->update($arr);
       
        if($updated){

            $user = User::find($id);
            
            $user->user = $user->user;
            $user->role = $user->role;
            $user->status = $user->status;

            return response()->json(['success' => true, 'data' => $user]);
        }
        else{
            return response()->json(['success' => false,'data' => '']);
        }
    }

    public function change_password(Request $request,$id)
    {
        $response = false;
        $update = User::where('id', $id)->update(['password' => bcrypt($request->change_password)]);
        $response = ($update) ?  true : false ;
        return response()->json(['success' => $response] );
    }

    public function admins()
    {
        $data = User::where('master',1)->where('id','!=',1)->orWhere('role_id',7)->get();
        return response()->json(['success' => true,'data' => $data]);
    }

   public function user_2be_assigned($id,$master,$role_id)
   {
        $data = [];

        if($master){
            $data = User::where('id','!=',$id)->where('master',1)
            ->where('role_id',1)
            ->where('role_id',2)
            ->where('role_id',3)
            ->where('role_id',4)
            ->get();
        }
        else{
           if($role_id == 1){
            $data = User::where('master',0)
            ->where('role_id','!=',1)
            ->where('role_id',2)
            ->orWhere('role_id',3)
            ->orWhere('role_id',4)
            ->get();
           }
           else if($role_id == 2){
            $data = User::where('id','!=',$id)->where('role_id',2)->orWhere('role_id',3)->orWhere('role_id',4)->get();
           }
           else if($role_id == 3){
            $data = User::where('role_id',4)->get();
           }
        }

       return response()->json(['success' => true,'data' => $data]);

   } 
   
    public function destroy($id)
    {
        return (User::find($id)->delete()) 
                ? [ 'response_status' => true, 'message' => 'user has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'user cannot delete' ];
    }
}
