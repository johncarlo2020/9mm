<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    public $table = 'agents';

    protected $fillable = [
        'user_id',
        'agency_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with agencies
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

}
