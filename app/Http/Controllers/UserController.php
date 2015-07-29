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
  
}