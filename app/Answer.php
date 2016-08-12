<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['session_id', 'question_id','number', 'answer', 'marked', 'time'];

    protected $with = ['question', 'session'];

    public function session(){
    	return $this->belongsTo(Session::class);
    }

    public function question(){
    	return $this->belongsTo(Question::class);
    }
}
