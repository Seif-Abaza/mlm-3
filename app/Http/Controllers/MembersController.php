<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Share;
use App\Country;
use App\Earning;
use App\Http\Controllers\AccountController;
use DateTime;
use App\Http\Controllers\SharesController;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(date('Y', strtotime('next year')));
        if (auth()->user()->role_id > 3 ||  auth()->user()->role_id < 1){
            return redirect('/');
        }
        $members = Member::orderBy('created_at', 'asc')->get();
        $final_members = array();
        //calculate balance
        foreach ($members as $member){
            $member->balance = $this->getMemberBalance($member->id);
            array_push($final_members, $member);
        }

        return view('nella.members.index')->with('members', $final_members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role_id > 3 ||  auth()->user()->role_id < 1){
            return redirect('/');
        }
        $countries = Country::orderBy('name', 'asc')->get();
        $members = Member::orderBy('created_at', 'desc')->get();
        return view('nella.members.create')->with([
            'countries' => $countries,
            'members' => $members
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role_id > 3 ||  auth()->user()->role_id < 1){
            return redirect('/');
        }
        //check if upline shares are above 14
        //get upline member's number of shares
        $upline1 = Member::find($request->input('upline'));
        if ($upline1->shares > 14){
            return redirect('/nella/members')->with('error', 'Upline has more than 14 shares!');
        }

        $this->validate($request, [
            'sir_name' => 'required',
            'first_name' => 'required',
            'country' => 'required',
            /*'postal_address' => 'required',
            'physical_address' => 'required',*/
            'phone' => 'required',
            /*'alt_phone' => 'required',
            'id_no' => 'required',
            'id_nin' => 'required',
            'passport' => 'required',
            'email' => 'required',*/
            /*'dob' => 'required',
            'neolife_id' => 'required',*/
            'sponsor' => 'required',
            'upline' => 'required',
            'shares' => 'required',
            'paid_at' => 'required',
            /*'amount' => 'required',
            'nok' => 'required',
            'nok_phone' => 'required',
            'nok_email' => 'required',*/
        ]);

        //check that both amount and amount_inst are not entered at once
        if (!empty($request->input('amount')) && !empty($request->input('amount_inst'))){
            return redirect('/nella/members')->with('error', 'You can\'t  enter both full pay and installments! Only fill one field');
        }elseif (!empty($request->input('amount'))){
            $amount_paid = $request->input('amount');
        }elseif (!empty($request->input('amount_inst'))){
            $amount_paid = $request->input('amount_inst');
        }else{
            $amount_paid = null;
        }

        //make sure 7 share holders must pay in full.
        if ($request->input('shares') == 7 && empty($request->input('amount'))){
            return redirect('/nella/members')->with('error', '7 Shares MUST be fully paid and not in installments.');
        }
        //date object for pay date
        $pay_date = DateTime::createFromFormat('d/m/Y', $request->input('paid_at'));

        //sanity check
        //check if all upline's direct down slots have been taken.
        $upline = Member::find($request->input('upline'));
        $u_share = Share::where('owner', $request->input('upline'))->first();
        if ($upline->shares == 1 || $upline->shares == 2){
            if(Share::where('uuid', $u_share->uuid.'L')->count() > 0
                && Share::where('uuid', $u_share->uuid.'R')->count() > 0){
                return redirect('/nella/members')->with('error', 'This upline can\'t have this member directly under them!');
            }
        }elseif ($upline->shares >= 3 && $upline->shares <= 6){
            if(Share::where('uuid', $u_share->uuid.'LL')->count() > 0
                && Share::where('uuid', $u_share->uuid.'RR')->count() > 0
                && Share::where('uuid', $u_share->uuid.'RL')->count() > 0
                && Share::where('uuid', $u_share->uuid.'LR')->count() > 0
            ){
                return redirect('/nella/members')->with('error', 'This upline can\'t have this member directly under them!');
            }
        }elseif ($upline->shares >= 7 && $upline->shares <= 14){
            if(Share::where('uuid', $u_share->uuid.'LLL')->count() > 0
                && Share::where('uuid', $u_share->uuid.'LLR')->count() > 0
                && Share::where('uuid', $u_share->uuid.'LRL')->count() > 0
                && Share::where('uuid', $u_share->uuid.'RLL')->count() > 0
                && Share::where('uuid', $u_share->uuid.'LRR')->count() > 0
                && Share::where('uuid', $u_share->uuid.'RLR')->count() > 0
                && Share::where('uuid', $u_share->uuid.'RRL')->count() > 0
                && Share::where('uuid', $u_share->uuid.'RRR')->count() > 0
            ){
                return redirect('/nella/members')->with('error', 'This upline can\'t have this member directly under them!');
            }
        }
        //end of sanity check

        //Create Member
        $db_neolife_id = Member::where('phone', $request->input('phone'))/*->orWhere('email', $request->input('email'))*/->get();
        if (count($db_neolife_id)<1){
            $member = new Member;
            $member->sir_name = $request->input('sir_name');
            $member->first_name = $request->input('first_name');
            $member->country_id = $request->input('country');
            $member->postal_address = $request->input('postal_address');
            $member->physical_address = $request->input('physical_address');
            $member->phone = $request->input('phone');
            $member->alt_phone = $request->input('alt_phone');
            $member->id_no = $request->input('id_no');
            $member->id_nin = $request->input('id_nin');
            $member->passport = $request->input('passport');
            $member->email = $request->input('email');

            //format dated
            if (!empty($request->input('dob'))) {
                $member->dob = DateTime::createFromFormat('d/m/Y', $request->input('dob'))->format('Y-m-d H:i:s');
            }

            $member->paid_at = $pay_date->format('Y-m-d H:i:s');

            $member->neolife_id = $request->input('neolife_id');
            $member->sponsor = $request->input('sponsor');
            $member->upline = $request->input('upline');
            $member->shares = $request->input('shares');

            $member->amount = $amount_paid;
            $member->pay_time = $request->input('pay_time');
            $member->nok = $request->input('nok');
            $member->nok_phone = $request->input('nok_phone');
            $member->nok_email = $request->input('nok_email');
            $member->created_by = auth()->user()->id;
            $member->updated_by = auth()->user()->id;
            $member->save();

            //Share variables
            $r_shares = $request->input('shares');
            $r_amount = $request->input('amount');
            $r_amount_inst = $request->input('amount_inst');
            $r_pay_time = $request->input('pay_time');
            $r_upline = $request->input('upline');
            $r_sponsor = $request->input('sponsor');

            $stares_controller = new SharesController;
            $stares_controller->processNewShares($member,$r_shares, $r_amount, $r_amount_inst, $r_pay_time, $r_upline, $r_sponsor,$pay_date);

            //return view
            return redirect('/nella/members')->with('success', 'Member Added Successfully');
        }else{
            return redirect('/nella/members')->with('error', 'Error: Member with Phone NO. '.$request->input('phone').' already exists!');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->role_id > 3 ||  auth()->user()->role_id < 1){
            return redirect('/');
        }
        $member = Member::find($id);
        $first_share = Share::where('owner', $member->id)->first();
        $earnings = Earning::where('dest', $first_share->uuid)->get();
        $shares = Share::where('owner', $member->id)->get();
        return view('nella.members.show')->with([
            'member' => $member,
            'earnings' => $earnings,
            'shares' => $shares
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role_id > 3 ||  auth()->user()->role_id < 1){
            return redirect('/');
        }
        $member = Member::find($id);
        $countries = Country::orderBy('name', 'asc')->get();
        //$members = Member::orderBy('first_name', 'asc')->get();
        return view('nella.members.edit')->with([
            'member' => $member,
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role_id > 3 ||  auth()->user()->role_id < 1){
            return redirect('/');
        }
        $this->validate($request, [
            'sir_name' => 'required',
            'first_name' => 'required',
            'country' => 'required',
            /*'postal_address' => 'required',
            'physical_address' => 'required',*/
            'phone' => 'required',
            /*'alt_phone' => 'required',
            'id_no' => 'required',
            'id_nin' => 'required',
            'passport' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'neolife_id' => 'required',
            'sponsor' => 'required',
            'upline' => 'required',
            'shares' => 'required',*/
            /*'nok' => 'required',
            'nok_phone' => 'required',
            'nok_email' => 'required',*/
        ]);


        //Update Member
        $member = Member::find($id);
        $member->sir_name = $request->input('sir_name');
        $member->first_name = $request->input('first_name');
        $member->country_id = $request->input('country');
        $member->postal_address = $request->input('postal_address');
        $member->physical_address = $request->input('physical_address');
        $member->phone = $request->input('phone');
        $member->alt_phone = $request->input('alt_phone');
        $member->id_no = $request->input('id_no');
        $member->id_nin = $request->input('id_nin');
        $member->passport = $request->input('passport');
        $member->email = $request->input('email');
        //$member->dob = $request->input('dob');
        $member->neolife_id = $request->input('neolife_id');
        //$member->sponsor = $request->input('sponsor');
        //$member->upline = $request->input('upline');
        //$member->shares = $request->input('shares');
        $member->nok = $request->input('nok');
        $member->nok_phone = $request->input('nok_phone');
        $member->nok_email = $request->input('nok_email');
        $member->updated_by = auth()->user()->id;
        $member->updated_at = date('Y-m-d H:i:s');
        $member->save();

        return redirect('/nella/members')->with('success', 'Member Details Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$member = Member::find($id);
        $member->delete();
        return redirect('/nella/members')->with('success', 'Member Deleted');*/
        return redirect('/nella/members')->with('error', 'Member not Deleted!!');
    }

    //get member's balance from shares
    public static function getMemberBalance($id){
        $balance = Share::where('owner', $id)->sum('balance');
        return $balance;
    }

    public function renew($id)
    {
        /*$shares = Share::where('owner', $id)->get();
        $shares_controller = new SharesController;
        foreach ($shares as $share){
            if($shares_controller->shareHasExpired($share->id)){
                $shares_controller->renewShare(share);
            }
        }*/
        return redirect('/nella/members/'.$id)->with('success', 'The Member\'s shares have been renewed!');
    }
}
