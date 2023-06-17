<div class="form-card">
    <div class="row">
        <div class="col-7">
            <h2 class="fs-title">Other Details:</h2>
        </div>
        <div class="col-5">
            <h2 class="steps">Step 5 - 6</h2>
        </div>
    </div> 
    
       <label class="fieldlabels">Are you a Director or Staff of NSB Fund Management Company Ltd? </label> 
       <label class="radio-inline"><input type="radio" name="nsb_staff_fund_management" value=1 {{$client->otherDetails->nsb_staff_fund_management==1?"checked":""}}> Yes</label>
       <label class="radio-inline"><input type="radio" name="nsb_staff_fund_management" checked value=0 {{$client->otherDetails->nsb_staff_fund_management==0?"checked":""}}> No</input></label>
       <label class="fieldlabels">Are you a Director or Staff of NSB? </label> 
       <label class="radio-inline"><input type="radio" name="nsb_staff" value=1 {{$client->otherDetails->nsb_staff==1?"checked":""}}> Yes</label>
       <label class="radio-inline"><input type="radio" name="nsb_staff" checked value=0 {{$client->otherDetails->nsb_staff==0?"checked":""}}> No</label>
       <label class="fieldlabels">Are you related to any Director or Staff of NSB Fund Management Company Ltd? </label> 
       <label class="radio-inline"><input type="radio" name="related_nsb_staff" value=1 {{$client->otherDetails->related_nsb_staff==1?"checked":""}} > Yes</label>
       <label class="radio-inline"><input type="radio" name="related_nsb_staff" checked value=0 {{$client->otherDetails->related_nsb_staff==0?"checked":""}}> No</label>
       <label class="fieldlabels">If “Yes”, please state the Relationship </label> 
       <input type="text" name="relationship" placeholder="" value="{{$client->otherDetails->staff_relationship}}"  /> 
       <label class="fieldlabels">Are you a Director/Employee of another Primary Dealer/ Holding Company and/or an associate of the Primary Dealer</label> 
       <label class="radio-inline"><input type="radio" name="member_holding_company" value=1 {{$client->otherDetails->member_holding_company==1?"checked":""}} > Yes</label>
       <label class="radio-inline"><input type="radio" name="member_holding_company" checked value=0 {{$client->otherDetails->member_holding_company==1?"checked":""}} > No</label>
       <label class="fieldlabels">If yes, please state the Prior written concern </label> 
       <input type="text" name="state" placeholder=""  value="{{$client->otherDetails->member_holding_company_state}}" /> 

       <div id="notification_DIV">
        <div class="row">
           <div class="col-md-12">
               <h3>Preferred Real-Time Notification Method</h3>

           </div>
           <div class="col-md-12">
            <table class="table table-striped table-responsive">
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check pull-left" >
                                <label class="form-check-label" style="margin-top: 2.7em" >
                                    <input class="form-check-input" type="checkbox" name="notification_by_email" id="notification_by_email" value="notification_by_email" {{$client->realTimeNotification->on_email==1?"checked":""}}> 
                                    Email
                                </label>
                            </div>   
                        </td>
                        <td>
                            <input type="text" name="notification_email" id="notification_email" class="form-control"  value="{{$client->realTimeNotification->email}}" style="margin-top: 2.5em">
                        </td>
    
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check pull-left" >
                                <label class="form-check-label" style="margin-top: 2.7em" >
                                    <input class="form-check-input" type="checkbox" name="notification_by_mobile" id="notification_by_phone_no" value="notification_by_mobile" {{$client->realTimeNotification->on_mobile==1?"checked":""}}> 
                                    Mobile No
                                </label>
                            </div>   
                        </td>
                        <td>
                            <input type="text" name="notification_mobile" id="notification_mobile" class="form-control" value="{{$client->realTimeNotification->mobile}}" style="margin-top: 2.5em">
                        </td>
    
                    </tr>
                    <tr>
                        <td colspan="2">
                            <i> if you tick none , No  <b>Real-Time</b> notification will be available for you from CBSL </i>
                        </td>
                    </tr>
                
                </tbody>
            
            </table>
           </div>

        </div>

       </div>

</div> 