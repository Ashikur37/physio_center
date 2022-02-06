<?php

namespace App\Http\Controllers;

use App\Models\AppoinmentPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\AppointmentTherapy;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\PatientProfile;
use App\Models\Payment;
use App\Models\Refer;
use App\Models\Therapy;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('sender_id', Auth::user()->id)->orwhere('receiver_id', Auth::user()->id)->latest()->get();
        return view('conversation.index', compact('conversations'));
    }
    public function chat(Conversation $conversation)
    {
        return view('conversation.chat', compact('conversation'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'patient')->get();
        return view('conversation.create', compact('users'));
    }
    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        $conversation = Conversation::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id);
        })->Where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
        })->first();
        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->sender_id = Auth::user()->id;
            $conversation->receiver_id = $user->id;
            $conversation->save();
        }
        ConversationMessage::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::user()->id,
            'message' => $request->message,
        ]);
        return redirect()->route('conversation.chat', $conversation->id);
    }
}
