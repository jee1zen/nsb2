<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SettleReverseRepo;
use App\SettleReverseRepoProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettleReverseRepoController extends Controller
{
        //Reverse Repo
        public function index()
        {
    
            $officer = Auth::user();
            $officer_role = Auth::user()->roles()->first();
    
            if ($officer_role->id == 5) {
    
                $reverseRepos = SettleReverseRepo::where('status', '=', 0)->get();
            } elseif ($officer_role->id == 6) {
    
                $reverseRepos = SettleReverseRepo::where('status', '=', 0)->get();
            } elseif ($officer_role->id == 7) {
    
                $reverseRepos = SettleReverseRepo::where('status', '=', 1)->get();
            } else {
    
                $reverseRepos = '';
            }
    
    
    
    
            return view('admin.settleReverseRepo.index', compact('reverseRepos', 'officer_role'));
        }
    
        public function show($id)
        {
            $officer = Auth::user();
            $officer_role = Auth::user()->roles()->first();
    
            $reverseRepo = SettleReverseRepo::findOrFail($id);
    
    
            return view('admin.settleReverseRepo.show', compact('reverseRepo', 'officer_role'));
        }
    
    
    
        public function process(Request $request)
        {
    
            DB::beginTransaction();
            try {
    
                $officer = Auth::user();
                $officer_role = Auth::user()->roles()->first();
        
        
                $client_id = $request->client_id;
                $request_type = $request->request_type;
                $request_comment = $request->request_comment;
                $reverseRepo_id = $request->reverseRepo_id;
        
                $reverseRepo = SettleReverseRepo::findOrFail($reverseRepo_id);
        
        
                $prev_state = $reverseRepo->status;
        
                $reverseRepo->status = $reverseRepo->status + $request_type;
                $reverseRepo->save();
        
                SettleReverseRepoProcess::create([
                    'settle_reverse_repo_id' => $reverseRepo_id,
                    'user_id' => $officer->id,
                    'client_id' => $client_id,
                    'previous_state' => $prev_state,
                    'current_state' => $prev_state + $request_type,
                    'comment' => $request_comment
        
                ]);
        
        
        
                $reverseRepo = SettleReverseRepo::findOrFail($reverseRepo_id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    
    
            return view('admin.settleReverseRepo.show', compact('reverseRepo', 'officer_role'));
        }
    
}
