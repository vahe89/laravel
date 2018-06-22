<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charts extends Model
{
    //table name
    protected $table = 'charts';

    protected $fillable = [
        'name', 'type','user_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];


}
