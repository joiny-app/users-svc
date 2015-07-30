<?php
  
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
  
  
class UserController extends Controller{
  
  
    public function index()
    {
        
        $user = User::all();

        return response()->json($user);

    }
    
    public function show($id){

        $user = User::find($id);

        return response()->json($user);

    }

    public function store(Request $request)
    {

        $user = User::create($request->all());

        return response()->json($user);

    }

    public function update(Request $request, $id)
    {
        
        $user  = user::find($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->save();
 
        return response()->json($user);

    }
  
    public function destroy($id)
    {

        $user = User::find($id);

        $user->delete();

        return response()->json('success');
    }

}