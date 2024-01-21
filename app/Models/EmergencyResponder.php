<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyResponder extends Model
{
    use HasFactory;

    public $table = 'emergency_responders';

    protected $fillable = [
        'responder_id',
        'emergency_id',
    ];

    public function emergency()
    {
        return $this->belongsTo(Emergency::class);
    }

    public function responder()
    {
        return $this->belongsTo(Responder::class);
    }
}
