<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responder extends Model
{
    use HasFactory;

    public $table = 'responders';

    protected $fillable = [
        'name',
    ];


    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function responders()
    {
        return $this->hasMany(EmergencyResponder::class);
    }

}
