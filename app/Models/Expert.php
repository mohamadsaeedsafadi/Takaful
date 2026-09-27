<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'phone',
        'address',
        'time1',
        'time2',
        'experience',
        'consultation_type',
        'type',
        'rate',
        'fee',
        'money',
    ];

 public function scopeWhenFavoredById($query, $favoredById)
    {
        return $query->when($favoredById, function ($q) use ($favoredById) {

            return $q->whereHas('favoredByUsers', function($qu) use ($favoredById) {
                return  $qu->where('id', $favoredById);
            });

        });

    }
    public function favoredByUsers()
    {
        return $this->belongsToMany(Reguser::class, 'reguser_favored_expert', 'expert_id', 'reguser_id')->withTimestamps();
    }

    public function isFavoredById($user_id){
        return in_array($user_id, $this->favoredByUsers()->pluck('id')->toArray());
    }
}
