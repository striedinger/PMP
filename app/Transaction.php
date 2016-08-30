<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['admin_id', 'user_id', 'plan_id'];

    public function admin(){
    	return $this->belongsTo(User::class, 'admin_id');
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }


    public function plan(){
    	return $this->belongsTo(Plan::class);
    }
}
