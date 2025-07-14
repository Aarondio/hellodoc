<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'user_id',
        'timeslot_id',
        'appointment_time',
        'appointment_date',
        'description',
        'status'
    ];

    // public function doctor()
    // {
    //     return $this->belongsTo(Doctor::class);
    // }

    // public function patient()
    // {
    //     return $this->belongsTo(Patient::class);
    // }

    public function timeslot()
    {
        return $this->belongsTo(Timeslot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
            'appointment_time' => 'datetime:H:i',
        ];
    }

    // public function appointment(){
    //     return $this->hasMany(Appointment::class);
    // }
}
