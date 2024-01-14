<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    protected $table = 'requirements';
    protected $fillable = ['title', 'description', 'Type', 'priority', 'actor_id', 'project_id', 'status', 'need_id'];
    
    public function actor()
    {
    return $this->belongsTo(Actor::class);
    }
    public function need()
    {
    return $this->belongsTo(Need::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function analytics()
    {
        return $this->hasMany(Analytics::class);
    }
    public function designs()
    {
        return $this->hasMany(Designs::class);
    }
    public function tests()
    {
        return $this->hasMany(Tests::class);
    }
    public function codes()
    {
        return $this->hasMany(Codes::class);
    }
}
