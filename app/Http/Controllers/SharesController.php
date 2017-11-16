<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;
use DateTime;
use App\Member;
use App\Earning;

class SharesController extends Controller
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
        $shares = Share::orderBy('created_at', 'asc')->paginate(10);
        return view('nella.shares.index')->with('shares', $shares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::orderBy('first_name', 'asc')->get();
        return view('nella.shares.create')->with(['members' => $members]);
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
            'upline' => 'required',
            'shares' => 'required',
            'paid_at' => 'required',
            'amount' => 'required',
        ]);

        //Share variables
        $r_shares = $request->input('shares');
        $r_amount = $request->input('amount');
        $r_amount_inst = $request->input('amount_inst');
        $r_upline = $request->input('upline');

        //sanity check
        //
        foreach ([1=>870000,2=>1740000,3=>2610000,4=>3580000,5=>4350000,6=>5220000,7=>6090000] as $item=>$value){
            if ($item == $r_shares && $value != $r_amount){
                return redirect('/nella/shares')->with('error', 'You can\'t buy these shares with this amount!');
            }
        }
        //
        $upline = Member::find($request->input('upline'));
        if ($upline->shares > 14){
            return redirect('/nella/shares')->with('error', 'Upline has more than 14 shares!');
        }else{
            //get member's and uplines's first shares
            $m_share = Share::where('owner', $request->input('member'))->first();
            $u_share = Share::where('owner', $request->input('upline'))->first();
            //prevent getting shares not in one's leg
            if (substr($u_share->uuid, 0, strlen($m_share->uuid)) != $m_share->uuid){
                return redirect('/nella/shares')->with('error', 'You cant obtain a share in an other member\'s team!');
            }
            //check if all upline's direct down slots have been taken.
            if ($upline->shares == 1 || $upline->shares == 2){
                if(Share::where('uuid', $u_share->uuid.'L')->count() > 0
                 && Share::where('uuid', $u_share->uuid.'R')->count() > 0){
                    return redirect('/nella/shares')->with('error', 'This Member Can\'t be an upline to this share!');
                }
            }elseif ($upline->shares >= 3 && $upline->shares <= 6){
                if(Share::where('uuid', $u_share->uuid.'LL')->count() > 0
                    && Share::where('uuid', $u_share->uuid.'RR')->count() > 0
                    && Share::where('uuid', $u_share->uuid.'RL')->count() > 0
                    && Share::where('uuid', $u_share->uuid.'LR')->count() > 0
                ){
                    return redirect('/nella/shares')->with('error', 'This Member Can\'t be an upline to this share!');
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
                    return redirect('/nella/shares')->with('error', 'This Member Can\'t be an upline to this share!');
                }
            }

        }
        //end of sanity check

        $member = Member::find($request->input('member'));
        $r_pay_time = $member->pay_time;
        $r_sponsor = $request->input('member');

        //date object for pay date
        $pay_date = DateTime::createFromFormat('d/m/Y', $request->input('paid_at'));

        $stares_controller = new SharesController;
        $stares_controller->processNewShares($member,$r_shares, $r_amount, $r_amount_inst, $r_pay_time, $r_upline, $r_sponsor,$pay_date);

        $member->shares += $r_shares;
        $member->updated_by = auth()->user()->id;
        $member->updated_at = date('Y-m-d H:i:s');
        $member->save();
        return redirect('/nella/shares')->with('success', 'Share Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $share = Share::find($id);
        return view('nella.shares.show')->with('share', $share);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function getMemberShares($id){
        $shares = Share::where('owner', $id)->get();
        return $shares;
    }

    public static function updateShareBalance($id, $balance){
        $share = Share::find($id);
        $share->balance = $balance;
        $share->save();
    }

    public function processNewShares($member, $r_shares, $r_amount, $r_amount_inst, $r_pay_time, $r_upline, $r_sponsor, $pay_date){
        //check if number of shares is equivalent to the amount paid.
        if ($r_shares == 1){
            if($r_amount != 870000 && empty($r_amount_inst)){
                return redirect('/nella/members')->with('error', 'Error: The Shares don\'t match the amount of money paid!');
            }else{
                if ($r_pay_time == 3){ //3 = weekly
                    $share_pay_times = 24; //weeks
                    $pay_per_share = 50000;
                }elseif ($r_pay_time == 4){ //4 = bi-weekly
                    $share_pay_times = 12; //fortnights
                    $pay_per_share = 100000;
                }elseif ($r_pay_time == 5){ //5 = monthly
                    $share_pay_times = 6; //months
                    $pay_per_share = 200000;
                }
            }
        }elseif ($r_shares == 3){
            if($r_amount != 2610000  && empty($r_amount_inst)){
                return redirect('/nella/members')->with('error', 'Error: The Shares don\'t match the amount of money paid!');
            }else{
                if ($r_pay_time == 3){
                    $share_pay_times = 32;
                    $pay_per_share = 100000/3;
                }elseif ($r_pay_time == 4){
                    $share_pay_times = 16;
                    $pay_per_share = 200000/3;
                }elseif ($r_pay_time == 5){
                    $share_pay_times = 8;
                    $pay_per_share = 400000/3;
                }
            }
        }elseif ($r_shares == 7){
            if($r_amount != 6090000 && $r_amount != 10000000 && empty($r_amount_inst)){
                return redirect('/nella/members')->with('error', 'Error: The Shares don\'t match the amount of money paid!');
            }else{
                if ($r_amount == 6090000){
                    if ($r_pay_time == 3){
                        $share_pay_times = 48;
                        $pay_per_share = 150000/7;
                    }elseif ($r_pay_time == 4){
                        $share_pay_times = 24;
                        $pay_per_share = 300000/7;
                    }elseif ($r_pay_time == 5){
                        $share_pay_times = 12;
                        $pay_per_share = 600000/7;
                    }
                }elseif ($r_amount == 10000000){
                    if ($r_pay_time == 3){
                        $share_pay_times = 48;
                        $pay_per_share = 250000/7;
                    }elseif ($r_pay_time == 4){
                        $share_pay_times = 24;
                        $pay_per_share = 500000/7;
                    }elseif ($r_pay_time == 5){
                        $share_pay_times = 12;
                        $pay_per_share = 1000000/7;
                    }
                }
            }
        }

        //calculate first payment date
        $first_pay_date = $this->getFirstPayDate($pay_date);


        //Handle shares allocation
        //get upline's number of shares
        $upline = Member::find($r_upline);
        $upline_shares = $upline->shares;

        //get (upline main share) details
        $upline_share = Share::where('owner', $r_upline)->first();
        $upline_uuid = $upline_share->uuid;

        //Save Shares
        if ($r_shares == 1){
            //generate new share uuid
            if ($upline_shares == 1 || $upline_shares == 2){
                //decide left or right for new share
                if (Share::where('uuid', $upline_uuid.'L')->count() > 0){
                    include(app_path().'/Includes/save-award-1-1-share-R.php');
                }else{
                    include(app_path().'/Includes/save-award-1-1-share-L.php');
                }
            }elseif ($upline_shares >= 3 && $upline_shares <= 6){
                //decide left or right for new share
                if (Share::where('uuid', $upline_uuid.'LL')->count() > 0){
                    if (Share::where('uuid', $upline_uuid.'RL')->count() > 0){
                        if (Share::where('uuid', $upline_uuid.'LR')->count() > 0){
                            include(app_path().'/Includes/save-award-1-3-share-RR.php');
                        }else{
                            include(app_path().'/Includes/save-award-1-3-share-LR.php');
                        }
                    }else{
                        include(app_path().'/Includes/save-award-1-3-share-RL.php');
                    }
                }else{
                    include(app_path().'/Includes/save-award-1-3-share-LL.php');
                }
            }elseif ($upline_shares >= 7 && $upline_shares <= 14){
                //decide left or right for new share
                if (Share::where('uuid', $upline_uuid.'LLL')->count() > 0){
                    if (Share::where('uuid', $upline_uuid.'RLL')->count() > 0){
                        if (Share::where('uuid', $upline_uuid.'LLR')->count() > 0){
                            if (Share::where('uuid', $upline_uuid.'RLR')->count() > 0){
                                if (Share::where('uuid', $upline_uuid.'LRL')->count() > 0){
                                    if (Share::where('uuid', $upline_uuid.'RRL')->count() > 0){
                                        if (Share::where('uuid', $upline_uuid.'LRR')->count() > 0){
                                            include(app_path().'/Includes/save-award-1-7-share-RRR.php');
                                        }else{
                                            include(app_path().'/Includes/save-award-1-7-share-LRR.php');
                                        }
                                    }else{
                                        include(app_path().'/Includes/save-award-1-7-share-RRL.php');
                                    }
                                }else{
                                    include(app_path().'/Includes/save-award-1-7-share-LRL.php');
                                }
                            }else{
                                include(app_path().'/Includes/save-award-1-7-share-RLR.php');
                            }
                        }else{
                            include(app_path().'/Includes/save-award-1-7-share-LLR.php');
                        }
                    }else{
                        include(app_path().'/Includes/save-award-1-7-share-RLL.php');
                    }
                }else{
                    include(app_path().'/Includes/save-award-1-7-share-LLL.php');
                }
            }


        }elseif ($r_shares == 3){
            if ($upline_shares == 1 || $upline_shares == 2){
                //decide left or right for new share
                if (Share::where('uuid', $upline_uuid.'L')->count() > 0){
                    include(app_path().'/Includes/save-award-1-1-share-R.php');
                    $this->saveAndAwardTwoShares($upline_uuid.'R', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                }else{
                    include(app_path().'/Includes/save-award-1-1-share-L.php');
                    $this->saveAndAwardTwoShares($upline_uuid.'L', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                }
            }elseif ($upline_shares >= 3 && $upline_shares <= 6){
                if (Share::where('uuid', $upline_uuid.'LL')->count() > 0){
                    if (Share::where('uuid', $upline_uuid.'RL')->count() > 0){
                        if (Share::where('uuid', $upline_uuid.'LR')->count() > 0){
                            include(app_path().'/Includes/save-award-1-3-share-RR.php');
                            $this->saveAndAwardTwoShares($upline_uuid.'RR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                        }else{
                            include(app_path().'/Includes/save-award-1-3-share-LR.php');
                            $this->saveAndAwardTwoShares($upline_uuid.'LR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                        }
                    }else{
                        include(app_path().'/Includes/save-award-1-3-share-RL.php');
                        $this->saveAndAwardTwoShares($upline_uuid.'RL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                    }
                }else{
                    include(app_path().'/Includes/save-award-1-3-share-LL.php');
                    $this->saveAndAwardTwoShares($upline_uuid.'LL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                }
            }elseif ($upline_shares >= 7 && $upline_shares <= 14){
                if (Share::where('uuid', $upline_uuid.'LLL')->count() > 0){
                    if (Share::where('uuid', $upline_uuid.'RLL')->count() > 0){
                        if (Share::where('uuid', $upline_uuid.'LLR')->count() > 0){
                            if (Share::where('uuid', $upline_uuid.'RLR')->count() > 0){
                                if (Share::where('uuid', $upline_uuid.'LRL')->count() > 0){
                                    if (Share::where('uuid', $upline_uuid.'RRL')->count() > 0){
                                        if (Share::where('uuid', $upline_uuid.'LRR')->count() > 0){
                                            include(app_path().'/Includes/save-award-1-7-share-RRR.php');
                                            $this->saveAndAwardTwoShares($upline_uuid.'RRR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                                        }else{
                                            include(app_path().'/Includes/save-award-1-7-share-LRR.php');
                                            $this->saveAndAwardTwoShares($upline_uuid.'LRR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                                        }
                                    }else{
                                        include(app_path().'/Includes/save-award-1-7-share-RRL.php');
                                        $this->saveAndAwardTwoShares($upline_uuid.'RRL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                                    }
                                }else{
                                    include(app_path().'/Includes/save-award-1-7-share-LRL.php');
                                    $this->saveAndAwardTwoShares($upline_uuid.'LRL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                                }
                            }else{
                                include(app_path().'/Includes/save-award-1-7-share-RLR.php');
                                $this->saveAndAwardTwoShares($upline_uuid.'RLR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                            }
                        }else{
                            include(app_path().'/Includes/save-award-1-7-share-LLR.php');
                            $this->saveAndAwardTwoShares($upline_uuid.'LLR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                        }
                    }else{
                        include(app_path().'/Includes/save-award-1-7-share-RLL.php');
                        $this->saveAndAwardTwoShares($upline_uuid.'RLL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                    }
                }else{
                    include(app_path().'/Includes/save-award-1-7-share-LLL.php');
                    $this->saveAndAwardTwoShares($upline_uuid.'LLL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                }
            }
        }elseif ($r_shares == 7){
            if ($upline_shares == 1 || $upline_shares == 2){
                //decide left or right for new share
                if (Share::where('uuid', $upline_uuid.'L')->count() > 0){
                    include(app_path().'/Includes/save-award-1-1-share-R.php');
                    $this->saveAndAwardSixShares($upline_uuid.'R', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                }else{
                    include(app_path().'/Includes/save-award-1-1-share-L.php');
                    $this->saveAndAwardSixShares($upline_uuid.'L', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                }
            }elseif ($upline_shares >= 3 && $upline_shares <= 6){
                if (Share::where('uuid', $upline_uuid.'LL')->count() > 0){
                    if (Share::where('uuid', $upline_uuid.'RL')->count() > 0){
                        if (Share::where('uuid', $upline_uuid.'LR')->count() > 0){
                            include(app_path().'/Includes/save-award-1-3-share-RR.php');
                            $this->saveAndAwardSixShares($upline_uuid.'RR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                        }else{
                            include(app_path().'/Includes/save-award-1-3-share-LR.php');
                            $this->saveAndAwardSixShares($upline_uuid.'LR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                        }
                    }else{
                        include(app_path().'/Includes/save-award-1-3-share-RL.php');
                        $this->saveAndAwardSixShares($upline_uuid.'RL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                    }
                }else{
                    include(app_path().'/Includes/save-award-1-3-share-LL.php');
                    $this->saveAndAwardSixShares($upline_uuid.'LL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                }
            }elseif ($upline_shares >= 7 && $upline_shares <= 14){
                if (Share::where('uuid', $upline_uuid.'LLL')->count() > 0){
                    if (Share::where('uuid', $upline_uuid.'RLL')->count() > 0){
                        if (Share::where('uuid', $upline_uuid.'LLR')->count() > 0){
                            if (Share::where('uuid', $upline_uuid.'RLR')->count() > 0){
                                if (Share::where('uuid', $upline_uuid.'LRL')->count() > 0){
                                    if (Share::where('uuid', $upline_uuid.'RRL')->count() > 0){
                                        if (Share::where('uuid', $upline_uuid.'LRR')->count() > 0){
                                            include(app_path().'/Includes/save-award-1-7-share-RRR.php');
                                            $this->saveAndAwardSixShares($upline_uuid.'RRR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                                        }else{
                                            include(app_path().'/Includes/save-award-1-7-share-LRR.php');
                                            $this->saveAndAwardSixShares($upline_uuid.'LRR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                                        }
                                    }else{
                                        include(app_path().'/Includes/save-award-1-7-share-RRL.php');
                                        $this->saveAndAwardSixShares($upline_uuid.'RRL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                                    }
                                }else{
                                    include(app_path().'/Includes/save-award-1-7-share-LRL.php');
                                    $this->saveAndAwardSixShares($upline_uuid.'LRL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                                }
                            }else{
                                include(app_path().'/Includes/save-award-1-7-share-RLR.php');
                                $this->saveAndAwardSixShares($upline_uuid.'RLR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                            }
                        }else{
                            include(app_path().'/Includes/save-award-1-7-share-LLR.php');
                            $this->saveAndAwardSixShares($upline_uuid.'LLR', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                        }
                    }else{
                        include(app_path().'/Includes/save-award-1-7-share-RLL.php');
                        $this->saveAndAwardSixShares($upline_uuid.'RLL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                    }
                }else{
                    include(app_path().'/Includes/save-award-1-7-share-LLL.php');
                    $this->saveAndAwardSixShares($upline_uuid.'LLL', $member->id, $first_pay_date, $share_pay_times, $pay_per_share);
                }
            }
        }
    }

    private function saveEachShare($uuid, $owner, $begin_pay, $pay_times, $pay_amount){
        $share = new Share;
        $share->pair = 1;
        $share->uuid = $uuid;
        $share->owner = $owner;
        $share->begin_pay = $begin_pay;
        $share->pay_times = $pay_times;
        $share->pay_amount = $pay_amount;
        $share->balance = 0;
        $share->created_by = auth()->user()->id;
        $share->updated_by = auth()->user()->id;
        $share->save();

        return $share;
    }

    private function awardSponsoringBonus($sponsor_id, $source){
        $sponsor_share = Share::where('owner', $sponsor_id)->first();
        $sponsor_share->balance += 50000;
        $sponsor_share->save();
        $this->saveEarning(1, $source, $sponsor_share->uuid, 50000);
    }

    private function saveEarning($type, $source, $dest, $amount){
        $earning = new Earning;
        $earning->type = $type;
        $earning->source = $source;
        $earning->dest = $dest;
        $earning->amount = $amount;
        $earning->created_by = auth()->user()->id;
        $earning->updated_by = auth()->user()->id;
        $earning->save();
    }

    private function awardSponsoringBonusTwoShares($uuid, $source){
        $top_share = Share::where('uuid', $uuid)->first();
        $top_share->balance += 50000;
        $top_share->save();
        $this->saveEarning(1, $source, $uuid, 50000);
    }

    private function awardMatchingBonuses($saved_share){
        for ($i = 1; $i < strlen($saved_share->uuid); $i++){
            $letter_to_replace = substr($saved_share->uuid, -$i, 1);
            if ($letter_to_replace == 'L'){
                $replacement = 'R';
            }elseif ($letter_to_replace == 'R'){
                $replacement = 'L';
            }

            //the replacement process
            if ($i == 1){
                $search_uuid = substr($saved_share->uuid, 0, -$i).$replacement;
            }else{
                $search_uuid = substr($saved_share->uuid, 0, -$i).$replacement.substr($saved_share->uuid,-($i-1));
            }

            //reward up shares
            if (Share::where('uuid', $search_uuid)->count() > 0){
                //award share
                $upline_share = Share::where('uuid', substr($saved_share->uuid, 0, -$i))->first();
                //limit award_amount
                if ((strlen($saved_share->uuid) - strlen($upline_share)) < 6){
                    $m_bonus = 100000;
                }elseif ((strlen($saved_share->uuid) - strlen($upline_share)) < 11){
                    $m_bonus = 50000;
                }elseif ((strlen($saved_share->uuid) - strlen($upline_share)) < 16){
                    $m_bonus = 25000;
                }else{
                    $m_bonus = 0;
                }
                //award those below 16th level
                if ($m_bonus != 0){
                    $upline_share->balance += $m_bonus;
                    $upline_share->save();
                    $this->saveEarning(2, $saved_share->uuid.':'.$search_uuid, $upline_share->uuid, 100000); //2 for matching bonus
                }
            }
        }
    }

    private function saveAndAwardTwoShares($uuid, $owner, $begin_pay, $pay_times, $pay_amount){
        foreach (['L', 'R'] as $addition){
            $saved_share = $this->saveEachShare($uuid.$addition, $owner, $begin_pay, $pay_times, $pay_amount);
            $this->awardSponsoringBonusTwoShares($uuid, $uuid.$addition);
            $this->awardMatchingBonuses($saved_share);
        }
    }

    private function saveAndAwardSixShares($uuid, $owner, $begin_pay, $pay_times, $pay_amount){
        foreach (['L', 'R'] as $addition){
            $saved_share = $this->saveEachShare($uuid.$addition, $owner, $begin_pay, $pay_times, $pay_amount);
            $this->awardSponsoringBonusTwoShares($uuid, $uuid.$addition);
            $this->awardMatchingBonuses($saved_share);
            foreach (['L', 'R'] as $addition2){
                $saved_share2 = $this->saveEachShare($uuid.$addition.$addition2, $owner, $begin_pay, $pay_times, $pay_amount);
                $this->awardSponsoringBonusTwoShares($uuid.$addition, $uuid.$addition.$addition2);
                $this->awardMatchingBonuses($saved_share2);
            }
        }
    }

    public function renew($id)
    {
        $share = Share::find($id);
        if ($this->shareHasExpired($id)){
            $this->renewShare($share);
            return redirect('/nella/members/'.$share->owner)->with('success', 'The Member\'s share has been renewed');
        }else{
            return redirect('/nella/members/'.$share->owner)->with('error', 'The Member\'s share hasn\'t Expired!');
        }
    }

    public function renewShare($share)
    {
        $share->updated_by = auth()->user()->id;
        $share->renewed_at = date('Y-m-d H:i:s');
        $pay_date = DateTime::createFromFormat('d/m/Y', date('d/m/Y'));
        $share->begin_pay = $this->getFirstPayDate($pay_date);
        $share->save();
    }

    public function shareHasExpired($id){
        $share = Share::find($id);
        $owner = Member::find($share->owner);
        if ($owner->pay_time == 3){ //weekly
            $begin_days = date('z', strtotime($share->begin_pay));
            $full_days = $begin_days + 7*$share->pay_times;
            $last_day = date('z', strtotime('last day of december'));
            if ($full_days >= date('z')){
                //check if we are in a new year
                if ($last_day < $full_days){
                    //we are in a new year
                    if (date('z') + ($last_day - $begin_days) >= 7*$share->pay_times){
                        return true;
                    }else{
                        return false;
                    }

                }else{ //in same year
                    if (date('z') >= $full_days){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }elseif ($owner->pay_time == 4){ //bi-weekly
            $begin_days = date('z', strtotime($share->begin_pay));
            $full_days = $begin_days + 14*$share->pay_times;
            $last_day = date('z', strtotime('last day of december'));
            if ($full_days >= date('z')){
                //check if we are in a new year
                if ($last_day < $full_days){
                    //we are in a new year
                    if (date('z') + ($last_day - $begin_days) >= 14*$share->pay_times){
                        return true;
                    }else{
                        return false;
                    }

                }else{ //in same year
                    if (date('z') >= $full_days){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }elseif ($owner->pay_time == 5){ //monthly
            $begin_days = date('z', strtotime($share->begin_pay));
            $full_days = $begin_days + 28*$share->pay_times;
            $last_day = date('z', strtotime('last day of december'));
            if ($full_days >= date('z')){
                //check if we are in a new year
                if ($last_day < $full_days){
                    //we are in a new year
                    if (date('z') + ($last_day - $begin_days) >= 28*$share->pay_times){
                        return true;
                    }else{
                        return false;
                    }

                }else{ //in same year
                    if (date('z') >= $full_days){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }else{
            return false;
        }
    }

    public function getFirstPayDate($pay_date){
        if (strtolower($pay_date->format('l')) == 'monday'){
            //calculate the monday next week
            $this_monday = date('z');
            $start_monday = $this_monday + 7;
            //make sure we are in the same year.
            if ($start_monday > date('z', strtotime('last day of december'))){ //we are in new year
                $diff = date('z', strtotime('last day of december')) - date('z');
                $next_year = date('Y', strtotime('next year'));
                if($diff == 6){
                    $first_pay_date = date('Y-m-d H:i:s', strtotime('1 jan '.$next_year));
                }else{
                    $first_pay_date = date('Y-m-d H:i:s', strtotime((6-$diff).' jan '.$next_year));
                }
            }else{
                $first_pay_date = DateTime::createFromFormat('z', $start_monday)->format('Y-m-d H:i:s');
            }
        }else{
            //calculate the monday after next week
            $this_monday = date('z', strtotime('monday this week'));
            $start_monday = $this_monday + 14;
            //make sure we are in the same year.
            if ($start_monday > date('z', strtotime('last day of december'))){ //we are in new year
                $diff = date('z', strtotime('last day of december')) - date('z');
                $next_year = date('Y', strtotime('next year'));
                if($diff == 13){
                    $first_pay_date = date('Y-m-d H:i:s', strtotime('1 jan '.$next_year));
                }else{
                    $first_pay_date = date('Y-m-d H:i:s', strtotime((13-$diff).' jan '.$next_year));
                }
            }else{
                $first_pay_date = DateTime::createFromFormat('z', $start_monday)->format('Y-m-d H:i:s');
            }
        }
        return $first_pay_date;
    }
}
