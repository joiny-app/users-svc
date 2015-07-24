<?php
  
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
  
  
class UserController extends Controller{
  
  
    public function show($id){

        $User = User::find($id);

        return response()->json($User);

    }
  
}