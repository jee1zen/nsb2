<?php

namespace App;

use App\Notifications\CustomVerifyEmail;
use App\Notifications\CustomVerifyEmailNotification;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use \DateTimeInterface;

use Illuminate\Support\Facades\Hash as FacadesHash;


class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens, HasFactory;

    public $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
        'password_changed_at',
        'last_login'
    ];

    protected $fillable = [
        'name',
        'email',
        'team_id',
        'password',
        'created_at',
        'updated_at',
        'password_changed_at',
        'deleted_at',
        'remember_token',
        'email_verified_at',
        'last_login'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmailNotification);
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? FacadesHash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function client()
    {

        return $this->hasOne(Client::class, 'id', 'id');
    }

    public function accounts(){
        return $this->hasMany(Account::class,'client_id','id');
     }

     public function hasAccounts(){

        return (bool) $this->accounts()->first();

     }

    public function remarkOfficer()
    {
        return $this->hasMany(KYCForm::class, 'officer');
    }



    public function hasClient()
    {
        return (bool) $this->client()->first();
    }



    public function JointHolder()
    {

        return $this->hasOne(JointHolder::class, 'user_id');
    }

    public function selectedAccount()
    {
        return $this->hasOne(SelectedAccount::class, 'client_id', 'id');
    }

    public function hasSelectedAccount()
    {

        return (bool) $this->selectedAccount()->first();
    }

    public function companySignature()
    {


        return $this->hasOne(CompanySignature::class, 'user_id');
    }
    public function hasCompanySignature()
    {


        return (bool) $this->companySignature()->first();
    }

    public function isClientFirstLog()
    {
        return (bool) $this->client()->first()->is_first;
    }

    public function govDocs()
    {
        return $this->hasMany(GovernmentVerifyDoc::class, 'officer_id');
    }

    public function moneyDocs()
    {
        return $this->hasMany(MoneyLaunderingVerifyDoc::class, 'officer_id');
    }

    public function inquiry()
    {
        return $this->hasMany(Inquiry::class, 'user_id');
    }

    public function changeRequest()
    {
        return $this->hasMany(ChangeRequest::class, 'officer_id');
    }
    public function getKey()
    {
        return $this->getAttribute($this->primaryKey);
    }
}