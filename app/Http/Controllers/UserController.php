<?php
  
namespace App\Http\Controllers;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }
    
    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    
    /**
     * Display the current user.
     *
     * @return Response
     */
    public function profile()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->birth_date = $request->input('birth_date');
        $user->about_me = $request->input('about_me');
        $user->interests = $request->input('interests');
        $user->confirmed = false;

        try {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'Couldnt create token'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $user->save();

        return response()->json($user)->header('Authorization', 'Bearer: ' . $token);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        if ($user->save()) {
            return response()->json(['msg' => 'Success'], 200);
        } else {
            return response()->json(['error' => 'Invalid data'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!$user = User::find($id)) {
            return response()->json(['error' => 'No such user'], 400);
        }
        $user->delete();
        return response()->json(['msg' => 'Success'], 200);
    }
}
