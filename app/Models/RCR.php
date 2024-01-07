<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RCR extends Model
{
    protected $table = 'rcrs';
    protected $policy = RCRPolicy::class;

    protected $fillable = [
        'need_id',
        'title',
        'description',
        'status_id',
        'result',
        'cost',
    ];
    protected $attributes = [
        'result' => 'Default Result',
        'cost' => 0,
        'status_id' => 1,
    ];


    public function need()
    {
        return $this->belongsTo(Need::class);
    }

    public function status()
    {
        return $this->belongsTo(NeedStatus::class);
    }
}