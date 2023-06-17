<?php

return [
     'CLIENT_TYPE' =>[

        1=>'individual',
        2=>'Joint',
        3=>'Institute'

     ],
     'CLIENT_STATUS'=>[

      0=> 'Verification Process Not Initialized',
      1=> 'Bank Officer Started Verifying',
      2=> 'Bank Offcier Verified!',
      3=> 'Bank Officer Sheduled a Video Conference.',
      4=> 'Video Conferece Done!. Ready to send to  Bank Manager',
      5=> 'Bank Manager On Verification',
      6=> 'Bank Manager Confirmed! Ready to send to Middle Office',
      7=> 'Middle Office On Verification',
      8=> 'Middle Office Verified! User Initially Active',
      9=> 'Transaction Processed! User Active',
      100=>'Application Rejected'
      
     ],
     'CLIENT_STATUS_PHY'=>[

        0=> 'Verification Process Not Initialized',
        1=> 'Bank Officer Started Verifying',
        2=> 'Bank Offcier Verified!',
        3=> 'Physical Verfication',
        4=> 'Client Physically Verified!,Ready to Send to Bank Manager',
        5=> 'Bank Manager On Verification',
        6=> 'Bank Manager Confirmed! Ready to send to Middle Office',
        7=> 'Middle Office On Verification',
        8=> 'Middle Office Verified! User Initially Active',
        9=> 'Transaction Processed! User Active',
        100=>' Application Rejected'
     
        
       ],

     'REQUEST_STATUS'=>[

      -100=>'In Creating Process',
        0=>'Bank officer on Verification',
        1=>'Bank Officer Verified, Sent to Bank Manager',
        2=>'Bank Manager on Verfication',
        3=>'Bank Manager Verified, Sent to Middle Office',
        4=>'Middle Officer On verification',
        5=>'Middle officer Verified! New Investment is active, Waiting for transactions',
        6=>'Transcation Process! Investment Active'
     ],

     'WITHDRAW_REQUEST_STATUS'=>[

         0=>'Pending',
         1=>'Bank Officer or Bank Manager Verified',
         2=>'Middle Officer Verified',
         3=>'Transaction Processed',
      
     ],

     'REQUEST_TYPES'=>[
         1=>'Renewal With Interest',
         2=>'Renewal Partically With Face Value - Withdraw Only Interest',
         3=>'Pay Partcially And Renew Rest',
         4=>'Renew With Extra Investment',
         5=>'Full Withdraw',
         6=>'Premature Withdraw'
     ],

     'SETTLE_REPO_TYPES'=>[

        1=>'Renew the Reverse Repo with interest',
        2=>'Settled the interest from investment and renew the capital outstanding',
        3=>'Settled the Repo From Investment',
        4=>'Settled the Reverse Repo from Cash',
        5=>'Partial Settlement from Investment',
        6=>'Partial Settlement from cash',

     ],

     'INQUIRY_TYPES'=>[
        1=>'General',
        2=>'Complain',
        3=>'Suggession',
     ]

  

];

