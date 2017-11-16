<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WithdrawRequest;
use App\Member;
use App\Http\Controllers\MembersController;

class WithdrawRequestsController extends Controller
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
        if (auth()->user()->role_id > 3 ||  auth()->user()->role_id < 1){
            return redirect('/');
        }
        $withdraw_requests = WithdrawRequest::orderBy('created_at', 'desc')->paginate(10);
        return view('nella.withdraw-requests.index')->with('withdraw_requests', $withdraw_requests);
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
        $members = Member::orderBy('first_name', 'asc')->get();
        return view('nella.withdraw-requests.create')->with(['members' => $members]);
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
        $this->validate($request, [
            'member' => 'required',
            'amount' => 'required'
        ]);

        //check if member has enough funds
        if (MembersController::getMemberBalance($request->input('member')) > $request->input('amount')){
            //Create Withdraw request
            $withdraw_request = new WithdrawRequest;
            $withdraw_request->member_id = $request->input('member');
            $withdraw_request->amount = $request->input('amount');
            $withdraw_request->status = 2;
            $withdraw_request->created_by = auth()->user()->id;
            $withdraw_request->updated_by = auth()->user()->id;
            $withdraw_request->save();

            return redirect('/nella/withdraw-requests')->with('success', 'withdraw request Created');
        }else{
            return redirect('/nella/withdraw-requests')->with('error', 'Error: You are trying to withdraw More than you have in your account!');
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
        $withdraw_request = WithdrawRequest::find($id);
        return view('nella.withdraw-requests.show')->with('withdraw_request', $withdraw_request);
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
        $withdraw_request = WithdrawRequest::find($id);
        $members = Member::orderBy('first_name', 'asc')->get();
        if ($withdraw_request->status == 1 || $withdraw_request->status == 0){
            return redirect('/nella/withdraw-requests')->with('error', 'Error: This request can not be edited!');
        }

        return view('nella.withdraw-requests.edit')->with(['members'=> $members, 'withdraw_request' =>$withdraw_request]);

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
            'member' => 'required',
            'amount' => 'required'
        ]);

        //Update Withdraw Request
        $withdraw_request = WithdrawRequest::find($id);
        if ($withdraw_request->status == 1 || $withdraw_request->status == 0){
            return redirect('/nella/withdraw-requests')->with('error', 'Error: This request can not be edited!');
        }else{
            $withdraw_request->member_id = $request->input('member');
            $withdraw_request->amount = $request->input('amount');
            $withdraw_request->updated_at = date('Y-m-d H:i:s');
            $withdraw_request->updated_by = auth()->user()->id;
            $withdraw_request->save();
        }

        return redirect('/nella/withdraw-requests')->with('success', 'Withdraw Request Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role_id > 3 ||  auth()->user()->role_id < 1){
            return redirect('/');
        }
        $withdraw_request = WithdrawRequest::find($id);
        $withdraw_request->delete();
        return redirect('/nella/withdraw-requests')->with('success', 'Withdraw request Deleted');
    }
}
