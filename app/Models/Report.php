<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Report extends Model
{
    use HasFactory;
  
        public function receivers() {
            return $this->belongsToMany(User::class, 'report_receivers');
        }
    
}
