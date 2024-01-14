<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codes extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'abstract', 'filepath', 'requirement_id'];
    public function requirement ()
    {
        return $this->belongsTo(Requirement::class);
    }
}
