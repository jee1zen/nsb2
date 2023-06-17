<div class="page-break-b">
<h2><u>Master Repurchase Agreement</u></h2>
<p>
    This Agreement is entered into on this {{$today}} between NSB Fund Management Co. Ltd a Company incorporated in Sri Lanka (Registration No. PB 795) being an authorized primary dealer and having its  registered address at  No.400,Galle Road, Colombo 03, Sri Lanka (hereinafter referred to as the “DEALER” and which shall include its successors and assigns) {{$client->title}} {{$client->name}} (NIC No  {{$client->nic}} ) of {{$client->address_line_1}},{{$client->address_line_2}},{{$client->address_line_3}} 
    @if ($client->client_type==2)
        @foreach ($client->jointHolders()->get() as $jointHolder)
           {{$jointHolder->title}} {{$jointHolder->name}} &nbsp;(NIC No  {{$jointHolder->nic}}) &nbsp;
        @endforeach
    @endif
    
    (hereinafter referred to as the "CUSTOMER" and which shall include its successors and assigns )
 (each a “Party” and together the “Parties”).

</p>
<ul class="no_bullet">
    <ul class="no_bullet">
        <h4>1.	Interpretation</h4>
        <p>For the purposes of this Agreement, the following defined terms will bear the following meanings</p>
        <p><b>"Acceleration Date"</b>means the date specified as such in the Termination Notice, being the date upon which the Repurchase Date of all Transactions shall occur as a result of the service of such Termination Notice in accordance with the terms of this Agreement;</p>
        <p><b>"Act of Insolvency"</b>means, in respect of a Party (i) the Party being unable to pay its debts as they fall due in the ordinary course of business); (ii) the Party seeking, consenting to or acquiescing in the appointment of any trustee, administrator, receiver or liquidator or analogous officer of the Party or any material part of the Party’s property, or (iii) the presentation or filing of a petition in respect of the Party in any court or before any agency alleging or for the bankruptcy, winding-up or other insolvency of the Party or any analogous proceedings not having been stayed or dismissed within 30 days of its filing </p>
        <p><b>"Agreement"</b> means this Master Repurchase Agreement together with all Transactions which form part of it </p>
        <p><b>"Amended Repurchase Price"</b> shall have the meaning ascribed thereto in Section 7</p>
        <p><b>"Business Day"</b> means a day on which DEALER is open for general business</p>
        <p><b>“CDS Account"</b>  means the account of the CUSTOMER with the central depository system for government securities (“Lanka Secure”) in which the applicable Eligible Securities are held or, as appropriate, are to be held</p>
        <p><b>“Confirmation"</b> means a confirmation issued by the DEALER substantially in the form of that appearing as Annex I hereto. </p>
        <p><b>“Default Rate” </b> means SLIBOR plus 2% per annum</p>
        <p><b>“Eligible Security”</b> means any bill, note or bond issued by the Government of Sri Lanka or by the Central Bank of Sri Lanka andany other type of security approved by the Central Bank of Sri Lanka
            that the DEALER may from time to time notify the CUSTOMER will constitute an Eligible Security for these purposes;
        </p>
        <p><b>“Income” </b>means, in respect of Purchased Securities, any coupons, interest, dividends and any other payment made by the Issuer (other than any payment in respect of principal) thereon;</p>
        <p><b>“LKR” </b>means Sri Lanka Rupees</p>
        <p>
        <b>“Market Value”</b>  means, in respect of any Securities, the prevailing value of such Securities in the market or in the event of there being no such available value, as determined in accordance with such method as may be specified in the Confirmation;
        </p>
        <p>
            <b>“Notice of Default”</b>
            means a notice by the non-defaulting party to the defaulting party   of the occurrence of an Event of Default, such notice also specifying the applicable Acceleration Date and Termination Payment Date;
        </p>
        <p>
            <b>“Notice of Termination Event”</b>
            means a notice by the non-defaulting party to the other party of the occurrence of a Termination Event, such notice also specifying the applicable Acceleration Date and Termination Payment Date;
        </p>
        
        <p>
            <b>“Purchase Date”</b> means the date specified as such in the relevant Confirmation.
        </p>
        
        <p>
            <b>“Purchase Price”</b> means the price specified as such in the relevant Confirmation.
        </p>

        <p>
            <b>“Purchased Securities”</b>
            means securities specified as such in the relevant Confirmation and shall be deemed to include any substituted Eligible Securities in terms of clause 6 hereof. 
        </p>

        <p>
            <b>“Repurchase Date”</b> means the date specified as such in the relevant Confirmation.
        </p>
        
        <p>
            <b>“Repurchase Price”</b>  means the price specified as such in the relevant Confirmation.

        </p>
        <p>
            <b>“Repurchase Transaction”</b>means a transaction whereby DEALER agrees to sell Eligible Securities (the “Purchased Securities”) to the CUSTOMER at an agreed price (the “Purchase Price”) on an agreed date (the “Purchase Date”) and the CUSTOMER simultaneously agrees to sell the Purchased Securities to DEALER for an agreed price (the “Repurchase Price”) on an agreed date (the “Repurchase Date”), subject to the terms hereof, as set out in the applicable Confirmation;
        </p>
        <p>
            <b>
                “Reverse Repurchase Transaction”
            </b>
            means a transaction whereby the CUSTOMER agrees to sell Purchased Securities to DEALER at the applicable Purchase Price on the applicable Purchase Date and DEALER simultaneously agrees to sell to the CUSTOMER the Purchased Securities for the applicable Repurchase Price on the applicable Repurchase Date, subject to the terms hereof, as set out in the applicable Confirmation.  
        </p>

        <p>
            <b>“SLIBOR”</b>
            means the Sri Lankan Interbank Offered Rate, being the rate offered in the interbank call money market for a period of one month as appearing on Reuters screen “SLIBOR” page as of 11am on the applicable day;
        </p>

        <p>
            <b>“Termination Notice”</b>
            means a Notice issued pursuant to Clause 7(iii) hereof;
        </p>
        <p>
            <b>“Termination Payment Date”</b>
            means the date on which the applicable amount is payable under Section 7 hereof (subject to the terms hereof), as set out in the Termination Notice;

        </p>
        <p>
            <b>“Transaction”</b>
            means a Repurchase Transaction or a Reverse Repurchase Transaction.
        </p>

        <p>
            In addition, in this Agreement, unless the context otherwise requires:
        </p>
    </ul>
    <ul class="sublist">

        <li>
            (a)	Section headings are inserted for ease of reference only and shall not affect the construction of this Agreement;
        </li>
        <li>
            (b)	references to Sections are to be construed as references to Sections of this Agreement;
        </li>
        <li>
            (c)	words importing the singular shall include the plural and vice versa and words importing the masculine gender shall include the feminine and neuter genders and vice versa; and
        </li>
        <li>
            (d)	Any reference to a legislation or subsidiary legislation shall be deemed to be a reference to that legislation or subsidiary legislation as from time to time amended, re-enacted or substituted.
        </li>

    </ul>
    <h4><b><u>2. Repurchase Transactions </u></b></h4>
    <ul class="sublist">
       
        <li>
            (I)	Where the Parties enter into a Transaction, the DEALER shall issue a Confirmation setting out the terms for each Transaction.
        </li>
        <li>
            (II) Any Transactions which are entered into between the Parties shall (unless expressly agreed otherwise) be subject to, form part of, and be governed by, this Master Repurchase Agreement, so that all Confirmations for each such Transaction and this Master Repurchase Agreement shall together constitute one single agreement.
        </li>
        <li>
            
            Subject to Section 7:
          
            <ul class="sublist">
                <li> (a)	In respect of each Repurchase Transaction:

                    <ul class="sublist">
                        <li>
                            (A)	On the Purchase Date, the DEALER shall, subject to the receipt of the Purchase Price (which the DEALER may in the case of a CUSTOMER having an account with the DEALER debit from the CUSTOMER’s cash account with the DEALER), credit the CUSTOMER’s CDS Account with the applicable Purchased Securities or transfer to the CUSTOMER’s CDS account the applicable Purchased Securities.
                        </li>
                        <li>
                            (B)	On the Repurchase Date, the DEALER shall debit the CUSTOMER’s CDS Account with the applicable Purchased Securities or obtain a transfer from the CUSTOMER’s CDS account of the applicable Purchased Securities and credit the Repurchase Price to the CUSTOMER’s cash account with the DEALER or to such other account as specified by the CUSTOMER for these purposes or make payment in such other manner as may be agreed with the CUSTOMER
                        </li>
                        <li>
                            (C)	It is expressly agreed and acknowledged that each Repurchase Transaction involves the sale by DEALER to the CUSTOMER of the Purchased Securities on the Purchase Date for the Purchase Price and the purchase by DEALER from the CUSTOMER of the Purchased Securities on the Repurchase Date for the Repurchase Price, and (for the avoidance of doubt) the entire legal and beneficial interest in such Purchased Securities shall respectively vest in the CUSTOMER on the Purchase Date and in the DEALER on the Repurchase Date
                        </li>

                    </ul>
                </li>
                 <li>
                    (b)	In respect of each Reverse Repurchase Transaction:
                    <ul class="sublist">
                        <li>
                            (A)	On the Purchase Date, the DEALER shall debit the CUSTOMER’s CDS  Account with the applicable Purchased Securities or obtain a transfer from the CUSTOMER’s CDS account of the applicable Purchased Securities, and credit the Purchase Price to the CUSTOMER’s cash account with the DEALER or to such other account as specified by the CUSTOMER for these purposes or makes payment in such other manner as may be agreed with the CUSTOMER.
                        </li>
                        <li>
                            (B)	On the Repurchase Date, the DEALER shall, subject to receipt of the Repurchase Price from the CUSTOMER (which the DEALER may in the case of a CUSTOMER having an account with the DEALER debit from the CUSTOMER’s cash account with the DEALER), credit the CUSTOMER’s CDS Account with the applicable Purchased Securities or transfer to the CUSTOMER’s CDS account the applicable Purchased Securities. 
                        </li>
                        <li>
                            (C)	It is expressly agreed and acknowledged that each Reverse Repurchase Transaction involves the sale by the CUSTOMER to DEALER of the Purchased Securities on the Purchase Date for the Purchase Price and the purchase by the CUSTOMER from DEALER of the Purchased Securities on the Repurchase Date for the Repurchase Price, and (for the avoidance of doubt) the entire legal and beneficial interest in such Purchased Securities shall respectively vest in the DEALER on the Purchase Date and in the CUSTOMER on the Repurchase Date
                        </li>
                       

                    </ul>
                </li>  
          </ul>
        </li>
         <li>
            
                (IV)	Unless the Confirmation provides otherwise neither the CUSTOMER in a Repurchase Transaction nor the DEALER in a Reverse Repurchase Transaction shall be entitled to call for a replenishment or removal of the Purchase Securities from the Purchase Date to the repurchase Date. 
             
         </li>
    </ul>
    <ul class="no_bullet">
        <h4>
            <b><u>3.Income</u></b>

        </h4>
        <li>
            (I)	which are the subject matter of a Repurchase Transaction, at any time after the Purchase Date and on or before the Repurchase Date, such amount shall accrue to the benefit of the DEALER which (for the avoidance of doubt) shall be absolutely entitled to such amount and if such Income Payment is paid to the CUSTOMER, the CUSTOMER shall pay an amount equal to the amount so received to DEALER on the same Business Day as receipt thereof; and
        </li>
        <li>
            (II)	under a Reverse Repurchase Transaction, at any time after the Purchase Date and on or before the Repurchase Date, such amount shall accrue to benefit of the CUSTOMER, and where such Income Payment is paid to DEALER, the DEALER shall pay an amount equal to the amount so received to the CUSTOMER on the same Business Day as receipt thereof.
        </li>
    </ul>
    <ul class="no_bullet">
        <h4>
            <b><u>4. Representations</u></b>
        </h4>
        <ul class="sublist">
            <p> (1) The CUSTOMER represents to the DEALER as follows (which representations shall be deemed to be repeated by the CUSTOMER on each day on which the CUSTOMER enters into a Transaction):</p>
            <li>
                (I)	the CUSTOMER has full power capacity and authority and has obtained any and all necessary authorizations and consents to enter into and perform its obligations under the Agreement and the Transactions hereunder on the terms set out in this Agreement and the applicable Confirmation;
            </li>
            <li>
                (II) The CUSTOMER is entering into this Agreement and such Transaction hereunder as principal;
            </li>
            <li>
                (III)	the CUSTOMER is the sole beneficial owner of all sums paid by the CUSTOMER under any Transactions under this Agreement;
            </li>
            <li>
                (IV)	the CUSTOMER is fully informed of, and has sufficient knowledge and experience (based on the CUSTOMER’s own judgment and evaluation or upon such professional advice as the CUSTOMER has deemed necessary to obtain, independently of the DEALER) to be able to evaluate, the tax and accounting implications, and potential financial benefits and risks and the appropriateness in light of the CUSTOMER’s financial circumstances, of entering into Transactions; 
            </li>
            <li>
                (V)	the CUSTOMER is not relying upon the view or advice of the DEALER in respect of the Transactions and this Agreement and based on the CUSTOMER’s own evaluation (including taking such advice from the CUSTOMER’s professional advisers as the CUSTOMER has deemed necessary) the CUSTOMER has decided to enter into each Transaction; and
            </li>
            <li>
                (VI)	the CUSTOMER has satisfied itself, and will continue to be responsible for assessing, the tax implications of becoming a party to any Transaction hereunder
            </li>
        </ul>
        <ul class="sublist">
            <p>
                (2)	The DEALER represents to the CUSTOMER as follows (which representations shall be deemed   to be repeated by the DEALER on each day on which the DEALER enters into a Transaction):
            </p>
            <li>
                (I)	the DEALER has full power capacity and authority and has obtained any and all necessary authorizations and consents to enter into and perform its obligations under the Agreement and the Transactions hereunder on the terms set out in this Agreement and the applicable Confirmation;
            </li>
            <li>
                (II)	the Transactions entered into by the DEALER do not violate any prudential norms or regulations in force relating Transactions by the DEALER
            </li>
        </ul>
    </ul>
    <li>
        <h4><u><b>5. Taxes</b></u></h4>
        <p>Unless otherwise agreed, all payments in respect of any Transaction hereunder shall be paid free and clear of, and without withholding or deduction for, any taxes or duties of whatever nature imposed, levied, collected, withheld or assessed by any authority having power to tax, unless the withholding or deduction of taxes is required by law or practice of any taxing authority.   In such circumstances, the paying party shall not be obliged to gross up any such payment and the net amount after such withholding or deduction will be payable to the receiving party. </p>
    </li> 
    
    <h4><b><u>6. Substitution</u></b></h4>
    <ul class="sublist">
       
        <li>
           (I) In relation to any Repurchase Transaction at any time between the Purchase Date and the Repurchase Date the DEALER may, in accordance with any relevant confirmation, substitute other Eligible Securities, for any Purchased Securities, provided, however, that such substitute Eligible Securities shall have a Market Value at least equal to the Market Value of the Purchased Securities for which they are initially substituted as at the date of substitution. Such substitution shall be made by transfer to the CUSTOMER of such other Eligible Securities and simultaneous transfer to DEALER of the relevant amount of Equivalent Securities in respect of the Purchased Securities being substituted. After substitution, the substituted Securities shall be deemed to be Purchased Securities and the original Purchased Securities so substituted shall cease to be the Purchased Securities.  The DEALER shall be entitled to debit and credit the CUSTOMER’s CDS Account accordingly or obtain a transfer from or make a transfer to the CUSTOMER’s CDS account accordingly
        </li>
        <li>
            (II) In relation to a Reverse Repurchase Transaction, the substitution provisions in (i) above shall apply only if the relevant Confirmation provides for such substitution
        </li>
    </ul>
    
    <h4><b><u>7. Event of Default/Termination Event</u></b></h4>

    <ul class="sublist">
        <ul class="sublist">
            <p>
                (I)	The following shall constitute Events of Default under this Agreement
            </p>
            <li>
                (a)	 any of the Parties fails to perform any payment or delivery obligation hereunder; 
            </li>
            <li>
                (b)	any of the representations made by a party hereunder is false or misleading in any material respect;
            </li>
            <li>
                (c)	 an Act of Insolvency in respect of a Party 
            </li>
            <li>
               (d)	if the CUSTOMER, being an individual, dies or becomes of unsound mind or otherwise incapacitated, and, in the case of death, the outstanding monetary obligations of the CUSTOMER to the DEALER are not satisfied within 30 days of the date of death.
            </li>
        </ul>
        <li>
            (II)	the Defaulting Party shall be obliged to notify the Non-Defaulting Party of the occurrence of any Event of Default in respect of the Defaulting Party, of which the Defaulting Party shall have become aware;
        </li>
        <li>
            (III)	if any Event of Default occurs the Non-Defaulting Party may serve a Termination Notice upon the Defaulting Party by giving not less than three (03) days’ notice
        </li>
        <li>
            (IV)	where the Non Defaulting Party serves a Termination Notice, the Repurchase Date in respect of each Transaction hereunder shall be accelerated to the Acceleration Date (which shall not be a date earlier than the date on which the Termination Notice is 
            deemed to be received in accordance with the terms hereof).  The Repurchase Price in respect of each Transaction shall be amended accordingly to an amount determined in good faith by the DEALER to take into account the acceleration of the relevant Repurchase Date in respect of each Transaction (such amended Repurchase Price, the “Amended Repurchase Price”);    
        </li>
        <ul>
            <p>(V) where an Acceleration Date so occurs, (A) the DEALER shall determine (a) the Market Value of each of the Purchased Securities hereunder and (b) the Amended Repurchase Prices hereunder, and (B) the obligation of the parties under the Transactions shall automatically be replaced </p>
            <li>(1)	where the sum of (a) the aggregate of the Market Values under all Repurchase Transactions and (b) the aggregate of the Amended Repurchase Prices under all Reverse Repurchase Transactions (such sum, the “DEALER Amounts”) exceeds the sum of (c) the aggregate of the Market Values under all Reverse Repurchase Transactions and (d) the aggregate of the Amended Repurchase Prices under any Repurchase Transactions (such sum, the “CUSTOMER Amounts”), by an obligation on the part of the CUSTOMER (subject to Section 7(vi) hereof) to pay an amount equal to such excess to DEALER on the Termination  Payment Date, and</li>
            <li>(2)	where the CUSTOMER Amounts (as defined in Section 7(v)(B)(1) hereof) exceed the DEALER Amounts (as defined in Section 7(v)(B)(1) hereof), by an obligation on the part of DEALER (subject to Section 7(vi) hereof) to pay an amount equal to such excess to the CUSTOMER on the Termination  Payment Date; </li>
        </ul>
        <li>
            (VI) without limiting any other rights of combination of accounts, netting or set-off available to the DEALER, the DEALER may set off any amount (a) payable to it under Section 7(v)(B)(1) hereof against any other amounts payable by it to the CUSTOMER and (b) payable by it under Section 7(v)(B)(2) against any other amounts payable to it by the CUSTOMER, in each case whether any such other amounts arise under this Agreement or otherwise.   
        </li>
    </ul>
    <li>
        <h4 style="margin-top: 10px"><u><b>8.	Notices</b></u></h4>
        <p>
            Notices will be given to the CUSTOMER at the address specified above, or such other address as the CUSTOMER may have notified to DEALER in writing, and will be deemed to have been received by the CUSTOMER (i) where delivered personally during business hours of DEALER (“Business Hours”) on a Business Day, on that Business Day (or if the date of delivery is not a Business Day, or the time of delivery is outside Business Hours, at the commencement of Business Hours on the next following Business Day), (ii) where delivered by fax, on a Business Day on receipt of the applicable acknowledgment of sending, (or if delivered by fax on a date which is not a Business Day, or the time of delivery is outside Business Hours, at the commencement of Business Hours on the next following Business Day) and (iii) where delivered by post, two Business Days following the date of dispatch.
        </p>

    </li>
    <li>
        <h4><u><b>9.	Interest on late payments</b></u></h4>
        <p>Where the Party fails to make any payment under any Transaction or under the Agreement, interest shall be payable by the Party at the Default Rate on the amount payable but unpaid for the period from and including the due date for such payment to but excluding the date on which the applicable payment is actually received by other Party.  Such interest will be calculated on the basis of daily compounding and the actual number of days elapsed.</p>
    </li>
    
    <h4><b><u>10. Non-Transferability</u></b></h4>
    <ul class="sublist">
        
        <li>
            (I)	Neither of the Parties shall transfer or assign any of its rights and obligations under this Agreement, nor shall it seek to create any third-party rights in respect thereof, without the prior written consent of the other Party. 
        </li>
        <li>
            (II) The Purchased Securities shall not be traded   at any time between the Purchase Date and the Re-Purchase Date on a Repurchase Transaction, unless specified otherwise in the relevant Confirmation. 
        </li>
    </ul>
    
    <h4 style="margin-top: 5px"><u><b>11. Obligations of DEALER/Force Majeure</b></u></h4>

    <ul class="sublist">
        <li>
            (I)	The obligations of the DEALER hereunder are performable only by DEALER and such performance is subject to all applicable laws and regulations in Sri Lanka.
        </li>
        <li>
            (II)	Where it becomes, by reason of force majeure or act of state, impossible or impracticable for DEALER to perform its obligations hereunder, such obligations shall be suspended until it is no longer impossible or impracticable for DEALER to perform such obligations, and no interest or other payment (except any interest or other payment that would have been payable in respect of such obligations had no such suspension occurred) shall be payable in respect of the suspended
        </li>
        <li>
            (III)	obligations during the period of suspension; provided that DEALER may declare that the relevant obligation is due for performance upon any event of default or termination event in respect of the other party to enable DEALER to include the value of such obligation in any netting or set-off in such circumstances.  
        </li>
    </ul>
    <li>
        <h4 style="margin-top: 5px"><u><b>12. Governing Law/Submission to Jurisdiction</b></u></p>
         <p>
            This Agreement and all Transactions entered into hereunder shall be governed by the laws of Sri Lanka and the Parties submit to the exclusive jurisdiction of the courts of Sri Lanka. 
        </p>   
    </li>


</ul>
<p style="margin: 5px 0">
    IN WITNESS WHEREOF the parties have executed this document on the respective dates specified below with effect from the date specified on the first page of this document.
</p>
<table class="table">
    <tr style="padding-top: 50px !important;">
        <td>By: ...................................</td>
        <td>By: ...................................</td>
    </tr>
    <tr>
        <td>Name: D.D.S.Samarasinghe </td>
        <td>Name: H.N.O.M.Somasiri</td>
    </tr>
    <tr>
        <td>Title: Manager </td>
        <td>Title: Executive Officer</td>
    </tr>
    <tr style="padding-top: 50px !important;">
        <td>Signature(s): …………………………………..</td>
        <td>…………………………………………….</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr style="padding-top: 50px !important;">
        <td>Signature(1) .........................</td>
        <td>Signature(2) .........................</td>
    </tr>
    <tr style="padding-top: 50px !important;">
        <td>Name(1) {{$client->name}}</td>
        <td>Name(2) {{$client->hasJointHolders()? $client->jointHolders()->first()->name : "............................"}} </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Witness Signature (1):....................</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Witness Name(1) ............................</td>
        <td>&nbsp;</td>
    </tr>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>Witness Signature(2):....................</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>Witness Name(1) ............................</td>
    <td>&nbsp;</td>
</tr>
    <tr>
        <td colspan="2">
            <p style="margin: 20px 0">
            IN WITNESS WHEREOF the parties have executed this document on the respective dates specified below. This agreement shall come into operation from the date of the last executed signature below.
            </p>
        </td>
    </tr>

</table>

<div class="clearfix">
    
</div>
<table class="table" style="margin-top: 90px">
  <tr>
      <th colspan="2" style="text-align: center">ANNEX I</th>
  </tr>
  <tr>
      <td><u>Letter</u></td>
      <td></td>
  </tr>
  <tr>
     <td>
        Lender:

     </td>
     <td>
        [Name of  CUSTOMER]
     </td>
  </tr>
  <tr>
      <td>Date:</td>
      <td></td>
  </tr>
  <tr>
      <td>Subject :Transaction (Reference NO </td>
      <td>[                                ]</td>
  </tr>
  <tr>
      <td>Dear Sirs,</td>
      <td></td>
  </tr>
  
  <tr>
      <td colspan="2">
          <p>
            The purpose of this letter (which constitutes a “Confirmation” for the purposes of the Master Repurchase Agreement between us (the “Agreement”)) is to set forth the terms and conditions of the Repurchase Transaction between us entered into on the Contract Date referred to below
          </p>
        
        <p>
            This Confirmation supplements and forms part of, and is subject to, the Agreement; all provisions contained in the Agreement govern this Confirmation except as expressly modified below.  Words and phrases defined in the Agreement and used in this Confirmation shall have the same meaning herein as in the Agreement.
        </p>
        <p>
            The Transaction evidenced by this Confirmation shall be recorded on the Central Depository System of Lanka Secure.
        </p>
      </td>
     
     

  </tr>
  <tr>
      <td colspan="2">
          <ul class="sublist">
              <li>
               Contract Date:
              </li>
              <li>
               Nature of Transaction: [Repurchase Transaction] [Reverse Repurchase Transaction]
              </li>
              <li>
               Purchased Securities:details + ISIN etc numbers]
              </li>
              <li>
                Market value of Purchased Securities:   
              </li>
              <li>
                Purchase Date/Value Date:
              </li>
              <li>
                Purchase Price/Interest rate:      
              </li>
              <li>
               Repurchase Date/Maturity Date
              </li>
              <li>
               Repurchase Price/Interest rate:   
              </li>
              <li>
                Securities substitution allowed (Y/N) 
              </li>
              <li>
                Securities replenishment allowed (Y/N) :
              </li>
              <li>
               Securities removal allowed (Y/N)	:
              </li>
              <li>
               Securities tradability allowed (Y/N) :
              </li>
              <li>
                Additional Terms: 
                <ul class="no_bullet">
             
                    <li>
                      (I)	Where the Market Value of any Securities needs to be determined, it shall be based on the rates mutually agreed upon by the parties, failing which the rates published by the Central Bank of Sri Lanka for corresponding Securities
                    </li>
                    <li>
                      (II)	The maturity proceeds/interest shall be credited to your cash account mentioned in the application form or any other account duly conveyed to us in writing. 
                    </li>
  
                </ul>
              </li>
           
              <li>
                14.	Errors in Confirmation:  You shall inform us in writing of any errors in these Confirmations within two (2) days of receipt of this Confirmation
              </li>


          </ul>
      </td>
  </tr>
  <tr>
      <td style="padding-top: 50px">Our Fax Number : </td>
      <td style="padding-top: 50px">Our Telex Number :</td>
  </tr>
  <tr>
      <td colspan="2">
        Our telephone number for documentation queries:
      </td>
  </tr>
  <tr>
      <td colspan="2">
        Regards,
      </td>
  </tr>
  <tr>
      <td colspan="2">
          For and On Behalf of
          <br> (Name of Dealer)

      </td>

     
  </tr>

</table>
</div>



 




