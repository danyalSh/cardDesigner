<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CompanyContacts extends Model
{

    protected $fillable =  [
        'company_id' ,'user_id' , 'contact_id'
    ];


    public function users()
    {
        return $this->hasOne('App\User', 'id', 'contact_id');
    }

    public function contacts()
    {
        return $this->hasOne('App\Contacts', 'id', 'contact_id');
    }

    public function createCompanyContact($request, $user_id = false, $contact_id) {
        $company_id = '';
        $this->companies = new Companies();
        if (Auth::user() -> hasRole('super_admin')) {
            $company_id = $request['company_id'];
        } else if (Auth::user() -> hasRole('company_owner')) {
            $companiesObj = $this->companies->getCompanies(Auth::user()->id);
            if ($companiesObj && count($companiesObj) > 0) {
                $company_id = $companiesObj[0]['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
        if (!$company_id || $company_id == '') {
            return false;
        }
        return $this->create([
            'company_id' => $company_id ,
            'user_id' => $user_id,
            'contact_id' => $contact_id,
            'ext' => $request['phone']
        ]);
    }

    public function getCompanyContacts($companyId)
    {
        return $this->with('users', 'contacts')->where('company_id', '=', $companyId)->get();
    }
}
