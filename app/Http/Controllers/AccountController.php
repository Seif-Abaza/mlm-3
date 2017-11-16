<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Share;
use App\Earning;
use App\NewsLetter;
use App\Message;
use App\Http\Controllers\MembersController;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['subscribe', 'sendMessage']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id > 0 && auth()->user()->role_id < 4){
            return redirect('nella');
        }elseif (auth()->user()->role_id != 4){
            return redirect('/');
        }else{
            $member = Member::find(auth()->user()->member_id);
            $member->balance = MembersController::getMemberBalance($member->id);
            $first_share = Share::where('owner', $member->id)->first();
            $earnings = Earning::where('dest', $first_share->uuid)->get();
            return view('member.index')->with([
                'member' => $member,
                'earnings' => $earnings,
            ]);
        }
    }

    public function subscribe(Request $request){
        $this->validate($request, ['Email' => 'required',]);
        $sub = new NewsLetter;
        $old = NewsLetter::where('email', $request->input('Email'))->first();
        if ($old == null){
            $sub->email = $request->input('Email');
            $sub->country_id = $request->input('Country');
            $sub->created_at = date('Y-m-d H:i:s');
            $sub->save();
        }
        return redirect('/');
    }

    public function sendMessage (Request $request){
        $this->validate($request, ['Name' => 'required','Email' => 'required','Message' => 'required',]);
        $msg = new Message;
        $msg->name = $request->input('Name');
        $msg->email = $request->input('Email');
        $msg->country_id = $request->input('Country');
        $msg->message = $request->input('Message');
        $msg->created_at = date('Y-m-d H:i:s');
        $msg->save();
        return redirect('/');
    }

    public function getDownloads($member_id){
        $team = array();
        $sub_teams =  Member::where('upline', $member_id)->get();
        foreach ($sub_teams as $sub_team){
            array_push($team, $sub_team);
        }
        return $team;
    }
}
