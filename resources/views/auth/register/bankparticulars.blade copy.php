<div class="form-card ">
    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">Bank Particulars:</h2>
        </div>
        <div class="col-5">
            <h2 class="steps">Step 4 - 6</h2>
        </div>
    </div>
    <div class="col-md-12 table-responsive" id="bankParticularDiv">
        <table class="table table-bordered table-hover table-sortable" id="tab_logic">
            <thead style="color:black; font-wight:bolder;">
                <tr >
                    <th class="text-center ">
                        
                        A/C Type
                    </th>
                    <th class="text-center ">
                        
                        Holders Name
                    </th>
                    <th class="text-center">
                        Bank Name
                    </th>
                    <th class="text-center">
                       Branch
                    </th>
                    <th class="text-center">
                        Account No
                    </th>
                    <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr id='addr0' data-id="0" class="hidden" style="cursor: move;">
                    <td data-name="AccountyType">
                        <select name="accountType[]" class="accountType">
                            <option value="">Select Option</option>
                            <option value="Individual">Individual</option>
                            <option value="Joint">Joint</option>
                        </select>
                    </td>
                    <td data-name="holder_name">
                        <input type="text" name='holder_name[]' placeholder='Holder Name' class="form-control accOwner"  class="fieldRequired"/>
                    </td>
                    <td data-name="bank">
                        <select type="text" name='bank[]'  placeholder='Bank Name'   class="form-control bank" class="fieldRequired">
                          <option value="0">Select Bank</option>
                           @if($banks) 
                            @foreach ($banks as $bank)
                                <option value="{{$bank->name}}">{{$bank->name}}</option>
                            @endforeach
                           @endif 
                        </select>
                    </td>
                    <td data-name="branch">
                        <select type="text" name='branch[]' placeholder='Branch'   class="form-control branch" >
                            <option value="0">Select Branch</option>
                        </select>   
                    </td>
                   
                    <td data-name="Account No">
                        <input type="text" name='accountno[]' placeholder='Account no' class="form-control acc" />
                    </td>
                    <td data-name="del">
                        <button name="del0" type="button" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></button>
                    </td>
                </tr>
            </tbody>
        </table>
        <a id="add_row" class="btn btn-primary float-right">Add More</a>
    </div>
    <br>
</div>