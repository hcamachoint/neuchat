<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Events\ChatMessage;
use App\Models\Message;
use App\Models\User;
use Session;
use Redirect;
use DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chatPage()
    {
        $users = User::all();
        return view('chat',['users'=> $users]);
    }

    public function messageget($userId)
    {
      $authUserId = auth()->user()->id;
      $output = DB::table('messages')
        ->leftJoin('users','users.id',  '=',  'messages.user_id')
        ->join('receivers','receivers.message_id','=','messages.id')
        ->where('messages.user_id','=',$authUserId)
        ->where('receivers.user_id','=',$userId)
        ->orWhere('messages.user_id','=',$userId)
        ->where('receivers.user_id','=',$authUserId)
        ->select('users.name as user', 'users.image','users.image_path','users.id as userId','messages.message','messages.file_path','messages.file_name','messages.type','messages.created_at as time','receivers.user_id as r_user_id')
        ->orderBy("messages.id","asc")
        ->get();
      return $output;
    }

    public function messagepost($userId)
    {
      $user = auth()->user();
      $message = $user->messages()->create([
        'message'=>request()->get('message'),
        'type'=>request()->get('type'),
      ]);

      $message->receivers()->create([
          'user_id'=>$userId
        ]);
      // // new message has beed posted
      try {
        broadcast(new ChatMessage($message,$user,$userId))->toOthers();
      } catch (Exception $e) {
        echo "string";
      }

      $output['message'] = $message;
      $output['user'] = $user;
      return ['output'=> $output];
    }

    public function messagefile(Request $request, $userId)
    {
      $file = $request->file('file');
      $user = auth()->user();
      if (!empty($file)){
        $fileName = $file->getClientOriginalName();
        // file with path
        $filePath = url('uploads/chats/'.$fileName);
        //Move Uploaded File
        $destinationPath = 'uploads/chats';
        if($file->move($destinationPath,$fileName)) {
            $msg['file_path'] = $filePath;
            $msg['file_name'] = $fileName;
            $msg['message'] = 'file';
            $msg['type'] = request('type');
        }

        $message = $user->messages()->create($msg);

        $message->receivers()->create([
          'user_id'=>$userId
        ]);

        $output = [];
        broadcast(new ChatMessage($message,$user,$userId))->toOthers();

        $output['message'] = $message;
        $output['user'] = $user;
        return ['output'=> $output];
      }
    }






    public function index()
    {
        return view('messages.view');
    }

    public function getUserNotifications(Request $request)
    {
      $notifications =  Message::where('read', 0)
                        ->where('receiver_id', $request->user()->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
      return response(['data' => $notifications], 200);
    }

    public function getMessages(Request $request)
    {
      $ms = Message::where('receiver_id', $request->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

      return response(['data' => $ms], 200);
    }

    public function getMessageById(Request $request)
    {
      $ms = Message::where('id', $request->input('id'))->first();
      //SI MENSAJE NO ESTA LEIDO, CAMBIAL EL ESTATUS
      if($ms->read == 0){
        $ms->read = 1;
        $ms->save();
      }

      return response(['data'  => $ms], 200);
    }

    public function getMessageSent(Request $request)
    {
      $ms = Message::where('sender_id', $request->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

      return response(['data' => $ms], 200);
    }

    public function sendMessage(Request $request)
    {
      $attributes = [
        'sender_id' => $request->input('sender_id'),
        'receiver_id' => $request->input('receiver_id'),
        'subject' => $request->input('subject'),
        'message' => $request->input('message'),
        'read' => 0,
      ];

      $ms = Message::create($attributes);
      $data = Message::where('id', $ms->id)->first();
      return response(['data' => $data], 201);
    }
}
