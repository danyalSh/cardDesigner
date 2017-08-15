<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'card_front',
        'card_back',
        'address',
        'created_at',
        'updated_at',
        'designation'
    ];

    public function createContact($request, $card_front, $card_back)
    {
        return $this->create([
            'id'=> $request['id'],
            'first_name'=> $request['name'],
            'last_name'=> $request['name'],
            'email'=> $request['email'],
            'phone'=> $request['phone'],
            'card_front'=> $card_front,
            'card_back'=> $card_back,
            'designation' => $request['designation'],
        ]);
    }

    public function getAllContacts() {

        $users = $this->get();
        return $users;
    }
}
