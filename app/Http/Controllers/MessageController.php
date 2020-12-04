<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Artisan;


class MessageController extends Controller
{
    public function view(){
        dd($request->user()->id);
    }
    public function send(Request $request){
        $this->validate($request, [
            'to' => 'required',
            'message' => 'required'
        ]);
        if ($request->user()->id == $request->to){
            return ['Cannot send message to self!'];
        }
        // Cari dulu conversation/percakapan mana yang mau ditambahkan. Kalau tidak ada, baru ditambahkan Conversation baru
        $conversation_exist=Conversation::where([
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->to
        ])->orWhere([
            'receiver_id' => $request->user()->id,
            'sender_id' => $request->to
        ])->first();
        if (is_null($conversation_exist)){
            $conversation_exist=Conversation::create([
                'sender_id' => $request->user()->id,
                'receiver_id' => $request->to
            ]);
        }
        if ($conversation_exist->sender_id == $request->user()->id){
            //Si pengirim pesan pertama / The first Sender
            $is_sender = 1;
        }else {
            //Si pembalas / The replier
            $is_sender = 0;
        }
        $message = Message::create([
            'conversation_id' => $conversation_exist->id,
            'sender_sent' => $is_sender,
            'message' => $request->message,
        ]);
        return 'Message sent!';
    }
    public function conversation(Request $request){
        $conv_list = Conversation::where('sender_id',$request->user()->id)
                    ->orWhere('receiver_id',$request->user()->id)->get();
        $result=[];
        foreach ($conv_list as $each){
            // User sender
            $search_name_sender = User::where('id',$each->sender_id)->first()->username;
            // User Receiver
            $search_name_receiver = User::where('id',$each->receiver_id)->first()->username;
            
            // Output sentence
            $sentence = 'ID : '.$each->id.' | '.$search_name_sender . ' to ' . $search_name_receiver;
            array_push($result,$sentence);
         
        }
        return $result;
    }

    public function detail_conversation(Request $request){
        $conversation_found = Conversation::where('id',$request->id);
        if (is_null($conversation_found->first())){
            return 'Not found';
        }
        $conv_list = $conversation_found->where('sender_id',$request->user()->id)
                    ->orWhere('receiver_id',$request->user()->id);
        // dd(is_null($conv_list));
        if (is_null($conv_list->first())){
            return 'Not allowed';
        }
        $conv_id = $conv_list->first()->id;
        $messages = [];
        $message_found = Message::where('conversation_id',$conv_id)->get()->sortByDesc("created_at");

        return $message_found;
    }
}
