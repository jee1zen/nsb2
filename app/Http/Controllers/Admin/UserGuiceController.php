<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UserManual;
use Illuminate\Http\Request;

class UserGuiceController extends Controller
{
    
    public function userGuide(){

        $userGuide = UserManual::find(1);

     

        return view('admin.userGuide.index',compact('userGuide'));



    }
   
    public function userGuidePost(Request $request){

        $destinationPath = storage_path('app/public/uploads/');
        $userGuide = UserManual::find(1);
        $deleteBidDoc = $userGuide->doc;

        if ($request->file('doc') != '') {
            $doc = $request->file('doc');
            $doc_edit = time() . '_' . $doc->getClientOriginalName();
            if ($doc->move($destinationPath, $doc_edit)) {



                $userGuide->doc = $doc_edit;
                $userGuide->save();

            
                unlink(storage_path('app/public/uploads/' . $deleteBidDoc));
             
            }
        }

     

     return back();
        

    }
}
