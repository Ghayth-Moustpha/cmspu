<?php

namespace App\Models;
use App\Models\Project;
use App\Models\User;
use App\Models\RCR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Need extends Model
{
   protected $fillable = ['title' , 'description' , 'project_id' , 'user_id' , 'need_status_id' ]; 
    use HasFactory;
  
    // to create releation between two table -> function named with other tabele 

    public function project()
    {
        return $this->belongsTo(Project::class);
        
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function needStatus() {
        return $this->hasOne(NeedStatus::class, 'id', 'need_status_id');
    }
    public function rcrs () {
        return $this->hasMany(RCR::class , 'id' , 'need_id' ) ; 
    }
}