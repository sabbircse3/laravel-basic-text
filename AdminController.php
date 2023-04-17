<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Http\Requests;
use DB;
use Session;

class AdminController extends Controller
{
	//Route funcrion start
    public function userReg()
    {
        return view('user-reg');
    }
	//Route funcrion end

    public function saveUser(Request $request)
    {

        // Start of validation
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        // End of validation


        // Start of collecting data from html form
        $email = trim($request->email);
        $password = trim($request->password);
        // End of collecting data from html form


        // Start of checking duplicate data
        $count = DB::table('user')->where('email',$email)->count();
        if($count > 0){
            Session::put('failed','Sorry, the email address already exist !!');
            return Redirect::to('user-reg');
        }
        // End of checking duplicate data


        // Start of data insertion
        $data = array();
        $data['email']  = $email;
        $data['password']  = $password;
        $query = DB::table('user')->insert($data);
        // End of data insertion
		
		
		//alart start
        if($query){
            Session::put('success','user data successfully saved');
            return Redirect::to('user-reg');
        }else{
            Session::put('failed','Alas! we are undone !!');
            return Redirect::to('user-reg');
        }
		//alart end 
    }
	

    // view function query start 
    public function userList()
    {
        $users = DB::table('user')->get();
        return view('user-list')->with('users',$users);
    }
	// view function query end


    // edit user data query  start
    public function editUser($id)
    {
        $user = DB::table('user')->where('id',$id)->first();
        return view('edit-user')->with('user',$user)->with('id',$id);
    }
	// edit user data query  end
	
	
    public function updateUser(Request $request)
    {
        // Start of validation
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        // End of validation


        // Start of collecting data from html form
        $email = trim($request->email);
        $password = trim($request->password);
        $id = trim($request->id);
        // End of collecting data from html form



        // Start of checking duplicate data
        $count = DB::table('user')->where('email',$email)->whereNotIn('id',[$id])->count();

        if($count > 0){
            Session::put('failed','Sorry, the email address already exist !!');
            return Redirect::to('user-reg');
        }
        // End of checking duplicate data


        // Start of data insertion
        $data = array();
        $data['email']  = $email;
        $data['password']  = $password;
        $query = DB::table('user')->where('id',$id)->update($data);
        // End of data insertion


		//alart start
        if($query){
            Session::put('success','user data successfully updated');
            return Redirect::to('edit-user/'.$id);
        }else{
            Session::put('failed','Alas! we are undone !!');
            return Redirect::to('edit-user/'.$id);
        }
		//alart end
    }

    public function deleteUser($id)
    {
		 //start delete quary
        $query = DB::table('user')->where('id',$id)->delete();
		//end delete quary


		//alart start
        if($query){
            Session::put('success','user successfully deleted !!');
            return Redirect::to('user-list');
        }else{
            Session::put('failed','user not deleted !!');
            return Redirect::to('user-list');
        }
		//alart end
    }

}
