<?php

namespace App\Http\Controllers;

use App\Mail\InvitationDeclineEmail;
use App\Models\InvitationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvitationDetailController extends Controller
{
    public function index($token)
    {
        $isTokenExist = InvitationDetail::where('token', $token)->exists();
        if ($isTokenExist) {
            return view('notes.invite-view', ['token' => $token]);
        } else {
            return back();
        }
    }

    public function invitationReject($token)
    {
        $DeclineInvitationUserDetail = InvitationDetail::where('token', $token)->first();
        $DeclineInvitationUserDetail->update([
            'status' => 1,
            'token' => null,
        ]);
        $invitationDeclineUserEmail = $DeclineInvitationUserDetail->email;
        Mail::to($DeclineInvitationUserDetail->getUser->email)->send(new InvitationDeclineEmail($invitationDeclineUserEmail));
        return redirect('register');
    }

    public function invitationAccept($token)
    {
        $AcceptInvitationUserDetail = InvitationDetail::where('token', $token)->first();
        $AcceptInvitationUserDetail->update([
            'status' => 2,
            'token' => null,
        ]);

        return redirect('register');
    }
}
