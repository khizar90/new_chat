<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\Message;

class ChatsController extends Controller
{
    // app/Http/Controllers/ChatsController.php



    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

   

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
    
        try {
            $user = Auth::user();
    
            $message = $user->messages()->create([
                'message' => $request->input('message')
            ]);
    
            broadcast(new MessageSent($user, $message))->toOthers();
    
            return ['status' => 'Message Sent!'];
        } catch (\Exception $e) {
            return ['status' => 'Message could not be sent!', 'error' => $e->getMessage()];
        }


       
    }
}

// // app/Http/Controllers/ChatsController.php

// //remember to use
// use App\Events\MessageSent;

// /**
//  * Persist message to database
//  *
//  * @param  Request $request
//  * @return Response
//  */
// public function sendMessage(Request $request)
// {
//   $user = Auth::user();

//   $message = $user->messages()->create([
//     'message' => $request->input('message')
//   ]);

//   broadcast(new MessageSent($user, $message))->toOthers();

//   return ['status' => 'Message Sent!'];
// }
