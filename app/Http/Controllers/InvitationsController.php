<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvitationRequest;
use App\Invitation;
use App\Shop;
use Illuminate\Http\Request;
use App\Notifications\Invitation as InvitationNotification;
use Illuminate\Support\Facades\Notification;

class InvitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::where('registered_at', null)->orderBy('created_at', 'desc')->get();
        return view('invitations.index', compact('invitations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvitationRequest $request)
    {
        $invitation = new Invitation();
        $invitation->email = $request->email;
        if($request->shop){
        $shop = Shop::where('name',$request->shop)->firstOrFail();
        $invitation->shopId = $shop->id;
        }
        $invitation->generateInvitationToken();
        $invitation->save();

        Notification::route('mail',$invitation->email)
        ->notify(new InvitationNotification($invitation->invitation_token));


        return redirect()->route('requestInvitation')
            ->with('success', "L'invitation a été soumise avec succés.");
    }
}
