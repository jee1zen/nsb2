<?php

namespace App\Http\Controllers\Reset;

use App\Bank;
use App\BankParticular;
use App\Branch;
use App\Client;
use App\EmploymentDetails;
use App\Http\Controllers\Controller;
use App\Investment;
use App\InvestmentType;
use App\JointHolder;
use App\KYCJointForm;
use App\OtherDetails;
use App\Process;
use App\RealTimeNotificationSetting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetController extends Controller
{
    
    public function index($id){

        $client = Client::findorFail($id);


        $investment_types = InvestmentType::all(); 
        $banks = Bank::orderBy('name', 'ASC')->with('branches')->get();  
        $banksJson = $banks->toJson();
        $branches= Branch::orderBy('name', 'ASC')->get();

    
        return view('reset.reset',compact('investment_types','banks','banksJson','client','id'));
    }

    public function post(Request $request,$id){
    //  dd($request->all());

        DB::beginTransaction();
        try {

            // $this->validator($request->all())->validate();
            User::where('id',$id)->update([
                    'name' => $request->name,
                    'email' => $request->email]);
         
        if($request->nationality=="other"){

            $nationality = $request->other_nationality;
        }else{
            $nationality = 'Sri Lankan';  
        }




            
            Client::where('id',$id)->update([
                'name'=>$request->name,
                'name_by_initials'=>$request->name_initials,
                'dob'=>$request->dob,
                'nic'=>$request->nic,
                'address_line_1'=>$request->address_line_1,
                'address_line_2'=>$request->address_line_2,
                'address_line_3'=>$request->address_line_3,
                'correspondence_address_line_1'=>$request->corresponding_address_line_1,
                'correspondence_address_line_2'=>$request->corresponding_address_line_2,
                'correspondence_address_line_3'=>$request->corresponding_address_line_3,
                'client_type' => $request->client_type,
                'title'=>$request->title,
                'nationality'=>$nationality,
                'telephone'=>$request->telephone,
                'mobile'=>$request->full_mobile,
                'joint_permission'=>$request->joint_permission
            ]);

            $destinationPath = storage_path('app/public/uploads/');

        

           if($request->hasFile('signature')){
            $signature = $request->file('signature');
            $signature_name = time() . '_' . $signature->getClientOriginalName();
            $signature->move($destinationPath, $signature_name);

            Client::where('id',$id)->update([
            
                'signature'=>$signature_name,
            ]);

           }



          


            //billing proof... save
            if($request->hasFile('billing_proof')){
                                                    
                $billing_proof = $request->file('billing_proof');
                $billing_proof_name = time() . '_' . $billing_proof->getClientOriginalName();
                $billing_proof->move($destinationPath,$billing_proof_name);

                Client::where('id',$id)->update([
            
                    'billing_proof'=>$billing_proof_name,
                ]);
        

            }

            //profile_pic... save
            if($request->hasFile('pro_pic')){

                $pro_pic = $request->file('pro_pic');
                $pro_pic_name = time() . '_' . $pro_pic->getClientOriginalName();
                $pro_pic->move($destinationPath,$pro_pic_name);

                Client::where('id',$id)->update([
            
                    'pro_pic'=>$pro_pic_name,
                ]);
        

            }




        if($request->nationality=="other"){

            // AuthorizedPerson::create([
            //     'client_id'=>$user_id,
            //     'name'=>$request->authorized_name,
            //     'address'=>$request->authorized_address,
            //     'nic'=>$request->authorized_nic,
            //     'telephone'=>$request->authorized_telephone,
            // ]);

            if($request->hasFile('passport')){
            $passport = $request->file('passport');
            $passport_name = time() . '.' . $passport->extension();
            $passport->move($destinationPath, $passport_name);

            Client::where('id',$id)->update([
                'passport'=>$passport_name
                
            ]);
        }

        }else{
            if($request->hasFile('nic_front')){
            $nic_front = $request->file('nic_front');
            $nic_front_name = time() . '_' . $nic_front->getClientOriginalName();
            $nic_front->move($destinationPath, $nic_front_name);
            Client::where('id',$id)->update([
                'nic_front'=>$nic_front_name,
               
            ]);

            }

            if($request->hasFile('nic_back')){
            $nic_back = $request->file('nic_back');
            $nic_back_name = time() . '_' . $nic_back->getClientOriginalName();
            $nic_back->move($destinationPath, $nic_back_name);
            Client::where('id',$id)->update([
                'nic_back'=>$nic_back_name,
               
            ]);

        }

           

        }

    

        $client = Client::find($id);
      






        if($request->client_type!=3){
            EmploymentDetails::where('id',$id)->update([
           
            'occupation'=>$request->emp_occupation,
            'company_name'=>$request->emp_company_name,
            'company_address'=>$request->emp_company_address,
            'telephone'=>$request->emp_company_telephone,
            'fax'=>$request->emp_fax,
            'nature'=>$request->emp_nature,
        ]);
        }else{
            EmploymentDetails::where('id',$id)->update([
             
                'occupation'=>$request->occupation,
                'company_name'=>$request->company_name,
                'company_address'=>$request->company_address_line_1.' '.$request->company_address_line_2.' '.$request->company_address_line_3,
                'telephone'=>$request->company_telephone_1,
                'fax'=>$request->company_fax_1,
                'nature'=>$request->company_nature_of_business,
            ]);

        }

    
    
        if($request->client_type==2){

            Client::where('id',$id)->update([
                'joint_permission'=>$request->joint_permission,
            
            ]);


            $joint_signature_array = $request->file('joint_signature');
            $joint_nic_front_array = $request->file('joint_nic_front');
            $joint_nic_back_array = $request->file('joint_nic_back');
            $joint_passport_array = $request->file('joint_passport');
            $joint_pro_pic_array = $request->file('joint_pro_pic');
        
          

            for($i=0;$i< count($request->jointHolder_info_id);$i++){

                $password_joint = Str::random(8);
                $kyc_link_1 = Str::random(15);

                $jointHolder =JointHolder::findorFail($request->jointHolder_info_id[$i]);

                // dd($request->jointHolder_info_id[$i]);
                $joint_user  = User::findOrFail($jointHolder->user_id);
                //  dd($joint_user->id);


                User::where('id',$joint_user->id)->update([
                    'email'=>$request->joint_email[$i],
                    'name'=>$request->joint_name[$i],
                   

                ]);
                // $user =User::findorFail($request->jointHolder_info_id[$i]);

                $joint_user->roles()->attach(10);
                $link = $joint_user->id.$kyc_link_1;
                

                if($request->joint_nationality[$i]=="other"){
                    $joint_nationality = $request->joint_nationality_other[$i];
                }else{
                    $joint_nationality = 'Sri Lankan';  
                }

             JointHolder::where('id',$request->jointHolder_info_id[$i])->update([
                    'client_id'=>$id,
                    'user_id'=>$jointHolder->user_id,
                    'name'=> $request->joint_name[$i],
                    'name_by_initials'=>$request->joint_name_initials[$i],
                    'title'=> $request->joint_title[$i],
                    'dob'=>$request->joint_dob[$i],
                    'nic'=>$request->joint_nic[$i],
                    'nationality'=>$joint_nationality,
                    'email'=>$request->joint_email[$i],
                    'address_line_1'=>$request->joint_address_line_1[$i],
                    'address_line_2'=>$request->joint_address_line_2[$i],
                    'address_line_3'=>$request->joint_address_line_3[$i],
                    'correspondence_address_line_1'=>$request->joint_address_line_1[$i],
                    'correspondence_address_line_2'=>$request->joint_address_line_2[$i],
                    'correspondence_address_line_3'=>$request->joint_address_line_3[$i],
                    'telephone'=>$request->joint_telephone[$i],
                    'mobile'=>$request->full_joint_mobile[$i],
                    'occupation'=>$request->joint_emp_occupation[$i],
                    'company_name'=>$request->joint_emp_company_name[$i],
                    'company_address'=>$request->joint_emp_company_address[$i],
                    'company_telephone'=>$request->joint_emp_company_telephone[$i],
                    'company_fax'=>$request->joint_emp_fax[$i],
                    'company_nature'=>$request->joint_emp_nature[$i],
                    'kyc_link' => $link
                   

                ]);

                if($joint_signature_array!=null){


                    if($joint_signature_array[$i]!=null){

                        $joint_signature = $joint_signature_array[$i];
                        $joint_signature_name = time() . '_' . $joint_signature->getClientOriginalName();
                        $joint_signature->move($destinationPath, $joint_signature_name);
                        JointHolder::where('id',$request->jointHolder_info_id[$i])->update([
                    
                            'signature'=>$joint_signature_name,
                        ]);
                     }


                }
        
              
             

                if($joint_pro_pic_array!=null){
                    
                       
                    if(isset($joint_pro_pic_array[$i])){

                        $joint_pro_pic = $joint_pro_pic_array[$i];
                        $joint_pro_pic_name = time() . '_' . $joint_pro_pic->getClientOriginalName();
                        $joint_pro_pic->move($destinationPath, $joint_pro_pic_name);

                        JointHolder::where('id',$request->jointHolder_info_id[$i])->update([
                
                            'pro_pic'=>$joint_pro_pic_name,
                        ]);

                    }

                  
                }

               
        
        
        
                if($request->joint_nationality[$i]=="other"){
                    
                    if($joint_passport_array!=null){
                        
                        if(isset($joint_passport_array[$i])){

                                $joint_passport = $joint_passport_array[$i];
                                $joint_passport_name = time() . '_' . $joint_passport->getClientOriginalName();
                                $joint_passport->move($destinationPath, $joint_passport_name);
                        
                                JointHolder::where('id',$request->jointHolder_info_id[$i])->update([
                                    'passport'=>$joint_passport_name
                                    
                                ]);

                        }
                        
                    }
            
                }else{
                    
                    if($joint_nic_front_array!=null && $joint_nic_back_array!=null ){

                        if(isset($joint_nic_front_array[$i])){

                                $joint_nic_front = $joint_nic_front_array[$i];
                                $joint_nic_front_name = time() . '_' . $joint_nic_front->getClientOriginalName();
                                $joint_nic_front->move($destinationPath, $joint_nic_front_name);
                                JointHolder::where('id',$request->jointHolder_info_id[$i])->update([
                                    'nic_front'=>$joint_nic_front_name
                                ]);

                            }
                        
                            if(isset($joint_nic_back_array[$i])){

                                $joint_nic_back = $joint_nic_back_array[$i];
                                $joint_nic_back_name = time() . '_' . $joint_nic_back->getClientOriginalName();
                                $joint_nic_back->move($destinationPath, $joint_nic_back_name);
                
                                JointHolder::where('id',$request->jointHolder_info_id[$i])->update([
                                    'nic_back'=>$joint_nic_back_name,
                                ]);

                            }

                    }

                }


    



            }
        }

        if($request->client_type==3){


            // $cp_signature_array = $request->file('cp_signature');
            // $cp_nic_front_array = $request->file('cp_nic_front');
            // $cp_nic_back_array = $request->file('cp_nic_back');
            // $cp_passport_array = $request->file('cp_passport');
            // $natural_signature_array = $request->file('natural_signature');
        
        
            //     $company = Company::create([

            //         'id'=>$user->id,
            //         'company_type'=>$request->type_of_company,
            //         'name'=>$request->company_name,
            //         'address_line_1'=>$request->company_address_line_1,
            //         'address_line_2'=>$request->company_address_line_2,
            //         'address_line_3'=>$request->company_address_line_3,
            //         'business_registration_no'=>$request->company_br_no,
            //         'nature_of_business'=>$request->company_nature_of_business,
            //         'telephone_1'=>$request->company_telephone_1,
            //         'email_1'=>$request->company_email,
            //         'fax_1'=>$request->company_fax_1,
            //         'business_registraton'=>'none',
            //         'business_act'=>'none',
            //         'trust_deed'=>'none',
            //         'board_resolution'=>'none',
            //         'society_constitution'=>'none',
            //         'power_of_attorney'=>'none',
            //         'partners_kyc'=>'none',
            //         'proprietors_kyc'=>'none',
            //         'certificate_of_registration'=>'none',
            //         'company_coi'=>'none',

                
            //     ]);

            // if($request->file('company_br')){
            //     $company_br = $request->file('company_br');
            //     $company_br_name = time() . '_' . $company_br->getClientOriginalName();
            //     if($company_br->move($destinationPath, $company_br_name)){

            //         Company::where('id',$user->id)->update([
            //             'business_registraton'=>$company_br_name
                        
            //         ]);

            //     }
            // }
            // if($request->file('company_act')){
            //     $company_act = $request->file('company_act');
            //     $company_act_name = time() . '_' . $company_act->getClientOriginalName();
            //     if($company_act->move($destinationPath, $company_act_name)){

            //         Company::where('id',$user->id)->update([
            //             'business_act'=>$company_act_name
                        
            //         ]);

            //     } 
            // }
            // if($request->file('company_trust_deed')){
            //     $company_trust_deed = $request->file('company_trust_deed');
            //     $company_trust_deed_name = time() . '_' . $company_trust_deed->getClientOriginalName();
            //     if($company_trust_deed->move($destinationPath, $company_trust_deed_name)){

            //         Company::where('id',$user->id)->update([
            //             'trust_deed'=>$company_trust_deed_name
                        
            //         ]);

            //     }
            // } 

            // if($request->file('company_board_resolution')){
            //     $company_board_resolution = $request->file('company_board_resolution');
            //     $company_board_resolution_name = time() . '_' . $company_board_resolution->getClientOriginalName();
            //     if($company_board_resolution->move($destinationPath, $company_board_resolution_name)){

            //         Company::where('id',$user->id)->update([
            //             'board_resolution'=>$company_board_resolution_name
                        
            //         ]);

            //     } 
            // }


            // if($request->file('company_society_constitution')){
            //     $company_society_constitution = $request->file('company_society_constitution');
            //     $company_society_constitution_name = time() . '_' . $company_society_constitution->getClientOriginalName();
            //     if($company_society_constitution->move($destinationPath, $company_society_constitution_name)){

            //         Company::where('id',$user->id)->update([
            //             'society_constitution'=>$company_society_constitution_name
                        
            //         ]);

            //     } 
            // }

            // if($request->file('company_power_of_attorney')){
            //     $company_power_of_attorney = $request->file('company_power_of_attorney');
            //         $company_power_of_attorney_name = time() . '_' . $company_power_of_attorney->getClientOriginalName();
            //         if($company_power_of_attorney->move($destinationPath, $company_power_of_attorney_name)){

            //             Company::where('id',$user->id)->update([
            //                 'power_of_attorney'=>$company_power_of_attorney_name
                            
            //             ]);

            //         }
            //     } 

            //     if($request->file('partners_kyc')){
            //         $company_partners_kyc = $request->file('partners_kyc');
            //         $company_partners_kyc_name = time() . '_' . $company_partners_kyc->getClientOriginalName();
            //         if($company_partners_kyc->move($destinationPath, $company_partners_kyc_name)){

            //             Company::where('id',$user->id)->update([
            //                 'partners_kyc'=>$company_partners_kyc_name
                            
            //             ]);

            //     }
            //     } 
                
            //     if($request->file('proprietors_kyc')){
            //     $company_proprietors_kyc = $request->file('proprietors_kyc');
            //     $company_proprietors_kyc_name = time() . '_' . $company_proprietors_kyc->getClientOriginalName();
            //     if($company_proprietors_kyc->move($destinationPath, $company_proprietors_kyc_name)){

            //         Company::where('id',$user->id)->update([
            //             'proprietors_kyc'=>$company_proprietors_kyc_name
                        
            //         ]);

            //     } 
            // }

            // if($request->file('certificate_of_registration')){
            //     $company_certificate_of_registration = $request->file('certificate_of_registration');
            //     $company_certificate_of_registration_name = time() . '_' . $company_certificate_of_registration->getClientOriginalName();
            //     if($company_certificate_of_registration->move($destinationPath, $company_certificate_of_registration_name)){

            //         Company::where('id',$user->id)->update([
            //             'certificate_of_registration'=>$company_certificate_of_registration_name
                        
            //         ]);

            //     } 
            // } 

            // if($request->file('company_coi')){
            //     $company_company_coi = $request->file('company_coi');
            //     $company_company_coi_name = time() . '_' . $company_company_coi->getClientOriginalName();
            //     if($company_company_coi->move($destinationPath, $company_company_coi_name)){

            //         Company::where('id',$user->id)->update([
            //             'company_coi'=>$company_company_coi_name
                        
            //         ]);

            //     } 
            // } 

            // if($request->makeSignatureB){

            //     $startCount = 1;
            
            //     Client::where('id',$user_id)->update([
            //         'is_signatureB'=>1
                    
            //     ]);
        
            // }else{
            //     $startCount = 0;
            // }


            // for($i=$startCount;$i< count($request->cp_name);$i++){

            //     $password_signature = Str::random(8);

            //     $sig_name = $request->cp_name[$i];
            //     $sig_email = $request->cp_email[$i];

            //         $userSignature = User::create([
            //             'name' => $sig_name,
            //             'email' =>  $sig_email,
            //             'password' => Hash::make($password_signature),

            //         ]);


            //         // Mail::send('emails.welcome', ['name' => $sig_name,'email'=>$sig_email,'password'=>$password_signature], function($message) use($sig_name,$sig_email){
            //         //     $message->to($sig_email);
            //         //     $message->subject('Welcome to NSB FMC '.$sig_name);
            //         // });
            



            //     if($request->cp_type[$i]=='A'){
            //         $userSignature->roles()->attach(8);
            //     }

            //     if($request->cp_type[$i]=='B'){
            //         $userSignature->roles()->attach(9);
            //     }

            //     if($request->cp_nationality[$i]=="other"){
            //             $cp_nationality = $request->cp_nationality_other[$i];
            //         }else{
            //             $cp_nationality = 'Sri Lankan';  
            //         }

            //         $companySignature=CompanySignature::create([
            //             'client_id'=>$user_id,
            //             'user_id'=>$userSignature->id,
            //             'password'=>$password_signature,
            //             'name'=> $request->cp_name[$i],
            //             'occupation'=>$request->cp_occupation[$i],
            //             'title'=>$request->cp_title[$i],
            //             'dob'=>$request->cp_dob[$i],
            //             'nic'=>$request->cp_nic[$i],
            //             'nationality'=>$cp_nationality,
            //             'email'=>$request->cp_email[$i],
            //             'address_line_1'=>$request->cp_address_line_1[$i],
            //             'address_line_2'=>$request->cp_address_line_2[$i],
            //             'address_line_3'=>$request->cp_address_line_3[$i],
            //             'correspondence_address_line_1'=>$request->cp_address_line_1[$i],
            //             'correspondence_address_line_2'=>$request->cp_address_line_2[$i],
            //             'correspondence_address_line_3'=>$request->cp_address_line_3[$i],
            //             'telephone'=>$request->cp_telephone[$i],
            //             'mobile'=>$request->cp_mobile[$i],
            //             'nic_front'=>'none',
            //             'nic_back'=>'none',
            //             'signature'=>'none',
            //             'type'=>$request->cp_type[$i],
            //         ]);

            //         if($cp_signature_array!=null){

            //             $cp_signature = $cp_signature_array[$i];
            //             $cp_signature_name = time() . '_' . $cp_signature->getClientOriginalName();
            //             $cp_signature->move($destinationPath, $cp_signature_name);
            //         }
            
            //         CompanySignature::where('id',$companySignature->id)->update([
                    
            //             'signature'=>$cp_signature_name,
            //         ]);
            
            
            
            //     if($request->cp_nationality[$i]=="other"){
                    
            //         if($cp_passport_array!=null){
                        
            //             $cp_passport = $cp_passport_array[$i];
            //             $cp_passport_name = time() . '_' . $cp_passport->getClientOriginalName();
            //             $cp_passport->move($destinationPath, $cp_passport_name);
                
            //             CompanySignature::where('id',$companySignature->id)->update([
            //                 'passport'=>$cp_passport_name
                            
            //             ]);
            //         }
            
            //     }else{
                    
            //         if($cp_nic_front_array!=null && $cp_nic_back_array!=null ){

            //                 $cp_nic_front = $cp_nic_front_array[$i];
            //                 $cp_nic_front_name = time() . '_' . $cp_nic_front->getClientOriginalName();
            //                 $cp_nic_front->move($destinationPath, $cp_nic_front_name);
                    
            //                 $cp_nic_back = $cp_nic_back_array[$i];
            //                 $cp_nic_back_name = time() . '_' . $cp_nic_back->getClientOriginalName();
            //                 $cp_nic_back->move($destinationPath, $cp_nic_back_name);
                
            //             CompanySignature::where('id',$companySignature->id)->update([
            //                 'nic_front'=>$cp_nic_front_name,
            //                 'nic_back'=>$cp_nic_back_name,
            //             ]);
            
            //         }
            //     }

            // }

            // for($i=0;$i<count($request->bene_name);$i++){

            //     Benefactor::create([
 
            //         'client_id' => $user->id,
            //         'title'    =>$request->bene_title[$i],
            //         'name'     =>$request->bene_name[$i],
            //         'designation' => $request->bene_designation[$i],
            //         'nic'       =>$request->bene_nic[$i],
            //         'citizenship'   => $request->bene_citizenship[$i],
            //         'dob'       => $request->bene_dob[$i],
            //         'address_line_1' =>$request->bene_address_line1[$i],
            //         'address_line_2' =>$request->bene_address_line2[$i],
            //         'address_line_3' =>$request->bene_address_line3[$i],
            //         'source_of_beneficial_ownership' =>$request->bene_source_of_beneficial[$i],
            //         'pep' => $request->bene_pep[$i]

            //     ]);


            // }

            // for($i=0;$i<count($request->natural_name);$i++){

            //     $naturalPerson=NaturalPerson::create([
 
            //         'client_id'   => $user->id,
            //         'title'       =>$request->natural_title[$i],
            //         'name'        =>$request->natural_name[$i],
            //         'designation' => $request->natural_designation[$i],
            //         'nic'         =>$request->natural_nic[$i],
            //         'mobile'      => $request->natural_mobile[$i],
            //         'signature'   => 'none',

            //     ]);

            //     if($natural_signature_array!=null){

            //         $natural_signature = $natural_signature_array[$i];
            //         $natural_signature_name = time() . '_' . $cp_signature->getClientOriginalName();
            //         $natural_signature->move($destinationPath, $natural_signature_name);

            //         $naturalPerson->signature = $natural_signature_name;
            //         $naturalPerson->save();
            //     }
              
    
            // }

            // //if signature B is Key Contact Person
            // if($request->chk_key_contact_b){
            //     ContactPerson::create([

            //         'client_id'=>$user_id,
            //         'name'=>$request->cp_name[0],
            //         'designation'=>$request->cp_occupation[0],
            //         'contact_no'=>$request->cp_mobile[0],
            //         'email'=>$request->cp_email[0],
            //     ]);

            // }

            // //if signature A is key Contact Person
            
            // if($request->chk_key_contact_a){

            //     ContactPerson::create([

            //         'client_id'=>$user_id,
            //         'name'=>$request->cp_name[1],
            //         'designation'=>$request->cp_occupation[1],
            //         'contact_no'=>$request->cp_mobile[1],
            //         'email'=>$request->cp_email[1],

            //     ]);


            // }
                    


            //     for($i=0;$i<count($request->contact_name);$i++){
            //         if($request->contact_name[$i]!=null){  
            //         ContactPerson::create([
            //             'client_id'=>$user_id,
            //             'name'=>$request->contact_name[$i],
            //             'designation'=> $request->contact_designation[$i],
            //             'contact_no'=>$request->contact_contact_no[$i],
            //             'email'=>$request->contact_email[$i],
            //         ]);
            //     }
            
            // }




        }

        BankParticular::where('client_id',$id)->delete();

        for($i=0;$i<count($request->accountType);$i++){
            if($request->accountType[$i]!=null){  
                BankParticular::create([
                    'client_id'=>$id,
                    'name'=>$request->holder_name[$i],
                    'bank_name'=>isset($request->bank[$i])?$request->bank[$i]:"",
                    'branch'=> isset($request->branch[$i])?$request->branch[$i]:"",
                    'Account_type'=>$request->accountType[$i],
                    'account_no'=>$request->accountno[$i],
                ]);
            }
        
        }


        OtherDetails::where('id',$id)->update([

            'nsb_staff_fund_management' => $request->nsb_staff_fund_management,
            'nsb_staff'=>$request->nsb_staff,
            'related_nsb_staff'=>$request->related_nsb_staff,
            'staff_relationship'=>$request->relationship,
            'member_holding_company'=>$request->member_holding_company,
            'member_holding_company_state'=>$request->state,

        ]); 

        RealTimeNotificationSetting::where('id',$id)->update([
            
            
            'on_email'=>$request->notification_by_email==true?1:0,
            'email'=>$request->notification_email, 
            'on_mobile'=>$request->notification_by_mobile==true?1:0,
            'mobile'=>$request->notification_mobile,

        ]);

        // $officers =  User::select('email','role_id')->join('role_user','users.id','=','role_user.user_id')
        //              ->where('role_id',5)->where('role_id',6)->get();

        $officers = DB::select('Select users.email From users inner join role_user on  users.id = role_user.user_id  where role_id = 5 or role_id =6 ');


       


         $clientInformation = Client::findorFail($id);
         $cilentInfo = [
             'title'=>$clientInformation->title,
             'name' => $clientInformation->name,
             'phone' =>$clientInformation->mobile,
             'investment'=>"",
             
        
         ];   


                     
        foreach($officers as $officer){
            $officerEmail = $officer->email;


            Mail::send('emails.resetNotification', [
                'title'=>$clientInformation->title,
                'name' => $clientInformation->name,
                'phone' =>$clientInformation->mobile,
                  ],function($message) use($officerEmail){
                $message->to($officerEmail);
                $message->subject('Notification Client Reset Profile at NSB FMC ');
            });


      

        }

       $client->status = 1;
       $client->save();


        Process::create([

            'user_id' => $client->id,
            'client_id' => $client->id,
            'previous_state' => 100,
            'current_state' =>  1,
            'comment' => "Client refilled the application forms and submitted for approval."

        ]);


    DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return $e->getMessage();
    }

      $mainUser = User::findorFail($id);
      Auth::login($mainUser);
      return redirect()->route('login');


    }

    public function reason($id){

        $client = Client::findOrFail($id);
        $process = Process::where('client_id',$client->id)->where('current_state',100)->latest()->first();
        return view('reset.message',compact('process'));

    }
}