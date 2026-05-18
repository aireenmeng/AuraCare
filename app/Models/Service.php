<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // 1. Add this line

class Service extends Model
{
    use HasFactory, SoftDeletes; // 2. Add it here
    
    protected $fillable = ['service_name', 'description', 'duration_minutes', 'price', 'category'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}