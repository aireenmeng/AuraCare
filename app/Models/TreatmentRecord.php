<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreatmentRecord extends Model
{
    use HasFactory;
    protected $fillable = ['appointment_id', 'staff_notes', 'photo_path'];

    public function appointment() { return $this->belongsTo(Appointment::class); }
}
