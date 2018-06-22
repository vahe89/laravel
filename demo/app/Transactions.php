<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    //table name
    protected $table = 'tranactions';

    protected $fillable = [
        'description', 'amount','transaction_date','type','chart_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

}
