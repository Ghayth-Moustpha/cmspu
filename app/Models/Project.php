<?php

namespace App\Models;
use App\Models\Need;
use App\Models\Actor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title' , 'description' , 'Deadline' , 'Notes'] ; 
    use HasFactory;

    public function Needs (){
        return $this->hasMany(Need::class);
    }
    public function Actors (){
        return $this->hasMany(Actor::class);
    }
    public function Requirements (){
        return $this->hasMany(Requirement::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    

}

