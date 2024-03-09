<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Mail\SendEmail;
use App\Models\Message;
use App\Models\User;
use Faker\Extension\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:messages|message create|message update|message delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:message create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:message update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:message delete'], ['only' => ['destroy']]);
    }



    public function index()
    {
        $data=Message::all();
        return view('messages.messages',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::all();
       return view('messages.create',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]
        );
        $message_create['title']=$request->title;
        $message_create['body']=$request->body;
        $message_create['user_id']=Auth::user()->id;
        $message_create['created_at']=date('Y/m/d H:m:s');

        // save file in database
        if($request->has('file')){
        $file=$request->file;
        $extension=strtolower($file->getClientOriginalExtension());
        $file_name=time().rand(1,10000).".".$extension;
        $file->move((public_path('uploads')),$file_name);
        $message_create['file']=$file_name;
        }
        $message_id=Message::create($message_create);
        $users=$request->send_to==NULL?User::get()->pluck('email'):$request->send_to;
        $message = Message::findOrFail($message_id->id);
        SendMailJob::dispatch($users,$message,$file_name);
        return redirect(route('message.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
