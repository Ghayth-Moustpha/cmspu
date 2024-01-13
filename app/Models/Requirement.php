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
}
