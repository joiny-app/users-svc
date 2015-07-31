<?php
  
namespace App\Http\Controllers;

use App\User;
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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $password = Hash::make($request->input('password'));
        $user->login = $request->input('login');
        $user->email = $request->input('email');
        $user->confirmed = false;
        $user->password = $password;
        $token = md5($request->input('email').time());
        $confirm = new AccountConfirmation;
        $confirm->token = $token;
        $confirm->email = $request->input('email');
        $host = $_ENV['USER_SVC_UI_SVC_URL'];
        $link = $host.'/#/confirm?token='.$token;
        $message = [
            'to'      => $request->input('email'),
            'subject' => 'Registration to acn-bootcamp.com',
            'body'    => 'Dear '.$request->input('login').
                         ', your registration at acn.bootcamp.com was successful!
                          to confirm your account click on the following link:
                          '.$link,
        ];
        $client = SqsClient::factory([
                'key'    => $_ENV['USER_SVC_AWS_ACCESS_KEY'],
                'secret' => $_ENV['USER_SVC_AWS_SECRET_KEY'],
                'region' => $_ENV['USER_SVC_AWS_REGION'],
            ]);
        try {
            $client->sendMessage([
                'QueueUrl'    => $_ENV['USER_SVC_AWS_EMAIL_QUEUE_URL'],
                'MessageBody' => json_encode($message),
            ]);
        } catch (Exception $e) {
            return response(['error' => 'Confirmation message send failed!'], 503);
        }
        $user->save();
        $confirm->save();
        error_log(json_encode($message));
        return $user;

        
        // $user = User::create($request->all());

        // return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {
        $user  = user::find($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->save();
 
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('success');
    }
}
