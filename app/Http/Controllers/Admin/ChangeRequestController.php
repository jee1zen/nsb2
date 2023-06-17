<?php

namespace App\Http\Controllers\Admin;

use App\ChangeRequest;
use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeRequestController extends Controller
{
    public function index(){

        $officer = Auth::user();
        $officer_role = $officer->roles()->first();

        if($officer_role->id==5 || $officer_role->id==6 ){

            $changes = ChangeRequest::where('status',0)->get();
        }

        return view('admin.changes.index', compact('changes', 'officer_role'));
    }

    public function show($id)
    {
        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();

        $change = ChangeRequest::findOrFail($id);


        return view('admin.changes.show', compact('change', 'officer_role'));
    }



    public function process(Request $request)
    {


        $officer = Auth::user();
        $officer_role = Auth::user()->roles()->first();


        $client = Client::find($request->client_id);
       
     
        $change_id = $request->change_id;

        $change = ChangeRequest::findOrFail($change_id);
       

        if($change->title_state==1){
            $temp_title = $client->title;
            $client->title = $change->title;
            $change->title =$temp_title;
        }

        
        if($change->name_state==1){
            $temp_name = $client->name;
            $client->name = $change->name;
            $client->user->name = $change->name;
            $change->name =$temp_name;
         
        }
        if($change->address_state==1){

            $temp_address_line_1 = $client->address_line_1;
            $client->address_line_1 = $change->address_line_1;
            $change->address_line_1 =$temp_address_line_1;

            $temp_address_line_2 = $client->address_line_2;
            $client->address_line_2 = $change->address_line_2;
            $change->address_line_2 =$temp_address_line_2;

            $temp_address_line_3 = $client->address_line_3;
            $client->address_line_3 = $change->address_line_3;
            $change->address_line_3 =$temp_address_line_3;  
        }

        if($change->correspondence_address_state==1){


            $temp_correspondence_address_line_1 = $client->correspondence_address_line_1;
            $client->correspondence_address_line_1 = $change->correspondence_address_line_1;
            $change->correspondence_address_line_1 =$temp_correspondence_address_line_1;

            $temp_correspondence_address_line_2 = $client->correspondence_address_line_2;
            $client->correspondence_address_line_2 = $change->correspondence_address_line_2;
            $change->correspondence_address_line_2 =$temp_correspondence_address_line_2;

            $temp_correspondence_address_line_3 = $client->correspondence_address_line_3;
            $client->correspondence_address_line_3 = $change->correspondence_address_line_3;
            $change->correspondence_address_line_3 =$temp_correspondence_address_line_3;


        }

        if($change->nic_state ==1){


            $temp_nic = $client->nic;
            $client->nic = $change->nic;
            $change->nic =$temp_nic;

            $temp_nic_front = $client->nic_front;
            $client->nic_front = $change->nic_front;
            $change->nic_front =$temp_nic_front;

            $temp_nic_back = $client->nic_back;
            $client->nic_back = $change->nic_back;
            $change->nic_back =$temp_nic_back;

            $temp_passport = $client->passport;
            $client->passport = $change->passport;
            $change->passport =$temp_passport;


        }


     
        


     

        $change->status =1;
        $change->officer_id = $officer->id;
        $client->user->save();
        $change->save();
        $client->save();

    

       return redirect()->route('admin.changes.index');

    }



}
