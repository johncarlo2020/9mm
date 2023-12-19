<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    use HasFactory;

    public $table = 'emergencies';

    protected $fillable = [
        'user_id',
        'agency_id',
        'title',
        'status'
    ];

    protected $appends = ['status'];


    public function getStatusAttribute()
    {
        $status = $this->getAttributes()['status'] ;

        if($status == 0)
        return 'Pending';
        else 
        return 'Dispatched';
        
    }
    public function images()
    {
        return $this->hasMany(EmergencyImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
}
