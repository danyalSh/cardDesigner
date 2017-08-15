<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'address', 'city', 'state', 'zip', 'domain', 'email', 'logo', 'user_id'
    ];


    public function createCompany($request, $fileName = false, $id = false) {
        //TODO: Needs to save ext of user
        return $this->create([
            'user_id' => $id ? $id : '',
            'name' => $request['name'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip' => $request['zip'],
            'domain' => $request['domain'],
            'email' => $request['email'],
            'logo' =>$fileName
        ]);
    }

    public function companies() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getCompanies($userId = false) {
        if ($userId) {
            $companies = $this->with('companies')->where('user_id' , '=', $userId)->get();
        } else {
            $companies = $this->with('companies')->get();
        }
        return $companies;
    }
}
