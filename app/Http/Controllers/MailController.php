<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Mail\Email;
use App\Models\InvitationDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function create()
    {
        $collegues = InvitationDetail::where('user_id', Auth::user()->id)->get();
        return view('email.mail', ['collegues' => $collegues]);
    }

    public function store(EmailRequest $request)
    {
        $currentUser = Auth::user();
        $isEmailExist = InvitationDetail::where([
            'email' => $request->email, 'status' => 0, 'user_id' => $currentUser->id
        ])->exists();

        if ($currentUser->invitation_count < 2) {
            if ($isEmailExist == false) {
                User::find($currentUser->id)->increment('invitation_count');
                $createInvitation = InvitationDetail::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'user_id' => $currentUser->id,
                        'token' => Str::random(20)
                    ]
                );
                Mail::to($request->email)->send(new Email($createInvitation->token));
                return back();
            } else {
                return redirect()->back()->with('error', 'You have already sent email to this user');
            }
        }
        return redirect()->back()->with('error', 'You have already sent 2 invitations');
    }

    public function show()
    {
        return view('email.email-page');
    }

}
