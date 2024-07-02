<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDays extends Model
{


    use HasFactory;

    // protected $fillable = ['user_id', 'is_working', 'day'];
    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    protected function casts(): array
    {
        return  [
            'is_working' => 'boolean'
        ];
    }
}
