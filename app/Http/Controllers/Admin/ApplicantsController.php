<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\EmploymentDetails;
use App\GovernmentVerifyDoc;
use App\Http\Controllers\Controller;
use App\InvestmentType;
use App\JointHolder;
use App\MoneyLaunderingVerifyDoc;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ApplicantsController extends Controller
{
    public function index()
    {

        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $officer_role = Auth::user()->roles()->first();

        $clients = Client::all()->sortByDesc("create_at");

        return view('admin.applicants.index', compact('clients', 'officer_role'));
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employmentDetails = Client::find($client->id)->employmentDetails;
        $jointHolders = Client::find($client->id)->jointHolders;
        return view('admin.clients.edit', compact('client', 'employmentDetails', 'jointHolders'));
    }



    public function update(Request $request, $id)
    {

        $client = Client::findorFail($id);
        $client->name = $request->name;
        $client->dob = $request->dob;
        $client->nic = $request->nic;


        $deleteNicFront = $client->nic_front;
        $deleteNicBack = $client->nic_back;
        $deleteSignatrure = $client->signature;
        $deletePassport = $client->passport;


        $client->save();

        $destinationPath = storage_path('app/public/uploads/');

        // if ($request->file('verification_from_GOV') != '') {
        //     $gov_verification = $request->file('verification_from_GOV');
        //     $gov_verification_name = time() . '_' . $gov_verification->getClientOriginalName();
        //     if ($gov_verification->move($destinationPath, $gov_verification_name)) {



        //         $client->verification_from_GOV = $gov_verification_name;
        //         $client->save();


        //         // unlink(storage_path('app/public/uploads/' . $deleteNicFront));
        //     }
        // }

        // if ($request->file('money_laundering_verification') != '') {
        //     $money_laundering_verification = $request->file('money_laundering_verification');
        //     $money_laundering_verification_name = time() . '_' . $money_laundering_verification->getClientOriginalName();
        //     if ($money_laundering_verification->move($destinationPath, $money_laundering_verification_name)) {



        //         $client->money_laundering_verification = $money_laundering_verification_name;
        //         $client->save();


        //         // unlink(storage_path('app/public/uploads/' . $deleteNicFront));
        //     }
        // }






        if ($request->file('nic_front') != '') {
            $nic_front = $request->file('nic_front');
            $nic_front_edit = time() . '_' . $nic_front->getClientOriginalName();
            if ($nic_front->move($destinationPath, $nic_front_edit)) {



                $client->nic_front = $nic_front_edit;
                $client->save();


                unlink(storage_path('app/public/uploads/' . $deleteNicFront));
            }
        }

        if ($request->file('nic_back') != '') {
            $nic_back = $request->file('nic_back');
            $nic_back_edit = time() . '_' . $nic_back->getClientOriginalName();
            if ($nic_back->move($destinationPath, $nic_back_edit)) {

                $client->nic_back = $nic_back_edit;
                $client->save();


                unlink(storage_path('app/public/uploads/' . $deleteNicBack));
            }
        }


        if ($request->file('passport') != '') {
            $passport = $request->file('passport');
            $passport_edit = time() . '_' . $passport->getClientOriginalName();
            if ($passport->move($destinationPath, $passport_edit)) {

                $client->passport = $passport_edit;
                $client->save();


                unlink(storage_path('app/public/uploads/' . $deletePassport));
            }
        }


        if ($request->file('signature') != '') {
            $signature = $request->file('signature');
            $signature_edit = time() . '_' . $signature->getClientOriginalName();
            if ($signature->move($destinationPath, $signature_edit)) {

                $client->signature = $signature_edit;
                $client->save();


                unlink(storage_path('app/public/uploads/' . $deleteSignatrure));
            }
        }




        return back();
    }
    public function upload(Request $request)
    {
        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rules = array(
            'file'  => 'required',
            'title' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $date = date('m/d/Y h:i:s a', time());
        $user = Auth::user();
        $client_id = $request->client_id;
        $title = $request->title;


        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();

        $destinationPath = storage_path('app/public/uploads/');

        $image->move($destinationPath, $imageName);

        Upload::create([
            'user_id' => $user->id,
            'client_id' => $client_id,
            'file_name' => $imageName,
            'title' => $title,
        ]);


        $output = array(
            'success' => 'Video uploaded successfully',
            'video'  => '<Video width="320" height="240" controls><source src="' . asset("storage/uploads/" . $imageName) . '">video not supported in browser </video>',
        );

        return response()->json($output);
    }
    public function document(Request $request){
        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rules = array(
            'file'  => 'required|max:200000',
            'title' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $date = date('m/d/Y h:i:s a', time());
        $user = Auth::user();
        $client_id = $request->client_id;
        $title = $request->title;


        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();

        $destinationPath = storage_path('app/public/uploads/');

        $image->move($destinationPath, $imageName);

        Document::create([
            'officer_id' => $user->id,
            'client_id' => $client_id,
            'file_name' => $imageName,
            'title' => $title,
        ]);


        $output = array(
            'success' => 'document Uploaded',
            'Image'  => '<img src="' . asset("storage/uploads/" . $imageName) . '" alt="'.$title.'">',
        );

        return response()->json($output);




    }


    public function govVerifyDocUpload(Request $request,$id){

        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rules = array(
            'file'  => 'required|max:200000',
            
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $date = date('m/d/Y h:i:s a', time());
        $user = Auth::user();
    
        $title = $request->title;


        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();

        $destinationPath = storage_path('app/public/uploads/');

        $image->move($destinationPath, $imageName);

        GovernmentVerifyDoc::create([
            'officer_id' => $user->id,
            'client_id' => $id,
            'file_name' => $imageName,
            'title' => $title,
        ]);


        $output = array(
            'success' => 'document Uploaded',
            'file'  => '<a href="' . asset("storage/uploads/" . $imageName) . '" target="_blank">'.$imageName.'</a>',
        );

        return response()->json($output);


    }
    public function govVerifyDocUploadApproval(Request $request,$id){

        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rules = array(
            'file'  => 'required|max:200000',
            
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $date = date('m/d/Y h:i:s a', time());
        $user = Auth::user();
    
        $title = $request->title;


        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();

        $destinationPath = storage_path('app/public/uploads/');

        $image->move($destinationPath, $imageName);

        GovernmentVerifyDoc::create([
            'officer_id' => $user->id,
            'client_id' => $id,
            'file_name' => $imageName,
            'title' => $title,
        ]);


       
        return redirect()->back();
      


    }

    public function moneyLVDUpload(Request $request,$id){
        abort_if(Gate::denies('client_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rules = array(
            'file'  => 'required|max:200000',
            
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $date = date('m/d/Y h:i:s a', time());
        $user = Auth::user();
    
        $title = $request->title;


        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();

        $destinationPath = storage_path('app/public/uploads/');

        $image->move($destinationPath, $imageName);

        MoneyLaunderingVerifyDoc::create([
            'officer_id' => $user->id,
            'client_id' => $id,
            'file_name' => $imageName,
            'title' => $title,
        ]);


        $output = array(
            'success' => 'document Uploaded',
            'file'  => '<a href="' . asset("storage/uploads/" . $imageName) . '" target="_blank">'.$imageName.'</a>',
        );

        return response()->json($output);




    }



    public function empUpdate(Request $request, $id)
    {
        //dd($id);
        $employmentDetails = EmploymentDetails::findorFail($id);
        $employmentDetails->occupation = $request->occupation;
        $employmentDetails->company_name = $request->company_name;
        $employmentDetails->nature = $request->nature;
        $employmentDetails->telephone = $request->telephone;
        $employmentDetails->fax = $request->fax;
        $employmentDetails->save();







        return back();
    }


    public function jointUpdate(Request $request, $id)
    {
        //dd($request->all());
        $jointHolder = JointHolder::findorFail($id);
        $jointHolder->name = $request->name;
        $jointHolder->dob = $request->dob;
        $jointHolder->nic = $request->nic;
        $jointHolder->email = $request->email;
        $jointHolder->residence_address = $request->residence_address;
        $jointHolder->telephone = $request->telephone;
        $jointHolder->mobile = $request->mobile;

        $deleteNicFront = $jointHolder->nic_front;
        $deleteNicBack = $jointHolder->nic_back;
        $deleteSignatrure = $jointHolder->signature;
        $deletePassport = $jointHolder->passport;


        $jointHolder->save();


        $destinationPath = storage_path('app/public/uploads/');

        if ($request->file('joint_nic_front') != '') {

            $joint_nic_front = $request->file('joint_nic_front');
            $joint_nic_front_edit = time() . '_' . $joint_nic_front->getClientOriginalName();
            if ($joint_nic_front->move($destinationPath, $joint_nic_front_edit)) {
                $jointHolder->nic_front = $joint_nic_front_edit;
                $jointHolder->save();
                unlink(storage_path('app/public/uploads/' . $deleteNicFront));
            }
        }

        //dd('without nic front ');

        if ($request->file('joint_nic_back') != '') {

            $joint_nic_back = $request->file('joint_nic_back');
            $joint_nic_back_edit = time() . '_' . $joint_nic_back->getClientOriginalName();
            if ($joint_nic_back->move($destinationPath, $joint_nic_back_edit)) {

                $jointHolder->nic_back = $joint_nic_back_edit;
                $jointHolder->save();


                unlink(storage_path('app/public/uploads/' . $deleteNicBack));
            }
        }
        //dd('without nic back');


        if ($request->file('joint_passport') != '') {

            $joint_passport = $request->file('joint_passport');
            $joint_passport_edit = time() . '_' . $joint_passport->getClientOriginalName();
            if ($joint_passport->move($destinationPath, $joint_passport_edit)) {

                $jointHolder->passport = $joint_passport_edit;
                $jointHolder->save();


                unlink(storage_path('app/public/uploads/' . $deletePassport));
            }
        }
        // dd('without passport');

        if ($request->file('joint_signature') != '') {

            $joint_signature = $request->file('joint_signature');
            $joint_signature_edit = time() . '_' . $joint_signature->getClientOriginalName();
            if ($joint_signature->move($destinationPath, $joint_signature_edit)) {

                $jointHolder->signature = $joint_signature_edit;
                $jointHolder->save();


                unlink(storage_path('app/public/uploads/' . $deleteSignatrure));
            }
        }
        //dd('Without signature');




        return back();
    }
    public function fullProfile($id)
    {

        abort_if(Gate::denies('client_approval_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client = Client::findOrFail($id);
        $authorizedPerson = Client::find($id)->authorizedPerson;
        $employmentDetails = Client::find($id)->employmentDetails;
        $otherDetails = Client::find($id)->otherDetails;
        


        return view('admin.clients.fullProfile', compact('client', 'authorizedPerson', 'employmentDetails', 'otherDetails'));
    }

    public function clientDashboard($id){

     $client = Client::findOrFail($id);
     $investments = $client->investments()->where('invested_amount','>',0)->where('method','!=','Maturity')->get();
     $investmentTypes = InvestmentType::all();
     return view('admin.applicants.dashboard',compact('client','investmentTypes','investments'));

    }



}