<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    public $table = 'agency';

    protected $fillable = [
        'name',
    ];

    public function agents()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function emergency()
    {
        return $this->hasMany(Emergency::class);
    }

    public function responder()
    {
        return $this->hasMany(Responder::class);
    }

  
}
