<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $fillable = [
        'expert_id',
        'name',
        'email',
        'photo',
        'phone',
        'money_transferred',
        'start_datetime',
        'end_datetime',
    ];
}
