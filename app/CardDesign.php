<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardDesign extends Model
{
    protected $table = 'card_design';
    
    protected $fillable = [
      'uploader_id',
      'card'
    ];
}
