<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abilitie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'allowed_usage', 'used_usage', 'subscription_id'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_abilities')
            ->withPivot('count') // اضافه کردن فیلد count به رابطه
            ->withTimestamps();
    }
}
