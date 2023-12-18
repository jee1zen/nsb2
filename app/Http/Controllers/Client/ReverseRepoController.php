<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\JointReverseRepoApproval;
use App\ReverseRepo;
use App\ReverseRepoProcess;
use Illuminate\Http\Request;
use Auth;

class ReverseRepoController extends Controller
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

        return view('client.reverseRepo.index',compact('client'));
        
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


        $reverseRepo = new ReverseRepo;
        $reverseRepo->investment_id = $request->investment;
        $reverseRepo->client_id = $client->id;
        $reverseRepo->amount = str_replace(",", "",$request->amount);
        $reverseRepo->maturity_date = $request->maturity_date;


        if($client->client_type==2 && $client->joint_permission==1){

            $countJointHolders = $client->jointHolders()->count();
            $status = -$countJointHolders;
            $reverseRepo->status = $status;
            $reverseRepo->save();
            foreach($client->jointHolders()->get() as $jointHolder){

                $approval = new JointReverseRepoApproval;
                $approval->reverseRepo_id = $reverseRepo->id;
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
         
            $reverseRepos = $client->reverseRepos()->where('status',-1)->paginate(10);
          
            
    
        }elseif($role==9  || $is_signatureB==1 ){
         
            $reverseRepos = $client->reverseRepos()->where('status',-2)->paginate(10);
         
    
        }elseif($role==10 && $client->joint_permission==1){ 
    
          
           $reverseRepos = $client->reverseRepos()->where('status', '<', 0)->paginate(10);
         
           
    
        }else{
    
    
        }
    
    
        return view('client.subUser.requests.reverseRepos.show',compact('reverseRepos','client'));
    
       }

    public function reverseRepoProcess(Request $request){


        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first()->id;
    
    
        $client_id = $request->client_id;
        $request_type = $request->request_type;
        $request_comment = $request->request_comment;
        $reverseRepo_id = $request->reverseRepo_id;
    
        $reverseRepo = ReverseRepo::findOrFail($reverseRepo_id);
    
    
        $prev_state = $reverseRepo->status;
    
        $reverseRepo->status = $reverseRepo->status + $request_type;
        $reverseRepo->save();
    
        ReverseRepoProcess::create([
            'reverseRepo_id' => $reverseRepo_id,
            'user_id' => $officer->id,
            'client_id' => $client_id,
            'previous_state' => $prev_state,
            'current_state' => $prev_state + $request_type,
            'comment' => $request_comment
    
        ]);
    
        if($officer_role==10){
            $jointApproval = JointReverseRepoApproval::where('reverseRepo_id',$reverseRepo_id)->where('joint_holder_id',$officer->jointHolder->id)->first();
            if($request_type==1){
            $jointApproval->status = 1;
            }else{
            $jointApproval->status = 2;
    
            }
            $jointApproval->save();
        }
    
    
    
        return redirect()->route('client.requests.proceed');
    
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
