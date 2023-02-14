<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='subjects';

    // Relation 
    public function exam(){
        return $this->belongsTo(Exam::class,'subject_id');
    }
}
