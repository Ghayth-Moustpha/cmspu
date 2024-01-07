<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeedStatus extends Model
{
    use HasFactory;
    protected $table = 'need_statuses';
 
    public function statusable()
    {
        return $this->morphTo();
    }
}
