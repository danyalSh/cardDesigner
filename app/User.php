<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token', 'active',
    ];


    /**
     * The roles that belongs to user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Roles', 'user_roles', 'user_id', 'role_id');
    }

    public function companies() {
        return $this->belongsTo('App\Companies', 'id', 'user_id');
    }

    /**
     * Permissions of Users
     * @param $permission
     * @return mixed
     */
    public function hasPermission($permission, $request = false)
    {
        $user = Auth::User();
        $email = $user->email;
        $userWithRoles = $this->with('roles')->where('email', '=', $email)->get();
        if (count($userWithRoles) > 0) {
            foreach ($userWithRoles[0]->relations['roles'] as $role) {
                $result = Roles::where('name', '=', $role['name'])->first()->hasPermissionRole($permission);
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == $roleName) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * Assign a role to the user
     * @param $role
     * @return mixed
     */
    public function assignRole($userObject, $role)
    {
        return $userObject->roles()->attach($role);
    }

    /**
     * Remove all roles from a user
     * @param $role
     * @return mixed
     */
    public function removeRole($userObject)
    {
        $userObject->roles()->detach();
        return $userObject;
    }

    public function getUserByEmail($email) {
        return $this->where('email', '=', $email)->get();
    }

    public function createUser($request) {
        return $this->create([
          'name' => $request['name'] ? $request['name'] : '',
          'email' => $request['email'] ?  $request['email']  : '' ,
          'password' => $request['password'] ? bcrypt($request['password']) : '',
          'active' => $request['actvive'] ? $request['actvive'] : '',
          'remember_token' => $request['name'] ? bcrypt($request['name']) : '',
        ]);
    }

    public function getCompanyId($id)
    {
        $this->companies = new Companies();
        return $this->companies->where('user_id', '=', $id)->first();
    }

    public function getCompanyCardTemplate()
    {
        $this->companiesCard = new CompaniesCardTemplate();
        $companyId = self::getCompanyId(Auth::user()->id)->id;
        $cardTemplate = $this->companiesCard->where('company_id' , '=', $companyId)->get();
        return collect([
          'status' => 'success',
          'card_front' => $this->companiesCard->where('company_id' , '=', $companyId)->where('card_side', '=', 1)->first(),
          'card_back' => $this->companiesCard->where('company_id' , '=', $companyId)->where('card_side', '=', 2)->first()
        ]);
    }

    public function getCompanyFrontCard()
    {
        $this->companiesCard = new CompaniesCardTemplate();
        $companyId = self::getCompanyId(Auth::user()->id)->id;
        $cardTemplate = $this->companiesCard->where('company_id' , '=', $companyId)->get();
        $tmp = $this->companiesCard->where('company_id' , '=', $companyId)->where('card_side', '=', 1)->first();
	      $template = array();
        $cardHtmlPreview = array();
        if (count($tmp) > 0) {
	        $template = count($tmp) > 0 ? $tmp->card_json : array();
	        $cardHtmlPreview = $tmp->template_html;
        }
        return collect([
          'status' => true,
          'data' => $template,
	        'htmlPreview' => $cardHtmlPreview
        ]);
    }

    public function getCompanyBackCard()
    {
        $this->companiesCard = new CompaniesCardTemplate();
        $companyId = self::getCompanyId(Auth::user()->id)->id;
        $cardTemplate = $this->companiesCard->where('company_id' , '=', $companyId)->get();
        $tmp = $this->companiesCard->where('company_id' , '=', $companyId)->where('card_side', '=', 2)->first();
	      $template = array();
	      $cardHtmlPreview = array();
		    if (count($tmp) > 0) {
			    $template = count($tmp) > 0 ? $tmp->card_json : array();
			    $cardHtmlPreview = $tmp->template_html;
		    }
        return  collect([
          'status' => true,
          'data' => $template,
	        'htmlPreview' => $cardHtmlPreview
        ]);
    }
}
