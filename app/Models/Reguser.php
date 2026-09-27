<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Reguser extends Model
{
    use HasFactory;
    protected $fillable=['name','email','password',
    'photo','phone','address' ,'type', 'money'];

    public function favoredExperts()
        {
        return $this->belongsToMany(Expert::class, 'reguser_favored_expert', 'reguser_id', 'expert_id', );
        }
}

