<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',

        'image',
        'department_id',
        'cv',
        'experience',
        'school_attended',
        'is_available',

        'user_id',
        'blood_group',
        'genotype',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // 'image'=>'array',
        ];
    }
    
    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
    // public function doctor()
    // {
    //     return $this->hasOne(Doctor::class);
    // }

    // public function patient()
    // {
    //     return $this->hasOne(Patient::class);
    // }


}
