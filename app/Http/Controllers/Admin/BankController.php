<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Bank;
use App\Branch;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $banks = Bank::all();

       return view('admin.banks.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('admin.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
         'name'=>'required'
            
        ]);

        $bank = new Bank;
        $bank->name = $request->name;
        $bank->save();
       
        return redirect()->route('admin.banks.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $bank = Bank::findOrFail($id);

       return view('admin.banks.edit',compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
               
           ]);
        $bank = Bank::findOrFail($id);
        $bank->name = $request->name;
        $bank->save();

        return redirect()->route('admin.banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
    }

    public function addBranches($id){

        $bank = Bank::findOrFail($id);



        return view('admin.banks.addBranches',compact('bank'));
    
    }
    
    public function updateBranches(Request $request,$id){

        $request->validate([
            'name'=>'required'
               
           ]);


        $branch = new Branch;
        $branch->bank_id = $id;
        $branch->name = $request->name;
        $branch->save();


       return redirect()->back();



    }

    public function deleteBranch($id){
        
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->back();

    }


}
