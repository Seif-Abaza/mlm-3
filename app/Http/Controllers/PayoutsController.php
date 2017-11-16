<?php

namespace App\Http\Controllers;

use App\Share;
use Illuminate\Http\Request;
use App\Payout;
use App\Member;
use App\Http\Controllers\SharesController;
use App\Http\Controllers\MembersController;
use App\Tasks;

class PayoutsController extends Controller
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
        $payouts = Payout::where('status', '=', 0)->get();
        $paid_payouts = Payout::where('status', '=', 1)->get();//->whereDate('created_at','=',date('d'))->get();
        //dd($paid_payouts);
        $final_members = array();
        $paid_members = array();
        $members = Member::all();
        foreach ($members as $member){
            $member->w_payout = 0;
            $member->w_status = 0;
            $member->p_payout = 0;
            foreach ($payouts as $payout){
                if ($member->id == $payout->share->owner){
                    $member->w_payout += $payout->amount;
                    $member->w_status = $payout->status;
                }
            }
            foreach ($paid_payouts as $paid_payout){
                if ($member->id == $paid_payout->share->owner){
                    $member->p_payout += $paid_payout->amount;
                }
            }
            if ($member->p_payout != 0){
                array_push($paid_members, $member);
            }
            if ($member->w_payout != 0){
                array_push($final_members, $member);
            }
        }

        return view('nella.payouts.index')->with([
            'payouts' => $payouts,
            'final_members' => $final_members,
            'paid_members' => $paid_members
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$members = Member::orderBy('first_name', 'asc')->get();
        $shares = Share::whereNotNull('begin_pay')->get();
        $shares_controller = new SharesController;
        if (strtolower(date('l')) == 'monday'){
            //check if create query has been run
            $task = Tasks::find(1); //monday payouts task
            if (date('z',strtotime($task->updated_at)) < date('z')){
                foreach ($shares as $share){
                    if(!$shares_controller->shareHasExpired($share->id)){
                        $this->createPayout($share);
                    }
                }
                $task->updated_at = date('Y-m-d H:i:s');
                $task->save();
            }
            else{
                return redirect('/nella/payouts')->with('error', 'You can only run this once every monday');
            }
        }else{
            return redirect('/nella/payouts')->with('error', 'You can only run this on a monday');
        }

        return redirect('/nella/payouts')->with('success', 'This week\'s payouts have been generated.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'member' => 'required',
            'amount' => 'required'
        ]);

        //check if member has enough funds
        if (MembersController::getMemberBalance($request->input('member')) > $request->input('amount')){
            //Create Payout
            $payout = new Payout;
            $payout->member_id = $request->input('member');
            //calculate shares used
            $total_shares = 0;
            $shares_used = '';
            $j = 0;
            foreach (SharesController::getMemberShares($request->input('member')) as $member_share){
                $total_shares += $member_share->balance;
                if ($request->input('amount') > $total_shares){
                    SharesController::updateShareBalance($member_share->id, 0);
                    $shares_used .= $member_share->uuid.':'.$member_share->balance.'#';
                }else{
                    if ($j > 0){
                        $share_balance = $total_shares - $request->input('amount');
                        $shares_used .= $member_share->uuid.':'.($member_share->balance - $share_balance);
                    }else{
                        $share_balance = $member_share->balance - $request->input('amount');
                        $shares_used .= $member_share->uuid.':'.$request->input('amount');
                    }
                    SharesController::updateShareBalance($member_share->id, $share_balance);
                    break;
                }
                $j += 1;
            }

            $payout->shares_used = $shares_used;
            $payout->amount = $request->input('amount');
            $payout->created_by = auth()->user()->id;
            $payout->updated_by = auth()->user()->id;
            $payout->save();

            return redirect('/nella/payouts')->with('success', 'Payout Created');
        }else{
            return redirect('/nella/payouts')->with('error', 'Error: You are trying to pay more than the member\'s balance!');
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$this->makeOldPayouts();
        /*$payout = Payout::find($id);
        return view('nella.payouts.show')->with('payout', $payout);*/
        return redirect('/nella/payouts')->with('success', 'Success.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$withdraw_request = WithdrawRequest::find($id);
        $members = Member::orderBy('first_name', 'asc')->get();
        if ($withdraw_request->status == 1 || $withdraw_request->status == 0){
            return redirect('/nella/payouts')->with('error', 'Error: This request can not be edited!');
        }

        return view('nella.payouts.edit')->with(['members'=> $members, 'withdraw_request' =>$withdraw_request]);
        */

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
        $member = Member::find($id);
        $shares = Share::where('owner', '=', $member->id)->get();
        foreach ($shares as $share){
            $payouts = Payout::where('share_id', '=', $share->id)->where('status', '=', 0)->get();
            foreach ($payouts as $payout){
                $payout->status = 1;
                $payout->updated_at = date('Y-m-d H:i:s');
                $payout->updated_by = auth()->user()->id;
                $payout->save();
            }
        }
        return redirect('/nella/payouts')->with('success', 'Payment Marked as sent');
        /*$this->validate($request, [
            'member' => 'required',
            'amount' => 'required'
        ]);

        //Update Withdraw Request
        $withdraw_request = WithdrawRequest::find($id);
        if ($withdraw_request->status == 1 || $withdraw_request->status == 0){
            return redirect('/nella/payouts')->with('error', 'Error: This request can not be edited!');
        }else{
            $withdraw_request->member_id = $request->input('member');
            $withdraw_request->amount = $request->input('amount');
            $withdraw_request->updated_at = date('Y-m-d H:i:s');
            $withdraw_request->updated_by = auth()->user()->id;
            $withdraw_request->save();
        }

        return redirect('/nella/payouts')->with('success', 'Withdraw Request Updated');
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$withdraw_request = WithdrawRequest::find($id);
        $withdraw_request->delete();*/
        return redirect('/nella/payouts')->with('error', 'Not Allowed!');
    }

    private function createPayout($share){
        $payout = new Payout;
        $payout->share_id = $share->id;
        $payout->amount = $share->pay_amount;
        $payout->created_by = auth()->user()->id;
        $payout->updated_by = auth()->user()->id;
        $payout->save();

    }

    public function makeOldPayouts(){
        $shares = Share::whereNotNull('begin_pay')->get();
        $shares_controller = new SharesController;
        if (strtolower(date('l')) == 'thursday'){
            //check if create query has been run
            $task = Tasks::find(2); //Generate Old Payouts
            if ($task->status == 0){
                foreach ($shares as $share){
                    if(!$shares_controller->shareHasExpired($share->id)){
                        $p_start = date('z', strtotime($share->begin_pay));
                        if ($share->member->pay_time == 3){ //weekly
                            $cc = 1;
                            while ($p_start < date('z') && $cc <= $share->pay_times){
                                $this->createPayout($share);
                                $p_start += 7;
                                $cc += 1;
                            }
                        }elseif ($share->member->pay_time == 4){ //bi-weekly
                            $cc = 1;
                            while ($p_start < date('z') && $cc <= $share->pay_times){
                                $this->createPayout($share);
                                $p_start += 14;
                                $cc += 1;
                            }
                        }elseif ($share->member->pay_time == 5){ //monthly
                            $cc = 1;
                            while ($p_start < date('z') && $cc <= $share->pay_times){
                                $this->createPayout($share);
                                $p_start += 28;
                                $cc += 1;
                            }
                        }
                    }
                }

                $task->updated_at = date('Y-m-d H:i:s');
                $task->status = 1;
                $task->save();
            }
            else{
                return redirect('/nella/payouts')->with('error', 'You can only run this once on thursday');
            }
        }else{
            return redirect('/nella/payouts')->with('error', 'You can only run this on thursday');
        }

        return redirect('/nella/payouts')->with('success', 'Old payouts have been generated.');
    }
}
