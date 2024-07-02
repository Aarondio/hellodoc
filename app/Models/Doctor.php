<?php

namespace App\Models;

use App\Models\WorkingDays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;
    

    protected $guarded = [];
    // protected $fillable = [
    //     'user_id', 
    //     'department_id', 
    //     'image',
    //     'cv', 
    //     'experience', 
    //     'school_attended', 
    //     'is_available',
    //     'password',
    // ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function timeSlot(){
        return $this->hasMany(Timeslot::class);
    }

    public function workingDays()
    {
        return $this->hasMany(WorkingDays::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }

    protected function casts(): array
    {
        return [
      
            'password' => 'hashed',
           
        ];
    }
    
  
}
