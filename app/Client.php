<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;

class Client extends Model
{


    use SoftDeletes,HasFactory;
    public $table = 'clients';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'id',
        'password',
        'name',
        'name_by_initials',
        'nic',
        'dob',
        'title',
        'name_by_initials_verify',
        'address_line_1',
        'address_line_1_verify',
        'address_line_2',
        'address_line_2_verify',
        'address_line_3',
        'address_line_3_verify',
        'correspondence_address_line_1',
        'correspondence_address_line_1_verify',
        'correspondence_address_line_2',
        'correspondence_address_line_2_verify',
        'correspondence_address_line_3',
        'correspondence_address_line_3_verify',
        'client_type',
        'nationality',
        'verification_from_GOV',
        'verification_from_GOV_verify',
        'money_laundering_verification',
        'money_laundering_verification_verify',
        'pro_pic',
        'pro_pic_verify',
        'status',
        'telephone',
        'mobile',
        'officer_id',
        'kyc',
        'is_signatureB',
        'joint_permission',
        'billing_proof',
        'billing_proof_verify',
        'is_first',
        'is_ex',
        'reference_email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
   
     public function user(){ 

        return $this->belongsTo(User::class,'id','id');

     }
     public function officer(){ 

        return $this->belongsTo(User::class,'officer_id','id');

     }


     public function process(){
         return $this->hasMany(Process::class,'client_id');
     }

     public function newInvestmentProcess(){
         return $this->hasMany(NewInvestmentProcess::class,'client_id');
     }

     public function uploads(){
         return $this->hasMany(Upload::class,'client_id');
     }
     public function hasUploads(){
         return (bool) $this->uploads()->first();
    }
     public function authorizedPerson(){
         return $this->hasOne(AuthorizedPerson::class);
     }
     public function hasAuthorizedPerson(){
        return (bool) $this->authorizedPerson()->first();
    }
     public function employmentDetails(){
        return $this->hasOne(EmploymentDetails::class,'id')->withDefault();

    }

    public function hasEmploymenDetails(){

        return (bool) $this->employmentDetails()->first();
    } 

    public function jointHolders(){
        return $this->hasMany(JointHolder::class,'client_id');
    }
    public function hasJointHolders(){
        return (bool) $this->jointHolders()->first();
    }


    public function bankParticulars(){
        return $this->hasMany(BankParticular::class,'client_id');
    }

    public function hasBankParticulars(){
        return (bool) $this->bankParticulars()->first();
    }
    public function otherDetails(){
        return $this->hasOne(OtherDetails::class,'id');
    }
    public function hasOtherDetails(){
        return (bool) $this->otherDetails()->first();

    }

    public function meetings(){
        return $this->hasMany(Meeting::class,'client_id');
    }

    public function clientRecords(){
        return $this->hasMany(ClientRecord::class,'client_id');
    }

    public function hasClientRecords(){
        return (bool) $this->clientRecords()->first();
    }

    public function hasClientRecordsWithType($type){

        return (bool) $this->clientRecords()->where('type',$type)->first();
    }

    public function currentInvestedAmout($type){
        return $this->clientRecords()->where('type',$type)->last()->account_balance;
    }



    public function withdraws(){
        return $this->hasMany(Withdraw::class,'client_id');

    }

    public function hasWithdraws(){

        return (bool) $this->withdraws()->first();

    }

    public function investments(){

        return $this->hasMany(Investment::class,'client_id');
        
    }

    

    public function hasInvestments(){
        return (bool) $this->investments()->first();
    }

    public function investmentCount(){
        return $this->investments()->count();
    }

    public function investmentsWithType($type){
        return  $this->investments()->where('investment_type_id','=',$type)->first();
    }
    public function investmentById($id){

        return $this->investments()->find($id);

    }


    public function investmentsWithTypeStatus($type){
        return  $this->investments()->where('investment_type_id','=',$type)->first()->status;
    }

    public function investmentsWithIdStatus($id){
        return  $this->investmentById($id)->status;
    }


    public function hasInvestmentsWithType($type){
        return (bool) $this->investments()->where('investment_type_id','=',$type)->first();
    }

  


    public function mainInvestmentState(){
        return $this->investments()->where('is_main','=',1)->first()->status;
    }
    public function mainInvestmentStateWithInvestmentType(){
        return $this->investments()->where('is_main','=',1)->first()->investment_type_id;
    }
    public function returnMainInvestmentId(){
        return $this->investments()->where('is_main',1)->first()->id;
    }
    public function mainInvestmentKyc(){
        return $this->investments()->where('is_main','=',1)->first()->kyc;
    }

    public function mainInvestment(){
        return $this->investments()->where('is_main','=',1)->first();
    }
    public function mainInvestments(){
        return $this->investments()->where('is_main','=',1);
    }
    public  function mainInvestmentsWithStatus($status,$logic){
        return $this->investments()->where('is_main','=',1)->where('status',$logic,$status);
    }
    public function mainInvestmentWithKyc(){
        return $this->investments()->where('is_main','=',1)->first()->kyc;
    }
    

    public function investmentsTobeApproved(){
        return $this->investments()->where('is_main','=',0)->where('status','<',9);
    }


    public function documents(){
        return $this->hasMany(Document::class,'client_id');
    }

    public function hasDocuments(){
        return (bool) $this->documents()->first();
    }

    public function kyc(){
        return $this->hasMany(KYCForm::class,'client_id');
    }
    public function hasKyc(){
        return (bool) $this->kyc()->first();
    }

    public function kycByInvestmentid($id){
        return  $this->kyc()->where('investment_id',$id)->first();

    }

    public function hasKycWithInvestmentId($id){
        return (bool) $this->kyc()->where('investment_id','=',$id)->first();
    }
    public function kycWithInvestmentType($type){
        return  $this->kyc()->where('investment_type','=',$type)->first();
    }

    public function clientKYC(){
        return $this->kyc()->where('investment_id',0)->first();

    }

    public function hasClientKYC(){
        return (bool) $this->clientKYC();
    }


    public function companySignatures(){
        return $this->hasMany(CompanySignature::class,'client_id');

    }

    public function hasCompanySignatures(){
        return (bool) $this->companySignatures()->first();
    }

    public function company(){
        return $this->hasOne(Company::class,'id')->withDefault();
    }
    public function hasCompany(){
        return (bool) $this->company()->first();
    }
    public function contacts(){
        return $this->hasMany(ContactPerson::class,'client_id');

    }
    public function hasContacts(){
        return (bool) $this->contacts()->first();
    }

    public function kycCompany(){
        return $this->hasMany(KYCCompany::class,'company_id');

    }
    public function hasKycCompany(){
        return (bool) $this->kyc()->first();
    }
   public function govDocs(){
       return $this->hasMany(GovernmentVerifyDoc::class,'client_id');
   }

   public function hasGovDocs(){
       return (bool) $this->govDocs()->first();
   }
   
   public function moneyLaunderingVerifications(){
       return $this->hasMany(MoneyLaunderingVerifyDoc::class,'client_id');

   }

   public function hasMoneyLaunderingVerifications(){

      return (bool) $this->moneyLaunderingVerifications()->first();
   }

   public function reverseRepos(){

        return $this->hasMany(ReverseRepo::class);
   }

   public function bids(){
       return $this->hasMany(BidSet::class,'client_id');
   }

   public function  hasBids(){
    return (bool) $this->bids()->first();
   }

   public function benefactors(){

    return $this->hasMany(Benefactor::class,'client_id');

   }


   public function naturalPeople(){

    return $this->hasMany(NaturalPerson::class,'client_id');
   }


   public function  settleReverseRepos(){
       return $this->hasMany(SettleReverseRepo::class,'client_id');
   }

   public function changeRequests(){
       return $this->hasMany(ChangeRequest::class,'client_id');
   }

   public function hasChangeRequests(){
    return (bool) $this->changeRequests()->first();
    }   

    public function tempInvestment(){
        return  $this->hasMany(tempInvestment::class,'client_id');

    }

    public function realTimeNotification(){
        return $this->hasOne(RealTimeNotificationSetting::class,'id');
    }

    public function hasRealTimeNotification(){

        return (bool) $this->realTimeNotification()->first();
    }

    



}