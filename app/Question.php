<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['question', 'description', 'optionA', 'optionB', 'optionC', 'optionD', 'answer', 'process_id','area_id', 'active', 'image', 'subject'];

    protected $with = ['area', 'process'];

    public function process(){
    	return $this->belongsTo(Process::class);
    }

    public function area(){
    	return $this->belongsTo(Area::class);
    }
}
