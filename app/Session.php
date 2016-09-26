<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'exam_id', 'time', 'area_id', 'process_id'];

    protected $with = ['exam'];

    public function answers(){
    	return $this->hasMany(Answer::class);
    }

    public function exam(){
    	return $this->belongsTo(Exam::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function process(){
        return $this->belongsTo(Process::class);
    }

    public function isComplete(){
        foreach($this->answers as $answer){
            if($answer->answer==null){
                return false;
            }
        }
        return true;
    }
}
