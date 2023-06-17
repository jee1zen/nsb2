<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ReverseRepo;
use App\ReverseRepoProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReverseRepoController extends Controller
{


     //Reverse Repo
     public function reverseRepo()
     {
 
         $officer = Auth::user();
         $officer_role = Auth::user()->roles()->first();
 
         if ($officer_role->id == 5) {
 
             $reverseRepos = ReverseRepo::where('status', '=', 0)->get();
         } elseif ($officer_role->id == 6) {
 
             $reverseRepos = ReverseRepo::where('status', '=', 0)->get();
         } elseif ($officer_role->id == 7) {
 
             $reverseRepos = ReverseRepo::where('status', '=', 1)->get();
         } else {
 
             $reverseRepos = '';
         }
 
 
 
 
         return view('admin.reverseRepo.index', compact('reverseRepos', 'officer_role'));
     }
 
    public function reverseRepoShow($id)
    {
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();

        $reverseRepo = reverseRepo::findOrFail($id);


        return view('admin.reverseRepo.show', compact('reverseRepo', 'officer_role'));
    }



    public function reverseRepoProcess(Request $request)
    {


        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();


        $client_id = $request->client_id;
        $request_type = $request->request_type;
        $request_comment = $request->request_comment;
        $reverseRepo_id = $request->reverseRepo_id;

        $reverseRepo = reverseRepo::findOrFail($reverseRepo_id);


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



        // $reverseRepo = ReverseRepo::findOrFail($reverseRepo_id);


        // return view('admin.reverseRepo.show', compact('reverseRepo', 'officer_role'));

        return redirect()->route('admin.reverseRepo.index');
    }


}
