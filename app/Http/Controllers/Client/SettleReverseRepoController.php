<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\JointReverseRepoApproval;
use App\JointSettleReverseRepoApproval;
use App\ReverseRepo;
use App\ReverseRepoProcess;
use App\SettleReverseRepo;
use App\SettleReverseRepoProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettleReverseRepoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $client = Auth::user()->client;

        return view('client.settleReverseRepo.create',compact('client'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $client = Auth::user()->client;


        $reverseRepo = new SettleReverseRepo();
        $reverseRepo->reverse_repo_id = $request->reverseRepo;
        $reverseRepo->client_id = $client->id;
        $reverseRepo->instruction = $request->instruction;
        $reverseRepo->amount = $request->amount;



        if($client->client_type==2 && $client->joint_permission==1){

            $countJointHolders = $client->jointHolders()->count();
            $status = -$countJointHolders;
            $reverseRepo->status = $status;
            $reverseRepo->save();
            foreach($client->jointHolders()->get() as $jointHolder){

                $approval = new JointSettleReverseRepoApproval();
                $approval->settle_reverse_repo_id = $reverseRepo->id;
                $approval->joint_holder_id = $jointHolder->id;
                $approval->save();
            }

        }else{
            $status=0;
            $reverseRepo->status = $status;
            $reverseRepo->save();
        }

       
    return redirect()->route('client.requests');
    }

    public function proceed(){

        DB::beginTransaction();
        try {
    
            $clientUser = Auth::user();
        
            $role = $clientUser->roles()->first()->id;
        
            if($clientUser->hasClient()){
            $client = $clientUser->client;
            $is_signatureB = $client->is_signatureB;
            }
            else{
                if($role==10){
                    $client = $clientUser->jointHolder->client;
                    $is_signatureB =0;
                } else{
                    $client = $clientUser->companySignature->client;
                    $is_signatureB =0;
            
                }
            }
            
        
            $reverseRepos='';
        
        
            if($role == 8 ){
            
                $reverseRepos = $client->settleReverseRepos()->where('status',-1)->paginate(10);
            
                
        
            }elseif($role==9  || $is_signatureB==1 ){
            
                $reverseRepos = $client->settleReverseRepos()->where('status',-2)->paginate(10);
            
        
            }elseif($role==10 && $client->joint_permission==1){ 
        
            
            $reverseRepos = $client->settleReverseRepos()->where('status', '<', 0)->paginate(10);
            
            
        
            }else{
        
        
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    
        return view('client.subUser.requests.settleReverseRepo.show',compact('reverseRepos','client'));
    
       }

    public function reverseRepoProcess(Request $request){

        DB::beginTransaction();
        try {
   

            $officer = Auth::user();
            $officer_role = Auth::user()->roles()->first()->id;
        
        
            $client_id = $request->client_id;
            $request_type = $request->request_type;
            $request_comment = $request->request_comment;
            $settle_reverse_repo_id = $request->settle_reverse_repo_id;
        
            $reverseRepo = SettleReverseRepo::findOrFail($settle_reverse_repo_id);
        
        
            $prev_state = $reverseRepo->status;
        
            $reverseRepo->status = $reverseRepo->status + $request_type;
            $reverseRepo->save();
        
            SettleReverseRepoProcess::create([
                'settle_reverse_repo_id' => $settle_reverse_repo_id,
                'user_id' => $officer->id,
                'client_id' => $client_id,
                'previous_state' => $prev_state,
                'current_state' => $prev_state + $request_type,
                'comment' => $request_comment
        
            ]);
        
            if($officer_role==10){
                $jointApproval = JointSettleReverseRepoApproval::where('settle_reverse_repo_id',$settle_reverse_repo_id)->where('joint_holder_id',$officer->jointHolder->id)->first();
                if($request_type==1){
                $jointApproval->status = 1;
                }else{
                $jointApproval->status = 2;
        
                }
                $jointApproval->save();
            }
    
        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return $e->getMessage();
    }
    
    
        return redirect()->route('client.settleReverseRepo.proceed');
    
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\ReverseRepo  $reverseRepo
     * @return \Illuminate\Http\Response
     */
    public function show(ReverseRepo $reverseRepo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReverseRepo  $reverseRepo
     * @return \Illuminate\Http\Response
     */
    public function edit(ReverseRepo $reverseRepo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReverseRepo  $reverseRepo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReverseRepo $reverseRepo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReverseRepo  $reverseRepo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReverseRepo $reverseRepo)
    {
        //
    }
}
