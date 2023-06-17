<!DOCTYPE html>
<html>
<head>
    <title>Tbill Certificate</title>
    <style>

      table {
        padding: 10px;
        margin: 10px 0;
    }

    .full-width {
      width:100%;
      float:left;
      padding: 10px 0;
    }

    td {
      padding:5px;
    }

    body {
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #fff;
        width: 600px;
        margin: 15px auto;
        display: block;
        font-size: 14px;
    }

      table {
        border-collapse: collapse;
    }
    hr {
      margin-top: 1rem;
      margin-bottom: 1rem;
      border: 0;
      border-top: 1px solid rgba(0,0,0,.1);
  }

  .clearfix {
    display:block;
    width:100%;
  }
  
    </style>

</head>
<body style="width: 600px; margin:15px auto; display: block">
     
                 <table>
                   <tr>
                      <td>Customer ID</td>
                      <td>  {{$match->cus_id1}}</td>   
                   </tr> 
                   <tr>
                    <td>Ref No
                      Initial Ref No</td>
                    <td>  {{$match->cus_id1}}</td>   
                   </tr>   
                 </table> 
              
              </div>
          

        
              <table width="300px" style="float:left; margin-bottom:20px">
                <tr>
                  <th>
                    SELLER
                  </th>
                </tr>
                 <tr>
                   <td> NSB Fund Management Co. Ltd</td>
                  
                 </tr>
                 <tr>
                  <td>No 400</td>
                </tr>
                <tr>
                  <td>Galle Road</td>
                </tr>
                <tr>
                  <td>Colombo 03</td>
                 
                </tr>
                <tr>
                  <td>Telephone : 0112425010</td>
                </tr>
                <tr>
                  <td>Fax :  0112574387</td>
                </tr>
                <tr>
                  <td> Date:	{{$today}}</td>
                </tr>
              </table>
         
            
              <table width="300px" style="float:left">
                <tr><th>BUYER</th></tr>
                <tr><td>{{$client->title}} {{$client->name}}</td></tr>
                <tr><td>{{$client->address_line_1}}</td></tr>
                <tr><td>{{$client->address_line_2}}</td></tr>
                <tr><td>{{$client->address_line_3}}</td></tr>
              </table>
        
        <div class="clearfix"></div>
         
        <hr class="solid">
          
          <div class="full-width">
            <strong>Purchase Of Treasury Bills - Reinvestment</strong>
       
       
            We furnish below the details of government securities, 
            purchased from us and recorded in the Central Depository 
            System of the Central Bank (Lanka Secure) as a customer 
            of NSB Fund Management Co. Ltd.
          </div>
         
      

        

          <table width="600px" style="float:left">
            <tr>
              <td>Face Value </td>
              <td>Rs. @money($match->face_value)</td>
            </tr>
            <tr>
              <td>ISIN</td>
              <td>LKA09122B041</td>
            </tr>
            <tr>
              <td>Date of Sale</td>
              <td>05-Nov-2021</td>
            </tr>
            <tr>
              <td>Yield	</td>
              <td>{{$match->yield}}% p.a.</td>
            </tr>
            <tr>
              <td>Coupon</td>
              <td>{{$match->coupon}} p.a.</td>
            </tr>
            <tr>
              <td>Coupon Dates</td>
              <td>N/A</td>
            </tr>
            <tr>
              <td>Date of Maturity</td>
              <td>{{$maturity_date}}</td>
            </tr>
            <tr>
              <td>Days to Maturity</td>
              <td>{{$days_to_maturity}}days</td>
            </tr>
            <tr>
              <td> Price Per Rs. 100/-</td>
              <td>{{$match->price}}</td>
            </tr>
            <tr>
              <td>Cost of the Security</td>
              <td>Rs. *******</td>
            </tr>
            <tr>
              <td>  
                Value Of the Security which
                Matured On {{$maturity_date}}</td>
              <td>Rs. *******</td>
            </tr>
          </table>

          <div class="full-width">
       
        <hr class="solid">
     
          On Maturity
          We will reinvest the proceeds and purchase Government Securities 
          for the full value,unless we receive instructions to the contrary 
          at least one week prior to the maturity date.
          * This is computer generated report and signature does not required
      

        </div>

    
       
    </body>
</html>


