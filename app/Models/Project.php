<?php

namespace App\Models;
use App\Models\Need;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title' , 'description' , 'Deadline' , 'Notes'] ; 
    use HasFactory;

    public function Needs (){
        return $this->hasMany(Need::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    

}

