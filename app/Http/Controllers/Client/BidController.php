<?php

namespace App\Http\Controllers\Client;

use App\Bid;
use App\BidForAuction;
use App\Bidprocess;
use App\BidSet;
use App\Http\Controllers\Controller;
use App\JointBidApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{


    public function bid()
    {


        $bidDocs = BidForAuction::find(1);
        $client = Auth::user()->client;
        $bidSet = $client->bids()->where('status', -2)->first();





        return view('client.bids.index', compact('bidDocs', 'client', 'bidSet'));
    }

    public function bidPost(Request $request)
    {


        DB::beginTransaction();
        try {

            $user = Auth::user();
            $client = $user->client;
            $bidSet  =  $client->bids()->where('status', -2)->first();

            if (!$bidSet) {
                $bidSet = new BidSet;
            }

            $bidSet->client_id = $user->client->id;
            $bidSet->status = -2;
            $bidSet->save();
            $bid = new Bid;
            $bid->investment_id = $request->investment;
            $bid->bidset_id = $bidSet->id;
            $bid->amount = $request->bid;
            $bid->value_date = $request->value_date;
            $bid->auction_date = $request->auction_date;
            $bid->maturity_date = $request->maturity_date;
            $bid->rate = $request->rate;
            if ($user->client->client_type == 3) {
                $status = -2;
                $bid->status =  $status;
                $bid->save();
            } else if ($user->client->client_type == 2 && $user->client->joint_permission == 1) {


                $count = $user->client->jointHolders()->count();
                $status = -$count;
                $bid->status =  $status;
                $bid->save();

                foreach ($user->client->jointHolders()->get() as $jointHolder) {
                    $approval = new JointBidApproval();
                    $approval->bid_id = $bid->id;
                    $approval->joint_holder_id = $jointHolder->id;
                    $approval->save();
                }
            } else {
                $status = 0;
                $bid->status =  $status;
                $bid->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }


        return redirect()->back();
    }

    public function bidDelete($id)
    {

        $bid = Bid::findOrFail($id);
        $bid->delete();
        return redirect()->back();
    }


    public function bidSetPost(Request $request)
    {

        $bidSet = BidSet::find($request->bidset_id);
        $bidSet->status = 0;
        $bidSet->save();
        return redirect()->back();
    }

    public function proceed()
    {

        $clientUser = Auth::user();

        $role = $clientUser->roles()->first()->id;

        if ($clientUser->hasClient()) {
            $client = $clientUser->client;
            $is_signatureB = $client->is_signatureB;
        } else {
            if ($role == 10) {
                $client = $clientUser->jointHolder->client;
                $is_signatureB = 0;
            } else {
                $client = $clientUser->companySignature->client;
                $is_signatureB = 0;
            }
        }


        $bids = '';

        if ($role == 8) {

            $bids = $client->bids()->first()->bids()->where('status', -1)->get();
        } elseif ($role == 9  || $is_signatureB == 1) {

            $bids = $client->bids()->first()->bids()->where('status', -2)->get();
        } elseif ($role == 10 && $client->joint_permission == 1) {
            if ($client->hasBids())

                $bids = $client->bids()->latest()->first()->bids()->where('status', '<', 0)->get();
        } else {
        }


        return view('client.subUser.requests.bids.show', compact('bids', 'client'));
    }



    public function process(Request $request)
    {


        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first()->id;

        DB::beginTransaction();
        try {

            $client_id = $request->client_id;
            $request_type = $request->request_type;
            $request_comment = $request->request_comment;
            $bid_id = $request->bid_id;

            $bid = Bid::findOrFail($bid_id);


            $prev_state = $bid->status;

            $bid->status = $bid->status + $request_type;
            $bid->save();

            Bidprocess::create([
                'bid_id' => $bid_id,
                'user_id' => $officer->id,
                'client_id' => $client_id,
                'previous_state' => $prev_state,
                'current_state' => $prev_state + $request_type,
                'comment' => $request_comment

            ]);

            if ($officer_role == 10) {
                $jointApproval = JointBidApproval::where('bid_id', $bid_id)->where('joint_holder_id', $officer->jointHolder->id)->first();
                if ($request_type == 1) {
                    $jointApproval->status = 1;
                } else {
                    $jointApproval->status = 2;
                }
                $jointApproval->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

        return back();
    }

    public function myBids()
    {

        $user = Auth::user();

        $bids = Bid::join('bid_sets', 'bids.bidset_id', '=', 'bid_sets.id')
            ->join('investment_types', 'bids.investment_id', 'investment_types.id')
            ->where('client_id', $user->id)
            ->where('bid_sets.status', 3)
            ->where('bids.status', 0)
            ->paginate(20);




        return view('client.myBids', compact('bids'));
    }
    public function myBidsFilter(Request $request)
    {


        $type = $request->investment_type;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;





        $user = Auth::user();


        if ($type == 0) {
            // $bids = Bid::join('bid_sets', 'bid_sets.id', '=', 'bids.bidset_id')
            //     ->join('investment_types', 'bids.investment_id', 'investment_types.id')
            //     ->where('client_id', $user->id)
            //     ->where('bid_sets.status', 2)
            //     ->where('bids.status', 0)
            //     ->whereBetween('bids.created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
            //     ->paginate(20);

             $bids = Bid::join('bid_sets', function($join) use($user){
                $join->on('bid_sets.id', '=', 'bids.bidset_id')
                ->where('bid_sets.status', 2)
                ->where('bid_sets.client_id',$user->id);
             })->join('investment_types', function($join){
                $join->on('bids.investment_id','=', 'investment_types.id');
             })->paginate(20);

        } else {
            // $bids = Bid::join('bid_sets', 'bid_sets.id', '=', 'bids.bidset_id')
            //     ->join('investment_types', 'bids.investment_id', 'investment_types.id')
            //     ->where('client_id', $user->id)->where('bid_sets.status', 2)->where('bids.status', 0)
            //     ->whereBetween('bids.created_at', [$fromDate . " 00:00:00", $toDate . " 23:59:59"])
            //     ->where('bids.investment_id', $type)
            //     ->paginate(20);


                $bids = Bid::join('bid_sets', function($join) use($user){
                    $join->on('bid_sets.id', '=', 'bids.bidset_id')
                    ->where('bid_sets.status', 2)
                    ->where('bid_sets.client_id',$user->id);
                 })->join('investment_types', function($join) use($type){
                    $join->on('bids.investment_id','=', 'investment_types.id')
                    ->where('bids.investment_id', $type);

                 })->paginate(20);
        }


        $parameters = [
            'type' => $type,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ];


        return view('client.myBids', compact('bids', 'parameters'));
    }
}