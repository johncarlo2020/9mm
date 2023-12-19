<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyImage extends Model
{
    use HasFactory;

    public $table = 'emergency_images';

    protected $fillable = [
        'image',
        'emergency_id',
    ];

    public function emergency()
    {
        return $this->belongsTo(Emergency::class);
    }

}
