<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
    protected $table='exams';


    // relation 
    public function subjects(){
        return $this->hasMany(Subject::class,'id','subject_id');
    }
}
